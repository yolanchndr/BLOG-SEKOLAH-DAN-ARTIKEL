<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'role_id'    => 1, // Mengacu ke ID Super Admin
            'name'       => 'Administrator',
            'username'   => 'admin',
            'email'      => 'admin@sekolah.com',
            'password'   => password_hash('password123', PASSWORD_DEFAULT),
            'job_title'  => 'System Administrator',
            'bio'        => 'Pengelola utama sistem website sekolah.',
            'status'     => 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($data);
    }
}