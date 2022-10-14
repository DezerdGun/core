<?php

namespace common\models;

use Yii;
use \common\models\base\LoadNote as BaseLoadNote;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_note".
 */
class LoadNote extends BaseLoadNote
{

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false,
            ]
        ];
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
}
