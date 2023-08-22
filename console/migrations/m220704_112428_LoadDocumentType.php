<?php

use yii\db\Migration;

/**
 * Class m220704_112428_LoadDocumentType
 */
class m220704_112428_LoadDocumentType extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{load_document_type}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(32)
        ]);

        $pdf = [
            "Bill of Lading",
            "Quote",
            "Proof of Delivery",
            "Delivery Order",
            "TIR",
            "Rate Confirmation",
            "TIR IN",
            "TIR OUT",
            "TIR Chassis",
            "Packaging Slip",
            "Email",
            "Dock Receipt",
            "Scale Ticket",
            "635 Ingate receipt",
            "635 outgate receipt",
            "Tolls",
            "Other",
            "Container / chassis - in - picture",
            "Container / chassis - out - picture",
            "Genset picture in - picture out",
            "Void out ticket",
            "Revised 1",
            "Revised 2",
            "Revised 3",
            "Demurrage(receipt)",
            "Pier pass(receipt)",
            "Temperature unit",
            "Damaged cargo - box",
            "Haz Mat",
            "Lumper Receipt",
            "Invoice",
            "Rate Con",
            "Detention PICs",
            "Seal Import",
            "Seal export",
            "Seal improper",
            "Debris pics",
            "Per Diem",
            "Booking Confirmation",
        ];

        foreach ($pdf as $item){
            $model = new \common\models\LoadDocumentType();
            $model->name = $item;
            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220704_112428_LoadDocumentType cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220704_112428_LoadDocumentType cannot be reverted.\n";

        return false;
    }
    */
}
