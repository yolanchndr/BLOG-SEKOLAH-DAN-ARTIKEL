<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactMessageModel;

class ContactMessageController extends BaseController
{
    protected $messageModel;

    public function __construct()
    {
        $this->messageModel = new ContactMessageModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Pesan Kontak Masuk',
            'messages' => $this->messageModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return view('admin/contact/index', $data);
    }

    public function detail($id = null)
    {
        $message = $this->messageModel->find($id);

        if (!$message) {
            return redirect()->to('/admin/contact-messages')->with('error', 'Pesan tidak ditemukan.');
        }

        // Tandai sebagai sudah dibaca jika statusnya unread
        if ($message->status === 'unread') {
            $this->messageModel->update($id, [
                'status'  => 'read',
                'read_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $data = [
            'title'   => 'Detail Pesan: ' . $message->subject,
            'message' => $message,
        ];

        return view('admin/contact/detail', $data);
    }

    public function delete($id = null)
    {
        $message = $this->messageModel->find($id);
        if ($message) {
            $this->messageModel->delete($id);
            return redirect()->to('/admin/contact-messages')->with('success', 'Pesan berhasil dihapus.');
        }
        return redirect()->to('/admin/contact-messages')->with('error', 'Pesan tidak ditemukan.');
    }
}