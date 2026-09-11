<?php

namespace App\Controllers;

use App\Models\AlbumModel;
use App\Models\GalleryPhotoModel;
use App\Models\MenuModel;
use App\Models\SchoolProfileModel;
use App\Models\SocialMediaModel;

class GalleryPublicController extends BaseController
{
    protected $albumModel;
    protected $photoModel;
    protected $profileModel;
    protected $sosmedModel;
    protected $menuModel;

    public function __construct()
    {
        $this->albumModel   = new AlbumModel();
        $this->photoModel   = new GalleryPhotoModel();
        $this->profileModel = new SchoolProfileModel();
        $this->sosmedModel  = new SocialMediaModel();
        $this->menuModel    = new MenuModel();
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
            'title'  => 'Galeri Foto - Website Sekolah',
            'albums' => $this->albumModel->where('status', 'active')->orderBy('created_at', 'DESC')->findAll(),
        ]);

        return view('frontend/gallery/index', $data);
    }

    public function detail($slug = null)
    {
        $album = $this->albumModel->where('slug', $slug)->where('status', 'active')->first();
        if (!$album) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Album tidak ditemukan.');
        }

        $data = array_merge($this->getCommonData(), [
            'title'  => $album->name . ' - Galeri Foto',
            'album'  => $album,
            'photos' => $this->photoModel->where('album_id', $album->id)->orderBy('created_at', 'DESC')->findAll(),
        ]);

        return view('frontend/gallery/detail', $data);
    }
}