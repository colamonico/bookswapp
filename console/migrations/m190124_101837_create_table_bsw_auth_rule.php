<?php

use yii\db\Migration;

class m190124_101837_create_table_bsw_auth_rule extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%auth_rule}}', [
            'name' => $this->string()->notNull()->append('PRIMARY KEY'),
            'data' => $this->binary(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%auth_rule}}');
    }
}
