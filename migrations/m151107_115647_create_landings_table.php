<?php

use yii\db\Migration;

class m151107_115647_create_landings_table extends Migration
{
    const DEFAULT_STATUS = 0;

    public function up()
    {
        $this->createTable(
            'landing',
            [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer()->notNull(),
                'status' => $this->smallInteger()->defaultValue(self::DEFAULT_STATUS),
                'slug' => $this->text()->notNull(),
            ]);
    }

    public function down()
    {
        $this->dropTable('landing');

        return true;
    }
}
