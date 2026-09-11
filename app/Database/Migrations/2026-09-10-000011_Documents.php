<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Documents extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'           => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'description'    => ['type' => 'TEXT', 'null' => true],
            'original_name'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'stored_name'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'file_path'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'extension'      => ['type' => 'VARCHAR', 'constraint' => 20],
            'mime_type'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'file_size'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'download_count' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'status'         => ['type' => 'ENUM', 'constraint' => ['active', 'inactive'], 'default' => 'active'],
            'uploaded_by'    => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('uploaded_by', 'users', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('documents');
    }

    public function down()
    {
        $this->forge->dropTable('documents');
    }
}