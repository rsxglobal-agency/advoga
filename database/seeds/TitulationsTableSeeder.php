<?php

use Illuminate\Database\Seeder;
use App\Titulation;

class TitulationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if(Titulation::all()->count() > 0) {
    		return;
    	}

        	$titulations = [
        	['name' => 'Advogado'],
        	['name' => 'Escritório de Direito'],
        	['name' => 'Bacharel'],
        	['name' => 'Estagiário'],
        	['name' => 'Pessoa Física']
        	
        	];

        	foreach($titulations as $t){
        		Titulation::create($t);
        	}
    }
}
