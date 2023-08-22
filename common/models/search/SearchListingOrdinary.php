<?php

namespace common\models\search;

use common\models\Equipment;
use common\models\ListingOrdinary;
use common\models\Address;
use common\models\ListingOrdinaryAdditionalInfo;
use common\models\ListingOrdinaryInfo;
use common\models\Location;
use common\enums\ListingStatus;
use common\models\OrdinaryEquipment;
use common\models\State;
use yii\db\ActiveQuery;
use common\models\User;

class SearchListingOrdinary extends \yii\base\Model
{
    public $id;
    public $status;
    public $origin_id;
    public $destination_id;
    public $equipment_code;
    public $pick_up_from;
    public $pick_up_to;
    public $quantity;
    public $size;
    public $max_weight;
    public $owner_id;
    public $origin_state_code;
    public $destination_state_code;
    public $hazmat;
    public $overweight;
    public $reefer;
    public $alcohol;
    public $urgent;


    public function rules()
    {
        return [
            [['id', 'origin_id', 'destination_id', 'max_weight', 'quantity'], 'integer'],
            [['hazmat', 'overweight', 'reefer', 'alcohol', 'urgent', 'size'], 'string'],
            [['status'], 'each', 'rule' => ['in', 'range' => ListingStatus::getEnums()]],
            [['origin_state_code', 'destination_state_code'], 'each', 'rule' => ['string']],
            [['equipment_code'], 'each', 'rule' => ['exist', 'targetClass' => Equipment::className(), 'targetAttribute' => ['equipment_code' => 'code']]],
            [['origin_state_code'], 'each', 'rule' => ['exist', 'targetClass' => State::className(), 'targetAttribute' => ['origin_state_code' => 'state_code']]],
            [['destination_state_code'], 'each', 'rule' => ['exist', 'targetClass' => State::className(), 'targetAttribute' => ['destination_state_code' => 'state_code']]],
            [['pick_up_from', 'pick_up_to'], 'date', 'format' => 'php:Y-m-d']
        ];
    }

    public function search()
    {
        $query = ListingOrdinary::find()
            ->from(['ordinary' => ListingOrdinary::tableName()])
            ->joinWith([
                'origin' => function (ActiveQuery $query) {
                    $query->joinWith([
                        'address' => function (ActiveQuery $query) {
                            $query->from(['originAddress' => Address::tableName()]);
                        }
                    ]);
                    $query->from(['origin' => Location::tableName()]);
                },
                'destination' => function (ActiveQuery $query) {
                    $query->joinWith([
                        'address' => function (ActiveQuery $query) {
                            $query->from(['destinationAddress' => Address::tableName()]);
                        }
                    ]);
                    $query->from(['destination' => Location::tableName()]);
                },
                'ordinaryInfo' => function (ActiveQuery $query) {
                    $query->from(['ordinaryInfo' => ListingOrdinaryInfo::tableName()]);
                },
                'additionalInfo' => function (ActiveQuery $query) {
                    $query->from(['additionalInfo' => ListingOrdinaryAdditionalInfo::tableName()]);
                },
                'ordinaryEquipments' => function (ActiveQuery $query) {
                    $query->from(['ordinaryEquipments' => OrdinaryEquipment::tableName()]);
                }
            ]);
        $query->distinct();

        if (\Yii::$app->user->identity->role == User::SUB_BROKER) {
            $query->filterWhere(['user_id' => \Yii::$app->user->id]);
        }

        if ($this->id) {
            $query->Where(['like', 'CAST(ordinary.id AS CHAR)', $this->id. '%', false]);
        }

        if ($this->status) {
            $query->andFilterWhere(['in', 'status', $this->status]);
        }

        if ($this->origin_id) {
            $query->andFilterWhere(['origin_id' => $this->origin_id]);
        }

        if ($this->destination_id) {
            $query->andFilterWhere(['destination_id' => $this->destination_id]);
        }

        if ($this->size) {
            $query->andFilterWhere(['ordinaryInfo.size' => $this->size]);
        }

        if ($this->equipment_code) {
            $query->andFilterWhere(['in', 'ordinaryEquipments.equipment_code', $this->equipment_code]);
        }

        if ($this->pick_up_from && $this->pick_up_to) {
            $query->andFilterWhere(['between', 'pick_up', $this->pick_up_from, $this->pick_up_to]);
        }

        if ($this->quantity) {
            $query->andFilterWhere(['=', 'ordinaryInfo.quantity', $this->quantity]);
        }

        if ($this->max_weight) {
            $query->andFilterWhere(['<=', 'ordinaryInfo.weight', $this->max_weight]);
        }

        if ($this->origin_state_code) {
            $query->andFilterWhere(['in', 'originAddress.state_code', $this->origin_state_code]);
        }

        if ($this->destination_state_code) {
            $query->andFilterWhere(['in', 'destinationAddress.state_code', $this->destination_state_code]);
        }




        if ($this->hazmat) {
            $query->andWhere(['not', ['additionalInfo.hazmat_description' => null]]);
        }

        if ($this->overweight) {
            $query->andWhere(['not', ['additionalInfo.overweight_description' => null]]);
        }

        if ($this->reefer) {
            $query->andWhere(['not', ['additionalInfo.reefer_description' => null]]);
        }

        if ($this->alcohol) {
            $query->andWhere(['not', ['additionalInfo.alcohol_description' => null]]);
        }

        if ($this->urgent) {
            $query->andWhere(['not', ['additionalInfo.urgent_description' => null]]);
        }

        $query->orderBy([
            'id' => SORT_DESC
        ]);

        return $query;
    }
}
