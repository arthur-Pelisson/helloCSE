<?php

namespace App\Contracts;

use App\Models\profil;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\profil\StoreprofilRequest;
use App\Http\Requests\profil\UpdateprofilRequest;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Js;

interface ProfileInterface
{
    /**
     * Display a listing of the resource by role.
     *
     * @param Profil $profil
     * @return  JsonResponse
     */
    public function index(Request $request, Profil $profil): JsonResponse;

    /**
     * Store a newly created profil resource in storage.
     * @param StoreprofilRequest $request
     * @return JsonResponse
     */
    public function store(StoreprofilRequest $request): JsonResponse;

    /**
     * Display unique profil resource.
     *
     * @param profil $profil
     * @return JsonResponse
     */
    public function show(Profil $profil): JsonResponse;

    /**
     * Update the profil resource in storage.
     *
     * @param UpdateprofilRequest $request
     * @param profil $profil
     * @return JsonResponse
     */
    public function update(UpdateprofilRequest $request, profil $profil): JsonResponse;

    /**
     * Remove the profil resource from storage.
     *
     * @param profil $profil
     * @return JsonResponse
     */
    public function destroy(Profil $profil): JsonResponse;
}
