<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LoginsTableSeeder::class,
            CustomersTableSeeder::class,
            SuppliersTableSeeder::class,
            ItemsTableSeeder::class,
            TransactionsTableSeeder::class
        ]);
    }
}