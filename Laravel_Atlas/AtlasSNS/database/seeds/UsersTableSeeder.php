<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'hoge',
                'mail' => 'test123@gmail.com',
                'password' => '12345678'
            ],
           [
                'username' => 'hogehoge',
                'mail' => 'test456@gmail.com',
                'password' => '23456789']
           ]);
    }
}
