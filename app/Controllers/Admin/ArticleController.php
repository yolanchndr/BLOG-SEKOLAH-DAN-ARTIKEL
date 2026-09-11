<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\CategoryModel;

class ArticleController extends BaseController
{
    protected $articleModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->articleModel  = new ArticleModel();
        $this->categoryModel = new CategoryModel();
    }

    /**
     * Menampilkan daftar artikel.
     * Admin (role_id = 1) dapat melihat semua artikel.
     * Author (role_id != 1) hanya melihat artikel miliknya sendiri.
     */
    public function index()
    {
        $roleId = session()->get('role_id');
        $userId = session()->get('id');

        $query = $this->articleModel
            ->select('articles.*, categories.name as category_name, users.name as author_name')
            ->join('categories', 'categories.id = articles.category_id', 'left')
            ->join('users', 'users.id = articles.author_id', 'left');

        // Jika BUKAN Super Admin (misal: Author), filter berdasarkan author_id miliknya
        if ($roleId != 1) {
            $query->where('articles.author_id', $userId);
        }

        $data = [
            'title'    => ($roleId == 1) ? 'Kelola Semua Artikel' : 'Artikel Saya',
            'articles' => $query->orderBy('articles.created_at', 'DESC')->findAll(),
        ];

        return view('admin/articles/index', $data);
    }

    public function create()
    {
        $data = [
            'title'      => 'Tambah Artikel Baru',
            'categories' => $this->categoryModel->where('status', 'active')->findAll(),
        ];

        return view('admin/articles/create', $data);
    }

    public function store()
    {
        $rules = [
            'title'          => 'required|min_length[5]|max_length[255]',
            'category_id'    => 'required|is_natural_no_zero',
            'content'        => 'required',
            'featured_image' => 'uploaded[featured_image]|is_image[featured_image]|mime_in[featured_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[featured_image,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileImage = $this->request->getFile('featured_image');
        $imageName = $fileImage->getRandomName();
        $fileImage->move('uploads/articles/', $imageName);

        $title  = $this->request->getPost('title');
        $status = $this->request->getPost('status');

        $this->articleModel->save([
            'category_id'     => $this->request->getPost('category_id'),
            'author_id'       => session()->get('id'), // Otomatis menyimpan ID pengguna yang sedang login
            'title'           => $title,
            'slug'            => url_title($title, '-', true) . '-' . time(),
            'excerpt'         => $this->request->getPost('excerpt'),
            'content'         => $this->request->getPost('content'),
            'featured_image'  => 'uploads/articles/' . $imageName,
            'status'          => $status,
            'published_at'    => ($status === 'published') ? date('Y-m-d H:i:s') : null,
            'seo_title'       => $this->request->getPost('seo_title'),
            'seo_description' => $this->request->getPost('seo_description'),
            'seo_keywords'    => $this->request->getPost('seo_keywords'),
        ]);

        log_activity('create', 'articles', "Membuat artikel baru: {$title}");

        return redirect()->to('/admin/articles')->with('success', 'Artikel berhasil diterbitkan.');
    }

    /**
     * Memeriksa hak akses sebelum menghapus artikel.
     */
    public function delete($id = null)
    {
        $article = $this->articleModel->find($id);

        if (!$article) {
            return redirect()->to('/admin/articles')->with('error', 'Artikel tidak ditemukan.');
        }

        $roleId = session()->get('role_id');
        $userId = session()->get('id');

        // Pengecekan Keamanan: Jika bukan Admin DAN artikel ini bukan milik user yang sedang login
        if ($roleId != 1 && $article->author_id != $userId) {
            log_activity('unauthorized_access', 'articles', "Percobaan menghapus artikel ID {$id} milik pengguna lain");
            return redirect()->to('/admin/articles')->with('error', 'Anda tidak memiliki hak akses untuk menghapus artikel ini.');
        }

        $this->articleModel->delete($id);

        log_activity('delete', 'articles', "Menghapus artikel ID {$id}: {$article->title}");

        return redirect()->to('/admin/articles')->with('success', 'Artikel berhasil dihapus.');
    }
}