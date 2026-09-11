<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Articles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true, 'auto_increment' => true],
            'category_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'author_id'       => ['type' => 'BIGINT', 'constraint' => 20, 'unsigned' => true],
            'title'           => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'            => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'excerpt'         => ['type' => 'TEXT', 'null' => true],
            'content'         => ['type' => 'LONGTEXT'],
            'featured_image'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'          => ['type' => 'ENUM', 'constraint' => ['draft', 'published', 'scheduled', 'archived'], 'default' => 'draft'],
            'view_count'      => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'default' => 0],
            'seo_title'       => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'seo_description' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'seo_keywords'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'canonical_url'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'published_at'    => ['type' => 'DATETIME', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->addKey('status');
        $this->forge->addKey('published_at');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('author_id', 'users', 'id', 'CASCADE', 'RESTRICT');
        $this->forge->createTable('articles');

        // Menambahkan FULLTEXT Index menggunakan Raw Query karena CI4 Forge tidak mendukungan FULLTEXT secara native
        $this->db->query('ALTER TABLE articles ADD FULLTEXT INDEX articles_search_fulltext (title, excerpt, content)');
    }

    public function down()
    {
        $this->forge->dropTable('articles');
    }
}