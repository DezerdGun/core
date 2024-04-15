<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "card_products_reissue_block".
 *
 * @property int $id
 * @property string|null $branch_id
 * @property string|null $card_product_id
 * @property string|null $blocked_from
 * @property string|null $blocked_to
 * @property string|null $branches_ec_id
 * @property string|null $key
 */
class CardProductsReissueBlock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card_products_reissue_block';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blocked_from', 'blocked_to'], 'safe'],
            [['branch_id', 'card_product_id', 'key'], 'string', 'max' => 255],
            [['branches_ec_id'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch_id' => 'Branch ID',
            'card_product_id' => 'Card Product ID',
            'blocked_from' => 'Blocked From',
            'blocked_to' => 'Blocked To',
            'branches_ec_id' => 'Branches Ec ID',
            'key' => 'Key',
        ];
    }
}
