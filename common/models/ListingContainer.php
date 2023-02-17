<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\ListingContainer as BaseListingContainer;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "listing_container".
 */
class ListingContainer extends BaseListingContainer
{
    use Template;
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }

    public static function count(): array
    {
        $query = self::find()
            ->select(['status','COUNT(status) as number'])
            ->groupBy(['status'])
            ->asArray();
        if (Yii::$app->user->identity->role == User::SUB_BROKER) {
            $query->filterWhere(['user_id' => Yii::$app->user->id]);
        }
        return $query->all();
    }
}
