<?php

use yii\db\Migration;

class m151107_115236_create_section_templates_table extends Migration
{
    public function up()
    {
        $this->createTable(
            'section_template',
            [
                'id' => $this->primaryKey(),
                'title' => $this->text()->notNull(),
                'template_id' => $this->integer()->notNull(),
            ]);
    }

    public function down()
    {
        $this->dropTable('section_template');

        return true;
    }
}
