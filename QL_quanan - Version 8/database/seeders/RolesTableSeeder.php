<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::truncate();
        Roles::create(['roles_name'=>'admin']);
        Roles::create(['roles_name'=>'nhanvien_pv']);
        Roles::create(['roles_name'=>'nhanvien_bep']);

    }
}
