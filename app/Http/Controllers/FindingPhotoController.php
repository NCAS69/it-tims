<?php

namespace App\Http\Controllers;

use App\Models\Finding;
use App\Models\FindingPhoto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FindingPhotoController extends Controller
{
    public function store(Request $request, Finding $finding)
    {
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
            'caption' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $uploadedBy = auth()->id()
            ?? User::where(
                'email',
                'inspector@it-tims.local'
            )->value('id');

        if (!$uploadedBy) {
            abort(500, 'User uploader belum tersedia.');
        }

        foreach ($request->file('photos', []) as $photo) {

            $fileName =
                Str::uuid() .
                '.' .
                $photo->getClientOriginalExtension();

            $filePath = $photo->storeAs(
                "findings/{$finding->id}",
                $fileName,
                'public'
            );

            FindingPhoto::create([
                'finding_id' => $finding->id,
                'file_path' => $filePath,
                'file_name' => $photo->getClientOriginalName(),
                'caption' => $validated['caption'] ?? null,
                'uploaded_by' => $uploadedBy,
            ]);
        }

        return redirect()
            ->route('findings.show', $finding)
            ->with(
                'success',
                'Foto finding berhasil diupload.'
            );
    }

    public function destroy(
        Finding $finding,
        FindingPhoto $photo
    ) {
        if ($photo->finding_id !== $finding->id) {
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
            ->route('findings.show', $finding)
            ->with(
                'success',
                'Foto finding berhasil dihapus.'
            );
    }
}