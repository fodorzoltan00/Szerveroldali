<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Position;
use App\Models\Room;
use App\Models\UserRoomEntry;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@szerveroldali.hu',
            'password' => password_hash('adminpwd', PASSWORD_BCRYPT),
            'admin' => true
        ]);

        User::factory(10)->create();
        Position::factory(5)->create();
        //Room::factory(10)->create();
        //UserRoomEntry::factory(10)->create();


        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
