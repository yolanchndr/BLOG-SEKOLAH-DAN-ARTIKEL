<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SchoolProfileModel;
use App\Models\SocialMediaModel;

class SettingController extends BaseController
{
    protected $profileModel;
    protected $sosmedModel;

    public function __construct()
    {
        $this->profileModel = new SchoolProfileModel();
        $this->sosmedModel  = new SocialMediaModel();
    }

    public function index()
    {
        $data = [
            'title'         => 'Pengaturan Website & Profil Sekolah',
            'site_profile'  => $this->profileModel->find(1),
            'social_medias' => $this->sosmedModel->orderBy('sort_order', 'ASC')->findAll(),
        ];

        return view('admin/settings/index', $data);
    }

    public function updateProfile()
    {
        $rules = [
            'school_name' => 'required|min_length[3]|max_length[150]',
            'email'       => 'permit_empty|valid_email',
            'logo'        => 'permit_empty|is_image[logo]|mime_in[logo,image/png,image/jpg,image/jpeg,image/svg+xml,image/webp]|max_size[logo,2048]',
            'principal_photo' => 'permit_empty|is_image[principal_photo]|mime_in[principal_photo,image/png,image/jpg,image/jpeg,image/webp]|max_size[principal_photo,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $profile = $this->profileModel->find(1);

        $data = [
            'id'                => 1,
            'school_name'       => $this->request->getPost('school_name'),
            'school_short_name' => $this->request->getPost('school_short_name'),
            'npsn'              => $this->request->getPost('npsn'),
            'level'             => $this->request->getPost('level'),
            'address'           => $this->request->getPost('address'),
            'postal_code'       => $this->request->getPost('postal_code'),
            'phone'             => $this->request->getPost('phone'),
            'email'             => $this->request->getPost('email'),
            'google_maps_url'   => $this->request->getPost('google_maps_url'),
            'principal_name'    => $this->request->getPost('principal_name'),
            'principal_message' => $this->request->getPost('principal_message'),
            'seo_title_default' => $this->request->getPost('seo_title_default'),
            'seo_desc_default'  => $this->request->getPost('seo_desc_default'),
            'footer_text'       => $this->request->getPost('footer_text'),
        ];

        // Upload Logo Baru
        $fileLogo = $this->request->getFile('logo');
        if ($fileLogo && $fileLogo->isValid() && !$fileLogo->hasMoved()) {
            $logoName = $fileLogo->getRandomName();
            $fileLogo->move('uploads/settings/', $logoName);
            $data['logo'] = 'uploads/settings/' . $logoName;
        }

        // Upload Foto Kepala Sekolah Baru
        $filePrincipal = $this->request->getFile('principal_photo');
        if ($filePrincipal && $filePrincipal->isValid() && !$filePrincipal->hasMoved()) {
            $principalName = $filePrincipal->getRandomName();
            $filePrincipal->move('uploads/settings/', $principalName);
            $data['principal_photo'] = 'uploads/settings/' . $principalName;
        }

        $this->profileModel->save($data);

        return redirect()->to('/admin/settings')->with('success', 'Pengaturan sekolah berhasil diperbarui.');
    }

    public function storeSosmed()
    {
        $rules = [
            'name'     => 'required|min_length[2]|max_length[50]',
            'platform' => 'required',
            'url'      => 'required|valid_url',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->sosmedModel->save([
            'name'       => $this->request->getPost('name'),
            'platform'   => $this->request->getPost('platform'),
            'url'        => $this->request->getPost('url'),
            'icon'       => $this->request->getPost('icon') ?? 'fas fa-link',
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'status'     => $this->request->getPost('status') ?? 'active',
        ]);

        return redirect()->to('/admin/settings')->with('success', 'Media sosial berhasil ditambahkan.');
    }

    public function deleteSosmed($id = null)
    {
        $sosmed = $this->sosmedModel->find($id);
        if ($sosmed) {
            $this->sosmedModel->delete($id);
            return redirect()->to('/admin/settings')->with('success', 'Media sosial berhasil dihapus.');
        }
        return redirect()->to('/admin/settings')->with('error', 'Data tidak ditemukan.');
    }
}