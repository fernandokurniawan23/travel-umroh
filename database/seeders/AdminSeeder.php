<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin dengan email ini sudah ada
        $admin = User::where('email', 'admin@admin.com')->first();

        if (!$admin) {
            // Jika belum ada, buat admin baru
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123'),
                'role' => 'administrator',
            ]);
        }

        // Verifikasi email jika belum terverifikasi
        if (is_null($admin->email_verified_at)) {
            $admin->email_verified_at = now();
            $admin->save();
        }
    }
}
// namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// class AdminSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         User::create([
//             'name' => 'admin',
//             'email' => 'admin@admin.com',
//             'password' => bcrypt('123'),
//             'is_admin' => true,
//         ]);
//     }
// }
