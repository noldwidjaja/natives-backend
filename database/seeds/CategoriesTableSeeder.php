<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
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
            'top',
            'bottom',
            'outerwear',
            'innerwear'
        ];
        foreach($contents as $content) {
            DB::table('Categories')->insert([
                'id' => $faker->uuid(),
                'name' => $content,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        };
    }
}