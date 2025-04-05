<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create multiple users

        DB::table('users')->insert([
            [
                'email' => 'user1@gmail.com',
                'senha' => bcrypt('user12345'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'email' => 'user2@gmail.com',
                'senha' => bcrypt('user12345'),
                'created_at' => date('Y-m-d H:i:s'),
            ],

            [
                'email' => 'user3@gmail.com',
                'senha' => bcrypt('user12345'),
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
