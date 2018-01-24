<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Service::all()->count() > 0) {
    		return;
    	}

        	$services = [
        	
            ['name' => 'Acompahamentos'],
        	['name' => 'Andamentos'],
            ['name' => 'Outros'],
            ['name' => 'Alvarás'],
            ['name' => 'Análises'],
            ['name' => 'Audiências'],
            ['name' => 'Busca e Apreensão'],
            ['name' => 'Cargas'],
            ['name' => 'Certidões'],
            ['name' => 'Conciliação'],
            ['name' => 'Consultas'],
            ['name' => 'Cópias'],
            ['name' => 'Despachos'],
            ['name' => 'Distribuições'],
            ['name' => 'Elaboração de Peças'],
            ['name' => 'Elaboração de Teses'],
            ['name' => 'Exame de Processos'],
            ['name' => 'Guias'],
            ['name' => 'Mandados'],
            ['name' => 'Pareceres'],
            ['name' => 'Preposição'],
            ['name' => 'Protocolos'],
            ['name' => 'Recursos'],
            ['name' => 'Sustentação Oral'],
            ['name' => 'Visita in loco'],
            ['name' => 'Todos']
        	
        	
        	];

        	foreach($services as $s){
        		Service::create($s);
        	}
    }
}
