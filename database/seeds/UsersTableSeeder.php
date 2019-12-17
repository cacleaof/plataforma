<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Consult;
use App\Models\Perfil;
use App\Models\Profissoe;
use App\Models\Especialidade;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Project;
use App\Models\Task;

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
        Consult::create([
            'user_id'      => '3',
            'status'       => 'R',
            'consulta'    => 'Solicitação feita e enviada ao Regulador',
        ]);
        Consult::create([
            'user_id'      => '4',
            'status'       => 'R',
            'consulta'    => 'Solicitação regulada e enviada ao Teleconsultor',
        ]);
        Consult::create([
            'user_id'      => '5',
            'status'       => 'S',
            'consulta'    => 'Consultoria finalizada pelo Teleconsultor e enviada ao solicitante',
        ]);
        Consult::create([
            'user_id'      => '3',
            'status'       => 'F',
            'consulta'    => 'Consultoria avaliada pelo solicitante',
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
        Profissoe::create([
            'user_id'      => '5',
            'profissao'       => 'Médico',
        ]);
        Profissoe::create([
            'user_id'      => '4',
            'profissao'       => 'Enfermeiro',
        ]);
        Especialidade::create([
            'user_id'      => '5',
            'prof_id'      => '1',
            'especialidade'  => 'Radiologista',
        ]);    
        Role::create([
            'name'      => 'admin',
            'display_name'      => 'Administrador',
        ]);
        RoleUser::create([
            'user_id'      => '1',
            'role_id'      => '1',
        ]);
        Project::create([
            'projeto'      => 'Hospedagem ATI - Moodle',
            'proj_detalhe'      => 'Desenvolver e hospedar novo Moodle na ATI',
            'gerente'      => '1',
        ]);
        DB::table('tasks')->insert([
            ['id'=>1, 'text'=>'Project #1', 'start_date'=>'2017-04-01 00:00:00', 'duration'=>5, 'progress'=>0.8, 'parent'=>0],
            ['id'=>2, 'text'=>'Task #1', 'start_date'=>'2017-04-06 00:00:00', 'duration'=>4, 'progress'=>0.5, 'parent'=>1],
            ['id'=>3, 'text'=>'Task #2', 'start_date'=>'2017-04-05 00:00:00', 'duration'=>6, 'progress'=>0.7, 'parent'=>1],
            ['id'=>4, 'text'=>'Task #3', 'start_date'=>'2017-04-07 00:00:00', 'duration'=>2, 'progress'=>0, 'parent'=>1],
            ['id'=>5, 'text'=>'Task #1.1', 'start_date'=>'2017-04-05 00:00:00', 'duration'=>5, 'progress'=>0.34, 'parent'=>2],
            ['id'=>6, 'text'=>'Task #1.2', 'start_date'=>'2017-04-11 00:00:00', 'duration'=>4, 'progress'=>0.5, 'parent'=>2],
            ['id'=>7, 'text'=>'Task #2.1', 'start_date'=>'2017-04-07 00:00:00', 'duration'=>5, 'progress'=>0.2, 'parent'=>3],
            ['id'=>8, 'text'=>'Task #2.2', 'start_date'=>'2017-04-06 00:00:00', 'duration'=>4, 'progress'=>0.9, 'parent'=>3]
        ]);
        //task::create([
        //    'task'      => 'Definir versão do Moodle',
        //    'detalhe'      => 'A versão deve ser estável',
        //    'proj_id'      => '1',
        //]);
        task::create([
            'text'      => 'Definir versão do Moodle',
            'detalhe'      => 'A versão deve ser estável',
            'proj_id'      => '1',
        ]);
    }
}
