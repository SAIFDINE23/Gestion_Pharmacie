<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [''];
    protected $primaryKey = 'id_marque';
    protected $table = 'marque';

}
