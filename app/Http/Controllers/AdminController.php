<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function accueil(){

        return view('agent.accueil');
        
    }
    public function login(){

        return view('agent.login');
    }

    public function handleLogin(Request $adminConnect){

        $validateAdmin = $adminConnect->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.email' => '* L\'adresse email saisi est non valide.',
            'email.required' => '* Veuillez saisir votre adresse email.',
            'password.required' => '* Veuillez saisir votre mot de passe.',
        ]);

        if ($validateAdmin) {
            if (Auth::attempt($validateAdmin)) {
                $adminConnect->session()->regenerate();
    
                return redirect()->intended('accueil');
            }
            else{
                dd(Hash::make(0));
                // dd(($credentials['password']==$admin->password));

                return redirect()->back()->with('error', '* L\'email saisi n\'existe pas ');
            }
        } else {
            return redirect()->back()->withErrors($validateAdmin)->withInput();
        }
        
           
    }
    
    public function forgot_password(){
        
        return view('admin.forgotPass');
    }
    
    public function sendResetLinkEmail(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();
        
        if (!$admin) {
            // L'utilisateur n'existe pas
            return redirect()->back()->with('error', 'Adresse email invalide.');
        }
        
        // Générer un jeton de réinitialisation de mot de passe et l'enregistrer dans la table password_resets
        $token = \Illuminate\Support\Facades\Password::createToken($admin);
        
        // Envoyer l'email de réinitialisation du mot de passe
        $admin->sendPasswordResetNotification($token);
        
        return redirect()->back()->with('success', 'Un email de réinitialisation du mot de passe a été envoyé à votre adresse email.');
    }
    
    public function reset_password(){
        
        return view('admin.resetPass');
    }
    public function register_new_password(Request $passwords){
    
        $validatePass = $passwords->validate([
            'password' => ['required', 'min: 8', 'confirmed'],
        ], [
            'password.required' => '* Veuillez saisir un mot de passe.',
            'password.min' => '* Le mot de passe doit dépasser 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);
    
        if ($validatePass) {
            
            $admin = Admin::where('id_admin', Auth::id())->first();
            $admin->password = $passwords->password;
            $admin->save();

            return view('login');

        } else {
            return redirect()->back()->withErrors($validatePass)->withInput();
        }
        
           
    }

    public function logout(){

        Session::flush();
        
        Auth::logout();
        return redirect('login');
    }
}
