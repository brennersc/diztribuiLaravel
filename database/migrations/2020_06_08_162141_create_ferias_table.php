<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ferias', function (Blueprint $table) {
            $table->bigInteger('pkFerias')->autoIncrement()->unsigned();
            $table->bigInteger('fkUsuario')->nullable(true)->unsigned();
            $table->bigInteger('fkStatus')->nullable(true)->unsigned();
            $table->date('dataInicio')->nullable(true);
            $table->date('dataFinal')->nullable(true);
            $table->longtext('resposta')->nullable(true);
            $table->timestamp('created_at')->nullable(true);
            $table->timestamp('updated_at')->nullable(true);

            $table->foreign('fkUsuario')->references('pkUsuario')->on('usuario');
            $table->foreign('fkStatus')->references('pkStatus')->on('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ferias');
    }
}
