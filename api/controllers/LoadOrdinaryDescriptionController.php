<?php

namespace api\controllers;

use api\components\HttpException;
use api\khalsa\services\LoadOrdinaryDescriptionService;
use api\templates\load_ordinary_description\Large;
use common\models\LoadOrdinaryDescription;
use common\models\LoadOrdinaryDescriptionRows;
use OpenApi\Annotations as OA;
use yii\base\InvalidConfigException;
use yii\db\Exception;

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
     *          encoding={
     *             "From[pallets][]": {
     *                 "explode": true
     *             },
     *          "From[commodity][]": {
     *                 "explode": true
     *             },
     *         "From[description][]": {
     *                 "explode": true
     *             },
     *          "From[description][]": {
     *                 "explode": true
     *             },
     *          "From[pieces][]": {
     *                 "explode": true
     *             },
     *          "From[weight_KGs][]": {
     *                 "explode": true
     *             },
     *          "From[weight_LBs][]": {
     *                 "explode": true
     *             },
     *         },
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="Load[load_id]",
     *                     type="integer",
     *                     example="1",
     *                     description="1"
     *                 ),
     *                   @OA\Property (
     *                     property="From[pallets][]",
     *                      type="array",
     *                      @OA\Items(
     *                           type="integer",
     *                           example="12",
     *                      )
     *                  ),
     *                   @OA\Property (
     *                      property="From[commodity][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="string",
     *                          example="Fruits",
     *                      )
     *                  ),
     *                   @OA\Property (
     *                       property="From[description][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="string",
     *                          example="Apples, Peaches, Bananas",
     *                      )
     *                  ),
     *                 @OA\Property (
     *                      property="From[pieces][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer",
     *                          example="3",
     *                      )
     *                  ),
     *                 @OA\Property (
     *                      property="From[weight_KGs][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer",
     *                          example="3.33",
     *                      )
     *                  ),
     *                 @OA\Property (
     *                       property="From[weight_LBs][]",
     *                      type="array",
     *                      @OA\Items(
     *                          type="integer",
     *                          example="9",
     *                      )
     *                  ),
     *                  @OA\Property (
     *                      property="Load[pallets]",
     *                      type="integer",
     *                      example="28",
     *                      description="(number) => overall Pallets"
     *                  ),
     *                  @OA\Property(
     *                     property="Load[pallet_size]",
     *                     type="integer",
     *                     enum={"48x40","42x42","48x48"}
     *                 ),
     *                  @OA\Property (
     *                       property="Load[weight_LBs]",
     *                       type="integer",
     *                       example="24",
     *                      description="Total weight (LBs) => overall weight (LBs)"
     *                  ),
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
     * @throws Exception
     */
    public function actionCreate(): array
    {
        $model =  $this->loadOrdinaryDescription->create();
        return $this->success($model->getAsArray(Large::class));
    }
}