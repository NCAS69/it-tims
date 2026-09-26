<?php

namespace App\Http\Controllers;

use App\Models\Finding;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorkOrderController extends Controller
{
    public function index()
{
    $workOrders = WorkOrder::with([
        'finding.inspection.tower.site',
        'assignee',
    ])
        ->latest()
        ->paginate(15);

    return view(
        'work-orders.index',
        compact('workOrders')
    );
}
    public function create(Finding $finding)
    {
        $finding->load([
            'inspection.tower.site',
        ]);

        $users = User::orderBy('name')->get();

        return view('work-orders.create', compact(
            'finding',
            'users'
        ));
    }

    public function store(Request $request, Finding $finding)
    {
        $validated = $request->validate([
            'assigned_to' => [
                'nullable',
                'exists:users,id',
            ],
            'description' => [
                'required',
                'string',
                'max:5000',
            ],
            'priority' => [
                'required',
                'in:low,medium,high,critical',
            ],
            'start_date' => [
                'nullable',
                'date',
            ],
            'due_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
        ]);

        $workOrder = DB::transaction(function () use (
            $validated,
            $finding
        ) {
            do {
                $workOrderNumber =
                    'WO-' .
                    now()->format('Ymd-His') .
                    '-' .
                    Str::upper(Str::random(4));
            } while (
                WorkOrder::where(
                    'work_order_number',
                    $workOrderNumber
                )->exists()
            );

            $workOrder = WorkOrder::create([
                'finding_id' => $finding->id,
                'work_order_number' => $workOrderNumber,
                'assigned_to' => $validated['assigned_to'] ?? null,
                'description' => $validated['description'],
                'priority' => $validated['priority'],
                'start_date' => $validated['start_date'] ?? null,
                'due_date' => $validated['due_date'] ?? null,
                'status' => !empty($validated['assigned_to'])
                    ? 'assigned'
                    : 'open',
            ]);

            if ($finding->status === 'open') {
                $finding->update([
                    'status' => 'on_progress',
                ]);
            }

            return $workOrder;
        });

        return redirect()
            ->route('work-orders.show', $workOrder)
            ->with(
                'success',
                'Work Order ' .
                $workOrder->work_order_number .
                ' berhasil dibuat.'
            );
    }

    public function show(WorkOrder $workOrder)
    {
        $workOrder->load([
            'finding.inspection.tower.site',
            'finding.inspectionResult.checklistItem',
            'assignee',
            'maintenanceRecords.asset',
            'maintenanceRecords.technician',
        ]);

        $users = User::orderBy('name')->get();

        return view('work-orders.show', compact(
            'workOrder',
            'users'
        ));
    }

    public function updateStatus(
        Request $request,
        WorkOrder $workOrder
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:open,assigned,on_progress,completed,cancelled',
            ],
        ]);

        DB::transaction(function () use (
            $validated,
            $workOrder
        ) {
            $status = $validated['status'];

            $workOrder->update([
                'status' => $status,
                'completed_date' => $status === 'completed'
                    ? now()->toDateString()
                    : $workOrder->completed_date,
            ]);

            $finding = $workOrder->finding;

            if (!$finding) {
                return;
            }

            if ($status === 'completed') {
                $finding->update([
                    'status' => 'resolved',
                    'resolved_at' => now(),
                ]);
            }

            if ($status === 'cancelled') {
                $finding->update([
                    'status' => 'open',
                ]);
            }

            if (
                in_array(
                    $status,
                    ['assigned', 'on_progress'],
                    true
                )
            ) {
                $finding->update([
                    'status' => 'on_progress',
                ]);
            }
        });

        return redirect()
            ->route('work-orders.show', $workOrder)
            ->with(
                'success',
                'Status Work Order berhasil diperbarui.'
            );
    }
}