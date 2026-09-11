<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PageModel;

class PageController extends BaseController
{
    protected $pageModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Halaman Statis',
            'pages' => $this->pageModel
                ->select('pages.*, users.name as author_name')
                ->join('users', 'users.id = pages.author_id', 'left')
                ->orderBy('pages.created_at', 'DESC')
                ->findAll(),
        ];

        return view('admin/pages/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Halaman Baru',
        ];

        return view('admin/pages/create', $data);
    }

    public function store()
    {
        $rules = [
            'title'          => 'required|min_length[3]|max_length[255]',
            'content'        => 'required',
            'featured_image' => 'permit_empty|is_image[featured_image]|mime_in[featured_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[featured_image,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagePath = null;
        $fileImage = $this->request->getFile('featured_image');
        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            $imageName = $fileImage->getRandomName();
            $fileImage->move('uploads/pages/', $imageName);
            $imagePath = 'uploads/pages/' . $imageName;
        }

        $title  = $this->request->getPost('title');
        $status = $this->request->getPost('status') ?? 'draft';

        $this->pageModel->save([
            'author_id'       => session()->get('id'),
            'title'           => $title,
            'slug'            => url_title($title, '-', true),
            'excerpt'         => $this->request->getPost('excerpt'),
            'content'         => $this->request->getPost('content'),
            'featured_image'  => $imagePath,
            'status'          => $status,
            'published_at'    => ($status === 'published') ? date('Y-m-d H:i:s') : null,
            'seo_title'       => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
            'seo_keywords'    => $this->request->getPost('seo_keywords'),
        ]);

        return redirect()->to('/admin/pages')->with('success', 'Halaman berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        $page = $this->pageModel->find($id);

        if (!$page) {
            return redirect()->to('/admin/pages')->with('error', 'Halaman tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Halaman: ' . $page->title,
            'page'  => $page,
        ];

        return view('admin/pages/edit', $data);
    }

    public function update($id = null)
    {
        $page = $this->pageModel->find($id);

        if (!$page) {
            return redirect()->to('/admin/pages')->with('error', 'Halaman tidak ditemukan.');
        }

        $rules = [
            'title'          => 'required|min_length[3]|max_length[255]',
            'content'        => 'required',
            'featured_image' => 'permit_empty|is_image[featured_image]|mime_in[featured_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[featured_image,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagePath = $page->featured_image;
        $fileImage = $this->request->getFile('featured_image');

        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            if ($imagePath && file_exists(FCPATH . $imagePath)) {
                unlink(FCPATH . $imagePath);
            }
            $imageName = $fileImage->getRandomName();
            $fileImage->move('uploads/pages/', $imageName);
            $imagePath = 'uploads/pages/' . $imageName;
        }

        $title  = $this->request->getPost('title');
        $status = $this->request->getPost('status') ?? 'draft';

        $this->pageModel->update($id, [
            'title'           => $title,
            'slug'            => url_title($title, '-', true),
            'excerpt'         => $this->request->getPost('excerpt'),
            'content'         => $this->request->getPost('content'),
            'featured_image'  => $imagePath,
            'status'          => $status,
            'published_at'    => ($status === 'published' && !$page->published_at) ? date('Y-m-d H:i:s') : $page->published_at,
            'seo_title'       => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
            'seo_keywords'    => $this->request->getPost('seo_keywords'),
        ]);

        return redirect()->to('/admin/pages')->with('success', 'Halaman berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        $page = $this->pageModel->find($id);

        if (!$page) {
            return redirect()->to('/admin/pages')->with('error', 'Halaman tidak ditemukan.');
        }

        $this->pageModel->delete($id);

        return redirect()->to('/admin/pages')->with('success', 'Halaman berhasil dihapus.');
    }
}