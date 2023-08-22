<?php

namespace api\controllers;

use api\components\HttpException;
use api\templates\loaddocuments\Large;
use api\templates\loaddocuments\Small;
use common\models\LoadDocuments;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

class LoadDocumentController extends BaseController
{

    /**
     * @OA\PATCH (
     *     path="/load-document/{id}",
     *     tags={"load-documents"},
     *     operationId="patchLoadDocument",
     *     summary="patchDocuments",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *          type="string"
     *          )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      property="LoadDoc[doc_type]",
     *                      type="integer",
     *                  ),
     *            )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successfull operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="doc_type",
     *                  type="string",
     *                  example="success"
     *              ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/LoadDocumentsLarge"
     *             )
     *          )
     *      ),
     *      security={
     *          {"main":{}},
     *          {"ClientCredentials":{}}
     *      }
     *  )
     * @throws HttpException
     */

    public function actionUpdate($id): array
    {
        $condition = ['id' => $id];
        $model = LoadDocuments::findOne($condition);
        if ($condition){
            $model->load(\Yii::$app->getRequest()->post(), 'LoadDoc') && $model->validate();
            if (!$model->validate()){
                throw new HttpException(400, \Yii::t('app', 'Something has gonna wrong!'));
            }
            $model->save();
        }
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Get(
     *     path="/load-document/{id}",
     *     tags={"load-documents"},
     *     operationId="getLoadDocument",
     *     summary="getLoadDocuments",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true
     *     ),
     *       @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 type="string",
     *                 example="success"
     *             ),
     *              @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/LoadDocumentsLarge"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     * @throws HttpException
     */

    public function actionGetDocuments($id): array
    {
        $model = $this->findModelDoc($id);
        return $this->success($model->getAsArray(Large::class));
    }

    /**
     * @OA\Post(
     *     path="/load-document",
     *     tags={"load-documents"},
     *     operationId="createLoadDocument",
     *     summary="createLoadDocument",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *          @OA\Property(
     *              property="LoadDocuments[load_id]",
     *              type="integer",
     *              ),
     *           @OA\Property(
     *               property="LoadDocuments[filename]",
     *               type="string",
     *               format="binary"
     *                 ),
     *          @OA\Property(
     *              property="LoadDocuments[doc_type]",
     *              type="integer",
     *              ),
     *            )
     *         )
     *     ),
     *       @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="load_id",
     *                 type="string",
     *                 example="success"
     *             ),
     *              @OA\Property(
     *                 property="filename",
     *                 type="string",
     *                 example="success"
     *             ),
     *              @OA\Property(
     *                 property="doc_type",
     *                 type="string",
     *                 example="success"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/LoadDocumentsLarge"
     *             )
     *         )
     *     ),
     *     security={
     *      {"main":{}},
     *     {"ClientCredentials":{}}
     *     }
     * )
     * @throws HttpException
     * @throws InvalidConfigException
     */

    public function actionCreateUploadDocument(): array
    {
        $model = new LoadDocuments();
        $model->upload_by = \Yii::$app->user->id;
        $model->setScenario(LoadDocuments::SCENARIO_INSERT);
        if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->success($model->getAsArray(Small::class));
        } else {
            throw new HttpException(400,
                [$model->formName() => $model->getErrors()]);
        }
    }

    /**
     * @OA\Delete(
     *     path="/load-document/{id}",
     *     tags={"load-documents"},
     *     operationId="deleteLoadDocument",
     *     summary="deleteLoadDocument",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successfull operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 type="integer",
     *                 example="success"
     *             ),
     *              @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 ref="#/components/schemas/LoadDocumentsLarge"
     *             )
     *         )
     *     ),
     *     security={
     *         {"main":{}},
     *      {"ClientCredentials":{}}
     *     }
     * )
     * @throws HttpException
     * @throws StaleObjectException
     */

    public function actionDeleteDocument($id): array
    {
        $docdel = $this->findModelDoc($id);
        $docdel->delete();
        return $this->success();
    }

    /**
     * @throws HttpException
     */
    private function findModelDoc($id): LoadDocuments
    {
        $condition = ['id' => $id];
        $model = LoadDocuments::findOne($condition);
        if (!$model) {
            throw new HttpException(404, \Yii::t('app', 'ID не найден!'));
        }
        return $model;

    }


}