<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicaments', function (Blueprint $table) {
            $table->id('code_barre');
            $table->string('nom_med');
            $table->string('categorie')->nullable();
            $table->text('description_med')->nullable();
            $table->decimal('prix_unit', 8, 2);
            $table->integer('quantite');
            $table->integer('promo')->nullable();
            $table->text('photo_med');
            $table->unsignedBigInteger('id_marque'); // Utiliser le type de données correct
            $table->foreign('id_marque')->references('id_marque')->on('marque')->onDelete('cascade')->nullable();    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicaments');
    }
}
