<?php

use yii\db\Migration;

/**
 * Class m230216_124049_alter_carrier_table
 */
class m230216_124049_alter_carrier_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('carrier', 'scac', $this->string(10));
        $this->addColumn('carrier', 'instagram', $this->string(100));
        $this->addColumn('carrier', 'facebook', $this->string(100));
        $this->addColumn('carrier', 'linkedin', $this->string(100));
        $this->addColumn('carrier', 'w9_name', $this->string(100));
        $this->addColumn('carrier', 'ic_name', $this->string(100));

        $this->dropColumn('carrier','mc');
        $this->dropColumn('carrier', 'ein');
        $this->dropColumn('carrier', 'dot');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('carrier', 'scac');
        $this->dropColumn('carrier', 'instagram');
        $this->dropColumn('carrier', 'facebook');
        $this->dropColumn('carrier', 'linkedin');
        $this->dropColumn('carrier', 'w9_name');
        $this->dropColumn('carrier', 'ic_name');

        $this->addColumn('carrier','mc', $this->string(32));
        $this->addColumn('carrier', 'ein', $this->string(32));
        $this->addColumn('carrier', 'dot', $this->string(32));

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230216_124049_alter_carrier_table cannot be reverted.\n";

        return false;
    }
    */
}
