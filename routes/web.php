<?php

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){

	$this->group(['middleware' => ['role:admin']], function(){

	$this->get('lista', 'UserControl@lista')->name('admin.cadastro.lista');

	$this->get('usuario', 'UserControl@usuario')->name('admin.cadastro.usuario');

	$this->post('store/{id}', 'UserControl@store')->name('admin.cadastro.store');

	$this->get('deletar', 'UserControl@deletar')->name('admin.cadastro.deletar');

	$this->get('task', 'ProjControl@task')->name('admin.proj.task');

	$this->get('diario', 'ProjControl@diario')->name('admin.proj.diario');

	$this->get('n_proj', 'ProjControl@n_proj')->name('admin.proj.n_proj');

	$this->get('n_task', 'ProjControl@n_task')->name('admin.proj.n_task');

	$this->get('store_p', 'ProjControl@store_p')->name('admin.proj.store_p');

	$this->get('store_t', 'ProjControl@store_t')->name('admin.proj.store_t');

	$this->get('status_proj', 'ProjControl@status_proj')->name('admin.proj.status_proj');

	$this->get('status_task', 'ProjControl@status_task')->name('admin.proj.status_task');

	});	
	

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

	$this->get('/saida', 'ConsultController@saida')->name('consult.saida');

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

	$this->post('save_usuarios', 'Importar@save_usuarios')->name('importar.save_usuarios');

	$this->get('usuarios', 'Importar@usuarios')->name('importar.usuarios');

	$this->get('tarefas', 'Importar@tarefas')->name('importar.tarefas');

	$this->post('save_tarefas', 'Importar@save_tarefas')->name('importar.save_tarefas');

	$this->get('gettask', 'Importar@gettask')->name('importar.gettask');

	$this->get('getindex', 'Importar@getindex')->name('importar.getindex');

	$this->get('/export_excel', 'ExportExcelController@index');

	$this->get('/export_users', 'ExportUserController@index');

	$this->get('/export_proj', 'ExportProjController@index');

	$this->get('/export_task', 'ExportTaskController@index');

	$this->get('/export_dep', 'ExportDepController@index');

	$this->get('/export_excel/excel', 'ExportExcelController@excel')->name('export_excel.excel');

	$this->get('/export_users/excel', 'ExportUserController@excel')->name('export_users.excel');

	$this->get('/export_proj/excel', 'ExportProjController@excel')->name('export_proj.excel');

	$this->get('/export_task/excel', 'ExportTaskController@excel')->name('export_task.excel');

	$this->get('/export_dep/excel', 'ExportDepController@excel')->name('export_dep.excel');

});
     //o certo é colocar o post, saida, fim dentro do 'middleware' => ['auth'] pois o
	//usuario tem que estar logado para que ele possar ver os posts
	$this->post('atualizar-perfil', 'Admin\UserControl@profileUpdate')->name('profile.update')->middleware('auth');

	//$this->get('/saida', 'Admin\ConsultController@saida')->name('admin.consult.saida')->middleware('auth');

	$this->get('meu-perfil', 'Admin\UserControl@profile')->name('profile')->middleware('auth');

	$this->get('/', 'Site\SiteController@index')->name('home');

	$this->get('/finalizadas', 'Admin\ConsultController@finalizada')->name('admin.home.finalizada')->middleware('auth');

	//$this->get('/post', 'Site\SiteController@post')->name('post')->middleware('auth');

	$this->post('/duvida', 'Site\SiteController@duvida')->name('admin.home.duvida')->middleware('auth');
	


	Auth::routes();

