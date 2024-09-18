<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreprofilRequest;
use App\Http\Requests\UpdateprofilRequest;
use App\Models\Profil;
use App\Contracts\ProfileInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\Collection;
class ProfilController extends Controller implements ProfileInterface
{
    use AuthorizesRequests;

    // Define the roles and the corresponding methods
    // we could do middlewar to check the role but overkill to do it here
    private $roles = [
        "ADMIN" => "indexAdmin",
        "GUEST" => "indexGuest"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $isAdmin = (new AdminContoller)->isAdmin();
        $role = $isAdmin ? "ADMIN" : "GUEST";
        $method = $this->roles[$role];
        return $this->$method();
    }

    public function indexAdmin()
    {
        $profils = Profil::all();
        $this->encodeImage($profils, 'image');
        return response()->json($profils, 200);
    }
    

    public function indexGuest()
    {
        $profils = Profil::where('statut', 'actif')->get();
        // Encode the image to base64 to display it in the json response
        $this->encodeImage($profils, 'image');
        return response()->json(['data' => $profils], 200);
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

    /**
     * Encode the image to base64 to display it in the json response
     *
     * @param Collection $profils
     * @param string $target
     * @return void
     */protected function encodeImage(Collection &$profils, string $target): void
    {
        foreach ($profils as $profil) {
            if (isset($profil->$target)) {
                $imageBase64 = base64_encode($profil->$target);
                $profil->$target = $imageBase64;
            }
        }
    }
}
