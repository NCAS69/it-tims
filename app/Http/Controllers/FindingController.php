<?php

namespace App\Http\Controllers;

use App\Models\Finding;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FindingController extends Controller
{
    public function index()
    {
        $findings = Finding::with([
            'inspection.tower.site',
            'assignee',
        ])
            ->latest()
            ->paginate(10);

        return view('findings.index', compact('findings'));
    }

    public function show(Finding $finding)
    {
        $finding->load([
            'inspection.tower.site',
            'inspectionResult.checklistItem',
            'assignee',
            'photos',
            'workOrders',
        ]);

        $users = User::orderBy('name')->get();

        return view('findings.show', compact(
            'finding',
            'users'
        ));
    }

    public function updateStatus(
        Request $request,
        Finding $finding
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:open,on_progress,resolved,verified,closed',
            ],
        ]);

        $newStatus = $validated['status'];
        $currentStatus = $finding->status;

        $allowedTransitions = [
            'open' => [
                'open',
                'on_progress',
            ],

            'on_progress' => [
                'open',
                'on_progress',
                'resolved',
            ],

            'resolved' => [
                'on_progress',
                'resolved',
                'verified',
            ],

            'verified' => [
                'resolved',
                'verified',
                'closed',
            ],

            'closed' => [
                'verified',
                'closed',
            ],
        ];

        if (
            !isset($allowedTransitions[$currentStatus]) ||
            !in_array(
                $newStatus,
                $allowedTransitions[$currentStatus],
                true
            )
        ) {
            return back()->withErrors([
                'status' =>
                    "Perubahan status dari {$currentStatus} ke {$newStatus} tidak diperbolehkan.",
            ]);
        }

        DB::transaction(function () use (
            $finding,
            $newStatus
        ) {
            $data = [
                'status' => $newStatus,
            ];

            if ($newStatus === 'resolved') {
                $data['resolved_at'] =
                    $finding->resolved_at ?? now();

                $data['verified_at'] = null;
            }

            if ($newStatus === 'verified') {
                $data['resolved_at'] =
                    $finding->resolved_at ?? now();

                $data['verified_at'] =
                    $finding->verified_at ?? now();
            }

            if ($newStatus === 'closed') {
                $data['resolved_at'] =
                    $finding->resolved_at ?? now();

                $data['verified_at'] =
                    $finding->verified_at ?? now();
            }

            if (
                in_array(
                    $newStatus,
                    ['open', 'on_progress'],
                    true
                )
            ) {
                $data['resolved_at'] = null;
                $data['verified_at'] = null;
            }

            if ($newStatus === 'resolved') {
                $data['verified_at'] = null;
            }

            $finding->update($data);
        });

        return redirect()
            ->route('findings.show', $finding)
            ->with(
                'success',
                'Status finding berhasil diperbarui.'
            );
    }
}