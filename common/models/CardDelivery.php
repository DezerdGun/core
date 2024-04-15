<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "card_delivery".
 *
 * @property int $id
 * @property string|null $branch
 * @property string|null $product_id
 * @property string|null $operation
 * @property string|null $design
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class CardDelivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_delivery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['branch', 'product_id', 'operation', 'design'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch' => 'Branch',
            'product_id' => 'Product ID',
            'operation' => 'Operation',
            'design' => 'Design',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }
}
