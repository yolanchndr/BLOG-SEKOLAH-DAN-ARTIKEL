<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DocumentModel;

class DocumentController extends BaseController
{
    protected $documentModel;

    public function __construct()
    {
        $this->documentModel = new DocumentModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Kelola Dokumen Sekolah',
            'documents' => $this->documentModel
                ->select('documents.*, users.name as uploader_name')
                ->join('users', 'users.id = documents.uploaded_by', 'left')
                ->orderBy('documents.created_at', 'DESC')
                ->findAll(),
        ];

        return view('admin/documents/index', $data);
    }

    public function store()
    {
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'file'  => 'uploaded[file]|ext_in[file,pdf,doc,docx,xls,xlsx,zip,rar]|max_size[file,10240]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('file');
        $originalName = $file->getClientName();
        $extension    = $file->getClientExtension();
        $mimeType     = $file->getClientMimeType();
        $fileSize     = $file->getSize();
        $storedName   = $file->getRandomName();

        $file->move('uploads/documents/', $storedName);

        $title = $this->request->getPost('title');

        $this->documentModel->save([
            'title'         => $title,
            'slug'          => url_title($title, '-', true) . '-' . time(),
            'description'   => $this->request->getPost('description'),
            'original_name' => $originalName,
            'stored_name'   => $storedName,
            'file_path'     => 'uploads/documents/',
            'extension'     => $extension,
            'mime_type'     => $mimeType,
            'file_size'     => $fileSize,
            'status'        => $this->request->getPost('status') ?? 'active',
            'uploaded_by'   => session()->get('id'),
        ]);

        return redirect()->to('/admin/documents')->with('success', 'Dokumen publik berhasil ditambahkan.');
    }

    public function delete($id = null)
    {
        $document = $this->documentModel->find($id);
        if ($document) {
            $this->documentModel->delete($id); // Soft delete
            return redirect()->to('/admin/documents')->with('success', 'Dokumen berhasil dihapus.');
        }
        return redirect()->to('/admin/documents')->with('error', 'Dokumen tidak ditemukan.');
    }
}