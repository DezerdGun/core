<?php

namespace api\controllers;


use api\components\HttpException;
use common\models\Address;
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
     *                     property="Address[street_address]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Address[city]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Address[state_code]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Address[zip]",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="Address[country]",
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
     *                 @OA\Property(
     *                     property="Company[is_customer]",
     *                     type="boolean",
     *                      format="binary"
     *                 ),
     *                  @OA\Property(
     *                     property="Company[is_port]",
     *                     type="boolean",
     *                      format="binary"
     *                 ),
     *                   @OA\Property(
     *                     property="Company[is_consignee]",
     *                     type="boolean",
     *                      format="binary"
     *                 ),
     *                    @OA\Property(
     *                     property="Company[is_chassis]",
     *                     type="boolean",
     *                      format="binary"
     *                 ),
     *             )
     *         )
     *     ),
     *       @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="status",
     *                 type="string",
     *                 example="success"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/CompanySmall"
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

        $model = new Address();
        if ($model->load($this->getAllowedPost()) && $model->validate()) {
            $model->save();
            if ($model->save()) {
                $detail = new Company();
                $detail->address_id = $model->id;
                $detail->setScenario(Company::SCENARIO_INSERT);
                if ($detail->load($this->getAllowedPost()) && $detail->validate()) {
                    $this->saveModel($detail);
                } else {
                    throw new HttpException(400, [$detail->formName() => $detail->getErrors()]);
                }
                return $this->success();

            }
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }

}
