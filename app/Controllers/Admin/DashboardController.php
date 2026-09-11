<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\ContactMessageModel;
use App\Models\UserModel;
use App\Models\DocumentModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $articleModel = new ArticleModel();
        $messageModel = new ContactMessageModel();
        $userModel    = new UserModel();
        $documentModel = new DocumentModel();

        $data = [
            'title'           => 'Dashboard Admin',
            'total_articles'  => $articleModel->countAllResults(),
            'total_messages'  => $messageModel->where('status', 'unread')->countAllResults(),
            'total_users'     => $userModel->countAllResults(),
            'total_documents' => $documentModel->countAllResults(),
            'recent_articles' => $articleModel->orderBy('created_at', 'DESC')->limit(5)->findAll(),
        ];

        return view('admin/dashboard/index', $data);
    }
}