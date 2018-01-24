<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('states')->insert([
               
                'sigla' => 'AC',
                'name' => 'Acre'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'AL',
                'name' => 'Alagoas'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'AM',
                'name' => 'Amazonas'
            ]);

        DB::table('states')->insert([
                
                'sigla' => 'AP',
                'name' => 'Amapá'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'BA',
                'name' => 'Bahia'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'CE',
                'name' => 'Ceará'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'DF',
                'name' => 'Distrito Federal'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'ES',
                'name' => 'Espírito Santo'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'GO',
                'name' => 'Goiás'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'MA',
                'name' => 'Maranhão'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'MG',
                'name' => 'Minas Gerais'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'MS',
                'name' => 'Mato Grosso do Sul'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'MT',
                'name' => 'Mato Grosso'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'PA',
                'name' => 'Pará'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'PB',
                'name' => 'Paraíba'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'PE',
                'name' => 'Pernambuco'
            ]);

        DB::table('states')->insert([
              
                'sigla' => 'PI',
                'name' => 'Piauí'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'PR',
                'name' => 'Paraná'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'RJ',
                'name' => 'Rio de Janeiro'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'RN',
                'name' => 'Rio Grande do Norte'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'RO',
                'name' => 'Rondônia'
            ]);

        DB::table('states')->insert([
              
                'sigla' => 'RR',
                'name' => 'Roraima'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'RS',
                'name' => 'Rio Grande do Sul'
            ]);

        DB::table('states')->insert([
                
                'sigla' => 'SC',
                'name' => 'Santa Catarina'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'SE',
                'name' => 'Sergipe'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'SP',
                'name' => 'São Paulo'
            ]);

        DB::table('states')->insert([
               
                'sigla' => 'TO',
                'name' => 'Tocantins'
            ]);
    }
}
