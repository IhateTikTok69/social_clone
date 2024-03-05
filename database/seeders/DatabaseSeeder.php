<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\have_chat;
use Illuminate\Database\Seeder;
use App\Models\users;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        users::factory()->create([
            'id' => '1549842',
            'userName' => 'testuserA',
            'email' => 'test1@example.com',
            'password' => bcrypt('password123'),
            'banner_pic' => '/assets/banner/banner.jpg',
            'display_name' => 'Rickidy Rick',
            'status' => 'offline',
            'profile_pic' => '/assets/usr/rick.webp'
        ]);
        users::factory()->create([
            'userName' => 'testuserB',
            'email' => 'test2@example.com',
            'password' => bcrypt('password123'),
            'banner_pic' => '/assets/banner/banner.jpg',
            'display_name' => 'Big Tities',
            'status' => 'offline',
            'profile_pic' => '/assets/usr/HOT.jpg'
        ]);
        users::factory()->create([
            'userName' => 'testuserC',
            'email' => 'test3@example.com',
            'password' => bcrypt('password123'),
            'banner_pic' => '/assets/banner/banner.jpg',
            'display_name' => 'Big Ass',
            'status' => 'offline',
            'profile_pic' => '/assets/usr/images.jpg'
        ]);
    }
}
