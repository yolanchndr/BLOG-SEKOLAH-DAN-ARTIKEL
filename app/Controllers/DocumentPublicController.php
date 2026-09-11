<?php

namespace App\Controllers;

use App\Models\DocumentModel;
use App\Models\MenuModel;
use App\Models\SchoolProfileModel;
use App\Models\SocialMediaModel;

class DocumentPublicController extends BaseController
{
    protected $documentModel;
    protected $profileModel;
    protected $sosmedModel;
    protected $menuModel;

    public function __construct()
    {
        $this->documentModel = new DocumentModel();
        $this->profileModel  = new SchoolProfileModel();
        $this->sosmedModel   = new SocialMediaModel();
        $this->menuModel     = new MenuModel();
    }

    public function index()
    {
        $parentMenus = $this->menuModel->where('parent_id', null)->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll();
        foreach ($parentMenus as $menu) {
            $menu->submenus = $this->menuModel->where('parent_id', $menu->id)->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll();
        }

        $data = [
            'title'         => 'Pusat Unduhan Dokumen Sekolah',
            'site_profile'  => $this->profileModel->find(1),
            'social_medias' => $this->sosmedModel->where('status', 'active')->orderBy('sort_order', 'ASC')->findAll(),
            'nav_menus'     => $parentMenus,
            'documents'     => $this->documentModel->where('status', 'active')->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('frontend/documents/index', $data);
    }

    public function download($slug = null)
    {
        $doc = $this->documentModel->where('slug', $slug)->where('status', 'active')->first();
        if (!$doc) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan.');
        }

        $this->documentModel->update($doc->id, [
            'download_count' => $doc->download_count + 1,
        ]);

        $filePath = FCPATH . $doc->file_path . $doc->stored_name;
        if (file_exists($filePath)) {
            return $this->response->download($filePath, null)->setFileName($doc->original_name);
        }

        return redirect()->back()->with('error', 'File fisik tidak ditemukan.');
    }
}