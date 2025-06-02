<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('conceptos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('tipo_concepto', 30); // 'VENTA', 'GASTO', 'ENVIO', etc.
            $table->string('descripcion', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conceptos');
    }
};