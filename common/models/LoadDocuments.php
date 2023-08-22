<?php

namespace common\models;

use common\behaviors\UploadBehavior;
use common\models\traits\Template;
use Yii;
use \common\models\base\LoadDocuments as BaseLoadDocuments;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "load_documents".
 */
class LoadDocuments extends BaseLoadDocuments
{
    use Template;
    const SCENARIO_INSERT = 'insert';

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'filename' => [
                    'class' => UploadBehavior::class,
                    'attribute' => 'filename',
                    'scenarios' => [self::SCENARIO_INSERT],
                    'path' => '@cdn-webroot/load-documents',
                    'url' => '@cdn-webroot/load-documents',
                    'fileInfoAttributes' => [
                        'mimeType' => 'mime_type'
                    ]
                ],
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                [
                    'filename',
                    'file',
                    'on' => [self::SCENARIO_INSERT],
                    'skipOnEmpty' => false,
                    'extensions' => 'jpeg, png, pdf, jpg'
                ],
            ]
        );
    }

}
