<?php

namespace App\Contracts;

use Illuminate\Http\Request;
use App\Http\Requests\profil\StoreprofilRequest;
use App\Http\Requests\profil\UpdateprofilRequest;
use App\Models\profil;

interface ProfileInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index();

     /**
     * Display a listing of the resource for Admin.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function indexAdmin();

    /**
     * Display a listing of the resource for Guest.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function indexGuest();

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreprofilRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(StoreprofilRequest $request);

    /**
     * Display the specified resource.
     *
     * @param profil $profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(profil $id);

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateprofilRequest $request
     * @param profil $profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateprofilRequest $request, profil $profil);

    /**
     * Remove the specified resource from storage.
     *
     * @param profil $profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(profil $profil);
}