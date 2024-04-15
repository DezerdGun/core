<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ServiceResponseLocalizations;

/**
 * SearchServiceResponseLocalizations represents the model behind the search form of `common\models\ServiceResponseLocalizations`.
 */
class SearchServiceResponseLocalizations extends ServiceResponseLocalizations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['CODE', 'DESCRIPTION', 'TYPE', 'KEY', 'CREATED_AT', 'UPDATED_AT'], 'safe'],
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
        $query = ServiceResponseLocalizations::find();

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
            'ID' => $this->ID,
            'CREATED_AT' => $this->CREATED_AT,
            'UPDATED_AT' => $this->UPDATED_AT,
        ]);

        $query->andFilterWhere(['ilike', 'CODE', $this->CODE])
            ->andFilterWhere(['ilike', 'DESCRIPTION', $this->DESCRIPTION])
            ->andFilterWhere(['ilike', 'TYPE', $this->TYPE])
            ->andFilterWhere(['ilike', 'KEY', $this->KEY]);

        return $dataProvider;
    }
}
