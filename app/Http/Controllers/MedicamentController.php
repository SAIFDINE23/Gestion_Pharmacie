<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicamentRequest;
use App\Models\Medicament;
use App\Models\Marque;
use App\Models\Promotion;
use Illuminate\Http\Request;

class MedicamentController extends Controller
{
    public function index(){
        $medicaments = Medicament::paginate(5);
        $marques = Marque::all();
        $promotions = Promotion::all();


        return view('/medicaments/infos', [
            'medicaments' => $medicaments,
            'marques' => $marques,
            'promotions' => $promotions
        ]);
    }

    public function show(Medicament $medicament){
        
        $marque = Marque::where('id_marque', $medicament->id_marque)->first();
        $promotion = Promotion::where('id_promo', $medicament->promo)->first();

        
        return view('medicaments.details',[
            'medicament' => $medicament,
            'marque' => $marque,
            'promotion' => $promotion
        ]);
    }

    public function search(Request $request)
    {
        // Récupérer le terme de recherche depuis la requête
        $query = $request->input('query');

        // Effectuer la recherche de médicaments
        $medicaments = Medicament::where('nom_med', 'like', "%{$query}%")->paginate(5);
        $marques = Marque::all();

        return view('/medicaments/infos', [
            'medicaments' => $medicaments,
            'marques' => $marques
        ]);
    }

    public function delete(Medicament $medicament){

        // dd($medicament);

        if(Medicament::where('code_barre', $medicament->code_barre)->delete())
            return redirect('/medicaments')->with('success', 'Médicament supprimé avec succés');
        else
            return redirect('/medicaments')->with('success', 'Erreur lors de suppression');


    }

    public function store(MedicamentRequest $request){

        if ($request->hasFile('photo_med')) {
            $imagePath = $request->photo_med->store('public/medicament'); // Store the file in the 'photos' directory
        }

        Medicament::create([
            'code_barre' => $request->code_barre,
            'nom_med' => $request->nom_med,
            'categorie' => $request->categorie_med,
            'description_med' => $request->desc_med,
            'prix_unit' => $request->prix_unit,
            'quantite' => $request->quantite_med,
            'promo' => $request->promo_med,
            'id_marque' => $request->marque_med,
            'photo_med' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Medicament ajouté avec succès');
    }

    public function edit(Medicament $medicament){
        
        //$article = articles::find($id);
        $marques = Marque::all();
        $promotion = Promotion::all();

        return view('medicaments.edit',[
            'medicament' => $medicament,
            'marques' => $marques,
            'promotion' => $promotion
        ]);
    }

    public function update(Medicament $medicament, MedicamentRequest $request){
            // la variable $article permet de recuperer l'article dont on souhaite  faire la maj
            // la variable $request recupère les données du formuaire 
            $imagePath = $request->photo_med->store('public/medicament'); // Store the file in the 'photos' directory

            
            $medicament -> code_barre = $request -> code_barre; 
            $medicament -> nom_med = $request -> nom_med; 
            $medicament -> categorie = $request -> categorie_med; 
            $medicament -> description_med = $request -> desc_med; 
            $medicament -> prix_unit = $request -> prix_unit; 
            $medicament -> quantite = $request -> quantite_med; 
            $medicament -> promo = $request -> promo_med; 
            $medicament -> id_marque = $request -> marque_med; 
            $medicament -> photo_med = $imagePath;
            $medicament->save();

            return redirect()->back()->with('success' ,'Médicament a été mise à jour ');
    }
}
