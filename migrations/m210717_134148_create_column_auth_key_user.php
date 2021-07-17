<?php

use yii\db\Migration;

/**
 * Class m210717_134148_create_column_auth_key_user
 */
class m210717_134148_create_column_auth_key_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'auth_key', $this->string(60)->notNull()->unique()->after('contact_phone'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210717_134148_create_column_auth_key_user cannot be reverted.\n";

        $this->dropColumn('user', 'auth_key');
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210717_134148_create_column_auth_key_user cannot be reverted.\n";

        return false;
    }
    */
}
