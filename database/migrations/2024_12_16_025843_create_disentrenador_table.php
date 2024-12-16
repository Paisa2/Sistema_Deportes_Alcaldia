<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisentrenadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disentrenador', function (Blueprint $table) {
            $table->id();
            $table->string('inscritos');
            $table->string('gestion');
            $table->string('cv_entrenador');

            $table->unsignedBigInteger('subcategoria');
            $table->unsignedBigInteger('disciplina');
            $table->unsignedBigInteger('entrenador');
            $table->foreign('subcategoria')->references('id')->on('subcategorias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('disciplina')->references('id')->on('disciplinas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('entrenador')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disentrenador');
    }
}
