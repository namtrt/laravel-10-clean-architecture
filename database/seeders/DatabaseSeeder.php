<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()
            ->create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
            ]);
    }
}
