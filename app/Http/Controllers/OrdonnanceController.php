<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdonnanceRequest;
use App\Models\LigneOrdonnance;
use App\Models\Ordonnance;
use App\Models\Medicament;
use Illuminate\Support\Facades\DB;

class OrdonnanceController extends Controller
{
    public function index(){
        $ordonnance = Ordonnance::paginate(5);
        $medicament = Medicament::all();

        return view('/ordonnances/infos', [
            'ordonnance' => $ordonnance,
            'medicament' => $medicament
        ]);
    }

    public function show(Ordonnance $ordonnance){
        
        //$article = articles::find($id);
        $ligne_ord = LigneOrdonnance::where('id_ord', $ordonnance->id_ord)
                        ->join('medicaments', 'medicaments.code_barre', '=', 'ligne_ordonnance.code_barre')
                        ->join('promotion', 'medicaments.promo','=', 'promotion.id_promo')
                        ->select('ligne_ordonnance.quantite','medicaments.nom_med', 'medicaments.prix_unit', 'promotion.pourcentage')
                        ->get();

                        $ord = Ordonnance::where('ordonnance.id_ord', $ordonnance->id_ord)
                ->join('ligne_ordonnance as lo1', 'lo1.id_ord','=', 'ordonnance.id_ord')
                ->join('medicaments', 'lo1.code_barre','=', 'medicaments.code_barre')
                ->join('promotion', 'medicaments.promo','=', 'promotion.id_promo')
                ->select('ordonnance.*', 'lo1.quantite', 'medicaments.nom_med', 'medicaments.prix_unit', 'promotion.pourcentage')
                ->get();

        $prix_total = LigneOrdonnance::where('id_ord', $ordonnance->id_ord)
                        ->join('medicaments', 'ligne_ordonnance.code_barre','=', 'medicaments.code_barre')
                        ->join('promotion', 'medicaments.promo','=', 'promotion.id_promo')
                        ->select(DB::raw('SUM(prix_unit*(1-pourcentage/100)*ligne_ordonnance.quantite) as prix_total'))
                        ->groupBy('id_ord')
                        ->get();

        return view('ordonnances.details',[
            'ordonnance' => $ordonnance,
            'ligne_ord' => $ligne_ord,
            'prix_total' => $prix_total
        ]);
    }

    public function delete(Ordonnance $ordonnance){

        Ordonnance::where('id_ord', $ordonnance->id_ord)->delete();

        return redirect('/ordonnances')->with('success', 'supprimé avec succés');
    }

    public function store(OrdonnanceRequest $request){
        
        // dd($request);
        $ord = Ordonnance::create([
            'nom_patient' => $request->nom_patient,
            'medecin' => $request->medecin,
            'date_ord' => $request->date_ord,
        ]);


        foreach($request->medicaments as $med){
            // dd($med);
            $quantite = $request->quantite[$med];
            // dd($quantite);
            LigneOrdonnance::create([
                'code_barre' => $med,
                'id_ord' => $ord->id_ord,
                'quantite' => $quantite
            ]);

            $medicament = Medicament::find($med);
            // dd($medicament);
            $medicament->quantite -= $quantite;
            $medicament->save();


        }

        

        return redirect()->back()->with('success', 'Ordonnance ajouté avec succès');
    }

    public function edit(Ordonnance $ordonnance){
        
        //$article = articles::find($id);
        $medicament = Medicament::all();

        return view('ordonnances.edit',[
            'ordonnance' => $ordonnance,
            'medicament' => $medicament
        ]);
    }

    public function update(Ordonnance $ordonnance, OrdonnanceRequest $request){
            // la variable $article permet de recuperer l'article dont on souhaite  faire la maj
            // la variable $request recupère les données du formuaire 
            
            $ordonnance -> nom_patient = $request -> nom_patient; 
            $ordonnance -> medecin = $request -> medecin; 
            $ordonnance -> date_ord = $request -> date_ord;
            $ordonnance->save();
            
            LigneOrdonnance::where('id_ord', '=', $ordonnance->id_ord)->delete();

            foreach($request->medicaments as $med){
                // dd($med);
                $quantite = $request->quantite[$med];
                // dd($quantite);
                LigneOrdonnance::create([
                    'code_barre' => $med,
                    'id_ord' => $ordonnance->id_ord,
                    'quantite' => $quantite
                ]);
    
                $medicament = Medicament::find($med);
                // dd($medicament);
                $medicament->quantite -= $quantite;
                $medicament->save();
    
            } 
            

            return redirect()->back()->with('success' ,'Ordonnance a été mise à jour ');
    }
}
