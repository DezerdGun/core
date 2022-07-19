<?php

namespace api\controllers;


use api\components\HttpException;
use common\models\Company;

class CompanyController extends BaseController
{
    /**
     * @OA\Post(
     *     path="/company",
     *     tags={"company"},
     *     operationId="company",
     *     summary="createCompany",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="Company[company_name]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Company[street_address]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Company[city]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Company[state]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Company[zip_code]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Company[country]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Company[business_phone]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Company[w9_file]",
     *                     type="string",
     *                     format="binary"
     *                 ),
     *                 @OA\Property(
     *                     property="Company[ic_file]",
     *                     type="string",
     *                     format="binary"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionCreate()
    {
       $model = new Company();
        $model->setScenario(Company::SCENARIO_INSERT);
       if ($model->load($this->getAllowedPost()) && $model->validate()) {
           $this->saveModel($model);
       } else {
           throw new HttpException(400, [$model->formName() => $model->getErrors()]);
       }
       return $this->success();
    }
}
