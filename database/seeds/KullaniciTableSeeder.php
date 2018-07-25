<?php

use \App\Models\Kullanici;
use \App\Models\KullaniciDetay;
use Illuminate\Database\Seeder;

class KullaniciTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Kullanici::truncate();
        KullaniciDetay::truncate();

        $kullanici_yonetici = Kullanici::create([
            'adsoyad'     => 'Eser TOPÇU',
            'email'       => 'topcueser@gmail.com',
            'sifre'       => bcrypt('1223'),
            'aktif_mi'    => 1,
            'yonetici_mi' => 1,
        ]);

        $kullanici_yonetici->detay()->create([
            'adres'       => 'Çanakkale',
            'telefon'     => '(312) 111 11 11',
            'ceptelefonu' => '(555) 444 33 22',
        ]);

        for($i = 0; $i < 50; $i++){
            $kullanici_musteri = Kullanici::create([
                'adsoyad'     => $faker->name,
                'email'       => $faker->unique()->safeEmail,
                'sifre'       => bcrypt('1223'),
                'aktif_mi'    => 1,
                'yonetici_mi' => 0
            ]);

            $kullanici_musteri->detay()->create([
                'adres'       => $faker->address,
                'telefon'     => $faker->e164PhoneNumber,
                'ceptelefonu' => $faker->e164PhoneNumber,
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
