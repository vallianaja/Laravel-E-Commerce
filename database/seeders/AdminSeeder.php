<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ini Seeder untuk membuat Admin
        $user = new User;
        $user->name = "Admin Vallian";
        $user->email = "vallian@admin.com";
        $user->level = "admin";
        $user->password = "123123123";
        $user->save();
    }
}
