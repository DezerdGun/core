<?php

namespace app\models;

use Yii;
use \app\models\base\LoadDocumentTypes as BaseLoadDocumentTypes;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_document_type".
 */
class LoadDocumentTypes extends BaseLoadDocumentTypes
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
