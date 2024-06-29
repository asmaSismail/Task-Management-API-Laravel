<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Hash;
use \App\Http\Requests\StoreUserRequest;
use \App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request){
        $request->validated($request->all());

        if (!Auth::attempt($request->only(['email','password'])))
        {
            return $this->error('','erreur de saisie',403);
        }

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('token of ' . $user->name)->plainTextToken; 

        return $this->success([
            'user' => $user,
            'token' => $token,
        ]);

    }

    public function register(StoreUserRequest $request){
       
        // Validate the request data 

        $request->validated($request->only(['name', 'email', 'password','is_admin']));

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
        ]);

        //Generate token
        $token = $user->createToken('token of ' . $user->name)->plainTextToken; 

        return $this->success([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(){
        Auth::user()->currentAccessToken()->delete();
        return $this->success([
         'message'=>'vous etes déconnecter',
        ]);
       
    }
}
