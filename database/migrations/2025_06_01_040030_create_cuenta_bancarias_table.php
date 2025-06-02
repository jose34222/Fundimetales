<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cuentas_bancarias', function (Blueprint $table) {
            $table->id();
            $table->string('numero_cuenta', 20)->unique();
            $table->string('banco', 50);
            $table->string('tipo_cuenta', 30);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuentas_bancarias');
    }
};