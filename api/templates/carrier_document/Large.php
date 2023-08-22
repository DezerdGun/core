<?php
namespace api\templates\carrier_document;

use common\models\Carrier;
use Yii;

/**
 * @OA\Schema (
 *      schema="CarrierDocumentLarge",
 *     @OA\Property (
 *          property="w9_file",
 *          type="string"
 *     ),
 *     @OA\Property (
 *          property="w9_name",
 *          type="string"
 *     ),
 *     @OA\Property (
 *          property="ic_file",
 *          type="string"
 *     ),
 *     @OA\Property (
 *          property="ic_name",
 *          type="string"
 *     )
 * )
 */
class Large extends \TRS\RestResponse\templates\BaseTemplate
{

    protected function prepareResult()
    {
        /** @var Carrier $model */
        $model = $this->model;
        $this->result = [
            'w9_file' => ($model->w9_file) ? Yii::$app->params['CDN_URL'] . $model->w9_file : null,
            'w9_name' => $model->w9_name,
            'ic_file' => ($model->ic_file) ? Yii::$app->params['CDN_URL'] . $model->ic_file : null,
            'ic_name' => $model->ic_name
        ];
    }
}
