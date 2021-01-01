<?php

use Illuminate\Database\Seeder;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = \DB::table('provinces')->get();
        $kabupatens = [];
        foreach($provinces as $province) {
            $url_kabupaten = 'https://x.rajaapi.com/MeP7c5ne5ZZHvtG7IvXmVDSCLTB73gd1XwqFjaWUiiTZrz1exj8pLIbFFm/m/wilayah/kabupaten?idpropinsi='.$province->id;
            $json_str = file_get_contents($url_kabupaten);
            $json_obj = json_decode($json_str);
            foreach($json_obj->data as $kabupaten) {
                $kabupatens[] = [
                    'id' => $kabupaten->id,
                    'name' => $kabupaten->name,
                    'province_id' => $province->id
                ];
            }
        }
        DB::table('kabupatens')->insert($kabupatens);


    }
}
