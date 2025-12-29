<?php

use yii\db\Migration;

class m251229_081556_create_sample_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m251229_081556_create_sample_products cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251229_081556_create_sample_products cannot be reverted.\n";

        return false;
    }
    */
}
