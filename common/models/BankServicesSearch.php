<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BankServices;

/**
 * BankServicesSearch represents the model behind the search form of `common\models\BankServices`.
 */
class BankServicesSearch extends BankServices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'icon_id', 'is_new', 'ignore_custom_order', 'ignore_disabled'], 'integer'],
            [['code', 'name_ru', 'name_uz', 'name_en', 'action', 'platform', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BankServices::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sort' => $this->sort,
            'icon_id' => $this->icon_id,
            'is_new' => $this->is_new,
            'ignore_custom_order' => $this->ignore_custom_order,
            'ignore_disabled' => $this->ignore_disabled,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['ilike', 'code', $this->code])
            ->andFilterWhere(['ilike', 'name_ru', $this->name_ru])
            ->andFilterWhere(['ilike', 'name_uz', $this->name_uz])
            ->andFilterWhere(['ilike', 'name_en', $this->name_en])
            ->andFilterWhere(['ilike', 'action', $this->action])
            ->andFilterWhere(['ilike', 'platform', $this->platform]);

        return $dataProvider;
    }
}
