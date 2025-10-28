<?php

namespace App\Http\Controllers;
use App\Models\Medicament;
use App\Models\Marque;
use App\Models\Promotion;
use App\Models\Permanance;
use App\Models\Publication;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $medicaments = Medicament::join('promotion', 'promotion.id_promo', '=', 'medicaments.promo')
                         ->orderBy('code_barre', 'desc')
                         ->select('medicaments.*', 'promotion.*') // Ajout des colonnes souhaitées
                         ->paginate(9);
        $fmedicaments = Medicament::join('promotion', 'promotion.id_promo', '=', 'medicaments.promo')
                                    ->where('quantite', '>', 0)->get();
        $publications=Publication::all();
        $promotions=Promotion::all();
        $marques=Marque::all();
        $permanance=Permanance::all();
        return view("client.home",compact('fmedicaments','medicaments','publications','promotions','marques','permanance'));
    }

    public function showProducts(Request $request){
        $publications = Publication::all();
        $promotions = Promotion::all();
        $marques = Marque::all();
        $permanance = Permanance::all();
    
        // Récupérer les valeurs de prix minimales et maximales de la requête
        $min = $request->input('min_price');
        $max = $request->input('max_price');
        $selectedBrand = $request->input('brand');
        $query = $request->input('query');
    
        // Construire la requête pour les médicaments en utilisant le modèle Medicament
        $medicamentQuery = Medicament::join('promotion', 'promotion.id_promo', '=', 'medicaments.promo')
        ->selectRaw('medicaments.*, promotion.*, (prix_unit * (1 - pourcentage / 100)) as prix_final');
    
        // Filtrer en fonction des valeurs de prix minimales et maximales si elles sont fournies
        if (!empty($query)) {
            $medicamentQuery->where('nom_med', 'like', '%' . $query . '%');
        }
        
        if (!empty($min)) {
            $medicamentQuery->having('prix_final', '>=', $min);
        }
    
        if (!empty($max)) {
            $medicamentQuery->having('prix_final', '<=', $max);
        }
        if (!empty($selectedBrand)) {
            $medicamentQuery->where('id_marque', $selectedBrand);
        }
    
        // Paginer les résultats avec une limite de 5 éléments par page
        $medicaments = $medicamentQuery->paginate(5);
    
        // Passer les résultats à la vue
        return view("client.products", compact('medicaments', 'publications', 'promotions', 'marques', 'permanance'));
        // dd($request);
    }
    

    public function showProduct($code_barre){
        $publications = Publication::all();
        $promotions = Promotion::all();
        $marques = Marque::all();
        $permanance = Permanance::all();
        $medicament = Medicament::join('promotion', 'promotion.id_promo', '=', 'medicaments.promo')
                                    ->select('medicaments.*', 'promotion.*')
                                    ->where('code_barre', $code_barre)->first();
        $marque = Marque::where('id_marque',$medicament->id_marque)->first();
        return view('client.product',compact('medicament', 'publications', 'promotions', 'marque', 'permanance'));
    }

    public function showPermanance(){       
        return view('client.permanance');
    }

    public function getPermanance(Request $request){
        $query = $request->input('query');
        if(!empty($query)){
            $permanance = Permanance::where('date_permanance', 'like', "%{$query}%")->paginate(5);
        }
      
        
        return view('client.permanance', compact('permanance'));
    }

}

