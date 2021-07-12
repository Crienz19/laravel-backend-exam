<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
            'email'     =>  'admin@app.com',
            'full_name' =>  'AdminWebmaster',
            'password'  =>  Hash::make('adminadmin'),
            'role_id'   =>  1
        ]);

        Role::create([
            'name'          =>  'Administrator',
            'description'   =>  'Ol hail d admin!'
        ]);
    }
}
