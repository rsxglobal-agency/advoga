<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        //$this->call(StatesTableSeeder::class);
        //$this->call(CitiesTableSeeder::class);
        $this->call(TitulationsTableSeeder::class);
        $this->call(FormationsTableSeeder::class);
        $this->call(AtuationsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(DemandsTableSeeder::class);

    }
}
