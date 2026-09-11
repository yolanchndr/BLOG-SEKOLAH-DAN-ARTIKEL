<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table            = 'articles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'category_id', 'author_id', 'title', 'slug', 'excerpt', 
        'content', 'featured_image', 'status', 'view_count', 
        'seo_title', 'seo_description', 'seo_keywords', 
        'canonical_url', 'published_at'
    ];

    protected $useTimestamps    = true;
}