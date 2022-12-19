<?php
use Illuminate\Database\Seeder;
// Import DB and Faker services
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();
    	// foreach (range(1,20) as $index) {
        //     DB::table('cities')->insert([
        //         'name' => $faker->city,
        //         'country' => $faker->country,
        //         'province' => $faker->state,
        //         'zip_code' => $faker->postcode,
        //         'created_at' => $faker->date($format = 'Y-m-d h:s', $max = '2010',$min = '1980'),
        //         'updated_at' => $faker->date($format = 'Y-m-d h:s', $max = '2010',$min = '1980')
        //     ]);
        // }

        // DB::table('cities')->insert([
        //     'name' => 'Gdańsk',
        //     'country' => 'Polska',
        //     'province' => 'pomorskie',
        //     'zip_code' => '80-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Bydgoszcz',
        //     'country' => 'Polska',
        //     'province' => 'kujawsko-pomorskie',
        //     'zip_code' => '85-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Toruń',
        //     'country' => 'Polska',
        //     'province' => 'kujawsko-pomorskie',
        //     'zip_code' => '87-100',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Lublin',
        //     'country' => 'Polska',
        //     'province' => 'lubelskie',
        //     'zip_code' => '20-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Gorzów Wielkopolski',
        //     'country' => 'Polska',
        //     'province' => 'lubuskie',
        //     'zip_code' => '64-400',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Zielona Góra',
        //     'country' => 'Polska',
        //     'province' => 'lubuskie',
        //     'zip_code' => '65-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Łódź',
        //     'country' => 'Polska',
        //     'province' => 'łódzkie',
        //     'zip_code' => '90-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Kraków',
        //     'country' => 'Polska',
        //     'province' => 'małopolskie',
        //     'zip_code' => '30-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Warszawa',
        //     'country' => 'Polska',
        //     'province' => 'mazowieckie',
        //     'zip_code' => '00-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Opole',
        //     'country' => 'Polska',
        //     'province' => 'opolskie',
        //     'zip_code' => '45-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Rzeszów',
        //     'country' => 'Polska',
        //     'province' => 'podkarpackie',
        //     'zip_code' => '35-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Białystok',
        //     'country' => 'Polska',
        //     'province' => 'podlaskie',
        //     'zip_code' => '15-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Katowice',
        //     'country' => 'Polska',
        //     'province' => 'śląskie',
        //     'zip_code' => '40-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Kielce',
        //     'country' => 'Polska',
        //     'province' => 'świętokrzyskie',
        //     'zip_code' => '25-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Olsztyn',
        //     'country' => 'Polska',
        //     'province' => 'warmińsko-mazurskie',
        //     'zip_code' => '10-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Poznań',
        //     'country' => 'Polska',
        //     'province' => 'wielkopolskie',
        //     'zip_code' => '60-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        // DB::table('cities')->insert([
        //     'name' => 'Szczecin',
        //     'country' => 'Polska',
        //     'province' => 'zachodniopomorskie',
        //     'zip_code' => '70-000',
        //     'created_at' => date('Y-m-d h:s'),
        //     'updated_at' => date('Y-m-d h:s')
        // ]);

        DB::table('services')->insert([
            'name' => 'Szkolenie indywidualne',
            'slug' => 'szkolenie-indywidualne',
            'created_at' => date('Y-m-d h:s'),
            'updated_at' => date('Y-m-d h:s')
        ]);

        DB::table('services')->insert([
            'name' => 'Wyprowadzanie',
            'slug' => 'wyprowadzanie',
            'created_at' => date('Y-m-d h:s'),
            'updated_at' => date('Y-m-d h:s')
        ]);

        DB::table('services')->insert([
            'name' => 'Opieka dzienna',
            'slug' => 'opieka-dzienna',
            'created_at' => date('Y-m-d h:s'),
            'updated_at' => date('Y-m-d h:s')
        ]);

        DB::table('services')->insert([
            'name' => 'Konsultacja behawioralna',
            'slug' => 'konsultacja-behawioralna',
            'created_at' => date('Y-m-d h:s'),
            'updated_at' => date('Y-m-d h:s')
        ]);

        DB::table('services')->insert([
            'name' => 'Porada online',
            'slug' => 'porada-online',
            'created_at' => date('Y-m-d h:s'),
            'updated_at' => date('Y-m-d h:s')
        ]);
        
    }
}