    <?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Gender;
use App\Role;
use App\User;

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
        $users = User::all()->where('role_id',$role[0])->pluck('id')->toArray();
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
                'user_id' => $users[$index],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
        
    }
}