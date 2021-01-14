<?php

use Illuminate\Database\Seeder;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $goods = [];
        $goods[] = [
            'name' => 'Beras',
            'photo' => 'img/beras.png',
            'price' => 50000,
            'type' => 'sembako',
            'created_at' => $faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta'),
            'updated_at' => null,
        ];
        $goods[] = [
            'name' => 'Gula',
            'photo' => 'img/gula.png',
            'price' => 50000,
            'type' => 'sembako',
            'created_at' => $faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta'),
            'updated_at' => null,
        ];
        $goods[] = [
            'name' => 'Jaket',
            'photo' => 'img/jaket.png',
            'price' => 100000,
            'type' => 'pakaian',
            'created_at' => $faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta'),
            'updated_at' => null,
        ];
        $goods[] = [
            'name' => 'Magic Com',
            'photo' => 'img/tumang.png',
            'price' => 125000,
            'type' => 'barang',
            'created_at' => $faker->dateTime($max = 'now', $timezone = 'Asia/Jakarta'),
            'updated_at' => null,
        ];

        DB::table('goods')->insert($goods);
        $this->command->info("Data Dummy Goods berhasil diinsert");
    }
}
