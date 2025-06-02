<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->foreignId('cliente_id')->constrained('clientes', 'id');
            $table->foreignId('concepto_id')->constrained('conceptos', 'id');
            $table->foreignId('cuenta_id')->nullable()->constrained('cuentas_bancarias', 'id');
            $table->decimal('valor', 10, 2);
            $table->string('observaciones', 255)->nullable();
            $table->foreignId('user_id')->constrained('users'); // Cambiado de empleado_id a user_id
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};