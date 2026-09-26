<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with([
            'tower.site',
            'category',
        ])
            ->latest()
            ->paginate(15);

        return view(
            'assets.index',
            compact('assets')
        );
    }

    public function create()
    {
        $towers = Tower::with('site')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $categories = AssetCategory::orderBy('name')
            ->get();

        return view(
            'assets.create',
            compact(
                'towers',
                'categories'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tower_id' => [
                'required',
                'exists:towers,id',
            ],
            'category_id' => [
                'required',
                'exists:asset_categories,id',
            ],
            'asset_code' => [
                'required',
                'string',
                'max:255',
                'unique:assets,asset_code',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'brand' => [
                'nullable',
                'string',
                'max:255',
            ],
            'model' => [
                'nullable',
                'string',
                'max:255',
            ],
            'serial_number' => [
                'nullable',
                'string',
                'max:255',
            ],
            'ip_address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'mac_address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'installation_date' => [
                'nullable',
                'date',
            ],
            'status' => [
                'required',
                'in:active,inactive,maintenance,damaged,retired',
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ]);

        Asset::create($validated);

        return redirect()
            ->route('assets.index')
            ->with(
                'success',
                'Asset berhasil ditambahkan.'
            );
    }

    public function edit(Asset $asset)
    {
        $towers = Tower::with('site')
            ->orderBy('name')
            ->get();

        $categories = AssetCategory::orderBy('name')
            ->get();

        return view(
            'assets.edit',
            compact(
                'asset',
                'towers',
                'categories'
            )
        );
    }

    public function update(
        Request $request,
        Asset $asset
    ) {
        $validated = $request->validate([
            'tower_id' => [
                'required',
                'exists:towers,id',
            ],
            'category_id' => [
                'required',
                'exists:asset_categories,id',
            ],
            'asset_code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('assets', 'asset_code')
                    ->ignore($asset->id),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'brand' => [
                'nullable',
                'string',
                'max:255',
            ],
            'model' => [
                'nullable',
                'string',
                'max:255',
            ],
            'serial_number' => [
                'nullable',
                'string',
                'max:255',
            ],
            'ip_address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'mac_address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'installation_date' => [
                'nullable',
                'date',
            ],
            'status' => [
                'required',
                'in:active,inactive,maintenance,damaged,retired',
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $asset->update($validated);

        return redirect()
            ->route('assets.index')
            ->with(
                'success',
                'Asset berhasil diperbarui.'
            );
    }
}