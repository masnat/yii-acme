<?php

use yii\db\Migration;

/**
 * Class m210717_051815_create_table_place
 */
class m210717_051815_create_table_place extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('place', [
            'id' => $this->primaryKey()->unsigned(),
            'plane_id' => $this->string(45)->notNull(),
            'lat' => $this->string(45)->notNull(),
            'lng' => $this->string(45)->notNull(),
            'country_code' => $this->string(2)->notNull(),
            'is_contry' => $this->boolean()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210717_051815_create_table_place cannot be reverted.\n";
        $this->dropTable('place');
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210717_051815_create_table_place cannot be reverted.\n";

        return false;
    }
    */
}
