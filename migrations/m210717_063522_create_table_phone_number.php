<?php

use yii\db\Migration;

/**
 * Class m210717_063522_create_table_phone_number
 */
class m210717_063522_create_table_phone_number extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('phone_number', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'country_id' => $this->integer()->unsigned()->notNull(),
            'number' => $this->string(45)->notNull(),
            'verification_code' => $this->string(45)->notNull(),
            'verified' => $this->boolean()->notNull()->defaultValue(false),
            'active' => $this->boolean()->notNull()->defaultValue(true),
            'created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);

        // create index and foreign key
        $this->createIndex('idx_phone_number_user_id_user', 'phone_number', 'user_id');
        $this->addForeignKey('fk_phone_number_user_id_user', 'phone_number', 'user_id', 'user', 'id', 'restrict', 'cascade');

        $this->createIndex('idx_phone_number_country_id_country', 'phone_number', 'country_id');
        $this->addForeignKey('fk_phone_number_country_id_country', 'phone_number', 'country_id', 'country', 'id', 'restrict', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210717_063522_create_table_phone_number cannot be reverted.\n";

        // drop index and foreign key
        $this->dropForeignKey('fk_phone_number_user_id_user', 'phone_number');
        $this->dropIndex('idx_phone_number_user_id_user', 'phone_number');

        $this->dropForeignKey('fk_phone_number_country_id_country', 'phone_number');
        $this->dropIndex('idx_phone_number_country_id_country', 'phone_number');

        $this->dropTable('phone_number');

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210717_063522_create_table_phone_number cannot be reverted.\n";

        return false;
    }
    */
}
