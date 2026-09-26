<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\ChecklistItem;
use App\Models\Finding;
use App\Models\Inspection;
use App\Models\Site;
use App\Models\Tower;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'sites' => Site::count(),
            'towers' => Tower::count(),
            'assets' => Asset::count(),
            'inspections' => Inspection::count(),
            'open_findings' => Finding::whereIn('status', [
                'open',
                'on_progress',
            ])->count(),
        ];

        $checklistItems = ChecklistItem::with('template')
            ->orderBy('template_id')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $checklistCount = $checklistItems->count();

        return view(
            'dashboard.index',
            compact(
                'stats',
                'checklistItems',
                'checklistCount'
            )
        );
    }
}