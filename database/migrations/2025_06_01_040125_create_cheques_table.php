<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('numero_cheque', 20);
            $table->string('banco', 50);
            $table->decimal('valor', 10, 2);
            $table->string('observaciones', 255)->nullable();
            $table->foreignId('cuenta_id')->nullable()->constrained('cuentas_bancarias', 'id');
            $table->foreignId('user_id')->constrained('users'); // Cambiado de empleado_id a user_id
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cheques');
    }
};