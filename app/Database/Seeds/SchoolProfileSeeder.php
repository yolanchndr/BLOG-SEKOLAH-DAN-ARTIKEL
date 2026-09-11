<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SchoolProfileSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'id'                => 1, // ID wajib 1 sesuai rancangan 1 baris
            'school_name'       => 'SMA Contoh Nusantara',
            'school_short_name' => 'SMACON',
            'npsn'              => '12345678',
            'level'             => 'SMA',
            'address'           => 'Jl. Pendidikan No. 1, Bandar Lampung',
            'email'             => 'info@smacon.sch.id',
            'phone'             => '0721-123456',
            'footer_text'       => '© 2026 SMA Contoh Nusantara. All Rights Reserved.',
            'updated_at'        => date('Y-m-d H:i:s'),
        ];

        $this->db->table('school_profile')->insert($data);
    }
}