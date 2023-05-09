<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request) {
        // Je récupère les informations de connexion
        $credentials = $request->validated();
        // Le auth attempt va essayer de connecter l'utilisateur
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            // Le intented sert a renvoyer sur le lien sur lequel l'utilisateur été avant de se faire rediriger sur la page de login, s'il n'y en a pas on retourne une autre route
            return redirect()->intended(route('recipe.index'));
        };
        
        return to_route('auth.login')->withErrors([
            'email' => 'Email invalide'
            // on lui passe l'ancienne valeur
        ])->onlyInput('email');

    }

    public function logout(){
        Auth::logout();
        return to_route('auth.login');
    }
}
