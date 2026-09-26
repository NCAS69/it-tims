<?php

namespace App\Http\Controllers;

use App\Models\ChecklistItem;
use App\Models\Finding;
use App\Models\Inspection;
use App\Models\InspectionPhoto;
use App\Models\InspectionResult;
use App\Models\InspectionTemplate;
use App\Models\Tower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InspectionController extends Controller
{
public function index()
{
    $inspections = Inspection::with([
        'tower.site',
        'template',
        'inspector',
    ])
        ->latest('inspection_date')
        ->latest('id')
        ->paginate(15);

    return view(
        'inspections.index',
        compact('inspections')
    );
}
    public function create()
{
    $towers = Tower::with('site')
        ->where('status', 'active')
        ->orderBy('name')
        ->get();

    $templates = InspectionTemplate::where(
        'is_active',
        true
    )
        ->orderBy('name')
        ->get();

        return view(
        'inspections.create',
        compact(
            'towers',
            'templates'
        )
    );
}

public function store(Request $request)
{
        $validated = $request->validate([
            'tower_id' => ['required', 'exists:towers,id'],
            'template_id' => ['required', 'exists:inspection_templates,id'],
            'inspection_date' => ['required', 'date'],
        ]);

        $inspectorId = auth()->id()
            ?? User::where(
                'email',
                'inspector@it-tims.local'
            )->value('id');

        if (!$inspectorId) {
            abort(500, 'Inspector belum tersedia.');
        }

        $inspection = DB::transaction(function () use (
            $validated,
            $inspectorId
        ) {
            do {
                $inspectionNumber =
                    'INS-' .
                    now()->format('Ymd-His') .
                    '-' .
                    Str::upper(Str::random(4));
            } while (
                Inspection::where(
                    'inspection_number',
                    $inspectionNumber
                )->exists()
            );

            $inspection = Inspection::create([
                'inspection_number' => $inspectionNumber,
                'tower_id' => $validated['tower_id'],
                'template_id' => $validated['template_id'],
                'inspector_id' => $inspectorId,
                'inspection_date' => $validated['inspection_date'],
                'start_time' => now()->format('H:i:s'),
                'status' => 'in_progress',
            ]);

            $checklistItems = ChecklistItem::where(
                'template_id',
                $validated['template_id']
            )
                ->orderBy('sort_order')
                ->get();

            foreach ($checklistItems as $item) {
                InspectionResult::create([
                    'inspection_id' => $inspection->id,
                    'checklist_item_id' => $item->id,
                    'status' => 'normal',
                ]);
            }

            return $inspection;
        });

        return redirect()->route(
            'inspections.show',
            $inspection
        );
    }

    public function show(Inspection $inspection)
    {
        $inspection->load([
            'tower.site',
            'template',
            'inspector',
            'results.checklistItem',
            'photos',
        ]);

        return view(
            'inspections.show',
            compact('inspection')
        );
    }

    public function updateResults(
        Request $request,
        Inspection $inspection
    ) {
        if ($inspection->status === 'completed') {
            return back()->withErrors([
                'results' =>
                    'Inspection sudah selesai dan checklist tidak dapat diubah lagi.',
            ]);
        }

        $validated = $request->validate([
            'results' => ['required', 'array'],
            'results.*.status' => [
                'required',
                'in:normal,abnormal,na',
            ],
            'results.*.notes' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        DB::transaction(function () use (
            $validated,
            $inspection
        ) {
            foreach (
                $validated['results']
                as $resultId => $resultData
            ) {
                $result = InspectionResult::where(
                    'inspection_id',
                    $inspection->id
                )
                    ->where('id', $resultId)
                    ->with('checklistItem')
                    ->firstOrFail();

                $result->update([
                    'status' => $resultData['status'],
                    'notes' => $resultData['notes'] ?? null,
                ]);

                if ($resultData['status'] === 'abnormal') {
                    $existingFinding = Finding::where(
                        'inspection_result_id',
                        $result->id
                    )->first();

                    if (!$existingFinding) {
                        do {
                            $findingNumber =
                                'FND-' .
                                now()->format('Ymd-His') .
                                '-' .
                                Str::upper(Str::random(4));
                        } while (
                            Finding::where(
                                'finding_number',
                                $findingNumber
                            )->exists()
                        );

                        Finding::create([
                            'inspection_id' => $inspection->id,
                            'inspection_result_id' => $result->id,
                            'finding_number' => $findingNumber,
                            'title' =>
                                $result->checklistItem->item,
                            'description' =>
                                $resultData['notes']
                                ?: 'Ditemukan kondisi abnormal pada item inspeksi.',
                            'severity' => 'medium',
                            'recommendation' =>
                                'Lakukan pemeriksaan dan tindak lanjut terhadap kondisi abnormal.',
                            'status' => 'open',
                        ]);
                    }
                }

                if ($resultData['status'] !== 'abnormal') {
                    Finding::where(
                        'inspection_result_id',
                        $result->id
                    )
                        ->whereIn(
                            'status',
                            ['open', 'on_progress']
                        )
                        ->delete();
                }
            }

            $hasAbnormal = InspectionResult::where(
                'inspection_id',
                $inspection->id
            )
                ->where('status', 'abnormal')
                ->exists();

            $inspection->update([
                'overall_status' => $hasAbnormal
                    ? 'abnormal'
                    : 'normal',
            ]);
        });

        return redirect()
            ->route(
                'inspections.show',
                $inspection
            )
            ->with(
                'success',
                'Hasil inspeksi berhasil disimpan.'
            );
    }

    public function uploadPhotos(
        Request $request,
        Inspection $inspection
    ) {
        if ($inspection->status === 'completed') {
            return back()->withErrors([
                'photos' =>
                    'Inspection sudah selesai dan tidak dapat ditambahkan foto baru.',
            ]);
        }

        $validated = $request->validate([
            'photos' => [
                'required',
                'array',
                'min:1',
            ],
            'photos.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:20480',
            ],
            'inspection_result_id' => [
                'nullable',
                'exists:inspection_results,id',
            ],
            'caption' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        if (!empty($validated['inspection_result_id'])) {
            $resultBelongsToInspection =
                InspectionResult::where(
                    'id',
                    $validated['inspection_result_id']
                )
                    ->where(
                        'inspection_id',
                        $inspection->id
                    )
                    ->exists();

            if (!$resultBelongsToInspection) {
                abort(
                    422,
                    'Checklist tidak sesuai dengan inspection.'
                );
            }
        }

        $uploadedBy = auth()->id()
            ?? User::where(
                'email',
                'inspector@it-tims.local'
            )->value('id');

        if (!$uploadedBy) {
            abort(500, 'User uploader belum tersedia.');
        }

        foreach (
            $request->file('photos', [])
            as $photo
        ) {
            $fileName =
                Str::uuid() .
                '.' .
                $photo->getClientOriginalExtension();

            $filePath = $photo->storeAs(
                "inspections/{$inspection->id}",
                $fileName,
                'public'
            );

            InspectionPhoto::create([
                'inspection_id' => $inspection->id,
                'inspection_result_id' =>
                    $validated['inspection_result_id']
                    ?? null,
                'file_path' => $filePath,
                'file_name' =>
                    $photo->getClientOriginalName(),
                'caption' =>
                    $validated['caption'] ?? null,
                'uploaded_by' => $uploadedBy,
            ]);
        }

        return redirect()
            ->route(
                'inspections.show',
                $inspection
            )
            ->with(
                'success',
                'Foto inspeksi berhasil diupload.'
            );
    }

    public function destroyPhoto(
        Inspection $inspection,
        InspectionPhoto $photo
    ) {
        if ($inspection->status === 'completed') {
            return back()->withErrors([
                'photo' =>
                    'Foto tidak dapat dihapus karena inspection sudah completed.',
            ]);
        }

        if ($photo->inspection_id !== $inspection->id) {
            abort(404);
        }

        if (
            $photo->file_path &&
            Storage::disk('public')->exists(
                $photo->file_path
            )
        ) {
            Storage::disk('public')->delete(
                $photo->file_path
            );
        }

        $photo->delete();

        return redirect()
            ->route(
                'inspections.show',
                $inspection
            )
            ->with(
                'success',
                'Foto inspection berhasil dihapus.'
            );
    }

    public function complete(Inspection $inspection)
    {
        if ($inspection->status === 'completed') {
            return redirect()
                ->route(
                    'inspections.show',
                    $inspection
                )
                ->with(
                    'success',
                    'Inspection sudah berstatus completed.'
                );
        }

        $hasResults = $inspection
            ->results()
            ->exists();

        if (!$hasResults) {
            return back()->withErrors([
                'inspection' =>
                    'Inspection belum memiliki checklist.',
            ]);
        }

        $hasAbnormal = $inspection
            ->results()
            ->where('status', 'abnormal')
            ->exists();

        $inspection->update([
            'status' => 'completed',
            'end_time' => now()->format('H:i:s'),
            'overall_status' => $hasAbnormal
                ? 'abnormal'
                : 'normal',
        ]);

        return redirect()
            ->route(
                'inspections.show',
                $inspection
            )
            ->with(
                'success',
                'Inspection berhasil diselesaikan.'
            );
    }
}