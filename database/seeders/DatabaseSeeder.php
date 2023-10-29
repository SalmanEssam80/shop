<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (User::count() == 0) {
            User::create([
                'name' => 'Salman',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456789')
            ]);
        }
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            ContactUsSeeder::class,
            AboutUsSeeder::class,
            SubscriberSeeder::class,
            FaqSeeder::class
        ]);
    }
}
