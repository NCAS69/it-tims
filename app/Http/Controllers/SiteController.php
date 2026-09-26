<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::withCount('towers')
            ->latest()
            ->paginate(15);

        return view(
            'sites.index',
            compact('sites')
        );
    }

    public function create()
    {
        return view('sites.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:255',
                'unique:sites,code',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'location' => [
                'nullable',
                'string',
                'max:255',
            ],
            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],
            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        $site = new Site();

        $site->code = $validated['code'];
        $site->name = $validated['name'];
        $site->location = $validated['location'] ?? null;
        $site->latitude = $validated['latitude'] ?? null;
        $site->longitude = $validated['longitude'] ?? null;
        $site->description = $validated['description'] ?? null;
        $site->status = $validated['status'];

        $site->save();

        return redirect()
            ->route('sites.index')
            ->with(
                'success',
                'Site berhasil ditambahkan.'
            );
    }

    public function edit(Site $site)
    {
        return view(
            'sites.edit',
            compact('site')
        );
    }

    public function update(
        Request $request,
        Site $site
    ) {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sites', 'code')
                    ->ignore($site->id),
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'location' => [
                'nullable',
                'string',
                'max:255',
            ],
            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],
            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'status' => [
                'required',
                'in:active,inactive',
            ],
        ]);

        $site->code = $validated['code'];
        $site->name = $validated['name'];
        $site->location = $validated['location'] ?? null;
        $site->latitude = $validated['latitude'] ?? null;
        $site->longitude = $validated['longitude'] ?? null;
        $site->description = $validated['description'] ?? null;
        $site->status = $validated['status'];

        $site->save();

        return redirect()
            ->route('sites.index')
            ->with(
                'success',
                'Site berhasil diperbarui.'
            );
    }
}