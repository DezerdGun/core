<?php

namespace common\models\search;

use common\models\ContainerBid;
use Yii;

class SearchContainerBid extends \yii\base\Model
{
    public $is_favorite;

    public function rules(): array
    {
        return [
            ['is_favorite', 'boolean', 'trueValue' => true, 'falseValue' => false, 'strict' => false],
        ];
    }

    public function search(): \yii\db\ActiveQuery
    {
        $query = ContainerBid::find()
            ->from(['container_bid' => ContainerBid::tableName()]);

        $test = Yii::$app->user->id;
        $query->andfilterWhere(['user_id' => \Yii::$app->user->id]);

        if ($this->is_favorite == "true") {
            $query->andfilterWhere(['is_favorite' => true]);
        }

        if ($this->is_favorite == "false") {
            $query->andfilterWhere(['is_favorite' => false]);
        }
        $query->orderBy([
            'id' => SORT_DESC
        ]);
        return $query;
    }
}