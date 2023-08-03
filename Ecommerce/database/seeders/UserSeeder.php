<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'root',
                'username' => 'root',
                'email' => 'root@root.com',
                'role' => 'root',
                'password' => bcrypt('Crystian@2561234268532554')
            ],
            [
                'name' => 'xinitric',
                'username' => 'xinitric',
                'email' => 'test0@mail.com',
                'role' => 'admin',
                'password' => bcrypt('c25612342')
            ],
            [
                'name' => 'karasinski',
                'username' => 'karasinski',
                'email' => 'test1@mail.com',
                'role' => 'user',
                'password' => bcrypt('c25612342')
            ],
            [
                'name' => 'john doe',
                'username' => 'johndoe',
                'email' => 'test2@mail.com',
                'role' => 'vendor',
                'password' => bcrypt('c25612342')
            ]
        ]);
    }
}
