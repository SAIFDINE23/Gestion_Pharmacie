<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermananceRequest;
use App\Models\Permanance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermananceController extends Controller
{
    public function index(){
        $permanance = Permanance::paginate(5);

        return view('/permanances/infos', [
            'permanance' => $permanance
        ]);
    }

    public function search(Request $request)
    {
        // Récupérer le terme de recherche depuis la requête
        $query = $request->input('query');

        // Effectuer la recherche de médicaments
        $permanances = Permanance::where('date_permanance', 'like', "%{$query}%")->paginate(5);
        
        return view('/permanances/infos', [
            'permanance' => $permanances
        ]);
    }

    public function show(Permanance $permanance){
        
        $path = public_path('storage/'.$permanance->list);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    public function delete(Permanance $permanance){

        Permanance::where('id_list', $permanance->id_list)->delete();

        return redirect('/permanances')->with('success', 'supprimé avec succés');
    }

    public function store(PermananceRequest $request){

        if ($request->hasFile('list')) {
            $file = $request->file('list');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('permanances_list',$fileName, 'public');

            // Redirigez vers la route de téléchargement
            // return redirect()->route('download.pdf', ['filename' => $fileName]);
            Permanance::create([
                'list' => $filePath,
                'date_permanance' => $request->date_permanance,
            ]);
            return redirect()->back()->with('success', 'liste de permanances ajoutée avec succès');
        }else{
            return redirect()->back()->with('error', 'erreur lors de chargement de fichier');
        }

    }

    /* public function edit(Permanance $permanance){
        
        //$article = articles::find($id);

        return view('permanances.edit',[
            'permanance' => $permanance
        ]);
    } */

    /* public function update(Permanance $permanance, PermananceRequest $request){
            // la variable $article permet de recuperer l'article dont on souhaite  faire la maj
            // la variable $request recupère les données du formuaire 
            
            $permanance -> nom_phar = $request -> nom_phar; 
            $permanance -> contact_phar = $request -> contact_phar; 
            $permanance -> adresse_phar = $request -> adresse_phar; 
            $permanance->save();

            return redirect()->back()->with('success' ,'Permanance a été mise à jour ');
    } */
}
