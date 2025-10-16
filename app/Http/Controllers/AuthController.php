<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {

        $credentials = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> Hash::make($request->password)
        ]);

        // $token = $user->createToken('my-app-token');

        return response()->json($user,201);

    }

    public function login(Request $request) {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Identifiants invalides'], 401);
        }

        $user = User::where('email', $request->email)->first();

        // if (! $user) return response()->json([
        //     'message' => 'Utilisateur non trouvé'
        // ],404);

        return response()->json([
            'token' => $token,
            'user_id' => $user->id
        ],201);

    }

    public function logout() {
        Auth::logout();

        return response()->json(['message' => 'Déconnecté avec succèss']);
    }
}
