<?php

namespace common\models\search;

use common\enums\LoadStatus;
use common\models\Address;
use common\models\Container;
use common\models\Date;
use common\models\Load;
use common\models\LoadAdditionalInfo;
use common\models\LoadContainerInfo;
use common\models\Location;
use common\models\Owner;
use common\models\State;
use common\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;

class SearchLoadContainer extends Model
{
    public $id;
    public $load_id;
    public $customer_id;
    public $port_id;
    public $destination_id;
    public $vessel_eta;
    public $container_number;
    public $size;
    public $type;
    public $owner;
    public $vessel_eta_from;
    public $vessel_eta_to;
    public $status;
    public $port_state_code;
    public $destination_state_code;
    public $container_code;

    public function rules(): array
    {
        return [
            [['id','load_id', 'port_id','destination_id','size','customer_id', 'container_number'], 'integer'],
            [['type','owner'], 'string'],
            [['status'], 'each', 'rule' => ['in', 'range' => LoadStatus::getEnums()]],
            [['port_state_code', 'destination_state_code', 'container_code'], 'each', 'rule' => ['string']],
            [['port_id'], 'each', 'rule' => ['exist', 'targetClass' => State::className(), 'targetAttribute' => ['port_state_code' => 'state_code']]],
            [['destination_id'], 'each', 'rule' => ['exist', 'targetClass' => State::className(), 'targetAttribute' => ['destination_state_code' => 'state_code']]],
            [['vessel_eta_from', 'vessel_eta_to'], 'date', 'format' => 'php:Y-m-d']
        ];
    }

    public function search(): ActiveQuery
    {
        $query = Load::find()
            ->from(['container' => Load::tableName()])
            ->joinWith([
                'port' => function (ActiveQuery $query) {
                    $query->joinWith([
                        'address' => function (ActiveQuery $query) {
                            $query->from(['portAddress' => Address::tableName()]);
                        }
                    ]);
                    $query->from(['port' => Location::tableName()]);
                },
                'consignee' => function (ActiveQuery $query) {
                    $query->joinWith([
                        'address' => function (ActiveQuery $query) {
                            $query->from(['consigneeAddress' => Address::tableName()]);
                        }
                    ]);
                    $query->from(['consignee' => Location::tableName()]);
                },
                'loadContainerInfos' => function (ActiveQuery $query) {
                    $query->joinWith([
                        'owner' => function (ActiveQuery $query) {
                            $query->from(['loadContainerInfosOwner' => Owner::tableName()]);
                        }
                    ]);
                    $query->from(['loadContainerInfos' => LoadContainerInfo::tableName()]);
                },
                'loadAdditionalInfos' => function (ActiveQuery $query) {
                    $query->from(['loadAdditionalInfos' => LoadAdditionalInfo::tableName()]);
                },
                'date' => function (ActiveQuery $query) {
                    $query->from(['date' => Date::tableName()]);
                },
            ]);

        if (\Yii::$app->user->identity->role == User::SUB_BROKER) {
            $query->filterWhere(['user_id' => \Yii::$app->user->id]);
        }

        if ($this->id) {
            $query->Where(['like', 'CAST(container.id AS CHAR)', $this->id . '%', false]);
        }

        if ($this->owner) {
            $query->andFilterWhere(['loadContainerInfosOwner.name' => $this->owner]);
        }

        if ($this->load_id) {
            $query->andFilterWhere(['loadContainerInfos.load_id' => $this->load_id]);
        }

        if ($this->status) {
            $query->andFilterWhere(['in', 'status', $this->status]);
        }

        if ($this->customer_id) {
            $query->andFilterWhere(['customer_id' => $this->customer_id]);
        }

        if ($this->port_id) {
            $query->andFilterWhere(['port_id' => $this->port_id]);
        }

        if ($this->destination_id) {
            $query->andFilterWhere(['destination_id' => $this->destination_id]);
        }

        if ($this->size) {
            $query->andFilterWhere(['loadContainerInfos.size' => $this->size]);
        }

        if ($this->type) {
            $query->andFilterWhere(['loadContainerInfos.type' => $this->type]);
        }

        if ($this->port_state_code) {
            $query->andFilterWhere(['in', 'portAddress.state_code', $this->port_state_code]);
        }

        if ($this->destination_state_code) {
            $query->andFilterWhere(['in', 'consigneeAddress.state_code', $this->destination_state_code]);
        }

        if ($this->vessel_eta_from && $this->vessel_eta_to) {
            $query->andFilterWhere(['between', 'date.vessel_eta', $this->vessel_eta_from, $this->vessel_eta_to]);
        }

        $query->orderBy([
            'id' => 'SORT_ASC'
        ]);

        return $query;
    }


}