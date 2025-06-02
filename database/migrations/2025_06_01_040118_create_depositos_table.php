<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('depositos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('cuenta_id')->constrained('cuentas_bancarias', 'id');
            $table->decimal('valor', 10, 2);
            $table->foreignId('concepto_id')->nullable()->constrained('conceptos', 'id');
            $table->string('observaciones', 255)->nullable();
            $table->foreignId('user_id')->constrained('users'); // Cambiado de empleado_id a user_id
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('depositos');
    }
};