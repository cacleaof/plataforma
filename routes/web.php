<?php

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'Admin'], function(){

	$this->any('historic-search', 'BalanceController@searchHistoric')->name('historic.search');
	$this->get('historic', 'BalanceController@historic')->name('admin.historic');

	$this->post('transfer', 'BalanceController@TransferStore')->name('transfer.store');
	
	$this->post('confirm-transfer', 'BalanceController@confirmTransfer')->name('confirm.transfer');

	$this->get('transfer', 'BalanceController@transfer')->name('balance.transfer');

	$this->post('withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');
	$this->get('withdraw', 'BalanceController@withdraw')->name('balance.withdraw');

	$this->post('deposit', 'BalanceController@DepositStore')->name('deposit.store');
	$this->get('deposit', 'BalanceController@deposit')->name('balance.deposit');
	$this->get('balance', 'BalanceController@index')->name('admin.balance');


	$this->get('/', 'AdminController@index')->name('admin.consult');

	$this->get('entrada', 'ConsultController@entrada')->name('consult.entrada');

	$this->get('/nova', 'ConsultController@nova')->name('consult.nova');

	$this->post('store', 'ConsultController@store')->name('consult.store');

	$this->get('regular', 'ConsultController@regular')->name('consult.regular');

	$this->get('consultor', 'ConsultController@consultor')->name('consult.consultor');

	$this->get('encaminhar', 'ConsultController@encaminhar')->name('consult.encaminhar');

	$this->get('selecresp', 'ConsultController@selecresp')->name('consult.selecresp');

	$this->get('resposta', 'ConsultController@resposta')->name('consult.resposta');

	$this->get('devolver', 'ConsultController@devolver')->name('consult.devolver');

	$this->get('dev_cons', 'ConsultController@dev_cons')->name('consult.dev_cons');

	$this->post('dev_con_store', 'ConsultController@dev_con_store')->name('consult.dev_con_store');

	$this->post('devstore', 'ConsultController@devstore')->name('consult.devstore');

	$this->get('show', 'ConsultController@show')->name('consult.show');

	$this->get('showS', 'ConsultController@showS')->name('consult.showS');

	$this->get('modelo', 'ConsultController@modelo')->name('consult.modelo');

	$this->post('show_store', 'ConsultController@show_store')->name('consult.show_store');

	$this->get('download', 'ConsultController@download')->name('consult.download');

	$this->get('respcons', 'ConsultController@respcons')->name('consult.respcons');

	$this->post('storecons', 'ConsultController@storecons')->name('consult.storecons');

	$this->get('wordssearch', 'ConsultController@wordssearch')->name('consult.wordssearch');

	$this->get('getcontent', 'ConsultController@getcontent')->name('consult.getcontent');

	$this->post('save_usuarios', 'importar@save_usuarios')->name('importar.save_usuarios');

	$this->get('usuarios', 'importar@usuarios')->name('importar.usuarios');

	$this->get('getindex', 'importar@getindex')->name('importar.getindex');

	$this->get('/export_excel', 'ExportExcelController@index');

	$this->get('/export_excel/excel', 'ExportExcelController@excel')->name('export_excel.excel');
});
     //o certo é colocar o post, saida, fim dentro do 'middleware' => ['auth'] pois o
	//usuario tem que estar logado para que ele possar ver os posts
	$this->post('atualizar-perfil', 'Admin\UserControl@profileUpdate')->name('profile.update')->middleware('auth');

	$this->get('meu-perfil', 'Admin\UserControl@profile')->name('profile')->middleware('auth');

	$this->get('/', 'Site\SiteController@index')->name('home');

	$this->get('/saida', 'Admin\ConsultController@saida')->name('admin.consult.saida')->middleware('auth');

	$this->get('/finalizadas', 'Admin\ConsultController@finalizada')->name('admin.home.finalizada')->middleware('auth');

	//$this->get('/post', 'Site\SiteController@post')->name('post')->middleware('auth');

	$this->post('/duvida', 'Site\SiteController@duvida')->name('admin.home.duvida')->middleware('auth');

	$this->get('lista', 'admin\UserControl@lista')->name('admin.cadastro.lista')->middleware('auth');

	$this->get('usuario', 'admin\UserControl@usuario')->name('admin.cadastro.usuario')->middleware('auth');

	$this->post('store', 'admin\UserControl@store')->name('admin.cadastro.store')->middleware('auth');

	$this->get('deletar', 'admin\UserControl@deletar')->name('admin.cadastro.deletar')->middleware('auth');
	//Route::get('/post', function(){
	//	return view('post');});

	Auth::routes();

