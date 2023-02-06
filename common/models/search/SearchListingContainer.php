<?php

namespace common\models\search;

use common\enums\ListingStatus;
use common\models\Address;
use common\models\Container;
use common\models\ListingContainer;
use common\models\ListingContainerAdditionalInfo;
use common\models\ListingContainerInfo;
use common\models\Location;
use common\models\State;
use yii\base\Model;
use yii\db\ActiveQuery;

class SearchListingContainer extends Model
{
    public $id;
    public $status;
    public $port_id;
    public $destination_id;
    public $size;
    public $container_code;
    public $owner_id;
    public $port_state_code;
    public $destination_state_code;
    public $vessel_eta_from;
    public $vessel_eta_to;
    public $max_weight;
    public $hazmat;
    public $overweight;
    public $reefer;
    public $alcohol;
    public $urgent;

    public function rules(): array
    {
        return [
            [['id', 'port_id', 'destination_id', 'size', 'owner_id', 'max_weight'], 'integer'],
            [['status', 'hazmat', 'overweight', 'reefer', 'alcohol', 'urgent'], 'string'],
            ['status', 'in', 'range' => ListingStatus::getEnums()],
            [['port_state_code', 'destination_state_code', 'container_code'], 'each', 'rule' => ['string']],
            [['container_code'], 'each', 'rule' => ['exist', 'targetClass' => Container::className(), 'targetAttribute' => ['container_code' => 'code']]],
            [['port_state_code'], 'each', 'rule' => ['exist', 'targetClass' => State::className(), 'targetAttribute' => ['port_state_code' => 'state_code']]],
            [['destination_state_code'], 'each', 'rule' => ['exist', 'targetClass' => State::className(), 'targetAttribute' => ['destination_state_code' => 'state_code']]],
            [['vessel_eta_from', 'vessel_eta_to'], 'date', 'format' => 'php:Y-m-d']
        ];
    }

    public function search()
    {
        $query = ListingContainer::find()
        ->from(['container' => ListingContainer::tableName()])
        ->joinWith([
            'port' => function (ActiveQuery $query) {
                $query->joinWith([
                    'address' => function (ActiveQuery $query) {
                        $query->from(['portAddress' => Address::tableName()]);
                    }
                ]);
                $query->from(['port' => Location::tableName()]);
            },
            'destination' => function (ActiveQuery $query) {
                $query->joinWith([
                    'address' => function (ActiveQuery $query) {
                        $query->from(['destinationAddress' => Address::tableName()]);
                    }
                ]);
                $query->from(['destination' => Location::tableName()]);
            },
            'containerInfo' => function (ActiveQuery $query) {
                $query->from(['containerInfo' => ListingContainerInfo::tableName()]);
            },
            'additionalInfo' => function (ActiveQuery $query) {
                $query->from(['additionalInfo' => ListingContainerAdditionalInfo::tableName()]);
            }
        ]);

        if ($this->id) {
            $query->Where(['like', 'CAST(container.id AS CHAR)', $this->id. '%', false]);
        }

        if ($this->status) {
            $query->andFilterWhere(['status' => $this->status]);
        }

        if ($this->port_id) {
            $query->andFilterWhere(['port_id' => $this->port_id]);
        }

        if ($this->destination_id) {
            $query->andFilterWhere(['destination_id' => $this->destination_id]);
        }

        if ($this->size) {
            $query->andFilterWhere(['containerInfo.size' => $this->size]);
        }

        if ($this->container_code) {
            $query->andFilterWhere(['in', 'containerInfo.container_code', $this->container_code]);
        }

        if ($this->owner_id) {
            $query->andFilterWhere(['containerInfo.owner_id' => $this->owner_id]);
        }

        if ($this->port_state_code) {
            $query->andFilterWhere(['in', 'portAddress.state_code', $this->port_state_code]);
        }

        if ($this->destination_state_code) {
            $query->andFilterWhere(['in', 'destinationAddress.state_code', $this->destination_state_code]);
        }

        if ($this->vessel_eta_from && $this->vessel_eta_to) {
            $query->andFilterWhere(['between', 'vessel_eta', $this->vessel_eta_from, $this->vessel_eta_to]);
        }

        if ($this->max_weight) {
            $query->andFilterWhere(['<=', 'containerInfo.weight', $this->max_weight]);
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
            'id' => 'SORT_ASC'
        ]);

        return $query;
    }
}
