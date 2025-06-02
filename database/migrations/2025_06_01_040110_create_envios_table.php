<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('referencia', 100);
            $table->string('lugar', 100);
            $table->decimal('valor', 10, 2)->nullable();
            $table->string('autoriza', 100)->nullable();
            $table->string('observaciones', 255)->nullable();
            $table->foreignId('cuenta_id')->nullable()->constrained('cuentas_bancarias', 'id');
            $table->foreignId('cliente_id')->nullable()->constrained('clientes', 'id');
            $table->foreignId('user_id')->constrained('users'); // Cambiado de empleado_id a user_id
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('envios');
    }
};