<?php

namespace App\Http\Controllers;

use App\Models\LigneOrdonnance;
use App\Models\Ordonnance;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function generatePdf(Ordonnance $ordonnance)
    {
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
        


        $filename = 'recu'.$ordonnance->id_ord.'.pdf';
        $this->pdfService->createPdf('templates.pdf', compact('ord', 'prix_total'), $filename);
        return response()->download(storage_path('app/pdf/' . $filename));
    }
}
