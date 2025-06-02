<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('concepto_id')->constrained('conceptos', 'id');
            $table->decimal('valor', 10, 2);
            $table->string('detalles', 255)->nullable();
            $table->foreignId('user_id')->constrained('users'); // Cambiado de empleado_id a user_id
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gastos');
    }
};