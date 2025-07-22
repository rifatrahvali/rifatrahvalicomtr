<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Temel rolleri oluştur
        // firstOrCreate metodu, belirtilen rolu bulur veya yoksa oluşturur.
        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'User']);
    }
}
