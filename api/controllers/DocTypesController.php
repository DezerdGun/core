<?php

namespace api\controllers;

use common\models\LoadDocumentTypes;

class DocTypesController extends BaseController
{
    /**
     * @OA\Get(
     *     path="/lists/load-doc-types",
     *     tags={"lists"},
     *     operationId="getDocTypes",
     *     summary="getDocTypes",
     *     @OA\Response(
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
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer"
     *                     ),
     *                     @OA\Property(
     *                         property="Name",
     *                         type="string"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     */
    public function actionIndex()
    {
        $equipment = LoadDocumentTypes::find()->all();
        return $this->success($equipment);
    }
}