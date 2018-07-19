<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->truncate();

        DB::table('kategori')->insert([
            'kategori_adi' => 'Elektronik',
            'slug' => 'elektronik'
        ]);

        DB::table('kategori')->insert([
            'kategori_adi' => 'Kitap',
            'slug' => 'kitap'
        ]);

        DB::table('kategori')->insert([
            'kategori_adi' => 'Dergi',
            'slug' => 'dergi'
        ]);

        DB::table('kategori')->insert([
            'kategori_adi' => 'Mobilya',
            'slug' => 'mobilya'
        ]);

        DB::table('kategori')->insert([
            'kategori_adi' => 'Dekorasyon',
            'slug' => 'dekorasyon'
        ]);

        DB::table('kategori')->insert([
            'kategori_adi' => 'Kozmetik',
            'slug' => 'kozmetik'
        ]);

        DB::table('kategori')->insert([
            'kategori_adi' => 'Kişisel Bakım',
            'slug' => 'kisisel-bakim'
        ]);

        DB::table('kategori')->insert([
            'kategori_adi' => 'Giyim ve Moda',
            'slug' => 'giyim-moda'
        ]);

        DB::table('kategori')->insert([
            'kategori_adi' => 'Anne ve Çocuk',
            'slug' => 'anne-cocuk'
        ]);
    }
}
