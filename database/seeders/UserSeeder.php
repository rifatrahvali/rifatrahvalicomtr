<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin kullanıcısını oluştur veya bul
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@rifatrahvali.com.tr'],
            [
                'name' => 'Rıfat Rahvalı',
                'password' => Hash::make('password'), // Gerçek projede güvenli bir şifre kullanın
            ]
        );

        // Admin rolünü bul ve kullanıcıya ata
        $adminRole = Role::where('name', 'Admin')->first();
        if ($adminUser && $adminRole) {
            $adminUser->assignRole($adminRole);
        }

        // Normal kullanıcılar oluştur
        // UserFactory kullanarak 5 adet rastgele kullanıcı oluştur
        User::factory(5)->create()->each(function ($user) {
            // Her bir kullanıcıya 'User' rolünü ata
            $userRole = Role::where('name', 'User')->first();
            if ($userRole) {
                $user->assignRole($userRole);
            }
        });
    }
}
