<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromotionRequest;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index(){
        $promotion = Promotion::paginate(5);
        // dd($promotion);

        return view('/promotions/infos', [
            'promotion' => $promotion
        ]);
    }



    public function delete(Promotion $promotion){

        // dd($promotion);
        if(Promotion::where('id_promo', $promotion->id_promo)->delete())
            return redirect('/promotions')->with('success', 'Promotion supprimée avec succés');
        else
            return redirect('/promotions')->with('error', 'Erreur lors de la suppression');


    }

    public function store(PromotionRequest $request){

        if($request -> fin_promo > $request -> debut_promo){
            Promotion::create([
                'libelle' => $request->libelle,
                'pourcentage' => $request->pourcentage,
                'debut_promo' => $request->debut_promo,
                'fin_promo' => $request->fin_promo,
            ]);
            return redirect()->back()->with('success', 'Promotion ajoutée avec succès');
        }else
            return redirect()->back()->with('date_error' ,' * La date de fin doit être supérieure à la date de début');
    }

    public function edit(Promotion $promotion){
        

        return view('promotions.edit',[
            'promotion' => $promotion,
        ]);
    }

    public function update(Promotion $promotion, PromotionRequest $request){
            // la variable $article permet de recuperer l'article dont on souhaite  faire la maj
            // la variable $request recupère les données du formuaire 
            if($request -> fin_promo > $request -> debut_promo){
                $promotion -> libelle = $request -> libelle; 
                $promotion -> pourcentage = $request -> pourcentage; 
                $promotion -> debut_promo = $request -> debut_promo; 
                $promotion -> fin_promo = $request -> fin_promo; 
                $promotion->save();

                return redirect()->back()->with('success' ,'Promotion a été mise à jour ');
            }
            else
                return redirect()->back()->with('date_error' ,' * La date de fin doit être supérieure à la date de début');

    }
}
