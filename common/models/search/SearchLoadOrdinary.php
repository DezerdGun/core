<?php

namespace common\models\search;

use common\enums\LoadStatus;
use common\models\Address;
use common\models\Customer;
use common\models\Company;
use common\models\Date;
use common\models\Equipment;
use common\models\LoadAdditionalInfo;
use common\models\LoadOrdinaryAdditionalInfo;
use common\models\LoadOrdinaryDescription;
use common\models\Location;
use common\models\OrdinaryLoad;
use common\models\OrdinaryNeeded;
use common\models\Owner;
use common\models\State;
use common\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;

class SearchLoadOrdinary extends Model
{
    public $id;
    public $port_id;
    public $destination_id;
    public $equipmentNeed;
    public $pick_up_date;
    public $pick_up_date_from;
    public $pick_up_date_to;
    public $pallets;
    public $pallet_size;
    public $weight_LBs;
    public $owner_id;
    public $origin_id;
    public $load_id;
    public $status;
    public $port_state_code;
    public $destination_state_code;
    public $customer_id;


    public function rules(): array
    {
       return[
           [['id','port_id','destination_id','load_id','pallets','owner_id','customer_id'],'integer'],
           [['pallet_size','weight_LBs','pick_up_date'],'string'],
           [['status'], 'each', 'rule' => ['in', 'range' => LoadStatus::getEnums()]],
           [['equipmentNeed'], 'each', 'rule' => ['exist', 'targetClass' => Equipment::className(), 'targetAttribute' => ['equipmentNeed' => 'code']]],
           [['port_state_code', 'destination_state_code'], 'each', 'rule' => ['string']],
           [['port_state_code'], 'each', 'rule' => ['exist', 'targetClass' => State::className(), 'targetAttribute' => ['port_state_code' => 'state_code']]],
           [['destination_state_code'], 'each', 'rule' => ['exist', 'targetClass' => State::className(), 'targetAttribute' => ['destination_state_code' => 'state_code']]],
           [['pick_up_date_from', 'pick_up_date_to'], 'date', 'format' => 'php:Y-m-d']
       ];
    }

    public function search(): ActiveQuery
    {
        $query = OrdinaryLoad::find()
            ->from(['container' => OrdinaryLoad::tableName()])
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
                'loadOrdinaryAdditionalInfos' => function (ActiveQuery $query) {
                    $query->joinWith([
                        'load' => function (ActiveQuery $query) {
                            $query->from(['loadOrdinaryAdditionalInfos' => LoadOrdinaryAdditionalInfo::tableName()]);
                        }
                    ]);
                },
                'loadOrdinaryDescriptions' => function (ActiveQuery $query) {
                    $query->from(['loadOrdinaryDescriptions' => LoadOrdinaryDescription::tableName()]);
                },

            ]);

        if (\Yii::$app->user->identity->role == User::SUB_BROKER) {
            $query->filterWhere(['user_id' => \Yii::$app->user->id]);
        }

        if ($this->id) {
            $query->andWhere(['container.id'=> $this->id ]);
        }

        if ($this->customer_id) {
            $query->andFilterWhere(['customer_id' => $this->customer_id]);
        }

        if ($this->port_id) {
            $query->andFilterWhere(['origin_id' => $this->port_id]);
        }

        if ($this->destination_id) {
            $query->andFilterWhere(['destination_id' => $this->destination_id]);
        }

        if ($this->load_id) {
            $query->andFilterWhere(['like', 'CAST(load_reference_number AS char(50))', $this->load_id.'%',false]);
        }

        if ($this->pick_up_date_from && $this->pick_up_date_to) {
            $query->andFilterWhere(['between', 'pick_up_date', $this->pick_up_date_from, $this->pick_up_date_to]);
        }

        if ($this->status) {
            $query->andFilterWhere(['in', 'status', $this->status]);
        }

        if ($this->equipmentNeed) {
            $query->andFilterWhere(['ordinaryNeededs.ordinary_need' => $this->equipmentNeed]);
        }

        if ($this->pallets) {
            $query->andFilterWhere(['loadOrdinaryDescriptions.pallets'=> $this->pallets]);
        }

        if ($this->pallet_size) {
            $query->andFilterWhere([ 'loadOrdinaryDescriptions.pallet_size' => $this->pallet_size]);
        }

        if ($this->weight_LBs) {
            $query->andFilterWhere(['loadOrdinaryDescriptions.weight_LBs' => $this->weight_LBs]);
        }

        if ($this->owner_id) {
            $query->andFilterWhere(['equipment_need_id' => $this->owner_id]);
        }

        $query->orderBy([
            'id' => SORT_DESC
        ]);

        return $query;
    }


}