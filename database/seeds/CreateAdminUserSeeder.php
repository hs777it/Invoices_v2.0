<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{

        public function run()
        {

                $user = User::create([
                        'name' => 'hs777it',
                        'email' => 'hs777it@gmail.com',
                        'password' => bcrypt('123456'),
                        'roles_name' => ["owner"],
                        'Status' => 'مفعل',
                ]);

                $role = Role::create(['name' => 'owner']);

                $permissions = Permission::pluck('id', 'id')->all();

                $role->syncPermissions($permissions);

                $user->assignRole([$role->id]);
        }
}
