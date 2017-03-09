<?php

use yii\db\Migration;

class m170309_091129_create_setting extends Migration
{
    public function up()
    {
        $this->createTable('setting', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'key' => $this->string(64)->notNull(),
            'value' => $this->text()->defaultValue(null),
            'description' => $this->text()->defaultValue(null),
            'weight' => $this->integer()->defaultValue(0),
            'updatedAt' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'),
        ]);
    }

    public function down()
    {
        $this->dropTable('setting');
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
