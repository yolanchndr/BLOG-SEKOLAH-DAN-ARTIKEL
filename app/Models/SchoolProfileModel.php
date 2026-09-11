<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolProfileModel extends Model
{
    protected $table            = 'school_profile';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false; 
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'id', 'school_name', 'school_short_name', 'npsn', 'level', 
        'logo', 'favicon', 'address', 'postal_code', 'phone', 
        'email', 'google_maps_url', 'principal_name', 'principal_photo', 
        'principal_message', 'seo_title_default', 'seo_desc_default', 'footer_text'
    ];

    protected $useTimestamps    = true;
    protected $createdField     = ''; // Tidak memakai kolom created_at
    protected $updatedField     = 'updated_at';
}