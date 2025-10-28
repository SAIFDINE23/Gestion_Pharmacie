<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMarque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marque', function (Blueprint $table) {
            $table->foreignId('id_agent')->constrained('users');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marque', function (Blueprint $table) {
            $table->dropForeign(['id_agent']);
            $table->dropColumn('id_agent');
        });
    }
}
