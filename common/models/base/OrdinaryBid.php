<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use common\enums\UserRole;
use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "ordinary_bid".
 *
 * @property integer $id
 * @property boolean $is_favorite
 * @property integer $listing_ordinary_id
 * @property string $note
 * @property integer $edit_counting
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property \common\models\ListingOrdinary $listingOrdinary
 * @property \common\models\OrdinaryBidDetail[] $ordinaryBidDetail
 * @property User $user
 * @property string $aliasModel
 */
abstract class OrdinaryBid extends \yii\db\ActiveRecord
{
    public $role = UserRole::CARRIER;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordinary_bid';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['listing_ordinary_id', 'user_id'], 'required'],
            [['is_favorite'], 'default', 'value' => false],
            [['listing_ordinary_id', 'edit_counting', 'user_id'], 'default', 'value' => null],
            [['listing_ordinary_id', 'edit_counting', 'user_id'], 'integer'],
            [['note'], 'string', 'max' => 255],
            [['listing_ordinary_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\ListingOrdinary::className(), 'targetAttribute' => ['listing_ordinary_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id', 'role' => 'role']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_favorite' => 'Is Favorite',
            'listing_ordinary_id' => 'Listing Ordinary ID',
            'note' => 'Note',
            'edit_counting' => 'Edit Counting',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListingOrdinary()
    {
        return $this->hasOne(\common\models\ListingOrdinary::className(), ['id' => 'listing_ordinary_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdinaryBidDetail()
    {
        return $this->hasMany(\common\models\OrdinaryBidDetail::className(), ['ordinary_bid_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }



}