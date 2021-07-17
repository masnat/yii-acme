<?php

use yii\db\Migration;

/**
 * Class m210717_062109_create_table_trip
 */
class m210717_062109_create_table_trip extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('trip', [
            'id' => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'from' => $this->integer()->unsigned()->notNull(),
            'to' => $this->integer()->unsigned()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'number_seats' => $this->integer(4)->notNull(),
            'duration' => $this->decimal(10, 1)->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'currency_id' => $this->integer()->unsigned()->notNull(),
            'status' => $this->integer(4)->notNull()->defaultValue(1),
            'created' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated' => $this->timestamp()->notNull()
        ]);

        // create index and foreign key
        $this->createIndex('idx_trip_user_id_user', 'trip', 'user_id');
        $this->addForeignKey('fx_trip_user_id_user', 'trip', 'user_id', 'user', 'id', 'restrict', 'cascade');

        $this->createIndex('idx_trip_from_place', 'trip', 'from');
        $this->addForeignKey('fx_trip_from_place', 'trip', 'from', 'place', 'id', 'restrict', 'cascade');

        $this->createIndex('idx_trip_to_place', 'trip', 'to');
        $this->addForeignKey('fx_trip_to_place', 'trip', 'to', 'place', 'id', 'restrict', 'cascade');

        $this->createIndex('idx_trip_currency_id_currency', 'trip', 'currency_id');
        $this->addForeignKey('fx_trip_currency_id_currency', 'trip', 'currency_id', 'currency', 'id', 'restrict', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210717_062109_create_table_trip cannot be reverted.\n";

        // drop index and foreign key
        $this->dropForeignKey('fx_trip_user_id_user', 'trip');
        $this->dropIndex('idx_trip_user_id_user', 'trip');

        $this->dropForeignKey('fx_trip_from_place', 'trip');
        $this->dropIndex('idx_trip_from_place', 'trip');

        $this->dropForeignKey('fx_trip_to_place', 'trip');
        $this->dropIndex('idx_trip_to_place', 'trip');

        $this->dropForeignKey('fx_trip_currency_id_currency', 'trip');
        $this->dropIndex('idx_trip_currency_id_currency', 'trip');

        $this->dropTable('trip');
        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210717_062109_create_table_trip cannot be reverted.\n";

        return false;
    }
    */
}
