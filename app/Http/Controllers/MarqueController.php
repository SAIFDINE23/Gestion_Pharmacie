<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarqueRequest;
use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    public function index(){
        $marques = Marque::paginate(5);

        return view('/marque/infos', [
            'marques' => $marques
        ]);
    }

    public function show(Marque $marques){
        
        //$article = articles::find($id);

        return view('marque.details',[
            'marque' => $marques
        ]);
    }

    public function delete(Marque $marques){

        Marque::where('id_marque', $marques->id_marque)->delete();

        return redirect('/marques')->with('success', 'supprimée avec succés');
    }

    public function store(MarqueRequest $request){

        $imagePath = $request->photo_mrq->store('public/marque'); // Store the file in the 'photos' directory

        Marque::create([
            'owner' => $request->propr,
            'nom_marque' => $request->nom_mrq,
            'contact' => $request->contact,
            'photo_marque' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Marque ajoutée avec succès');
    }

    public function edit(Marque $marques){
        
        //$article = articles::find($id);

        return view('marque.edit',[
            'marque' => $marques
        ]);
    }

    public function update(Marque $marque, MarqueRequest $request){
            // la variable $article permet de recuperer l'article dont on souhaite  faire la maj
            // la variable $request recupère les données du formuaire 

            $imagePath = $request->photo_mrq->store('public/marque'); // Store the file in the 'photos' directory

            $marque -> owner = $request -> propr; 
            $marque -> nom_marque = $request -> nom_mrq; 
            $marque -> contact = $request -> contact; 
            $marque -> photo_mrq = $imagePath;
            $marque->save();

            return redirect()->back()->with('success' ,'La marque a été mise à jour ');
    }
}
