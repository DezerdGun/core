<?php

namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * @OA\Info(title="My TMP", version="0.1")
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="basic",
 *     securityScheme="httpBasic"
 * )
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     securityScheme="main",
 *     @OA\Flow(
 *         flow="password",
 *         tokenUrl="/oauth2/token",
 *         refreshUrl="/oauth2/refresh",
 *         scopes={
 *         }
 *     )
 * )
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     securityScheme="ClientCredentials",
 *     @OA\Flow(
 *         flow="clientCredentials",
 *         tokenUrl="/oauth2/token",
 *         refreshUrl="/oauth2/refresh",
 *         scopes={
 *         }
 *     )
 * )
 */

class SwaggerController extends Controller
{
    public $modelClass = 'common/models/User';

    public function actionDoc()
    {
        $directories = [
            Yii::getAlias('@api/controllers'),
            Yii::getAlias('@api/forms'),
            Yii::getAlias('@api/templates'),
        ];
        $openApi = \OpenApi\Generator::scan($directories);
        Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        Yii::$app->getResponse()->content = $openApi->toJson();
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

}
