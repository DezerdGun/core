<?php

use common\models\ChargeCode;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%charge_code}}`.
 */
class m220930_181437_create_charge_code_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%charge_code}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull()
        ]);

        $chargecode = [
        'TARP',
            'OTHER',
            'PER DIEM',
            'CHASSIS',
            'LINE HAUL',
            'ATTEMPTED TO PICK UP',
            'DROP CHARGE',
            'FLEXI BAG DISPOSAL',
            'BOBTAIL CHARGE',
            'OCEAN FREIGHT',
            'DEAD RUN',
            'MAINTENANCE AND REPAIR',
            'HAZMAT',
            'AES FEE',
            'DRY RUN',
            'TRAFFIC FINE',
            'SCALE LOAD',
            'BONDED CARGO CHARGE',
            'TOLLS',
            'FUEL',
            'DEMUR-DET FEE',
            'STOP OFF',
            'ATTEMPTED TO DROP',
            'DOMESTIC MOVE',
            'PLACARD REMOVAL',
            'PREPULL',
            'DEMURRAGE',
            'REEFER',
            'TRANSLOAD',
            'WASHOUT CONTAINER',
            'STRAP',
            'DETENTION',
            'SHUNT',
            'REDELIVERY',
            'TIRE REBILL',
            'PORT CONGESTION FEE',
            'WAITING TIME',
            'OVER WEIGHT',
            'BASE PRICE',
            'CONTAINER INSPECTION',
            'FLATBED',
            'TRI AXLE',
            'STORAGE',
            'PICK UP CHARGE',
            'HOURLY PAY',
            'PALLET HANDLING',
            'ADVANCEMENT FEE',
            'DRAYAGE',
            'PALLET STORAGE',
            'FACTORING FEE',
            'PALLETS',
            'UNLOAD',
            'HANDLING - DOCUMENTATION FEE',
            'PIER CONGESTION',
            'NIGHT PICK',
            'FULFILLMENT',
            'DIVERSION',
            'TRANSACTION FEE',
            'PALLET OUT FEE',
            'LAYOVER',
            'EXAM SITE PICK UP',
            'PALLETIZATION',
            'FLIP CHARGE',
            'CONTAINER STORAGE AT WAREHOUSE',
            'SATURDAY DELIVERY',
            'TANK',
            'CHASSIS SPLIT',
            'PS CREDIT',
            'PP-ADV. FEE',
            'SUNDAY GATE',
            'CHASSIS SPLIT',
            'PALLET CHARGE BY SKU AND WRAP',
            'PERMIT',
            'PORTCHASSIS',
            'PIER-PASS',
            'TOLL',
        ];
        foreach ($chargecode as $item){
            $model = new ChargeCode();
            $model->name = $item;
            $model->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%charge_code}}');
    }
}
