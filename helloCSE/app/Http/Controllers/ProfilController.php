<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreprofilRequest;
use App\Http\Requests\UpdateprofilRequest;
use App\Models\Profil;
use App\Contracts\ProfileInterface;
class ProfilController extends Controller implements ProfileInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(profil::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreprofilRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreprofilRequest $request)
    {
        $validated = $request->validated();
        return response()->json(profil::create($validated), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param profil $profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(profil $profil)
    {
        return response()->json($profil, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateprofilRequest $request
     * @param profil $profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateprofilRequest $request, profil $profil)
    {
        $validated = $request->validated();
        $profil->update($validated);
        return response()->json($profil, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param profil $profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(profil $profil)
    {
        $profil->delete();
        return response()->json([], 204);
    }
}
