<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Gender;
use App\Supplier;
use App\Type;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $genders = Gender::all()->pluck('id')->toArray();
        $suppliers = Supplier::all()->pluck('id')->toArray();
        $types = Type::all()->pluck('id')->toArray();

        foreach(range(0,49) as $index){
            $id = $faker->uuid;
            DB::table('items')->insert([ 
                'id' => $id,
                'gender_id' => $faker->randomElement($genders),
                'type_id' => $faker->randomElement($types),
                'name' => $faker->name,
                'price' => $faker->numberBetween($min = 50000, $max = 1000000),
                'stock' => $faker->numberBetween($min = 0, $max = 25),
                'description' => $faker->text($maxNbChars = 200),
                'supplier_id' => $faker->randomElement($suppliers),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('images')->insert([
                'id' => $faker->uuid,
                'directory' => $faker->imageUrl($width = 1000, $height = 1000),
                'item_id' => $id,
            ]);
        }
    }
}