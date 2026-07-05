<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUasFieldsToTransaction extends Migration
{
    public function up()
    {
        $fields = [
            'ppn' => [
                'type' => 'DOUBLE',
                'null' => TRUE,
            ],
            'biaya_admin' => [
                'type' => 'DOUBLE',
                'null' => TRUE,
            ],
            'kupon_code' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ],
            'diskon_kupon' => [
                'type' => 'DOUBLE',
                'null' => TRUE,
            ],
        ];

        $this->forge->addColumn('transaction', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction', ['ppn', 'biaya_admin', 'kupon_code', 'diskon_kupon']);
    }
}
