<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TowerController extends Controller
{
    public function index()
    {
        $towers = Tower::with('site')
            ->latest()
            ->paginate(15);

        return view(
            'towers.index',
            compact('towers')
        );
    }

    public function create()
    {
        $sites = Site::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view(
            'towers.create',
            compact('sites')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_id' => [
                'required',
                'exists:sites,id',
            ],
            'code' => [
                'required',
                'string',
                'max:255',
                'unique:towers,code',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'tower_type' => [
                'nullable',
                'string',
                'max:255',
            ],
            'height' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'installation_date' => [
                'nullable',
                'date',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'status' => [
                'required',
                'in:active,inactive,maintenance',
            ],
        ]);

        $tower = new Tower();

        $tower->site_id = $validated['site_id'];
        $tower->code = $validated['code'];
        $tower->name = $validated['name'];
        $tower->tower_type =
            $validated['tower_type'] ?? null;
        $tower->height =
            $validated['height'] ?? null;
        $tower->installation_date =
            $validated['installation_date'] ?? null;
        $tower->description =
            $validated['description'] ?? null;
        $tower->status =
            $validated['status'];

        $tower->save();

        return redirect()
            ->route('towers.index')
            ->with(
                'success',
                'Tower berhasil ditambahkan.'
            );
    }

    public function edit(Tower $tower)
    {
        $sites = Site::orderBy('name')
            ->get();

        return view(
            'towers.edit',
            compact(
                'tower',
                'sites'
            )
        );
    }

    public function update(
        Request $request,
        Tower $tower
    ) {
        $validated = $request->validate([
            'site_id' => [
                'required',
                'exists:sites,id',
            ],
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('towers', 'code')
                    ->ignore($tower->id),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'tower_type' => [
                'nullable',
                'string',
                'max:255',
            ],
            'height' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'installation_date' => [
                'nullable',
                'date',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'status' => [
                'required',
                'in:active,inactive,maintenance',
            ],
        ]);

        $tower->site_id = $validated['site_id'];
        $tower->code = $validated['code'];
        $tower->name = $validated['name'];
        $tower->tower_type =
            $validated['tower_type'] ?? null;
        $tower->height =
            $validated['height'] ?? null;
        $tower->installation_date =
            $validated['installation_date'] ?? null;
        $tower->description =
            $validated['description'] ?? null;
        $tower->status =
            $validated['status'];

        $tower->save();

        return redirect()
            ->route('towers.index')
            ->with(
                'success',
                'Tower berhasil diperbarui.'
            );
    }
}