<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'instructor']);
        Role::firstOrCreate(['name' => 'student']);

        // Create dev users
        $admin = User::firstOrCreate(
            ['email' => 'admin@vertex.ma'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('admin');

        $instructor = User::firstOrCreate(
            ['email' => 'instructor@vertex.ma'],
            [
                'name' => 'Instructor',
                'password' => bcrypt('password'),
            ]
        );
        $instructor->assignRole('instructor');

        $student = User::firstOrCreate(
            ['email' => 'student@vertex.ma'],
            [
                'name' => 'Student',
                'password' => bcrypt('password'),
            ]
        );
        $student->assignRole('student');
    }
}
