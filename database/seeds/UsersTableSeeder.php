<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'Edson Luiz Siqueira',
            'email' => 'edson.php@gmail.com',
            'password' => bcrypt('teste123'),
            'active' => 1,
            'description' => '',
            'social'   => '',
            'state_id'   => '26',
            'city_id'   => '5066',
            'formation_id'=> '1',
            'titulation_id'=>'3'
            
        ]);
        
    }
}
