<?php

use yii\db\Migration;

/**
 * Class m210717_053316_create_table_place_lang
 */
class m210717_053316_create_table_place_lang extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('place_lang', [
            'id' => $this->primaryKey()->unsigned(),
            'place_id' => $this->integer()->unsigned()->notNull(),
            'locality' => $this->string(45)->notNull(),
            'country' => $this->string(45)->notNull(),
            'lang' => $this->string(2)->notNull(),
        ]);

        // create index
        $this->createIndex('idx_place_lang_place_id_place', 'place_lang', 'place_id');
        // create foreign key
        $this->addForeignKey('fx_place_lang_place_id_place', 'place_lang', 'place_id', 'place', 'id', 'restrict', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210717_053316_create_table_place_lang cannot be reverted.\n";
        // drop foreign key
        $this->dropForeignKey('fx_place_lang_place_id_place', 'place_lang');
        // drop index
        $this->dropIndex('idx_place_lang_place_id_place', 'place_lang');

        $this->dropTable('place_lang');
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210717_053316_create_table_place_lang cannot be reverted.\n";

        return false;
    }
    */
}
