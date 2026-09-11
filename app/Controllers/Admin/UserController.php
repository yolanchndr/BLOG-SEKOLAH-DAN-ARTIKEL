<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $roleModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Pengguna & Author',
            'users' => $this->userModel
                ->select('users.*, roles.name as role_name')
                ->join('roles', 'roles.id = users.role_id', 'left')
                ->orderBy('users.created_at', 'DESC')
                ->findAll(),
            'roles' => $this->roleModel->where('status', 'active')->findAll(),
        ];

        return view('admin/users/index', $data);
    }

    public function store()
    {
        $rules = [
            'name'     => 'required|min_length[3]|max_length[100]',
            'username' => 'required|min_length[4]|max_length[50]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role_id'  => 'required|is_natural_no_zero',
            'avatar'   => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png,image/webp]|max_size[avatar,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $avatarPath = null;
        $fileAvatar = $this->request->getFile('avatar');
        if ($fileAvatar && $fileAvatar->isValid() && !$fileAvatar->hasMoved()) {
            $avatarName = $fileAvatar->getRandomName();
            $fileAvatar->move('uploads/users/', $avatarName);
            $avatarPath = 'uploads/users/' . $avatarName;
        }

        $username = $this->request->getPost('username');

        $this->userModel->save([
            'role_id'   => $this->request->getPost('role_id'),
            'name'      => $this->request->getPost('name'),
            'username'  => $username,
            'email'     => $this->request->getPost('email'),
            'password'  => $this->request->getPost('password'), // Hash otomatis dikelola oleh UserModel
            'avatar'    => $avatarPath,
            'job_title' => $this->request->getPost('job_title'),
            'bio'       => $this->request->getPost('bio'),
            'status'    => $this->request->getPost('status') ?? 'active',
        ]);

        log_activity('create', 'users', "Menambahkan pengguna baru: {$username}");

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function delete($id = null)
    {
        // Hindari menghapus akun diri sendiri yang sedang login
        if ($id == session()->get('id')) {
            return redirect()->to('/admin/users')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/users')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Soft delete (histori tulisan artikel user di DB tetap aman)
        $this->userModel->delete($id);

        log_activity('delete', 'users', "Menghapus pengguna: {$user->username}");

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil nonaktif/dihapus.');
    }
}