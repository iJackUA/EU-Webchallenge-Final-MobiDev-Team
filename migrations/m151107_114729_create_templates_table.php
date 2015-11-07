<?php

use yii\db\Migration;

class m151107_114729_create_templates_table extends Migration
{
    public function up()
    {
        $this->createTable(
            'template',
            [
                'id' => $this->primaryKey(),
                'title' => $this->text()->notNull(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ]);
    }

    public function down()
    {
        $this->dropTable('template');

        return true;
    }
}
