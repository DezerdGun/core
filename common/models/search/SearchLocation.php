<?php

namespace common\models\search;

use common\models\Location;
use common\models\Address;
use yii\base\Model;

class SearchLocation extends Model
{
    public $type;
    public $name;
    public $street_address;
    public $city;
    public $state_code;
    public $zip;

    public function rules()
    {
        return [
            [['type', 'name', 'street_address', 'city', 'state_code', 'zip'], 'string'],
        ];
    }

    public function search(): \yii\db\ActiveQuery
    {
        $query = Location::find()
        ->from(['location' => Location::tableName()])
        ->joinWith([
                'address' => function (\Yii\db\ActiveQuery $query) {
                    $query->from(['address' => Address::tableName()]);
                }
            ]);

        if ($this->type) {
            $query->andFilterWhere(['type' => $this->type]);
        }

        if ($this->name) {
            $query->andfilterWhere(['ILIKE', 'name', $this->name . '%', false]);
        }

        if ($this->street_address) {
            $query->andFilterWhere(['address.street_address' => $this->street_address]);
        }

        if ($this->city) {
            $query->andFilterWhere(['address.city' => $this->city]);
        }

        if ($this->state_code) {
            $query->andFilterWhere(['address.state_code' => $this->state_code]);
        }

        if ($this->zip) {
            $query->andFilterWhere(['address.zip' => $this->zip]);
        }

        $query->orderBy([
            'id' => 'SORT_ASC'
        ]);

        return $query;
    }
}
