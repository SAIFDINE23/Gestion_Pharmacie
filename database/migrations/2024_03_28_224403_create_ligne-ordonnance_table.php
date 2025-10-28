<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLigneOrdonnanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_ordonnance', function (Blueprint $table) {
            $table->id('id_ligne');    
            $table->foreignId('code_barre')->constrained('medicaments');    
            $table->foreignId('id_ord')->constrained('ordonnance');    
            $table->integer('quantite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ligne_ordonnance');

    }
}
