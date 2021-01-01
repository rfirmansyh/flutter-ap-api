<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $posts = [];
        for ($i=0; $i < 10; $i++) { 
            $posts[] = [
                'slug' => $faker->slug,
                'title' => $faker->sentence($nbWords = 1, $variableNbWords = true),
                'body' => $faker->text($maxNbChars = 200),
                'created_at' => new DateTime(null, new DateTimeZone('Asia/Bangkok')),
                'user_id' => 1,
            ];
        }
        DB::table('posts')->insert($posts);
        $this->command->info("Data Dummy Post berhasil diinsert");
    }
}
