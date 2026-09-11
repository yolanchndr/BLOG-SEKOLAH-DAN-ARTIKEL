<?php

namespace App\Controllers;

use App\Models\PageModel;
use App\Models\MenuModel;
use App\Models\SchoolProfileModel;
use App\Models\SocialMediaModel;

class PagePublicController extends BaseController
{
    protected $pageModel;
    protected $profileModel;
    protected $sosmedModel;
    protected $menuModel;

    public function __construct()
    {
        $this->pageModel    = new PageModel();
        $this->profileModel = new SchoolProfileModel();
        $this->sosmedModel  = new SocialMediaModel();
        $this->menuModel    = new MenuModel();
    }

    public function detail($slug = null)
    {
        $page = $this->pageModel
            ->select('pages.*, users.name as author_name')
            ->join('users', 'users.id = pages.author_id', 'left')
            ->where('pages.slug', $slug)
            ->where('pages.status', 'published')
            ->first();

        if (!$page) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Halaman tidak ditemukan.');
        }

        $parentMenus = $this->menuModel->where('parent_id', null)->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll();
        foreach ($parentMenus as $menu) {
            $menu->submenus = $this->menuModel->where('parent_id', $menu->id)->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll();
        }

        $data = [
            'title'           => $page->seo_title ?: $page->title,
            'seo_description' => $page->seo_description ?: $page->excerpt,
            'site_profile'    => $this->profileModel->find(1),
            'social_medias'   => $this->sosmedModel->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll(),
            'nav_menus'       => $parentMenus,
            'page'            => $page,
        ];

        return view('frontend/pages/detail', $data);
    }
}