<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AdminAuthController extends Controller
{


    public function register(Request $request){
        // validate the request data
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'email'=>'required|string|email|unique:administrateurs',
            'password'=>'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $AdminDataRegister = $validator->validated();
        // create the admin
        $admin = Administrateur::create([
            'name' => $AdminDataRegister['name'],
            'email' => $AdminDataRegister['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($AdminDataRegister['password']),
        ]);

        if (!$admin) {
            return response()->json([
                'message' => 'A problem occured while creating the admin',
            ], 500);
        }

        return response()->json([
            'message' => 'Administrateur created',
        ], 201);
    }

    public function login(Request $request){
        // validate the request data
        $validator = Validator::make($request->all(), [
            'email'=>'required|string|email',
            'password'=>'required|string'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $loginAdminData = $validator->validated();

        // check if the admin exists
        $admin = Administrateur::where('email',$loginAdminData['email'])->first();
        if(!$admin || !Hash::check($loginAdminData['password'],$admin->password)){
            return response()->json([
                'message' => 'Bad credentials'
            ],401);
        }

        // create a token for the admin
        $token = $admin->createToken('admin_token')->plainTextToken;

        return response()->json([
            'token' => $token
        ],200);
    }

    public function logout(Request $request){
        // revoke the token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ], 200);
    }
}
