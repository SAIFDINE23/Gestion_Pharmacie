<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationRequest;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index(){
        $publication = Publication::paginate(5);

        return view('/publications/infos', [
            'publication' => $publication
        ]);
    }

    public function show(Publication $publication){
        
        //$article = articles::find($id);

        return view('publications.details',[
            'publication' => $publication
        ]);
    }

    public function delete(Publication $publication){

        Publication::where('id_pub', $publication->id_pub)->delete();

        return redirect('/publications')->with('success', 'supprimé avec succés');
    }

    public function store(PublicationRequest $request){

        $imagePath = $request->photo_pub->store('public/publication'); // Store the file in the 'photos' directory

        Publication::create([
            'titre_pub' => $request->titre_pub,
            'description_pub' => $request->desc_pub,
            'photo_pub' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Publication ajouté avec succès');
    }

    public function edit(Publication $publication){
        
        //$article = articles::find($id);

        return view('publications.edit',[
            'publication' => $publication
        ]);
    }

    public function update(Publication $publication, PublicationRequest $request){
            // la variable $article permet de recuperer l'article dont on souhaite  faire la maj
            // la variable $request recupère les données du formuaire 

            $imagePath = $request->photo_pub->store('public/publication'); // Store the file in the 'photos' directory

            
            $publication -> titre_pub = $request -> titre_pub; 
            $publication -> description_pub = $request -> desc_pub; 
            $publication -> photo_pub = $imagePath;
            $publication->save();

            return redirect()->back()->with('success' ,'La publication a été mise à jour ');
    }
}
