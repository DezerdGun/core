<?php

namespace common\models\search;

use common\models\Location;
use common\models\Address;
use yii\base\Model;

class SearchLocation extends Model
{
    public $id;
    public $name;
    public $is_port;
    public $is_warehouse;
    public $street_address;
    public $city;
    public $state_code;
    public $zip;

    public function rules()
    {
        return [
            ['id', 'integer'],
            [['is_port', 'is_warehouse'], 'required'],
            [['name', 'street_address', 'city', 'state_code', 'zip', 'is_port', 'is_warehouse'], 'string'],
        ];
    }

    public function search($params)
    {
        $query = Location::find()
        ->from(['load' => Location::tableName()])
        ->joinWith([
                'address' => function (\Yii\db\ActiveQuery $query) {
                    $query->from(['address' => Address::tableName()]);
                }
            ]);

        if ($this->id) {
            $query->andfilterWhere(['LIKE', 'CAST(id AS VARCHAR)', $this->id . '%', false]);
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

        if ($this->is_port === 'yes' && $this->is_warehouse === 'yes') {
            $query->andFilterWhere(['or', ['location_type' => 'port'], ['location_type' => 'warehouse']]);
        }

        if ($this->is_port === 'yes' && $this->is_warehouse === 'no') {
            $query->andFilterWhere(['location_type' => 'port']);
        }

        if ($this->is_port === 'no' && $this->is_warehouse === 'yes') {
            $query->andFilterWhere(['location_type' => 'warehouse']);
        }

        if ($this->is_port === 'no' && $this->is_warehouse === 'no') {
            $query->andFilterWhere(['<>', 'location_type', 'port'])
            ->andFilterWhere(['<>', 'location_type', 'warehouse']);
        }
        $query->orderBy([
            'id' => SORT_ASC,
            'name' => SORT_DESC
        ]);

        return $query;
    }
}
