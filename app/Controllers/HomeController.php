<?php

namespace App\Controllers;

use App\Models\BannerModel;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\SchoolProfileModel;
use App\Models\SocialMediaModel;
use App\Models\MenuModel;

class HomeController extends BaseController
{
    protected $bannerModel;
    protected $articleModel;
    protected $categoryModel;
    protected $profileModel;
    protected $sosmedModel;
    protected $menuModel;

    public function __construct()
    {
        $this->bannerModel   = new BannerModel();
        $this->articleModel  = new ArticleModel();
        $this->categoryModel = new CategoryModel();
        $this->profileModel  = new SchoolProfileModel();
        $this->sosmedModel   = new SocialMediaModel();
        $this->menuModel     = new MenuModel();
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
        ];
    }

    public function index()
    {
        $data = array_merge($this->getCommonData(), [
            'title'    => 'Selamat Datang - Portal Resmi Sekolah',
            'banners'  => $this->bannerModel->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll(),
            'latest_articles' => $this->articleModel
                ->select('articles.*, categories.name as category_name, categories.slug as category_slug, users.name as author_name')
                ->join('categories', 'categories.id = articles.category_id', 'left')
                ->join('users', 'users.id = articles.author_id', 'left')
                ->where('articles.status', 'published')
                ->orderBy('articles.published_at', 'DESC')
                ->findAll(6),
        ]);

        return view('frontend/home/index', $data);
    }
}