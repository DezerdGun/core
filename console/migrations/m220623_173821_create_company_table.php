<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company}}`.
 */
class m220623_173821_create_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company}}', [
            'id' => $this->primaryKey(),
            'company_name' => $this->string(32),
            'street_address' => $this->string(32),
            'city' => $this->string(32),
            'state' => $this->string(32),
            'zip_code' => $this->string(32),
            'country' => $this->string(32),
            'business_phone' => $this->string(32),
            'ein' => $this->string(32),
            'w9_file' => $this->string(55),
            'w9_mime_type' => $this->string(32),
            'ic_file' => $this->string(55),
            'ic_mime_type' => $this->string(32),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company}}');
    }
}
