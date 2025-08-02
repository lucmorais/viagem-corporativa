<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('papel')->insert([
            'permissao' => 'admin',
        ]);

        DB::table('papel')->insert([
            'permissao' => 'usuario',
        ]);
    }
}
