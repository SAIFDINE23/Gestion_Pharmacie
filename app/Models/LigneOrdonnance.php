<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneOrdonnance extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_barre',
        'id_ord',
        'quantite'
        // Autres champs remplissables
    ];

    public $timestamps = false;
    protected $guarded = [''];
    protected $primaryKey = 'id_ligne';
    protected $table = 'ligne_ordonnance';


}
