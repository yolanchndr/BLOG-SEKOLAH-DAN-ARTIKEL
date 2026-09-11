<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactMessageModel extends Model
{
    protected $table            = 'contact_messages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['name', 'email', 'phone', 'subject', 'message', 'status', 'read_at'];
    protected $useTimestamps    = true;
    protected $updatedField     = ''; // Tabel ini tidak memakai updated_at
}