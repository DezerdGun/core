<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\LoadOrdinaryDescriptionService;
use api\templates\load_ordinary_description\Large;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;

class LoadOrdinaryDescriptionController extends BaseController
{
    public $loadOrdinaryDescription;
    public function __construct($id,$module,$config = [],LoadOrdinaryDescriptionService $loadOrdinaryDescription)
    {
        parent::__construct($id, $module, $config);
        $this->loadOrdinaryDescription = $loadOrdinaryDescription;
    }

    /**
     * @OA\Post(
     *     path="/load-ordinary-description",
     *     tags={"ordinary-load"},
     *     operationId="createLoadOrdinaryDescription",
     *     summary="createLoadOrdinaryDescription",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="load_id",
     *                     type="integer",
     *                     example="1",
     *                     description="1"
     *                 ),
     *                  @OA\Property(
     *                     property="commodity",
     *                     type="string",
     *                     example="Fruits",
     *                     description="Fruits"
     *                 ),
     *                  @OA\Property (
     *                      property="description",
     *                      type="array",
     *                      @OA\Items(
     *                          type="string"
     *                      )
     *                  ),
     *                  @OA\Property(
     *                     property="pieces",
     *                     type="integer",
     *                     example="3",
     *                     description="3"
     *                 ),
     *                  @OA\Property(
     *                     property="pallets",
     *                     type="integer",
     *                     example="12",
     *                     description="12"
     *                 ),
     *                  @OA\Property(
     *                     property="weight_KGs",
     *                     type="integer",
     *                     example="52.123",
     *                     description="52.123"
     *                 ),
     *                  @OA\Property(
     *                     property="weight_LBs",
     *                     type="integer",
     *                     example="9.000",
     *                     description="9.000"
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
     *                 ref="#/components/schemas/LoadOrdinaryDescriptionLarge"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function actionCreate(): array
    {
       $model =  $this->loadOrdinaryDescription->create();
        return $this->success($model->getAsArray(Large::class));
    }
}