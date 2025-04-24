<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\Todo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

=======
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
>>>>>>> c08d03ce07ef10461e3ccda1bb7ebc3176fb85e7

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
<<<<<<< HEAD
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ]);

        User::factory(100)->create();
        Todo::factory(500)->create();
=======
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
>>>>>>> c08d03ce07ef10461e3ccda1bb7ebc3176fb85e7
    }
}
