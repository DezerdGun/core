<?php

namespace api\templates\loaddocuments;

use common\models\Load;
use common\models\LoadDocumentType;
use common\models\User;
use TRS\RestResponse\templates\BaseTemplate;

/**
 *
 * @OA\Schema(
 *     schema="LoadDocumentsLarge",
 *     @OA\Property(
 *         property="id",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="load_id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="path",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="mime_type",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="route_type",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="doc_type",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="upload_by",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string"
 *     ),
 *
 * )
 */
class Large extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var \common\models\LoadDocuments $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'filename' => $model->filename,
            'mime_type'=>$model->mime_type,
            'created_at'=>$model->created_at,
            'load_id' => [Load::find()->one()],
            'doc_type' => [LoadDocumentType::find()->one()],
        ];
    }
}
