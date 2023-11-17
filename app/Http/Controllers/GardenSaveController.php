<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGardenSaveRequest;
use App\Models\Garden;
use App\Models\GardenSave;
use App\Models\User;
use Inertia\Inertia;

class GardenSaveController extends Controller
{
    /**
     * Save the game. API only request, returns 201.
     */
    public function store(StoreGardenSaveRequest $request, Garden $garden)
    {
        $gardenSave = $garden->saves()->create($request->validated());
        return response()->json(['id' => $gardenSave->id], 201);
    }

    /**
     * Delete save, redirect to GardenController@index
     */
    public function destroy(Garden $garden, GardenSave $gardenSave)
    {
        $gardenSave->delete();
        return redirect()->route('gardens.index');
    }
}
