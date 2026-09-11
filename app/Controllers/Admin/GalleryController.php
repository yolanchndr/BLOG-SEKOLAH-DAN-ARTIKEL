<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AlbumModel;
use App\Models\GalleryPhotoModel;

class GalleryController extends BaseController
{
    protected $albumModel;
    protected $photoModel;

    public function __construct()
    {
        $this->albumModel = new AlbumModel();
        $this->photoModel = new GalleryPhotoModel();
    }

    public function index()
    {
        $data = [
            'title'  => 'Kelola Galeri Foto',
            'albums' => $this->albumModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('admin/gallery/index', $data);
    }

    public function storeAlbum()
    {
        $rules = [
            'name'        => 'required|min_length[3]|max_length[255]',
            'cover_image' => 'uploaded[cover_image]|is_image[cover_image]|mime_in[cover_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[cover_image,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileCover = $this->request->getFile('cover_image');
        $coverName = $fileCover->getRandomName();
        $fileCover->move('uploads/gallery/covers/', $coverName);

        $name = $this->request->getPost('name');

        $this->albumModel->save([
            'name'        => $name,
            'slug'        => url_title($name, '-', true) . '-' . time(),
            'description' => $this->request->getPost('description'),
            'cover_image' => 'uploads/gallery/covers/' . $coverName,
            'status'      => $this->request->getPost('status') ?? 'active',
        ]);

        return redirect()->to('/admin/gallery')->with('success', 'Album berhasil ditambahkan.');
    }

    public function photos($albumId = null)
    {
        $album = $this->albumModel->find($albumId);
        if (!$album) {
            return redirect()->to('/admin/gallery')->with('error', 'Album tidak ditemukan.');
        }

        $data = [
            'title'  => 'Foto Album: ' . $album->name,
            'album'  => $album,
            'photos' => $this->photoModel->where('album_id', $albumId)->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('admin/gallery/photos', $data);
    }

    public function uploadPhoto($albumId = null)
    {
        $rules = [
            'photo' => 'uploaded[photo]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png,image/webp]|max_size[photo,3072]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $filePhoto = $this->request->getFile('photo');
        $originalName = $filePhoto->getClientName();
        $storedName = $filePhoto->getRandomName();
        $filePhoto->move('uploads/gallery/photos/', $storedName);

        $this->photoModel->save([
            'album_id'      => $albumId,
            'original_name' => $originalName,
            'stored_name'   => $storedName,
            'file_path'     => 'uploads/gallery/photos/',
            'caption'       => $this->request->getPost('caption'),
            'uploaded_by'   => session()->get('id'),
        ]);

        return redirect()->to('/admin/gallery/photos/' . $albumId)->with('success', 'Foto berhasil diunggah.');
    }

    public function deletePhoto($id = null)
    {
        $photo = $this->photoModel->find($id);
        if ($photo) {
            $filePath = FCPATH . $photo->file_path . $photo->stored_name;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $this->photoModel->delete($id);
            return redirect()->back()->with('success', 'Foto berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Foto tidak ditemukan.');
    }
}