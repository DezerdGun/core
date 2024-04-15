<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CardProductsReissueBlock;

/**
 * CardProductsReissueBlockSearch represents the model behind the search form of `common\models\CardProductsReissueBlock`.
 */
class CardProductsReissueBlockSearch extends CardProductsReissueBlock
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['branch_id', 'card_product_id', 'blocked_from', 'blocked_to', 'branches_ec_id', 'key'], 'safe'],
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
        $query = CardProductsReissueBlock::find();

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
            'blocked_from' => $this->blocked_from,
            'blocked_to' => $this->blocked_to,
        ]);

        $query->andFilterWhere(['ilike', 'branch_id', $this->branch_id])
            ->andFilterWhere(['ilike', 'card_product_id', $this->card_product_id])
            ->andFilterWhere(['ilike', 'branches_ec_id', $this->branches_ec_id])
            ->andFilterWhere(['ilike', 'key', $this->key]);

        return $dataProvider;
    }
}
