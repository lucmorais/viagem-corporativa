<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuario')->insert([
            'idPapel' => 1,
            'nome' => 'Admin Teste',
            'email' => 'admin.teste@example.com',
            'usuario' => 'admin.teste',
            'senha' => Hash::make('senha123'),
        ]);

        DB::table('usuario')->insert([
            'idPapel' => 2,
            'nome' => 'Usuario Teste',
            'email' => 'usuario.teste@example.com',
            'usuario' => 'usuario.teste',
            'senha' => Hash::make('senha123'),
        ]);
    }
}
