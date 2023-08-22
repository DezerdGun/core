<?php

namespace common\models;

use common\behaviors\UploadBehavior;
use \common\models\base\Carrier as BaseCarrier;
use common\models\traits\Template;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "carrier".
 */
/**
 * @OA\Schema(
 *     schema="Carrier",
 *     required={"user_id","created_at","updated_at"},
 *    @OA\Property(
 *       property="id",
 *       description="",
 *       type="integer",
 *       format="int64",
 *   ),
 *    @OA\Property(
 *       property="user_id",
 *       description="",
 *       type="integer",
 *       format="int64",
 *   ),
 *    @OA\Property(
 *       property="w9_file",
 *       description="",
 *       type="string",
 *       maxLength=55,
 *   ),
 *    @OA\Property(
 *       property="w9_mime_type",
 *       description="",
 *       type="string",
 *       maxLength=32,
 *   ),
 *    @OA\Property(
 *       property="ic_file",
 *       description="",
 *       type="string",
 *       maxLength=55,
 *   ),
 *    @OA\Property(
 *       property="ic_mime_type",
 *       description="",
 *       type="string",
 *       maxLength=32,
 *   ),
 *    @OA\Property(
 *       property="company_id",
 *       description="",
 *       type="integer",
 *       format="int64",
 *   ),
 *    @OA\Property(
 *       property="scac",
 *       description="",
 *       type="string",
 *       maxLength=10,
 *   ),
 *    @OA\Property(
 *       property="instagram",
 *       description="",
 *       type="string",
 *       maxLength=100,
 *   ),
 *    @OA\Property(
 *       property="facebook",
 *       description="",
 *       type="string",
 *       maxLength=100,
 *   ),
 *    @OA\Property(
 *       property="linkedin",
 *       description="",
 *       type="string",
 *       maxLength=100,
 *   ),
 *    @OA\Property(
 *       property="w9_name",
 *       description="",
 *       type="string",
 *       maxLength=100,
 *   ),
 *    @OA\Property(
 *       property="ic_name",
 *       description="",
 *       type="string",
 *       maxLength=100,
 *   ),
 * )
 */
class Carrier extends BaseCarrier
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const SCENARIO_INSERT = 'insert';
    const SCENARIO_UPDATE_W9 = 'update_w9';
    const SCENARIO_UPDATE_IC = 'update_ic';

    use Template;

    public function behaviors(): array
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'w9' => [
                    'class' => UploadBehavior::class,
                    'attribute' => 'w9_file',
                    'scenarios' => [self::SCENARIO_INSERT, self::SCENARIO_UPDATE_W9],
                    'path' => '@cdn-webroot',
                    'url' => '@cdn-webroot',
                    'fileInfoAttributes' => [
                        'mimeType' => 'w9_mime_type',
                        'fileName' => 'w9_name'
                    ],
                    'generateNewName' => false
                ],
                'ic' => [
                    'class' => UploadBehavior::class,
                    'attribute' => 'ic_file',
                    'scenarios' => [self::SCENARIO_INSERT, self::SCENARIO_UPDATE_IC],
                    'path' => '@cdn-webroot',
                    'url' => '@cdn-webroot',
                    'fileInfoAttributes' => [
                        'mimeType' => 'ic_mime_type',
                        'fileName' => 'ic_name'
                    ],
                    'generateNewName' => false
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
                    'on' => [self::SCENARIO_INSERT, self::SCENARIO_UPDATE_W9],
                    'skipOnEmpty' => false,
                    'extensions' => 'jpeg, png, pdf, jpg'
                ],
                [
                    'ic_file',
                    'file',
                    'on' => [self::SCENARIO_INSERT, self::SCENARIO_UPDATE_IC],
                    'skipOnEmpty' => false,
                    'extensions' => 'jpeg, png, pdf, jpg'
                ]
            ]
        );
    }
}
