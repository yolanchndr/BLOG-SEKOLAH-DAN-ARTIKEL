<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MenuModel;

class MenuController extends BaseController
{
    protected $menuModel;

    public function __construct()
    {
        $this->menuModel = new MenuModel();
    }

    public function index()
    {
        // Ambil semua menu parent (parent_id NULL)
        $parentMenus = $this->menuModel
            ->where('parent_id', null)
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        // Ambil submenu untuk tiap parent menu
        foreach ($parentMenus as $menu) {
            $menu->submenus = $this->menuModel
                ->where('parent_id', $menu->id)
                ->orderBy('sort_order', 'ASC')
                ->findAll();
        }

        $data = [
            'title'        => 'Kelola Menu Navigasi',
            'parent_menus' => $parentMenus,
            'all_parents'  => $this->menuModel->where('parent_id', null)->findAll(),
        ];

        return view('admin/menus/index', $data);
    }

    public function store()
    {
        $rules = [
            'name'   => 'required|min_length[2]|max_length[100]',
            'url'    => 'required|max_length[255]',
            'target' => 'required|in_list[_self,_blank]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $parentId = $this->request->getPost('parent_id');

        $this->menuModel->save([
            'parent_id'  => !empty($parentId) ? $parentId : null,
            'name'       => $this->request->getPost('name'),
            'url'        => $this->request->getPost('url'),
            'target'     => $this->request->getPost('target'),
            'icon'       => $this->request->getPost('icon'),
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'status'     => $this->request->getPost('status') ?? 'active',
        ]);

        return redirect()->to('/admin/menus')->with('success', 'Menu navigasi berhasil ditambahkan.');
    }

    public function delete($id = null)
    {
        $menu = $this->menuModel->find($id);

        if (!$menu) {
            return redirect()->to('/admin/menus')->with('error', 'Menu tidak ditemukan.');
        }

        // Penghapusan menu parent akan menghapus submenu secara otomatis (ON DELETE CASCADE pada DB)
        $this->menuModel->delete($id);

        return redirect()->to('/admin/menus')->with('success', 'Menu berhasil dihapus.');
    }
}