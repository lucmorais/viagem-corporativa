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
        Schema::create('usuario', function (Blueprint $table) {
            $table
            ->id()
            ->autoIncrement();

            $table
            ->foreignId('idPapel')
            ->references('id')
            ->on('papel');

            $table
            ->string('nome', 150)
            ->charset('utf8mb4')
            ->collation('utf8mb4_unicode_ci');

            $table
            ->string('email', 150)
            ->unique()
            ->charset('utf8mb4')
            ->collation('utf8mb4_unicode_ci');

            $table
            ->string('usuario', 150)
            ->charset('utf8mb4')
            ->collation('utf8mb4_unicode_ci');

            $table
            ->string('senha', 255)
            ->charset('utf8mb4')
            ->collation('utf8mb4_unicode_ci');

            $table
            ->string('recuperar_token', 255)
            ->charset('utf8mb4')
            ->collation('utf8mb4_unicode_ci')
            ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
