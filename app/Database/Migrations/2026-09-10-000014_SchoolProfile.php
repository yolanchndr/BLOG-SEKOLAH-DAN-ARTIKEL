<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SchoolProfile extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'TINYINT', 'constraint' => 1],
            'school_name'       => ['type' => 'VARCHAR', 'constraint' => 150],
            'school_short_name' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'npsn'              => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'level'             => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'logo'              => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'favicon'           => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'address'           => ['type' => 'TEXT', 'null' => true],
            'postal_code'       => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => true],
            'phone'             => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'email'             => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'google_maps_url'   => ['type' => 'TEXT', 'null' => true],
            'principal_name'    => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'principal_photo'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'principal_message' => ['type' => 'TEXT', 'null' => true],
            'seo_title_default' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'seo_desc_default'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'footer_text'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('school_profile');
    }

    public function down()
    {
        $this->forge->dropTable('school_profile');
    }
}