<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $bearer = Role::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'Bearer']);
        $guest = Role::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'Guest']);
        $actorIndex = Permission::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'actor-index']);
        $actorStore = Permission::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'actor-store']);
        $actorShow = Permission::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'actor-show']);
        $actorUpdate = Permission::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'actor-update']);
        $actorDestroy = Permission::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'actor-destroy']);
        $imageIndex = Permission::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'image-index']);
        $imageStore = Permission::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'image-store']);
        $imageShow = Permission::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'image-show']);
        $imageUpdate = Permission::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'image-update']);
        $imageDestroy = Permission::firstOrCreate(['guard_name' => 'sanctum', 'name' => 'image-destroy']);

        $bearer->syncPermissions([
            $actorIndex, $actorStore, $actorShow, $actorUpdate, $actorDestroy,
            $imageIndex, $imageStore, $imageShow, $imageUpdate, $imageDestroy
        ]);
        
        $guest->syncPermissions([
            $actorIndex, $actorShow, $imageIndex, $imageShow
        ]);

        $user = User::first();
        $user->assignRole($bearer);

        foreach (User::where('id', '>', 1)->get() as $user) {
            $user->assignRole($guest);
        }
    }

    }
