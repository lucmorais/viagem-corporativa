<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table
            ->id()
            ->autoIncrement();

            $table->foreignId('idUsuario')->constrained('usuario');

            $table
            ->string('destino', 200)
            ->charset('utf8mb4')
            ->collation('utf8mb4_unicode_ci');

            $table->date('dataIda');

            $table->date('dataVolta');

            $table
            ->enum('status', ['solicitado', 'aprovado', 'cancelado'])
            ->default('solicitado')
            ->charset('utf8mb4')
            ->collation('utf8mb4_unicode_ci');

            $table
            ->timestamp('dataCriacao')
            ->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido');
    }
};
