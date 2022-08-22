<?php

namespace api\templates\company;

use common\models\Company;
use TRS\RestResponse\templates\BaseTemplate;


/**
 *
 * @OA\Schema(
 *     schema="CompanySmall",
 *     @OA\Property(
 *         property="id",
 *         type="integer"
 *     ),
 *      @OA\Property(
 *         property="company_name",
 *         type="string"
 *     ),
 *      @OA\Property(
 *         property="w9_file",
 *         type="file"
 *     ),
 *      @OA\Property(
 *         property="ic_file",
 *         type="file"
 *     ),
 * )
 */
class Small extends BaseTemplate
{
    protected function prepareResult()
    {
        /** @var Company $model */
        $model = $this->model;
        $this->result = [
            'id' => $model->id,
            'company_name' => $model->company_name,
            'business_phone' => $model->business_phone,
            'w9_file' => $model->w9_file,
            'ic_file' => $model->ic_file,
        ];
    }
}
