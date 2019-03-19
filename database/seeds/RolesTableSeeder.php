<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $contents = [
            'customer',
            'supplier',
            'admin'
        ];

        foreach($contents as $content) {
            DB::table('Roles')->insert([
                'id' => $faker->uuid,
                'name' => $content,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}