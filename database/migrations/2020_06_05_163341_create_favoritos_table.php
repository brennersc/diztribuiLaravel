<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favoritos', function (Blueprint $table) {
            $table->bigInteger('fkUsuario')->nullable(true)->unsigned();
            $table->bigInteger('fkMateria')->nullable(true)->unsigned();
            
            $table->foreign('fkUsuario')->references('pkUsuario')->on('usuario');
            $table->foreign('fkMateria')->references('pkMateria')->on('materias'); 


            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favoritos');
    }
}
