<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        $users[] = [
            'name' => 'Rahmad Firmansyah',
            'email' => 'fsyah7052@gmail.com',
            'password' => bcrypt('123123'),
            'role_id' => 1,
            'kabupaten_id' => 3509
        ];
        $users[] = [
            'name' => 'Bambang Gentolet',
            'email' => 'bambang@gmail.com',
            'password' => bcrypt('123123'),
            'role_id' => 2,
            'kabupaten' => 3509
        ];

        DB::table('users')->insert($users);
        $this->command->info("Data Dummy User berhasil diinsert");
    }
}
