<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      User::create([
        'name' => 'Admin',
        'email' => 'admin@company.com',
        'password' => bcrypt('123123123'),
        'email_verified_at' => now()
      ]);

      User::create([
        'name' => 'Agent 1',
        'email' => 'agent@company.com',
        'password' => bcrypt('123123123'),
        'email_verified_at' => now()
      ]);

      User::create([
         'name' => 'Agent 2',
         'email' => 'agent2@company.com',
         'password' => bcrypt('123123123'),
         'email_verified_at' => now()
       ]);
    }
}
