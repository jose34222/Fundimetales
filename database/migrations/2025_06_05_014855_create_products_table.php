<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Categoria;
use App\Models\Proveedor;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('proveedor_id')->nullable()->constrained('proveedors');
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('precio_venta', 10, 2);
            $table->integer('stock_minimo')->default(0);
            $table->integer('stock_actual')->default(0);
            $table->string('unidad_medida', 20)->default('unidad');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
