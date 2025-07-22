<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Temel izinleri tanımla
        $permissions = [
            'manage-blog',
            'manage-users',
            'manage-settings',
            'manage-galleries',
            'manage-references',
        ];

        // İzinleri oluştur
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Admin rolünü bul ve tüm izinleri ata
        $adminRole = Role::where('name', 'Admin')->first();
        if ($adminRole) {
            $adminRole->syncPermissions(Permission::all());
        }

        // User rolünü bul ve hiçbir özel izin atama (şimdilik)
        $userRole = Role::where('name', 'User')->first();
        if ($userRole) {
            // Gerekirse daha sonra belirli izinler atanabilir.
            $userRole->syncPermissions([]);
        }
    }
}
