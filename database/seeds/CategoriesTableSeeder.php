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
        $types_content = [
        [
            'polos',
            'dress shirts',
            't-shirts',
            'tank tops',
            'casual button-down shirts'
        ],
        [
            'jeans',
            'dress pants',
            'casual pants',
            'shorts',
            'jogger'
        ],
        [
            'suits',
            'coats',
            'blazers',
            'sweaters',
            'jackets'
        ],
        [
            'boxers',
            'briefs',
            'boxer-briefs',
            'undershirts',
            'thermal underwears'
        ],
        ];
        foreach(range(0,3) as $index) {
            $id = $faker->uuid;
            DB::table('categories')->insert([
                'id' => $id,
                'name' => $contents[$index],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            foreach(range(0,4) as $content){
                DB::table('types')->insert([
                    'id' => $faker->uuid,
                    'name' => $types_content[$index][$content],
                    'category_id' => $id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            }
            
        };
    }
}