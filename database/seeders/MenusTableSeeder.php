<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MenusTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('menus')->insert([
            [
                'id' => 1,
                'title' => 'Home',
                'icon' => 'pie-chart',
                'url' => null,
                'route' => 'home',
                'parent_id' => null,
                'display_order' => 0,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'title' => 'User Management',
                'icon' => 'users',
                'url' => null,
                'route' => null,
                'parent_id' => null,
                'display_order' => 1,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'title' => 'Users List',
                'icon' => null,
                'url' => null,
                'route' => 'users.index',
                'parent_id' => 2,
                'display_order' => 2,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'title' => 'Add User',
                'icon' => null,
                'url' => null,
                'route' => 'users.create',
                'parent_id' => 2,
                'display_order' => 3,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'title' => 'User Logs',
                'icon' => null,
                'url' => null,
                'route' => 'users.index',
                'parent_id' => 2,
                'display_order' => 4,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'title' => 'Menu Management',
                'icon' => 'layout',
                'url' => null,
                'route' => 'menus.index',
                'parent_id' => null,
                'display_order' => 5,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 7,
                'title' => 'Roles Management',
                'icon' => 'tool',
                'url' => null,
                'route' => 'roles.index',
                'parent_id' => null,
                'display_order' => 6,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 8,
                'title' => 'Client Management',
                'icon' => 'server',
                'url' => null,
                'route' => null,
                'parent_id' => null,
                'display_order' => 7,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 9,
                'title' => 'Companies',
                'icon' => 'grid',
                'url' => null,
                'route' => 'company.index',
                'parent_id' => 8,
                'display_order' => 0,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 10,
                'title' => 'Uploaded File',
                'icon' => 'file-text',
                'url' => null,
                'route' => 'data.index',
                'parent_id' => 8,
                'display_order' => 3,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 11,
                'title' => 'MID Questions',
                'icon' => null,
                'url' => null,
                'route' => 'question.index',
                'parent_id' => null,
                'display_order' => 0,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 12,
                'title' => 'MID Setup',
                'icon' => null,
                'url' => null,
                'route' => 'mid_setups.index',
                'parent_id' => null,
                'display_order' => 0,
                'level' => 'admin',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
