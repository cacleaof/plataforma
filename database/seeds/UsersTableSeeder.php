<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'name' 		=> 'Carlos Leao',
    		'email' 	=> 'cacleaof@gmail.com',
            'cpf'       => '68631839434',
    		'password' 	=> bcrypt('123456'),
    	]);
        User::create([
            'name'      => 'Carlos SES',
            'email'     => 'carlos.leao@saude.pe.gov.br',
            'cpf'       => '96105097468',
            'password'  => bcrypt('123456'),
        ]);
    }
}
