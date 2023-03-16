<?php

namespace common\models\search;

use common\enums\UserRole;
use common\models\ContainerBid;
use common\models\User;
use Yii;
use yii\db\ActiveQuery;

class SearchContainerBid extends \yii\base\Model
{
    public $is_favorite;
    public $carrier_name;
    public $listing_container_id;

    public function rules(): array
    {
        return [
            ['is_favorite', 'boolean', 'trueValue' => true, 'falseValue' => false, 'strict' => false],
            ['carrier_name', 'string'],
            ['listing_container_id', 'integer']
        ];
    }

    public function search(): \yii\db\ActiveQuery
    {
        $query = ContainerBid::find()
            ->from(['containerBid' => ContainerBid::tableName()])
            ->joinWith([
            'user' => function (ActiveQuery $query) {
                $query->from(['user' => User::tableName()]);
            }
        ]);

        if ($this->carrier_name) {
            $query->andfilterWhere(['ILIKE', 'user.name', '%' . $this->carrier_name . '%', false]);
        }

        if (Yii::$app->user->identity->role == UserRole::CARRIER) {
            $query->andfilterWhere(['user_id' => \Yii::$app->user->id]);
        }



        if ($this->listing_container_id) {
            $query->andfilterWhere(['listing_container_id' => $this->listing_container_id]);
        }

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