<?php

use yii\db\Migration;

/**
 * Class m220828_105704_create_load_documents
 */
class m220828_105704_create_load_documents extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{load_documents}}', [
            'id' => $this->primaryKey(),
            'load_id' => $this->integer(),
            'path' => $this->string(255),
            'filename' => $this->string(255),
            'mime_type' => $this->string(255),
            'doc_type' => $this->integer(),
            'updated_at' => $this->timestamp(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('LOCALTIMESTAMP'),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'upload_by' => $this->integer(),
        ]);

        $this->addForeignKey(
            'load_documents_load_fk',
            'load_documents',
            'load_id',
            'load',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'load_documents_user_fk',
            'load_documents',
            'upload_by',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'load_documents_doc_type_fk',
            'load_documents',
            'doc_type',
            'load_document_type',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220828_105704_create_load_documents cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220828_105704_create_load_documents cannot be reverted.\n";

        return false;
    }
    */
}
