<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\AnimalType;
use App\Models\Breed;
use App\Models\Farm;
use Carbon\Carbon;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed Roles
        $farmRole = new Role;
        $farmRole->role = "farm";
        $farmRole->save();
        $adminRole = new Role;
        $adminRole->role = 'admin';
        $adminRole->save();
        $this->command->info('Roles Seeded');

        // Seed Animal Types
        $chickenAnimal = new AnimalType();
        $chickenAnimal->species = "chicken";
        $chickenAnimal->save();
        $duckAnimal = new AnimalType();
        $duckAnimal->species = "duck";
        $duckAnimal->save();
        $this->command->info('Animal Types Seeded');

        // Seed Breeds
        $darag = new Breed;
        $darag->breed = "DRG";
        $darag->animaltype_id = $chickenAnimal->id;
        $darag->save();
        $boholano = new Breed;
        $boholano->breed = "BHL";
        $boholano->animaltype_id = $chickenAnimal->id;
        $boholano->save();
        $zampen = new Breed;
        $zampen->breed = "ZAM";
        $zampen->animaltype_id = $chickenAnimal->id;
        $zampen->save();
        $camarines = new Breed;
        $camarines->breed = "CAM";
        $camarines->animaltype_id = $chickenAnimal->id;
        $camarines->save();
        $ipItim = new Breed;
        $ipItim->breed = "IPItim";
        $ipItim->animaltype_id = $duckAnimal->id;
        $ipItim->save();
        $IPKhaki = new Breed;
        $IPKhaki->breed = "IPKhaki";
        $IPKhaki->animaltype_id = $duckAnimal->id;
        $IPKhaki->save();
        $this->command->info('Breeds Seeded');

        // Seed Farms
        $farm1 = new Farm;
        $farm1->name = "Western Mindanao State University";
        $farm1->code = "WMSU";
        $farm1->address = "Normal Rd, Zamboanga, 7000 Zamboanga del Sur";
        $farm1->breedable_id = $zampen->id;
        $farm1->batching_week = 2;
        $farm1->save();

        $farm2 = new Farm;
        $farm2->name = "Western Visayas State University";
        $farm2->code = "WVSU";
        $farm2->address = "Luna St, La Paz, Iloilo City, 5000 Iloilo";
        $farm2->breedable_id = $darag->id;
        $farm2->batching_week = 2;
        $farm2->save();

        $farm3 = new Farm;
        $farm3->name = "Ubay Stock Farm";
        $farm3->code = "USF";
        $farm3->address = "Ubay, Bohol";
        $farm3->breedable_id = $boholano->id;
        $farm3->batching_week = 2;
        $farm3->save();

        $farm4 = new Farm;
        $farm4->name = "Bicol University";
        $farm4->code = "BU";
        $farm4->address = "Legazpi City, Albay, Philippines 4500";
        $farm4->breedable_id = $camarines->id;
        $farm4->batching_week = 2;
        $farm4->save();

        $farm5 = new Farm;
        $farm5->name = "National Swine And Poultry Research And Development Center";
        $farm5->code = "NSPRDC";
        $farm5->address = "KM 101 Maharlika Highway Brgy. Lagalag Tiaong, Quezon";
        $farm5->breedable_id = $ipItim->id;
        $farm5->batching_week = 2;
        $farm5->save();

        $farm6 = new Farm;
        $farm6->name = "National Swine And Poultry Research And Development Center";
        $farm6->code = "NSPRDC";
        $farm6->address = "KM 101 Maharlika Highway Brgy. Lagalag Tiaong, Quezon";
        $farm6->breedable_id = $IPKhaki->id;
        $farm6->batching_week = 2;
        $farm6->save();

        $farmSample = new Farm;
        $farmSample->name = "Farm Name Sample";
        $farmSample->code = "BUCAF";
        $farmSample->address = "Bicol";
        $farmSample->breedable_id = $camarines->id;
        $farmSample->batching_week = 2;
        $farmSample->save();

        $this->command->info('Farms Seeded');

        $now = Carbon::now()->toDateString();
        $user = new User;
        $user->name = "FarmSampleUser";
        $user->email = "sfretuerma@gmail.com";
        $user->last_active = $now;
        $user->farm_id = $farmSample->id;
        $user->role_id = $farmRole->id;
        $user->save();

        $user3 = new User;
        $user3->name = "WMSU";
        $user3->email = "zampen.wmsu@gmail.com";
        $user3->last_active = $now;
        $user3->farm_id = $farm1->id;
        $user3->role_id = $farmRole->id;
        $user3->save();

        $user4 = new User;
        $user4->name = "WVSU";
        $user4->email = "wvsu.darag@gmail.com";
        $user4->last_active = $now;
        $user4->farm_id = $farm2->id;
        $user4->role_id = $farmRole->id;
        $user4->save();

        $user5 = new User;
        $user5->name = "USF";
        $user5->email = "ngdoydora@gmail.com";
        $user5->last_active = $now;
        $user5->farm_id = $farm3->id;
        $user5->role_id = $farmRole->id;
        $user5->save();

        $user6 = new User;
        $user6->name = "BU";
        $user6->email = "tbpequena@gmail.com";
        $user6->last_active = $now;
        $user6->farm_id = $farm4->id;
        $user6->role_id = $farmRole->id;
        $user6->save();

        $user7 = new User;
        $user7->name = "NSPRDC";
        $user7->email = "ipitim.nsprdc@gmail.com";
        $user7->last_active = $now;
        $user7->farm_id = $farm5->id;
        $user7->role_id = $farmRole->id;
        $user7->save();

        $user8 = new User;
        $user8->name = "NSPRDC";
        $user8->email = "ipkhaki.nsprdc@gmail.com";
        $user8->last_active = $now;
        $user8->farm_id = $farm6->id;
        $user8->role_id = $farmRole->id;
        $user8->save();
        // TODO: pivot table for roles and users

        $this->command->info('Users Seeded');
    }
}
