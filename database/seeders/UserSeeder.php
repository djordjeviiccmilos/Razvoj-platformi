<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@pmf.rs',
            'password' => bcrypt('admin123'), // šifra je "password"
            'role' => 'admin',
            'banned' => false,
        ]);

        User::create([
            'name' => 'Milos Djordjevic',
            'email' => 'milos.djordjevic@pmf.rs',
            'password' => bcrypt('milos123'),
            'role' => 'student',
            'banned' => false,
        ]);

        User::create([
            'name' => 'Nikolija Cuckic',
            'email' => 'nikolija.cuckic@pmf.rs',
            'password' => bcrypt('nikolija123'),
            'role' => 'student',
            'banned' => false,
        ]);
    }
}
