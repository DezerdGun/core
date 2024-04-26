<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SurveyQuestions;

/**
 * SurveyQuestionsSearch represents the model behind the search form of `common\models\SurveyQuestions`.
 */
class SurveyQuestionsSearch extends SurveyQuestions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'survey_id', 'sort_order'], 'integer'],
            [['text_ru', 'text_uz', 'text_en', 'subtext_ru', 'subtext_uz', 'subtext_en', 'type', 'create_at', 'update_at', 'deleted_at'], 'safe'],
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
        $query = SurveyQuestions::find();

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
            'survey_id' => $this->survey_id,
            'sort_order' => $this->sort_order,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['ilike', 'text_ru', $this->text_ru])
            ->andFilterWhere(['ilike', 'text_uz', $this->text_uz])
            ->andFilterWhere(['ilike', 'text_en', $this->text_en])
            ->andFilterWhere(['ilike', 'subtext_ru', $this->subtext_ru])
            ->andFilterWhere(['ilike', 'subtext_uz', $this->subtext_uz])
            ->andFilterWhere(['ilike', 'subtext_en', $this->subtext_en])
            ->andFilterWhere(['ilike', 'type', $this->type]);

        return $dataProvider;
    }
}
