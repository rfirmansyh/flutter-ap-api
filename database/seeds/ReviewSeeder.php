<?php

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $reviews = [];
        $reviews[] = [
            'body' => $faker->text($maxNbChars = 200),
            'rating' => rand(1,5),
            'created_at' => new DateTime(null, new DateTimeZone('Asia/Bangkok')),
            'user_id' => 2,
            'tempat_id' => 1
        ];
        DB::table('reviews')->insert($reviews);
        $this->command->info("Data Dummy review berhasil diinsert");
    }
}
