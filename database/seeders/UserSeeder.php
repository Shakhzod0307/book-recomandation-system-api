<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=>'Shakhzod',
            'profession'=>'Student',
            'email'=>'shahzodrashidov0307@gmail.com',
            'password'=>Hash::make('superadmin123'),
        ]);
        $user->roles()->attach(1);
        $user2 = User::create([
            'name'=>'Mirzoyoqub',
            'profession'=>'Student',
            'email'=>'mirzoyoqub235@gmail.com',
            'password'=>Hash::make('admin123'),
        ]);
        $user2->roles()->attach(2);
        $user3 = User::create([
            'name'=>'Kamron',
            'profession'=>'Student',
            'email'=>'kamron@gmail.com',
            'password'=>Hash::make('author123'),
        ]);
        $user3->roles()->attach(3);
        $user4 = User::create([
            'name'=>'Samandar',
            'profession'=>'Student',
            'email'=>'samandar@gmail.com',
            'password'=>Hash::make('reader123'),
        ]);
        $user4->roles()->attach(4);
    }
}
