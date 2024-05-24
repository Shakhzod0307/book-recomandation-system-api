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
            'role_id'=>1,
            'profession'=>'Student',
            'email'=>'shahzodrashidov0307@gmail.com',
            'password'=>Hash::make('superadmin123'),
        ]);
//        $user->role()->attach(1);
        $user2 = User::create([
            'name'=>'Mirzoyoqub',
            'role_id'=>2,
            'profession'=>'Student',
            'email'=>'mirzoyoqub235@gmail.com',
            'password'=>Hash::make('admin123'),
        ]);
//        $user2->role()->attach(2);
        $user3 = User::create([
            'name'=>'Kamron',
            'role_id'=>3,
            'profession'=>'Student',
            'email'=>'kamron@gmail.com',
            'password'=>Hash::make('author123'),
        ]);
//        $user3->role()->attach(3);
        $user4 = User::create([
            'name'=>'Samandar',
            'role_id'=>4,
            'profession'=>'Student',
            'email'=>'samandar@gmail.com',
            'password'=>Hash::make('reader123'),
        ]);
//        $user4->role()->attach(4);
    }
}
