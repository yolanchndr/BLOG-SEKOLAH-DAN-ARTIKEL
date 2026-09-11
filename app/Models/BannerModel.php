<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table            = 'banners';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['title', 'subtitle', 'image', 'button_text', 'button_url', 'sort_order', 'status', 'start_at', 'end_at'];
    protected $useTimestamps    = true;
}