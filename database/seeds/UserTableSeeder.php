<?php

use App\Group;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{


    public function run()
    {

        Group::truncate();
        User::truncate();

        /* Admin */
        $adminGroup = Group::forceCreate([
            'name' => 'Admin',
            'permissions' => ['users.manage' => true, 'groups.manage' => true, 'organisations.access' => true],
            'description' => 'Administrator group',
        ]);

        /* Manager */
        $managerGroup = Group::forceCreate([
            'name' => 'Manager',
            'permissions' => ['organisation.*' => true],
            'description' => 'Manager for an organisation',
        ]);

        /* Counselor */
        Group::forceCreate([
            'name' => 'Counselor',
            'permissions' => ['organisation.counselor.edit' => true],
            'description' => 'Counselor for an organisation',
        ]);

        /* Author */
        Group::forceCreate([
            'name' => 'Author',
            'permissions' => ['articles.*' => true],
            'description' => 'Creates and edit articles individual articles or for an organisation',
        ]);

        /* User */
        $userGroup = Group::forceCreate([
            'name' => 'User',
            'permissions' => ['account.manage' => true],
            'description' => 'Default user group',
            'is_new_user_default' => true,
        ]);

        $admin = User::forceCreate([
            'email' => 'simon.sp@gmail.com',
            'username' => 'petross',
            'password' => '@minaks',
            'first_name' => 'Simon',
            'last_name' => 'Petross',
            'activated' => true,
            'permissions' => ['superuser' => true]
        ]);

        $manager = User::forceCreate([
            'email' => 'ssemwezi.s@gmail.com',
            'username' => 'simon',
            'password' => 'minads',
            'first_name' => 'Petross',
            'last_name' => 'Simon',
            'activated' => true,
        ]);
        $userGroup->addAllUsersToGroup();
        $admin->addGroup($adminGroup);
        $manager->addGroup($managerGroup);


    }
}
