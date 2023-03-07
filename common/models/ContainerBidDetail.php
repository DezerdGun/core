<?php

namespace common\models;

use Yii;
use \common\models\base\ContainerBidDetail as BaseContainerBidDetail;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "container_bid_detail".
 */
class ContainerBidDetail extends BaseContainerBidDetail
{
    const MAX_PRICE = 999999.99;
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    const SCENARIO_VALIDATE_ARRAY = 'validate_array';

    public $user_id;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->user_id = Yii::$app->user->id;
    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                ['container_bid_id', 'exist', 'targetClass' => \common\models\ContainerBid::className(), 'targetAttribute' => ['container_bid_id' => 'id', 'user_id' => 'user_id']],

                [['price'], 'each', 'rule' => ['number', 'max' => self::MAX_PRICE], 'on' => [self::SCENARIO_CREATE]],
                [['price'], 'each', 'rule' => ['match', 'pattern' => '/^\d{0,8}(\.\d{1,2}?)?$/'], 'on' => [self::SCENARIO_CREATE]],
                [['free_unit'], 'each', 'rule' => ['integer'], 'on' => [self::SCENARIO_CREATE]],
                ['charge_id', 'each', 'rule' => ['exist', 'targetClass' => \common\models\Charge::className(), 'targetAttribute' => ['charge_id' => 'id']], 'on' => [self::SCENARIO_CREATE]],
                ['measure_id', 'each', 'rule' => ['exist', 'targetClass' => \common\models\Measure::className(), 'targetAttribute' => ['measure_id' => 'id']], 'on' => [self::SCENARIO_CREATE]],
                ['charge_id', 'each', 'rule' => ['unique', 'targetClass'=> self::className(),'targetAttribute' => ['charge_id', 'container_bid_id']], 'on' => [self::SCENARIO_CREATE]],
                ['measure_id', 'each', 'rule' => ['unique', 'targetClass'=> self::className(), 'targetAttribute' => ['measure_id', 'container_bid_id']], 'on' => [self::SCENARIO_CREATE]],

                ['price', 'number', 'max' => self::MAX_PRICE, 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_VALIDATE_ARRAY]],
                ['price', 'match', 'pattern' => '/^\d{0,8}(\.\d{1,2}?)?$/', 'on' => [self::SCENARIO_UPDATE, self::SCENARIO_VALIDATE_ARRAY]],
                ['free_unit', 'integer',  'on' => [self::SCENARIO_UPDATE, self::SCENARIO_VALIDATE_ARRAY]],
                ['charge_id', 'exist', 'targetClass' => \common\models\Charge::className(), 'targetAttribute' => ['charge_id' => 'id'], 'on' => [self::SCENARIO_UPDATE]],
                ['measure_id', 'exist', 'targetClass' => \common\models\Measure::className(), 'targetAttribute' => ['measure_id' => 'id'], 'on' => [self::SCENARIO_UPDATE]],
                ['charge_id', 'unique', 'targetClass'=> self::className(),'targetAttribute' => ['charge_id', 'container_bid_id'], 'on' => self::SCENARIO_UPDATE],
                ['measure_id', 'unique', 'targetClass'=> self::className(), 'targetAttribute' => ['measure_id', 'container_bid_id'], 'on' => self::SCENARIO_UPDATE]
            ]
        );
    }
}
