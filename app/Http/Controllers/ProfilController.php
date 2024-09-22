<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\profil\StoreprofilRequest;
use App\Http\Requests\profil\UpdateprofilRequest;
use App\Models\Profil;
use App\Contracts\ProfileInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller implements ProfileInterface
{
    use AuthorizesRequests;

    /**
     * The roles dispatcher
     * To simplify the code, we use a dispatcher to call the right method
     * @var array
     */
    
    private $rolesDispatcher = [
        "ADMIN" => "indexAdmin",
        "GUEST" => "indexGuest"
    ];
    /**
     * Display a listing of the resource by role.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $isAdmin = (new AdminContoller)->isAdmin();
        $role = $isAdmin ? "ADMIN" : "GUEST";
        $method = $this->rolesDispatcher[$role];
        return $this->$method();
    }

    /**
     * Display a listing of the resource for Admin.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function indexAdmin()
    {
        $profils = Profil::all();
        // Encode the image to base64 to display it in the json response
        $this->encodeImage($profils, 'image');
        return response()->json($profils, 200);
    }
    

    /**
     * Display a listing of the resource for Guest.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function indexGuest()
    {
        $profils = Profil::where('statut', 'actif')->get();
        //remove the statut field from the response
        $profils->makeHidden(['statut']);
        // Encode the image to base64 to display it in the json response
        $this->encodeImage($profils, 'image');
        return response()->json($profils, 200);
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
        if (isset($validated['image'])) {
            $validated['image'] = base64_decode($validated['image']);
        }
        $newProfil = Profil::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'image' => $validated['image'],
            'statut' => $validated['statut'],
            
        ]);

        if (!$newProfil) {
            return response()->json(["message" => "An error occured"], 500);
        }
        return response()->json(["message" => "Profile create"], 201);
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

        if (isset($validated['image'])) {
            $validated['image'] = base64_decode($validated['image']);
        }

        $profil->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'image' => $validated['image'],
            'statut' => $validated['statut'],
        ]);
        if ($profil->wasChanged()) {
            return response()->json(["message" => "Profile updated"], 200);
        }

        return response()->json(["message" => "An error occured"], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param profil $profil
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(profil $profil)
    {
        $delete = $profil->delete();
        if ($delete) {
            return response()->json(["message" => "Profile deleted"], 200);
        }
        return response()->json(["message" => "An error occured"], 500);
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
