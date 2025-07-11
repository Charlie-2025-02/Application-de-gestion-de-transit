<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{


    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $clientRole = Role::firstOrCreate(['name' => 'client']);

        User::firstOrCreate([
            'email' => 'admin@transit.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRole->id,
        ]);
    }

}
