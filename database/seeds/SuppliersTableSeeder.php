<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Role;
use App\User;

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
        $role = Role::all()->where('name','supplier')->pluck('id')->toArray();
        $users = User::all()->where('role_id',$role[0])->pluck('id')->toArray();
        foreach(range(0,4) as $index){
            DB::table('Suppliers')->insert([ 
                'id' => $faker->uuid,
                'name' => $faker->company,
                'phone_number' => $faker->e164PhoneNumber,
                'user_id' => $users[$index],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
        
    }
}