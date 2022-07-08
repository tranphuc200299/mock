<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'nva',
            'password' => Hash::make('123123'),
            'email' => 'nva@gmail.com',
            'status' => true,
        ]);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'company']);
        Role::create(['name' => 'store']);

        $user->assignRole('admin');
    }
}
