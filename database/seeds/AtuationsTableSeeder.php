<?php

use Illuminate\Database\Seeder;
use App\Atuation;

class AtuationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Atuation::all()->count() > 0) {
    		return;
    	}

        	$atuations = [
        	['name' => 'Todos'],
            ['name' => 'Penal'],
        	['name' => 'Processual Penal'],       
            ['name' => 'Acidentário'],
            ['name' => 'Administrativo'],
            ['name' => 'Aeronáutico'],
            ['name' => 'Agrário'],
            ['name' => 'Ambiental'],
            ['name' => 'Bancário'],
            ['name' => 'Canônico'],
            ['name' => 'Civil'],
            ['name' => 'Constitucional'],
            ['name' => 'Consumidor'],
            ['name' => 'Contratual'],
            ['name' => 'Corporativo'],
            ['name' => 'Desportivo'],
            ['name' => 'Direito da Mulher'],
            ['name' => 'Direitos Humanos'],
            ['name' => 'Educacional'],
            ['name' => 'Empresarial | Comercial'],
            ['name' => 'Família'],
            ['name' => 'Financeiro'],
            ['name' => 'Imobiliário'],
            ['name' => 'Internacional'],
            ['name' => 'Marítimo'],
            ['name' => 'Mediação, Conciliação e Arbitragem'],
            ['name' => 'Militar'],
            ['name' => 'Médico'],
            ['name' => 'Negócios'],
            ['name' => 'Previdenciário'],
            ['name' => 'Processual Civil'],
            ['name' => 'Processual do Trabalho'],
            ['name' => 'Propriedade Intelectual e Industrial'],
            ['name' => 'Sanitário'],
            ['name' => 'Securitário'],
            ['name' => 'Sindical'],
            ['name' => 'Societário'],
            ['name' => 'Sucessões'],
            ['name' => 'Tecnologia da Informação'],
            ['name' => 'Trabalho'],
            ['name' => 'Tributário'],
            ['name' => 'Trânsito'],
            ['name' => 'Urbanístico']
	
        	];

        	foreach($atuations as $a){
        		Atuation::create($a);
        	}
    }
}
