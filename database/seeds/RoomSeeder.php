<?php

use Illuminate\Database\Seeder;
use App\Models\Building;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $building = Building::create(['name' => "Columbine Hall", 'abbreviation' => "COLU"]);
        
        $rooms = array('103','105','114','115','116','117','127','128','132','135','136',
        '209','214','216','220','221','223','224','230','231','231A',
        '303','304','317','322','323','324','325','329','333','334');
        
        foreach($rooms as $room){
            Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        
        $building = Building::create(['name' => "Centennial Hall", 'abbreviation' => "CENT"]);
        
        $rooms = array('102','106','186','188','191','192','203','245');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        $building = Building::create(['name' => "Dwire Hall", 'abbreviation' => "DWIR"]);
        
        $rooms = array('101','103','104','106','112','114','121','201','272','303');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        $building = Building::create(['name' => "Engineering", 'abbreviation' => "ENGR"]);
        
        $rooms = array('101','103','105','107','109');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        $building = Building::create(['name' => "Cucharas", 'abbreviation' => "CUCH"]);
        
        $rooms = array('101','103','104','105','107');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        $building = Building::create(['name' => "Osborne Center", 'abbreviation' => "OCSE"]);
        
        $rooms = array('B134','B136','B138','B211','B213','B215','B216','B217');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        $building = Building::create(['name' => "Academic Office Building", 'abbreviation' => "ACAD"]);
          
        $rooms = array('101','201','301','402');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        $building = Building::create(['name' => "Breckenridge", 'abbreviation' => "BREK"]);
        
        $rooms = array('5101','5104','5106','5113');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        $building = Building::create(['name' => "University Hall", 'abbreviation' => "UHAL"]);
        
        $rooms = array('109','118','132','133','140','141','165','216','317');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        $building = Building::create(['name' => "Cragmor", 'abbreviation' => "CRAG"]);
        
        $rooms = array('008');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        $building = Building::create(['name' => "Lane Center", 'abbreviation' => "LANE"]);
        
        $rooms = array('120','420');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        $building = Building::create(['name' => "El Pomar Center", 'abbreviation' => "EPC"]);
        
        $rooms = array('103','107','109','239');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room, 'bulb_hours'=>rand(100,2450)]);
        }
        
        $building = Building::create(['name' => "Kraemer Family Library", 'abbreviation' => "KFL"]);
        
        $rooms = array('Scotty1-5','Scotty6-11','McCoy1-5','McCoy6-11','Spock1-5','Spock6-11','Spock12-17',
        'Kirk1-5','Kirk6-11','Kirk12-17','Uhura1-5','Uhura6-11','Uhura12-19','Sulu1-5','Sulu6-11',
        'Sarek1-6','Sarek7-11','Chekov1-6','Chekov7-11','Chekov12-19','Jadzia1-6','Jadzia7-11','Jadzia12-14',
        'Chapel1-6','Chapel7-12','Chapel13-18','Chapel19-23','Rand1-6','Rand7-12','Rand13-18','Rand19-24','Rand25-34');
        
        foreach($rooms as $room){
           Room::create(['number'=>$room,'building'=>$building->id,'full_name'=>$building->abbreviation . " " . $room]);
        }

	
		$user = new App\User();
        $user->password = Hash::make('brendan');
        $user->name = 'brendan';
        $user->email = 'brendan@email.com';
        $user->assignRole('admin');
        $user->save();
        
        
        
    }
}
