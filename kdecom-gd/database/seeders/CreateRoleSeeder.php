<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'admin', 'display_name' => 'Chủ cửa hàng'],
            ['name' => 'guest', 'display_name' => 'Khách hàng'],
            ['name' => 'staff', 'display_name' => 'Nhân viên bán hàng'],
            ['name' => 'warehouse_staff', 'display_name' => 'Nhân viên kho'],
        ]);
    }
}
