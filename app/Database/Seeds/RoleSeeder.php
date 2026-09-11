<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        => 'Super Admin',
                'slug'        => 'super-admin',
                'description' => 'Memiliki hak akses penuh ke seluruh sistem',
                'status'      => 'active',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Author',
                'slug'        => 'author',
                'description' => 'Hanya dapat menulis dan mengelola artikel sendiri',
                'status'      => 'active',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}