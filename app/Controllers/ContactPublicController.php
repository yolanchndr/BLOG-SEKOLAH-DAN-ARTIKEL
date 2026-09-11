<?php

namespace App\Controllers;

use App\Models\ContactMessageModel;
use App\Models\MenuModel;
use App\Models\SchoolProfileModel;
use App\Models\SocialMediaModel;

class ContactPublicController extends BaseController
{
    protected $messageModel;
    protected $profileModel;
    protected $sosmedModel;
    protected $menuModel;

    public function __construct()
    {
        $this->messageModel = new ContactMessageModel();
        $this->profileModel = new SchoolProfileModel();
        $this->sosmedModel  = new SocialMediaModel();
        $this->menuModel    = new MenuModel();
    }

    public function index()
    {
        $parentMenus = $this->menuModel->where('parent_id', null)->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll();
        foreach ($parentMenus as $menu) {
            $menu->submenus = $this->menuModel->where('parent_id', $menu->id)->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll();
        }

        $data = [
            'title'         => 'Hubungi Kami - Website Sekolah',
            'site_profile'  => $this->profileModel->find(1),
            'social_medias' => $this->sosmedModel->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll(),
            'nav_menus'     => $parentMenus,
        ];

        return view('frontend/contact/index', $data);
    }

    public function send()
    {
        $rules = [
            'name'    => 'required|min_length[3]|max_length[100]',
            'email'   => 'required|valid_email|max_length[100]',
            'phone'   => 'permit_empty|max_length[20]',
            'subject' => 'required|min_length[5]|max_length[255]',
            'message' => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->messageModel->save([
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'subject'    => $this->request->getPost('subject'),
            'message'    => $this->request->getPost('message'),
            'status'     => 'unread',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/kontak')->with('success', 'Pesan Anda berhasil dikirim. Terima kasih telah menghubungi kami.');
    }
}