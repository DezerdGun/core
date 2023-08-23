<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Epos;

/**
 * EposSearch represents the model behind the search form of `common\models\Epos`.
 */
class EposSearch extends Epos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'processing', 'auto_reco'], 'integer'],
            [['code', 'specification', 'merchant', 'terminal', 'port', 'created_at', 'updated_at'], 'safe'],
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
        $query = Epos::find();

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
            'processing' => $this->processing,
            'auto_reco' => $this->auto_reco,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'code', $this->code])
            ->andFilterWhere(['ilike', 'specification', $this->specification])
            ->andFilterWhere(['ilike', 'merchant', $this->merchant])
            ->andFilterWhere(['ilike', 'terminal', $this->terminal])
            ->andFilterWhere(['ilike', 'port', $this->port]);

        return $dataProvider;
    }
}
