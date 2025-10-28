<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [''];
    protected $primaryKey = 'id_ord';
    protected $table = 'ordonnance';
}
