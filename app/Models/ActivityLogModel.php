<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table            = 'activity_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['user_id', 'action', 'module', 'description', 'ip_address', 'user_agent'];
    protected $useTimestamps    = true;
    protected $updatedField     = ''; // Log bersifat append-only, tidak ada update
}