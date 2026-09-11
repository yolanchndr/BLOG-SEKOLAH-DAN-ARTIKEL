<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table            = 'pages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'author_id', 'title', 'slug', 'excerpt', 'content', 
        'featured_image', 'status', 'seo_title', 
        'seo_description', 'seo_keywords', 'published_at'
    ];

    protected $useTimestamps    = true;
}