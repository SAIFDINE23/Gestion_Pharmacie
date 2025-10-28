<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permanance extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [''];
    protected $primaryKey = 'id_list';
    protected $table = 'permanance';
}
