<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Finding;
use App\Models\MaintenanceRecord;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceRecordController extends Controller
{
    public function index()
{
    $maintenanceRecords = MaintenanceRecord::with([
        'workOrder.finding.inspection.tower.site',
        'asset',
        'technician',
    ])
        ->latest('maintenance_date')
        ->latest('id')
        ->paginate(15);

    return view(
        'maintenance.index',
        compact('maintenanceRecords')
    );
}	
    public function create(WorkOrder $workOrder)
    {
        $workOrder->load([
            'finding.inspection.tower.site',
        ]);

        $assets = Asset::where(
            'tower_id',
            $workOrder->finding->inspection->tower_id
        )
            ->whereNotIn('status', ['retired'])
            ->orderBy('name')
            ->get();

        $technicians = User::orderBy('name')->get();

        return view('maintenance.create', compact(
            'workOrder',
            'assets',
            'technicians'
        ));
    }

    public function store(Request $request, WorkOrder $workOrder)
    {
        $validated = $request->validate([
            'asset_id' => [
                'required',
                'exists:assets,id',
            ],
            'technician_id' => [
                'required',
                'exists:users,id',
            ],
            'action' => [
                'required',
                'string',
                'max:5000',
            ],
            'result' => [
                'nullable',
                'string',
                'max:5000',
            ],
            'parts_used' => [
                'nullable',
                'string',
                'max:5000',
            ],
            'cost' => [
                'required',
                'numeric',
                'min:0',
            ],
            'maintenance_date' => [
                'required',
                'date',
            ],
        ]);

        $assetBelongsToTower = Asset::where('id', $validated['asset_id'])
            ->where(
                'tower_id',
                $workOrder->finding->inspection->tower_id
            )
            ->exists();

        if (!$assetBelongsToTower) {
            return back()
                ->withErrors([
                    'asset_id' => 'Asset tidak sesuai dengan tower pada finding ini.',
                ])
                ->withInput();
        }

        $maintenanceRecord = DB::transaction(function () use (
            $validated,
            $workOrder
        ) {
            return MaintenanceRecord::create([
                'work_order_id' => $workOrder->id,
                'asset_id' => $validated['asset_id'],
                'technician_id' => $validated['technician_id'],
                'action' => $validated['action'],
                'result' => $validated['result'] ?? null,
                'parts_used' => $validated['parts_used'] ?? null,
                'cost' => $validated['cost'],
                'maintenance_date' => $validated['maintenance_date'],
            ]);
        });

        return redirect()
            ->route(
                'findings.show',
                $workOrder->finding
            )
            ->with(
                'success',
                'Maintenance record berhasil disimpan.'
            );
    }
}