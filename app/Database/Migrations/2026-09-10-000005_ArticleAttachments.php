<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ArticleAttachments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'article_id'     => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true],
            'original_name'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'stored_name'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'file_path'      => ['type' => 'VARCHAR', 'constraint' => 255],
            'extension'      => ['type' => 'VARCHAR', 'constraint' => 20],
            'mime_type'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'file_size'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'download_count' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'uploaded_by'    => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('article_id', 'articles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('uploaded_by', 'users', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('article_attachments');
    }

    public function down()
    {
        $this->forge->dropTable('article_attachments');
    }
}