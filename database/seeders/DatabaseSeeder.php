<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@haawwaagalaan.gov.et'],
            [
                'name'     => 'Admin',
                'email'    => 'admin@haawwaagalaan.gov.et',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'change-me')),
            ]
        );

        // Seed all content
        $this->call(ContentSeeder::class);
    }
}
