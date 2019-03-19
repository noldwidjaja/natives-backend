<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Role;

class UsersTableSeeder extends Seeder
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
        $admin = Role::all()->where('name','admin')->pluck('id')->toArray();
        DB::table('users')->insert([ 
                'id' => $faker->uuid,
                'email' => 'admin@gmail.com',
                'password' => bcrypt('secret'),
                'role_id' => $admin[0],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        foreach(range(0,9) as $index){
            DB::table('users')->insert([ 
                'id' => $faker->uuid,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'role_id' => $supplier[0],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('users')->insert([ 
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