<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\Medicament;
use App\Models\Ordonnance;
use App\Models\Publication;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class agentController extends Controller
{
    public function accueil(){

        $total_med = Medicament::sum('quantite');
        $cat_val = Medicament::selectRaw('categorie, sum(quantite) as quantite, (sum(quantite) * 100) / :total_med as pourcentage', [
            'total_med' => $total_med,
        ])
                                ->groupBy('categorie')
                                ->get();
        // dd($total_med);

        $total_marque = Marque::count('id_marque');
        $total_pub = Publication::count('id_pub');
        $total_ord = Ordonnance::count('id_ord');
                                
        return view('agent.accueil', [
            'cat_val' => $cat_val,
            'total_cat' => count($cat_val),
            'total_med' => $total_med,
            'total_marque' => $total_marque,
            'total_pub' => $total_pub,
            'total_ord' => $total_ord
        ]);
        
    }
    public function showProfil(){

        $Agent = User::where('id', Auth::id())->first();
        return view('agent.profil', [
            'agent' => $Agent
        ]);
        
    }
    public function editProfil(){

        $Agent = User::where('id', Auth::id())->first();
        return view('agent.edit', [
            'agent' => $Agent
        ]);
        
    }
    public function updateProfil(User $agent, Request $agentRequest){
        $validateAgent = $agentRequest->validate([
            'nom' => ['required'],
            'email' => ['required', 'email'],
            'old_password' => ['required'],
            'new_password' => ['min:8'],
        ], [
            'nom.required' => '* Le nom est requis',
            'email.email' => '* L\'adresse email saisi est non valide.',
            'email.required' => '* Veuillez saisir votre adresse email.',
            'old_password.required' => '* Veuillez saisir votre ancien mot de passe.',
            'new_password.min' => '* Le nombre minimum de caractères est 8.',
        ]);
        // dd(Hash::check($agentRequest->old_password, $agent->password));
        if ($validateAgent) {
            if(Hash::check($agentRequest->old_password, $agent->password)){
                $agent->name = $agentRequest->nom;
                $agent->email = $agentRequest->email;
                ($agentRequest->new_password == "") ?  : $agent->password = Hash::make($agentRequest->new_password);
                $agent->save();
                // dd($agent);
                return redirect()->back()->with('success', 'Profil modifié avec succès');
            }else{
                return redirect()->back()->with('old_pass_error', '* L\'ancien mot de pass saisi est invalid');
            }
        } else {
            return redirect()->back()->withErrors($validateAgent)->withInput();
        }
        
        
    }

    public function newProfil(){

        return view('agent.new');
    }

    public function createProfil(Request $request){

        $validateInfo = $request->validate([
            'password' => ['required', 'min: 8', 'confirmed'],
            'nom' => ['required'],
            'email' => ['required', 'email']
        ], [
            'nom.required' => '* Le nom est requis',
            'email.email' => '* L\'adresse email saisi est non valide.',
            'email.required' => '* Veuillez saisir un adresse email.',
            'password.required' => '* Veuillez saisir un mot de passe.',
            'password.min' => '* Le mot de passe doit dépasser 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        if($validateInfo){
            User::create([
                'name' => $request->nom,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_at' => now()
            ]);

            return redirect()->back()->with('success', 'Compte créé avec succès');
        }else {
            return redirect()->back()->withErrors($validateInfo)->withInput();
        }
    }
    public function login(){

        return view('agent.login');
    }

    public function handleLogin(Request $agentConnect){

        $validateAgent = $agentConnect->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.email' => '* L\'adresse email saisi est non valide.',
            'email.required' => '* Veuillez saisir votre adresse email.',
            'password.required' => '* Veuillez saisir votre mot de passe.',
        ]);

        if ($validateAgent) {
            if (Auth::attempt($validateAgent)) {
                $agentConnect->session()->regenerate();
    
                return redirect()->intended('accueil');
            }
            else{

                return redirect()->back()->with('error', 'L\'email ou le mot de passe sont incorrects ');
            }
        } else {
            return redirect()->back()->withErrors($validateAgent)->withInput();
        }
        
           
    }
    
    public function forgot_password(){
        
        return view('agent.forgotPass');
    }
    
    public function sendResetLinkEmail(Request $request)
    {
        /* $agent = User::where('email', $request->email)->first();
        
        if (!$agent) {
            // L'utilisateur n'existe pas
            return redirect()->back()->with('error', '* Cette adresse email n\'existe pas.');
        }
        
        // Générer un jeton de réinitialisation de mot de passe et l'enregistrer dans la table password_resets
        $token = \Illuminate\Support\Facades\Password::createToken($agent);
        
        // Envoyer l'email de réinitialisation du mot de passe
        $agent->sendPasswordResetNotification($token);
        
        return redirect()->back()->with('success', 'Un email de réinitialisation du mot de passe a été envoyé à votre adresse email.'); */
        $request->validate(['email' => 'required|email']);
        $agent = User::where('email', $request->email)->first();
        if (!$agent) {
            // L'utilisateur n'existe pas
            return redirect()->back()->with('error', '* Cette adresse email n\'existe pas.');
        }

    $status = Password::sendResetLink(
        $request->only('email')
    );
    dd($status);
 
    // return $status === Password::RESET_LINK_SENT
    //             ? back()->with(['status' => __($status)])
    //             : back()->withErrors(['email' => __($status)]);
    }
    
    public function reset_password(){
        
        return view('agent.resetPass');
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
            
            $agent = User::where('id', Auth::id())->first();
            $agent->password = $passwords->password;
            $agent->save();

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
