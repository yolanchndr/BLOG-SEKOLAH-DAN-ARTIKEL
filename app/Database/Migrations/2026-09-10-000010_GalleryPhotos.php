<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GalleryPhotos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'album_id'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'original_name' => ['type' => 'VARCHAR', 'constraint' => 255],
            'stored_name'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'file_path'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'caption'       => ['type' => 'TEXT', 'null' => true],
            'sort_order'    => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'uploaded_by'   => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('album_id', 'albums', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('uploaded_by', 'users', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('gallery_photos');
    }

    public function down()
    {
        $this->forge->dropTable('gallery_photos');
    }
}