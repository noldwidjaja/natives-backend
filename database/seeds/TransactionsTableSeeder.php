<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Customer;
use App\Item;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $customers = Customer::all()->pluck('id');
        $items = Item::all()->pluck('id');
        foreach(range(0,10) as $index){
            $bool = $faker->boolean;
            $id = $faker->uuid;
            $price = $faker->numberBetween($min = 100000,$max = 2000000);
            DB::table('Transactions')->insert([ 
                'id' => $id,
                'total_price' => $price,
                'status' => $bool,
                'customer_id' => $faker->randomElement($customers),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('Boughts')->insert([
                    'id' => $faker->uuid,
                    'transaction_id' => $id,
                    'item_id' => $faker->randomElement($items),
                    'amount' => $faker->numberBetween($min = 0, $max = 10),
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
            ]);
            if($bool == True){
                DB::table('Payments')->insert([
                    'id' => $faker->uuid,
                    'payment_method' => $faker->creditCardType,
                    'total_price' => $price,
                    'payment_date' => date("Y-m-d H:i:s"),
                    'transaction_id' => $id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            }
        }
    }
}