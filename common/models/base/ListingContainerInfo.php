<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "listing_container_info".
 *
 * @property integer $id
 * @property integer $listing_container_id
 * @property integer $quantity
 * @property string $size
 * @property string $container_code
 * @property integer $owner_id
 * @property integer $weight
 *
 * @property \common\models\Container $containerCode
 * @property \common\models\ListingContainer $listingContainer
 * @property \common\models\Owner $owner
 * @property string $aliasModel
 */
abstract class ListingContainerInfo extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'listing_container_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['listing_container_id', 'quantity', 'size', 'container_code', 'owner_id', 'weight'], 'required'],
            [['listing_container_id', 'quantity', 'owner_id'], 'default', 'value' => null],
            [['listing_container_id', 'quantity', 'owner_id', 'weight', 'size'], 'integer'],
            [['container_code'], 'string', 'max' => 255],
            [['container_code'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Container::className(), 'targetAttribute' => ['container_code' => 'code']],
            [['listing_container_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\ListingContainer::className(), 'targetAttribute' => ['listing_container_id' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Owner::className(), 'targetAttribute' => ['owner_id' => 'id']],
            ['listing_container_id', 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'listing_container_id' => 'Listing Container ID',
            'quantity' => 'Quantity',
            'size' => 'Size',
            'container_code' => 'Container Code',
            'owner_id' => 'Owner ID',
            'weight' => 'Weight'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContainerCode()
    {
        return $this->hasOne(\common\models\Container::className(), ['code' => 'container_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListingContainer()
    {
        return $this->hasOne(\common\models\ListingContainer::className(), ['id' => 'listing_container_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(\common\models\Owner::className(), ['id' => 'owner_id']);
    }




}
