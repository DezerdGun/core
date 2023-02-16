<?php

namespace common\models\search;

use common\enums\LoadStatus;
use common\models\Address;
use common\models\Container;
use common\models\Load;
use common\models\LoadAdditionalInfo;
use common\models\LoadContainerInfo;
use common\models\Location;
use common\models\State;
use common\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;

class SearchLoadContainer extends Model
{
    public $id;
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
    public $portStateCode;
    public $destinationStateCode;
    public $container_code;

    public function rules(): array
    {
        return [
            [['id', 'port_id', 'destination_id', 'size', 'type','container_number'], 'integer'],
            [['status'], 'each', 'rule' => ['in', 'range' => LoadStatus::getEnums()]],
            [['portStateCode', 'destinationStateCode', 'container_code'], 'each', 'rule' => ['string']],
//            [['container_number'], 'each', 'rule' => ['exist', 'targetClass' => Container::className(), 'targetAttribute' => ['container_number' => 'code']]],
            [['port_id'], 'each', 'rule' => ['exist', 'targetClass' => State::className(), 'targetAttribute' => ['port_id' => 'state_code']]],
            [['destination_id'], 'each', 'rule' => ['exist', 'targetClass' => State::className(), 'targetAttribute' => ['destination_id' => 'state_code']]],
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
                    $query->from(['loadContainerInfos' => LoadContainerInfo::tableName()]);
                },
                'loadAdditionalInfos' => function (ActiveQuery $query) {
                    $query->from(['loadAdditionalInfos' => LoadAdditionalInfo::tableName()]);
                },
               ]);

        if (\Yii::$app->user->identity->role == User::SUB_BROKER || User::MASTER_BROKER) {
            $query->filterWhere(['user_id' => \Yii::$app->user->id]);
        }

        if ($this->id) {
            $query->Where(['like', 'CAST(container.id AS CHAR)', $this->id. '%', false]);
        }

        if ($this->status) {
            $query->andFilterWhere(['in', 'status', $this->status]);
        }

        if ($this->customer_id) {
            $query->andFilterWhere(['in', 'customer_id.', $this->customer_id]);
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

        if ($this->owner) {
            $query->andFilterWhere(['loadContainerInfos.owner' => $this->owner]);
        }

        if ($this->port_id) {
            $query->andFilterWhere(['in', 'portAddress.state_code', $this->port_id]);
        }

        if ($this->destination_id) {
            $query->andFilterWhere(['in', 'destinationStateCode.state_code', $this->destination_id]);
        }

        if ($this->vessel_eta_from && $this->vessel_eta_to) {
            $query->andFilterWhere(['between', 'vessel_eta', $this->vessel_eta_from, $this->vessel_eta_to]);
        }

        $query->orderBy([
            'id' => 'SORT_ASC'
        ]);

        return $query;
    }


}