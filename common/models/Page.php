<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string|null $page
 * @property string|null $block
 * @property string|null $text
 */
class page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page', 'block'], 'string', 'max' => 32],
            [['id','page', 'block', 'text'], 'safe'],
            ['page', 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page' => 'Page',
            'block' => 'Block',
            'text' => 'Text',
        ];
    }

    public function search($params)
    {
        $query = self::find();
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
                'pageParam' => 'p',
                'pageSizeParam' => 'pageSize',
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
                'attributes' => [
                    'id', 'page', 'block', 'text'
                ],
            ],
        ]);

        //If the verification fails, return directly
        if (!($this->load($params) && $this->validate())) {
            return $provider;
        }

        //Add filtering conditions
        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['page' => $this->page])
            ->andFilterWhere(['block' => $this->block])
            ->andFilterWhere(['text' => $this->text]);

        return $provider;
    }
}
