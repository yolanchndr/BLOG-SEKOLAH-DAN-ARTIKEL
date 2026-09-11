<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleAttachmentModel extends Model
{
    protected $table            = 'article_attachments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'article_id', 'original_name', 'stored_name', 'file_path', 
        'extension', 'mime_type', 'file_size', 'download_count', 'uploaded_by'
    ];

    protected $useTimestamps    = true;
}