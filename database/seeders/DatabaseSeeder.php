<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin[] = array(
            array(
                'name' => 'Claudio Souza',
                'email' => 'claudiosouza.cia@gmail.com',
                'email_verified_at' => now(),
                'nick_game' => 'claudiocia',
                'dt_nasc' => '1964-05-07',
                'phone' => '(71) 99909-4687',
                'cpf' => '21791350500',
                'role' => User::ROLE_ADMIN,
                'password' => Hash::make('91316445'),
            ),
            array(
                'name' => 'Usuario Teste',
                'email' => 'teste@user.com',
                'email_verified_at' => now(),
                'nick_game' => 'teste',
                'dt_nasc' => '1964-05-07',
                'phone' => '(71) 99909-4647',
                'cpf' => '02469619530',
                'role' => User::ROLE_PLAYER,
                'password' => Hash::make('91316445'),
            ),
            array(
                'name' =>  'Thales Kevin Lima',
                'email' =>  'thales_kevin_lima@ppconsulting.com.br',
                'email_verified_at' => now(),
                'nick_game' => 'thai',
                'dt_nasc' =>  '1993-01-23',
                'phone' =>  '(82) 98136-7766',
                'cpf' =>  '26469352006',
                'role' => User::ROLE_PLAYER,
                'password' => Hash::make('91316445'),
            ),
            array(
                'name' =>  'Cláudia Sueli da Costa',
                'email' =>  'claudia.sueli.dacosta@rotauniformes.com.br',
                'email_verified_at' => now(),
                'nick_game' => 'claus',
                'dt_nasc' =>  '1966-01-17',
                'phone' =>  '(51) 98987-0015',
                'cpf' =>  '52238164049',
                'role' => User::ROLE_PLAYER,
                'password' => Hash::make('91316445'),
            ),
            array(
                'name' =>  'Luana Lara Isabel Nogueira',
                'email' =>  'luana_nogueira@dhl.com',
                'email_verified_at' => now(),
                'nick_game' => 'lua',
                'dt_nasc' =>  '2002-02-14',
                'phone' =>  '(82) 99750-2170',
                'cpf' =>  '26459780889',
                'role' => User::ROLE_PLAYER,
                'password' => Hash::make('91316445'),
            ),
            array(
                'name' =>  'Victor Benjamin da Mata',
                'email' =>  'victorbenjamindamata@lifefp.com.br',
                'email_verified_at' => now(),
                'nick_game' => 'vic23',
                'dt_nasc' =>  '1957-01-08',
                'phone' =>  '(81) 99443-1007',
                'cpf' =>  '96483303106',
                'role' => User::ROLE_PLAYER,
                'password' => Hash::make('91316445'),
            ),
            array(
                'name' =>  'César Fernando Vieira',
                'email' =>  'cesar_vieira@mcpsolucoesgraficas.com.br',
                'email_verified_at' => now(),
                'nick_game' => 'cesar',
                'dt_nasc' =>  '1950-01-13',
                'phone' =>  '(51) 99610-1221',
                'cpf' =>  '33441808002',
                'role' => User::ROLE_PLAYER,
                'password' => Hash::make('91316445'),
            ),
            array(
                'name' =>  'Aparecida Valentina Galvão',
                'email' =>  'aparecidavalentinagalvao@gastrolight.com.br',
                'email_verified_at' => now(),
                'nick_game' => 'cida',
                'dt_nasc' =>  '1979-01-26',
                'phone' =>  '(47) 98625-1651',
                'cpf' =>  '90121033635',
                'role' => User::ROLE_PLAYER,
                'password' => Hash::make('91316445'),
            ),
            array(
                'name' =>  'Leonardo Heitor Souza',
                'email' =>  'leonardoheitorsouza@audiogeni.com.br',
                'email_verified_at' => now(),
                'nick_game' => 'leo',
                'dt_nasc' =>  '1980-02-18',
                'phone' =>  '(61) 99815-0067',
                'cpf' =>  '74074917203',
                'role' => User::ROLE_PLAYER,
                'password' => Hash::make('91316445'),
            )
        );

        foreach ($userAdmin as $user) {
            DB::table('users')->insert($user);
        }

        $plataformas[] = array(
            array(
                'name' => 'FIFA Football',
                'sigla' => 'FIFA'
            ),
            array(
                'name' => 'Pro Evolution Soccer 2019',
                'sigla' => 'PES-2019'
            )
        );

        foreach ($plataformas as $plataforma) {
            DB::table('plataformas')->insert($plataforma);
        }
    }
}
