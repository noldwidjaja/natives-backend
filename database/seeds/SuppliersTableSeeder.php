<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('Suppliers')->insert([ 
            'id' => $faker->uuid(),
            'company_name' => $faker->,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
            ]);
    }
}