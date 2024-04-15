<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service_response_localizations}}`.
 */
class m240328_124834_create_service_response_localizations_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%service_response_localizations}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(250)->notNull(),
            'description' => $this->string(250),
            'type' => $this->string(250),
            'key' => $this->string(250),
            'created_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
            'updated_at' => $this->timestamp()->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
        ]);
        $this->createIndex('INDEX_SERVICE_RESPONSE_LOCALIZATIONS_CODE', '{{%service_response_localizations}}', 'CODE');

        $this->batchInsert('{{%service_response_localizations}}', ['code', 'description', 'type', 'key'], [
            ['000', 'Approved', 'humo-payment', 'humo_approved'],
            ['100', 'Decline (general, no comments)', 'humo-payment', 'humo_decline_general_no_comments'],
            // Insert other records here...
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%service_response_localizations}}');
    }
}
