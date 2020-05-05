<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComentariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comentarios')->insert([
            'product_id' => 5,
            'user' => 'José da Silva',
            'comment' => 'Bom planeta, sem humanos.',
            'created_at' => date('Y/m/d h:i:s'),
            'updated_at' => date('Y/m/d h:i:s')
        ]);
        DB::table('comentarios')->insert([
            'product_id' => 5,
            'user' => 'João da Silva',
            'comment' => 'Bom planeta, sem humanos (ainda bem).',
            'created_at' => date('Y/m/d h:i:s'),
            'updated_at' => date('Y/m/d h:i:s')
        ]);
        DB::table('comentarios')->insert([
            'product_id' => 5,
            'user' => 'Maria José da Silva',
            'comment' => 'Bom planeta, sem humanos, só animais.',
            'created_at' => date('Y/m/d h:i:s'),
            'updated_at' => date('Y/m/d h:i:s')
        ]);
        DB::table('comentarios')->insert([
            'product_id' => 5,
            'user' => 'João da Silva',
            'comment' => 'Bom planeta, sem humanos para encher o saco.',
            'created_at' => date('Y/m/d h:i:s'),
            'updated_at' => date('Y/m/d h:i:s')
        ]);
    }
}
