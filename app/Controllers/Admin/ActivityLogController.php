<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ActivityLogModel;

class ActivityLogController extends BaseController
{
    protected $logModel;

    public function __construct()
    {
        $this->logModel = new ActivityLogModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Catatan Aktivitas Sistem (Activity Logs)',
            'logs'  => $this->logModel
                ->select('activity_logs.*, users.name as user_name, users.username')
                ->join('users', 'users.id = activity_logs.user_id', 'left')
                ->orderBy('activity_logs.created_at', 'DESC')
                ->paginate(20),
            'pager' => $this->logModel->pager,
        ];

        return view('admin/activity_logs/index', $data);
    }
}