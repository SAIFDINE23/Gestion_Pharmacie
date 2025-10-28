<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [''];
    protected $primaryKey = 'id_pub';
    protected $table = 'publication';
}
