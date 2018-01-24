<?php

use Illuminate\Database\Seeder;

class DemandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */



    public function run()
    {
         
    $users = factory(App\User::class, 15)->create();         
    $demands = factory(App\Demand::class, 15)->create();


    }
}
