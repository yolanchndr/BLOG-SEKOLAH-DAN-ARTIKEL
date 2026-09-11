<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        // Jika sudah login, lempar langsung ke dashboard admin
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }
        
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if ($user->status === 'inactive') {
                return redirect()->back()->with('error', 'Akun Anda telah dinonaktifkan.');
            }

            if (password_verify($password, $user->password)) {
                $sesData = [
                    'id'         => $user->id,
                    'name'       => $user->name,
                    'username'   => $user->username,
                    'email'      => $user->email,
                    'role_id'   => (int) $user->role_id,
                    'isLoggedIn' => true,
                ];
                $session->set($sesData);

                // Update waktu login terakhir
                $userModel->update($user->id, ['last_login_at' => date('Y-m-d H:i:s')]);

                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->back()->with('error', 'Username tidak ditemukan.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Anda telah berhasil logout.');
    }
}