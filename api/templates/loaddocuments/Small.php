<?php

namespace api\templates\loaddocuments;

use common\models\LoadDocuments;
use TRS\RestResponse\templates\BaseTemplate;
use Yii;
use yii\base\InvalidConfigException;


/**
 *
 * @OA\Schema(
 *     schema="LoadDocumentsSmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="doc_type",
 *         type="integer",
 *     ),
 *      @OA\Property(
 *         property="updated_by",
 *         type="string",
 *         example="2021-11-18T11:15:47Z"
 *     ),
 * )
 */



class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var LoadDocuments $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'filename' => $model->filename,
            'mime_type' => $model->mime_type,
            'doc_type' => $model->docType->name,
            'By' => $model->uploadBy->role

        ];
    }
}
