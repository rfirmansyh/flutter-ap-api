<?php

use Illuminate\Database\Seeder;

class TempatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $tempats = [];
        $tempats[] = [
            'name' => 'Warung Pak Edi',
            'description' => 'Warung sejenis kandang',
            'rating_sanitasi' => rand(1,5),
            'created_at' => new DateTime(null, new DateTimeZone('Asia/Bangkok')),
            'user_id' => 2,
            'province_id' => 11,
            'kabupaten_id' => 1101
        ];
        DB::table('tempats')->insert($tempats);
        $this->command->info("Data Dummy Tempat berhasil diinsert");
    }
}
