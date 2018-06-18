<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Post;
use App\Models\Perfil;

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
    		'password' 	=> bcrypt('123'),
    	]);
        User::create([
            'name'      => 'Carlos SES',
            'email'     => 'carlos.leao@saude.pe.gov.br',
            'cpf'       => '96105097468',
            'password'  => bcrypt('123'),
        ]);
        User::create([
            'name'      => 'solicitante',
            'email'     => 'solicitante@ses.br',
            'cpf'       => '3',
            'password'  => bcrypt('123'),
        ]);
        User::create([
            'name'      => 'regulador',
            'email'     => 'regulador@ses.br',
            'cpf'       => '4',
            'password'  => bcrypt('123'),
        ]);
        User::create([
            'name'      => 'consultor',
            'email'     => 'consultor@ses.br',
            'cpf'       => '5',
            'password'  => bcrypt('123'),
        ]);
        User::create([
            'name'      => 'monitor',
            'email'     => 'monitor@ses.br',
            'cpf'       => '6',
            'password'  => bcrypt('123'),
        ]);
        Post::create([
            'user_id'      => '3',
            'status'       => 'R',
            'descriçao'    => 'Solicitação feita e enviada ao Regulador',
        ]);
        Post::create([
            'user_id'      => '4',
            'status'       => 'C',
            'descriçao'    => 'Solicitação regulada e enviada ao Teleconsultor',
        ]);
        Post::create([
            'user_id'      => '5',
            'status'       => 'A',
            'descriçao'    => 'Consultoria finalizada pelo Teleconsultor e enviada ao solicitante',
        ]);
        Post::create([
            'user_id'      => '3',
            'status'       => 'F',
            'descriçao'    => 'Consultoria avaliada pelo solicitante',
        ]);
        Perfil::create([
            'user_id'      => '3',
            'perfil'       => 'S',
        ]);
        Perfil::create([
            'user_id'      => '4',
            'perfil'       => 'R',
        ]);
        Perfil::create([
            'user_id'      => '5',
            'perfil'       => 'C',
        ]);
        Perfil::create([
            'user_id'      => '6',
            'perfil'       => 'M',
        ]);
    }
}
