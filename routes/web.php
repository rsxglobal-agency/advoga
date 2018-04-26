<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/politica', function() { return view('politica'); });


/*
Route::get('/cadastro', function (){
    
  return view('cadastro');
});
*/

Route::get('/cadastro', 'UserController@cadastro');
Route::get('/atualizar-cadastro', 'UserController@update')->name('profile');

Route::get('/assinatura', 'UserController@assinatura');
Route::get('loginmensagem', 'Auth\LoginController@loginMensagem');

Route::post('/atualizar-cadastro', 'UserController@updatePost');
Route::get('/compra', 'UserController@compra');

Route::resource('user', 'UserController');
Route::post("user/pagamento/{user_id}", 'UserController@pagamento');
Route::post("payment/status", 'PaymentController@status');
Route::get("payment/status", 'PaymentController@status');
Route::get("status", 'StatusController@status');
Route::get("executor", 'StatusController@executor');

Route::get('/lancar-demanda','DemandController@lancar');
Route::post('/demandas/update', 'DemandController@update');    

Route::get('/minhas-demandas', 'HomeController@mydemand');
Route::get('/demandas-em-execucao', 'DiligenciaController@demandaexe');
Route::get('/demanda/cadidatos/{id}', 'DemandController@cadidatos');
//Route::get('/minhas-demandas/cadidatos/{id}', 'DemandController@cadidatos');


Route::resource('demands', 'DemandController');

Route::get('historical', 'HomeController@historic');

Route::get('/busca','BuscaController@index');
Route::post('/busca/resultados','BuscaController@resultados');

Route::get('/candidaturas', 'DiligenciaController@candidaturas');
Route::get('/emexecucao', 'DiligenciaController@index');

Route::get('/messages','MessagesController@teste');
//Route::get('/messages/conversa','MessagesController@conversa');
Route::post('/messages/conversa','MessagesController@conversa');
Route::post('/messages/insert','MessagesController@insert');
Route::get('/messages/insert','MessagesController@insert');
Route::get('/messages/json','MessagesController@json');

Route::get('/chat','ChatController@index');




Route::get(
    'ajax/cities',
    function () {
        $states_id = Input::get('state_id');

        return \App\City::where('state_id', '=', $states_id)->pluck('id', 'name');
    }
);


Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/aceitar/{id}', 'DiligenciaController@aceitar');

Route::get('/cancelar/{id}', 'DiligenciaController@cancelar');

Route::get('/removerexecutor/{id}', 'DiligenciaController@removerexecutor');

Route::get('/demandaconcluida/{id}', 'DiligenciaController@demandaconcluida');

Route::get('/removerdemanda/{id}', 'DiligenciaController@removerdemanda');

Route::get('/desistirdemanda/{id}', 'DiligenciaController@desistirdemanda');

Route::post('/concluir-demanda', 'DiligenciaController@concluir');

Route::post('/avaliar-demanda', 'DiligenciaController@avaliar');

/* Checkout */
Route::get('/checkout', 'CheckoutController@index');
Route::get('/checkout/redirect-url', 'CheckoutController@redirect_url');
Route::get('/checkout/status', 'CheckoutController@status');
Route::post('/checkout/status', 'CheckoutController@status'); 


