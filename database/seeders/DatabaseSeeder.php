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
                'phone' => '71999094687',
                'cpf' => '21791350500',
                'role' => User::ROLE_ADMIN,
                'password' => Hash::make('91316445'),
            ),
        );

        foreach ($userAdmin as $user) {
            DB::table('users')->insert($user);
        }
    }
}
