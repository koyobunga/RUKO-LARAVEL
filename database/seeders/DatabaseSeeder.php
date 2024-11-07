<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kaban;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'level' => 'admin',
            'asn_id' => '0',
            'username' => 'admin',
            'password' => Hash::make('admin'),

        ]);

        Kaban::create([
            'nama' => 'BUDIYANTO SIDIKI, S.Sos M.S',
            'nip' => '197403111993011001',
            'pangkat' => 'Pembina Utama Madya (IV/d)',

        ]);
    }
}
