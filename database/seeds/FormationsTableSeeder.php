<?php

use Illuminate\Database\Seeder;
use App\Formation;

class FormationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       if(Formation::all()->count() > 0) {
    		return;
    	}

        	$formations = [
        	['name' => 'Superior Incompleto'],
        	['name' => 'Superior Completo'],
        	['name' => 'Pós-Graduação'],
        	['name' => 'Mestre'],
        	['name' => 'Doutorado'],
        	['name' => 'Pós-Doutorado']
        	
        	];

        	foreach($formations as $f){
        		Formation::create($f);
        	}
    }
}
