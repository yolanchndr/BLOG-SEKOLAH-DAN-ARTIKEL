<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BannerModel;

class BannerController extends BaseController
{
    protected $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Kelola Banner / Hero Slider',
            'banners' => $this->bannerModel->orderBy('sort_order', 'ASC')->findAll(),
        ];

        return view('admin/banners/index', $data);
    }

    public function store()
    {
        $rules = [
            'image' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,3072]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileImage = $this->request->getFile('image');
        $imageName = $fileImage->getRandomName();
        $fileImage->move('uploads/banners/', $imageName);

        $startAt = $this->request->getPost('start_at');
        $endAt   = $this->request->getPost('end_at');

        $this->bannerModel->save([
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'image'       => 'uploads/banners/' . $imageName,
            'button_text' => $this->request->getPost('button_text'),
            'button_url'  => $this->request->getPost('button_url'),
            'sort_order'  => $this->request->getPost('sort_order') ?? 0,
            'status'      => $this->request->getPost('status') ?? 'active',
            'start_at'    => !empty($startAt) ? $startAt : null,
            'end_at'      => !empty($endAt) ? $endAt : null,
        ]);

        return redirect()->to('/admin/banners')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function delete($id = null)
    {
        $banner = $this->bannerModel->find($id);

        if (!$banner) {
            return redirect()->to('/admin/banners')->with('error', 'Banner tidak ditemukan.');
        }

        // Hapus file fisik gambar jika ada
        $filePath = FCPATH . $banner->image;
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $this->bannerModel->delete($id);

        return redirect()->to('/admin/banners')->with('success', 'Banner berhasil dihapus.');
    }
}