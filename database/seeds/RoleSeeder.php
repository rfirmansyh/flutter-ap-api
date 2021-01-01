<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [];
        $roles[] = [
            'name' => 'admin',
        ];
        $roles[] = [
            'name' => 'user',
        ];

        DB::table('roles')->insert($roles);
        $this->command->info("Data Dummy Role berhasil diinsert");
    }
}
