<?php

use yii\db\Migration;

/**
 * Class m210717_061158_create_table_user
 */
class m210717_061158_create_table_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey()->unsigned(),
            'uid' => $this->string(60)->unique()->notNull(),
            'username' => $this->string(45)->notNull(),
            'email' => $this->string(255)->unique()->notNull(),
            'password' => $this->string(60)->notNull(),
            'status' => $this->integer(4)->notNull()->defaultValue(0),
            'contact_email' => $this->boolean()->notNull()->defaultValue(false),
            'contact_phone' => $this->boolean()->notNull()->defaultValue(false),
            'created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated' => $this->timestamp()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210717_061158_create_table_user cannot be reverted.\n";
        
        $this->dropTable('user');
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210717_061158_create_table_user cannot be reverted.\n";

        return false;
    }
    */
}
