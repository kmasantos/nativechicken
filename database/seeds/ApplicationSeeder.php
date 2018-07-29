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
        $wmsu = new Breed;
        $wmsu->breed = "WMS";
        $wmsu->animaltype_id = $chickenAnimal->id;
        $wmsu->save();
        $this->command->info('Breeds Seeded');

        // Seed Farms
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
        $this->command->info('Users Seeded');
    }
}
