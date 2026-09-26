<?php

namespace App\Http\Controllers;

use App\Models\ChecklistItem;
use App\Models\InspectionTemplate;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    private function requireAdmin(): void
    {
        abort_unless(
            auth()->check()
                && auth()->user()->username === 'admin',
            403,
            'Hanya Supervisor yang dapat mengelola checklist.'
        );
    }

    public function index()
    {
        $checklists = ChecklistItem::with('template')
            ->orderBy('template_id')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view(
            'checklists.index',
            compact('checklists')
        );
    }

    public function create()
    {
        $this->requireAdmin();

        $templates = InspectionTemplate::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        return view(
            'checklists.create',
            compact('templates')
        );
    }

    public function store(Request $request)
    {
        $this->requireAdmin();

        $validated = $request->validate([
            'template_id' => [
                'required',
                'exists:inspection_templates,id',
            ],
            'category' => [
                'required',
                'string',
                'max:255',
            ],
            'item' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'sort_order' => [
                'nullable',
                'integer',
                'min:1',
            ],
            'is_required' => [
                'nullable',
                'boolean',
            ],
        ]);

        $sortOrder = $validated['sort_order']
            ?? (
                ChecklistItem::where(
                    'template_id',
                    $validated['template_id']
                )->max('sort_order') + 1
            );

        ChecklistItem::create([
            'template_id' => $validated['template_id'],
            'category' => $validated['category'],
            'item' => $validated['item'],
            'description' => $validated['description'] ?? null,
            'input_type' => 'status',
            'sort_order' => $sortOrder,
            'is_required' => $request->boolean('is_required'),
        ]);

        return redirect()
            ->route('checklists.index')
            ->with(
                'success',
                'Checklist berhasil ditambahkan.'
            );
    }

    public function edit(ChecklistItem $checklist)
    {
        $this->requireAdmin();

        $templates = InspectionTemplate::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        return view(
            'checklists.edit',
            compact(
                'checklist',
                'templates'
            )
        );
    }

    public function update(
        Request $request,
        ChecklistItem $checklist
    ) {
        $this->requireAdmin();

        $validated = $request->validate([
            'template_id' => [
                'required',
                'exists:inspection_templates,id',
            ],
            'category' => [
                'required',
                'string',
                'max:255',
            ],
            'item' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'sort_order' => [
                'required',
                'integer',
                'min:1',
            ],
            'is_required' => [
                'nullable',
                'boolean',
            ],
        ]);

        $checklist->update([
            'template_id' => $validated['template_id'],
            'category' => $validated['category'],
            'item' => $validated['item'],
            'description' => $validated['description'] ?? null,
            'input_type' => 'status',
            'sort_order' => $validated['sort_order'],
            'is_required' => $request->boolean('is_required'),
        ]);

        return redirect()
            ->route('checklists.index')
            ->with(
                'success',
                'Checklist berhasil diperbarui.'
            );
    }
}