<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        DB::table('users')->truncate();

        $faker = Faker::create();

        // Seed Admin User
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@healthhub.com',
            'password' => Hash::make('password123'),
            'is_self_pay' => false,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Multiple Random Users
        foreach (range(1, 50) as $index) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('user123'),
                'birth_date' => $faker->date(),
                'address' => $faker->address(),
                'phone_number' => $faker->phoneNumber(),
                'profile_picture' => $faker->optional()->imageUrl(),
                'is_self_pay' => $faker->boolean(30), // 30% chance of being true
                'email_verified_at' => $faker->optional()->dateTimeBetween('-1 year', 'now'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}