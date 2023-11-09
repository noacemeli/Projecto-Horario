<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('solicitudes', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('titulo');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->boolean('aprobada')->default(false);
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

        Schema::dropIfExists('solicitudes');
    }
}
