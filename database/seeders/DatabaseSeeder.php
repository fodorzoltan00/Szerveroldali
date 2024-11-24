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



        $Positions = Position::factory(4)->create();
        $Rooms = Room::factory(5)->create();

        $Users = collect();
        for($i = 0; $i < 10 ; $i++){
            $U = User::factory(1)->create([
                'position_id' => $Positions->random()->id,
            ]);
            $Users->push($U);
        }
        User::factory()->create([
            'email' => 'admin@szerveroldali.hu',
            'password' => password_hash('adminpwd', PASSWORD_BCRYPT),
            'admin' => true,
            'position_id' => 1
        ]);

        foreach($Rooms as $Room){
                $Room->positions()->attach($Positions->random(rand(0,4)));
        }



        //UserRoomEntry::factory(10)->create();


        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}
