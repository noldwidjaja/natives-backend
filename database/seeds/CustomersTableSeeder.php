<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Acme\Module\Gender\Model\Gender;
use Acme\Module\Role\Model\Role;
use Acme\Module\Login\Model\Login;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = Gender::all()->pluck('id')->toArray();
        $role = Role::all()->where('name','customer')->pluck('id')->toArray();
        $logins = Login::all()->where('role_id',$role[0])->pluck('id')->toArray();
        $faker = Faker::create();
        foreach(range(0,4) as $index){
            $id = $faker->uuid;
            DB::table('Customers')->insert([ 
                'id' => $id,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'gender_id' => $faker->randomElement($genders),
                'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'phone_number' => $faker->e164PhoneNumber,
                'login_id' => $logins[$index],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('Carts')->insert([
                'id' => $faker->uuid,
                'customer_id' => $id,
                'item_quantity' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('Wishlists')->insert([
                'id' => $faker->uuid,
                'customer_id' => $id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
        
    }
}