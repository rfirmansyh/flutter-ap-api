<?php

use Illuminate\Database\Seeder;

class DonationtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $donation_types = [];
        $donation_types[] = [
            'name' => 'Uang'
        ];
        $donation_types[] = [
            'name' => 'Barang'
        ];

        DB::table('donation_types')->insert($donation_types);
        $this->command->info("Data Dummy Donation Types berhasil diinsert");
    }
}
