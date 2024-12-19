<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Factory;
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
        $admin = User::create([
            'userid' => 'admin101',
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' =>  bcrypt('admin'),
        ]);
        \App\Models\User::factory()->count(5)->create();
        
    }
}

