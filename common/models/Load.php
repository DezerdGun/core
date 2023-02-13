<?php

namespace common\models;

use common\models\traits\Template;
use Yii;
use \common\models\base\Load as BaseLoad;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load".
 */
class Load extends BaseLoad
{
    use Template;

    const PENDING = 'Pending';
    const IN_PROGRESS = 'in_Progress';
    const COMPLETED = 'Completed';
    const CANCELLED = 'Cancelled';

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
}
