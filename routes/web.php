<?php

$this->group(['middleware' => ['auth'], 'namespace' => 'admin', 'prefix' => 'admin'], function(){

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

});
     //o certo é colocar o post, saida, fim dentro do 'middleware' => ['auth'] pois o
	//usuario tem que estar logado para que ele possar ver os posts
	$this->post('atualizar-perfil', 'Admin\UserControl@profileUpdate')->name('profile.update')->middleware('auth');

	$this->get('meu-perfil', 'Admin\UserControl@profile')->name('profile')->middleware('auth');

	$this->get('/', 'Site\SiteController@index')->name('home');

	$this->get('/saida', 'admin\ConsultController@saida')->name('admin.consult.saida')->middleware('auth');

	$this->get('/finalizadas', 'admin\ConsultController@finalizada')->name('admin.home.finalizada')->middleware('auth');

	//$this->get('/post', 'Site\SiteController@post')->name('post')->middleware('auth');

	$this->post('/duvida', 'Site\SiteController@duvida')->name('admin.home.duvida')->middleware('auth');
	//Route::get('/post', function(){
	//	return view('post');});

	Auth::routes();

