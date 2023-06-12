<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Role::create([
      'user_id' => 1,
      'role' => 'admin',
    ]);

    Role::create([
      'user_id' => 2,
      'role' => 'agent',
    ]);

    Role::create([
      'user_id' => 3,
      'role' => 'agent',
    ]);
  }
}
