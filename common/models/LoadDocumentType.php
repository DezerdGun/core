<?php

namespace common\models;

use Yii;
use \common\models\base\LoadDocumentType as BaseLoadDocumentType;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_document_type".
 */
class LoadDocumentType extends BaseLoadDocumentType
{

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
