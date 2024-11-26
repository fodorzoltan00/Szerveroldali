<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Position;
use App\Models\Room;
use App\Models\UserRoomEntry;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {



        $Positions = Position::factory(4)->create();
        $Rooms = Room::factory(5)->create();

        User::factory()->create([
            'email' => 'admin@szerveroldali.hu',
            'password' => password_hash('adminpwd', PASSWORD_BCRYPT),
            'admin' => true,
            'position_id' => rand(0,4)
        ]);

        $Users = collect();
        for($i = 0; $i < 10 ; $i++){
            $U = User::factory()->create([
                'position_id' => $Positions->random()->id,
            ]);
            $Users->push($U);
        }


        foreach($Rooms as $Room){
                $Room->positions()->attach($Positions->random(rand(0,4)));
        }

        $UserRoomEntry = collect();

        for($i = 0; $i < rand(200,300) ; $i++){
            $entry = UserRoomEntry::factory(1)->create([
                'room_id' => $Rooms->random()->id,
                'user_id' => $Users->random()->id,
            ]);
            $UserRoomEntry->push($entry);
        }
    }
}
