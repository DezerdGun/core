<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Carrier;

/**
 * SearchCarrier represents the model behind the search form of `common\models\Carrier`.
 */
class SearchCarrier extends Carrier
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'created_at', 'updated_at', 'company_id'], 'integer'],
            [['w9_file', 'w9_mime_type', 'ic_file', 'ic_mime_type', 'scac', 'instagram', 'facebook', 'linkedin', 'w9_name', 'ic_name'], 'safe'],
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
        $query = $this->searchQuery();

        // grid filtering conditions

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    /**
     * @return \api\models\CarrierQuery
     */
    public function searchQuery(): \api\models\CarrierQuery
    {
        $query = Carrier::find();

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'company_id' => $this->company_id,
        ]);

        $query->andFilterWhere(['ilike', 'w9_file', $this->w9_file])
            ->andFilterWhere(['ilike', 'w9_mime_type', $this->w9_mime_type])
            ->andFilterWhere(['ilike', 'ic_file', $this->ic_file])
            ->andFilterWhere(['ilike', 'ic_mime_type', $this->ic_mime_type])
            ->andFilterWhere(['ilike', 'scac', $this->scac])
            ->andFilterWhere(['ilike', 'instagram', $this->instagram])
            ->andFilterWhere(['ilike', 'facebook', $this->facebook])
            ->andFilterWhere(['ilike', 'linkedin', $this->linkedin])
            ->andFilterWhere(['ilike', 'w9_name', $this->w9_name])
            ->andFilterWhere(['ilike', 'ic_name', $this->ic_name]);
        return $query;
    }


}
