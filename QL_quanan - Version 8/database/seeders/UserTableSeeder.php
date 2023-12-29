<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();

        $adminRoles = Roles::where('roles_name', 'admin')->first();
        $nhanvien_pvRoles = Roles::where('roles_name', 'nhanvien_pv')->first();
        $nhanvien_bepRoles = Roles::where('roles_name', 'nhanvien_bep')->first();

        $admin = Admin::create([
            'admin_name' => 'Võ Thanh Hiếu',
            'admin_email' => 'thanhhieu090701@gmail.com',
            'admin_phone' => '1234567890',
            'admin_password' => md5('123456'),
            'admin_image' => '',
            'admin_code' => ''

        ]);
        $nhanvien_pv = Admin::create([
            'admin_name' => 'Hiếu nv phục vụ',
            'admin_email' => 'nvphucvu@gmail.com',
            'admin_phone' => '1234567890',
            'admin_password' => md5('123456'),
            'admin_image' => '',
            'admin_code' => ''

        ]);
        $nhanvien_bep = Admin::create([
            'admin_name' => 'Hiếu nv bếp',
            'admin_email' => 'nvbep@gmail.com',
            'admin_phone' => '1234567890',
            'admin_password' => md5('123456'),
            'admin_image' => '',
            'admin_code' => ''

        ]);

        $admin->roles()->attach($adminRoles);
        $nhanvien_pv->roles()->attach($nhanvien_pvRoles);
        $nhanvien_bep->roles()->attach($nhanvien_bepRoles);

    }
}
