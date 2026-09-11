<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryPhotoModel extends Model
{
    protected $table            = 'gallery_photos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false; // Dihapus permanen mengikuti CI4 events

    protected $allowedFields    = [
        'album_id', 'original_name', 'stored_name', 'file_path', 
        'caption', 'sort_order', 'uploaded_by'
    ];

    protected $useTimestamps    = true;
}