<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkshopRequest;
use App\Models\Workshop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.workshops.index', [
            'workshops' => Workshop::withCount('registrations')->latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.workshops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkshopRequest $request): RedirectResponse
    {
        Workshop::create($request->validated());

        return to_route('admin.workshops.index')->with('success', 'Workshop berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workshop $workshop): View
    {
        return view('admin.workshops.edit', compact('workshop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkshopRequest $request, Workshop $workshop): RedirectResponse
    {
        $workshop->update($request->validated());

        return to_route('admin.workshops.index')->with('success', 'Workshop berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workshop $workshop): RedirectResponse
    {
        $deleted = DB::transaction(function () use ($workshop): bool {
            $workshop = Workshop::query()->lockForUpdate()->findOrFail($workshop->id);

            if ($workshop->registrations()->exists()) {
                return false;
            }

            $workshop->delete();

            return true;
        });

        if (! $deleted) {
            return to_route('admin.workshops.index')->with('error', 'Workshop memiliki pendaftar dan tidak dapat dihapus.');
        }

        return to_route('admin.workshops.index')->with('success', 'Workshop berhasil dihapus.');
    }
}
