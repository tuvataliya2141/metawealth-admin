<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'User',
        ],
        [
            'name' => 'Admin',
        ],
        [
            'name' => 'Super Admin',
        ],
        [
            'name' => 'Advisior',
        ]);
    }
}
