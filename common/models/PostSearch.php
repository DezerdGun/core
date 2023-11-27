<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form of `common\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'create_at', 'update_at', 'view_count', 'image_id', 'user_id', 'hash', 'news_category_id', 'position_on_parent_list'], 'integer'],
            [['type', 'status', 'options', 'promo_data', 'about_main_section_type'], 'safe'],
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
        $query = Post::find();

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
            'category_id' => $this->category_id,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'view_count' => $this->view_count,
            'image_id' => $this->image_id,
            'user_id' => $this->user_id,
            'hash' => $this->hash,
            'news_category_id' => $this->news_category_id,
            'position_on_parent_list' => $this->position_on_parent_list,
        ]);

        $query->andFilterWhere(['ilike', 'type', $this->type])
            ->andFilterWhere(['ilike', 'status', $this->status])
            ->andFilterWhere(['ilike', 'options', $this->options])
            ->andFilterWhere(['ilike', 'promo_data', $this->promo_data])
            ->andFilterWhere(['ilike', 'about_main_section_type', $this->about_main_section_type]);

        return $dataProvider;
    }
}
