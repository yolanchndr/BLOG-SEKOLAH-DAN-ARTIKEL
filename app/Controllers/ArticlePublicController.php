<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\ArticleAttachmentModel;
use App\Models\CategoryModel;
use App\Models\MenuModel;
use App\Models\SchoolProfileModel;
use App\Models\SocialMediaModel;

class ArticlePublicController extends BaseController
{
    protected $articleModel;
    protected $attachmentModel;
    protected $categoryModel;
    protected $profileModel;
    protected $sosmedModel;
    protected $menuModel;

    public function __construct()
    {
        $this->articleModel    = new ArticleModel();
        $this->attachmentModel = new ArticleAttachmentModel();
        $this->categoryModel   = new CategoryModel();
        $this->profileModel    = new SchoolProfileModel();
        $this->sosmedModel     = new SocialMediaModel();
        $this->menuModel       = new MenuModel();
    }

    private function getCommonData()
    {
        $parentMenus = $this->menuModel->where('parent_id', null)->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll();
        foreach ($parentMenus as $menu) {
            $menu->submenus = $this->menuModel->where('parent_id', $menu->id)->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll();
        }

        return [
            'site_profile'  => $this->profileModel->find(1),
            'social_medias' => $this->sosmedModel->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll(),
            'nav_menus'     => $parentMenus,
            'categories'    => $this->categoryModel->where('status', 'active')->findAll(),
        ];
    }

    public function index()
    {
        $data = array_merge($this->getCommonData(), [
            'title'    => 'Berita & Pengumuman - Website Sekolah',
            'articles' => $this->articleModel
                ->select('articles.*, categories.name as category_name, categories.slug as category_slug, users.name as author_name')
                ->join('categories', 'categories.id = articles.category_id', 'left')
                ->join('users', 'users.id = articles.author_id', 'left')
                ->where('articles.status', 'published')
                ->orderBy('articles.published_at', 'DESC')
                ->paginate(9),
            'pager'    => $this->articleModel->pager,
        ]);

        return view('frontend/articles/index', $data);
    }

    /**
     * Menampilkan artikel berdasarkan kategori yang dipilih
     */
    public function category($slug = null)
    {
        // 1. Cari kategori berdasarkan slug
        $category = $this->categoryModel->where('slug', $slug)->where('status', 'active')->first();

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Kategori '{$slug}' tidak ditemukan.");
        }

        // 2. Ambil artikel yang sesuai dengan category_id
        $articles = $this->articleModel
            ->select('articles.*, categories.name as category_name, categories.slug as category_slug, users.name as author_name')
            ->join('categories', 'categories.id = articles.category_id', 'left')
            ->join('users', 'users.id = articles.author_id', 'left')
            ->where('articles.status', 'published')
            ->where('articles.category_id', $category->id)
            ->orderBy('articles.published_at', 'DESC')
            ->paginate(9);

        $data = array_merge($this->getCommonData(), [
            'title'         => 'Kategori: ' . $category->name,
            'active_category' => $category,
            'articles'      => $articles,
            'pager'         => $this->articleModel->pager,
        ]);

        return view('frontend/articles/index', $data);
    }

    public function detail($slug = null)
    {
        $article = $this->articleModel
            ->select('articles.*, categories.name as category_name, categories.slug as category_slug, users.name as author_name, users.avatar as author_avatar, users.job_title as author_job, users.bio as author_bio')
            ->join('categories', 'categories.id = articles.category_id', 'left')
            ->join('users', 'users.id = articles.author_id', 'left')
            ->where('articles.slug', $slug)
            ->where('articles.status', 'published')
            ->first();

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Artikel tidak ditemukan.');
        }

        // 1. Tambah hitungan pembaca (view_count)
        $this->articleModel->update($article->id, [
            'view_count' => $article->view_count + 1
        ]);

        // 2. Ambil lampiran file artikel jika ada
        $attachments = $this->attachmentModel->where('article_id', $article->id)->findAll();

        // 3. Ambil artikel terkait di kategori yang sama
        $relatedArticles = $this->articleModel
            ->where('category_id', $article->category_id)
            ->where('id !=', $article->id)
            ->where('status', 'published')
            ->orderBy('published_at', 'DESC')
            ->findAll(3);

        // 4. Ambil artikel populer berdasarkan jumlah pembaca (view_count)
        $popularArticles = $this->articleModel
            ->select('articles.title, articles.slug, articles.featured_image, articles.created_at, articles.published_at, articles.view_count')
            ->where('status', 'published')
            ->where('id !=', $article->id)
            ->orderBy('view_count', 'DESC')
            ->findAll(5);

        $data = array_merge($this->getCommonData(), [
            'title'            => $article->seo_title ?: $article->title,
            'seo_description'  => $article->seo_description ?: $article->excerpt,
            'article'          => $article,
            'attachments'      => $attachments,
            'related_articles' => $relatedArticles,
            'popular_articles' => $popularArticles, // Data artikel populer
        ]);

        return view('frontend/articles/detail', $data);
    }

    public function downloadAttachment($id = null)
    {
        $attachment = $this->attachmentModel->find($id);

        if (!$attachment) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Tambahkan hitungan download
        $this->attachmentModel->update($id, [
            'download_count' => $attachment->download_count + 1
        ]);

        $filePath = FCPATH . $attachment->file_path . $attachment->stored_name;

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null)->setFileName($attachment->original_name);
        }

        return redirect()->back()->with('error', 'File fisik tidak ditemukan di server.');
    }
}