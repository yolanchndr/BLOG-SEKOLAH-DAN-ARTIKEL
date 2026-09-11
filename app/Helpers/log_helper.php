<?php

use App\Models\ActivityLogModel;

if (!function_exists('log_activity')) {
    /**
     * Mencatat aktivitas pengguna ke database activity_logs
     */
    function log_activity(string $action, string $module, string $description)
    {
        $logModel = new ActivityLogModel();
        $request  = \Config\Services::request();

        $logModel->save([
            'user_id'     => session()->get('id'),
            'action'      => $action,
            'module'      => $module,
            'description' => $description,
            'ip_address'  => $request->getIPAddress(),
            'user_agent'  => (string) $request->getUserAgent(),
        ]);
    }
}