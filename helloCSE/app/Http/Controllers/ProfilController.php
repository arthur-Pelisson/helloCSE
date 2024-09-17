<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreprofilRequest;
use App\Http\Requests\UpdateprofilRequest;
use App\Models\profil;
use App\Contracts\ProfileInterface;
class ProfilController extends Controller implements ProfileInterface
{
    public function index()
    {
        return profil::all();
    }

    public function store(StoreprofilRequest $request)
    {
        $validated = $request->validated();
        return profil::create($validated);
    }

    public function show(profil $profil)
    {
        return $profil;
    }

    public function update(UpdateprofilRequest $request, profil $profil)
    {
        $validated = $request->validated();
        $profil->update($validated);
        return $profil;
    }

    public function destroy(profil $profil)
    {
        $profil->delete();
        return response()->json([], 204);
    }
}
