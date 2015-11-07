<?php

use yii\db\Migration;

class m151107_120033_create_sections_table extends Migration
{
    public function up()
    {
        $this->createTable(
            'section',
            [
                'id' => $this->primaryKey(),
                'landing_id' => $this->integer()->notNull(),
                'section_template_id' => $this->integer()->notNull(),
                'meta' => $this->text(),
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),
            ]);
    }

    public function down()
    {
        $this->dropTable('section');

        return true;
    }
}
