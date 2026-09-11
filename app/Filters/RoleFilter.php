<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Cek login menggunakan key 'isLoggedIn'
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $roleId = (int) session()->get('role_id');

        // 2. Jika Super Admin (role_id === 1), langsung loloskan tanpa syarat!
        if ($roleId === 1) {
            return;
        }

        // 3. Untuk role lain (Author/User), cek apakah role_id ada di argumen yang diizinkan
        if (!empty($arguments)) {
            $allowedRoles = array_map('intval', $arguments);
            if (!in_array($roleId, $allowedRoles, true)) {
                return redirect()->to('/admin/dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman ini.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}