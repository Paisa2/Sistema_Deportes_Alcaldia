<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificaci8onesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaci8ones', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("mensaje");
            $table->date("dia");
            $table->unsignedBigInteger('solicitud');
            $table->foreign('solicitud')->references('id')->on('solicitudes')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('notificaci8ones');
    }
}
