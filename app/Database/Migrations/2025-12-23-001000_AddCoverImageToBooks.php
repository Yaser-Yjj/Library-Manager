<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCoverImageToBooks extends Migration
{
    public function up()
    {
        $fields = [
            'cover_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 500,
                'null'       => true,
                'after'      => 'stock_quantity',
            ],
        ];

        $this->forge->addColumn('books', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('books', 'cover_image');
    }
}
