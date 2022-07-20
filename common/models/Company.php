<?php

namespace common\models;

use common\behaviors\UploadBehavior;
use Yii;
use \common\models\base\Company as BaseCompany;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company".
 */
class Company extends BaseCompany
{
    const SCENARIO_INSERT = 'insert';

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'w9' => [
                    'class' => UploadBehavior::class,
                    'attribute' => 'w9_file',
                    'scenarios' => [self::SCENARIO_INSERT],
                    'path' => '@cdn-webroot',
                    'url' => '@cdn-webroot',
                    'fileInfoAttributes' => [
                        'mimeType' => 'w9_mime_type'
                    ]
                ],
                'ic' => [
                    'class' => UploadBehavior::class,
                    'attribute' => 'ic_file',
                    'scenarios' => [self::SCENARIO_INSERT],
                    'path' => '@cdn-webroot',
                    'url' => '@cdn-webroot',
                    'fileInfoAttributes' => [
                        'mimeType' => 'ic_mime_type'
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
                    'w9_file',
                    'file',
                    'on' => [self::SCENARIO_INSERT],
                    'skipOnEmpty' => false,
                    'extensions' => 'jpeg, png, pdf, jpg'
                ],
                [
                    'ic_file',
                    'file',
                    'on' => [self::SCENARIO_INSERT],
                    'skipOnEmpty' => false,
                    'extensions' => 'jpeg, png, pdf, jpg'
                ]
            ]
        );
    }
}
