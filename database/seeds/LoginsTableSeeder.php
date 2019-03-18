<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Acme\Module\Role\Model\Role;

class LoginsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $supplier = Role::all()->where('name','supplier')->pluck('id')->toArray();
        $customer = Role::all()->where('name','customer')->pluck('id')->toArray();
        foreach(range(0,4) as $index){
            DB::table('Logins')->insert([ 
                'id' => $faker->uuid,
                'email' => $faker->email,
                'password' => $faker->password,
                'role_id' => $supplier[0],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('Logins')->insert([ 
                'id' => $faker->uuid,
                'email' => $faker->email,
                'password' => $faker->password,
                'role_id' => $customer[0],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}