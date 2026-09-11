<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table            = 'documents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;

    protected $allowedFields    = [
        'title', 'slug', 'description', 'original_name', 'stored_name', 
        'file_path', 'extension', 'mime_type', 'file_size', 
        'download_count', 'status', 'uploaded_by'
    ];

    protected $useTimestamps    = true;
}