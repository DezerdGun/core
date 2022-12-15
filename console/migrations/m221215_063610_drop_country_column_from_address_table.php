<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%address}}`.
 */
class m221215_063610_drop_country_column_from_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('address', 'country');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('address', 'country', $this->string(32));
    }
}
