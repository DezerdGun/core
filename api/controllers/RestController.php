<?php

namespace api\controllers;

use api\templates\me\Small;
use common\models\User;
use filsh\yii2\oauth2server\models\OauthRefreshTokens;
use filsh\yii2\oauth2server\Module;
use filsh\yii2\oauth2server\Request;
use OAuth2\ResponseInterface;
use OpenApi\Annotations as OA;
use TRS\RestResponse\templates\BaseTemplate;
use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * @OA\Post(
 *     path="/oauth2/revoke",
 *     tags={"oauth2"},
 *     operationId="revokeToken",
 *     summary="revokeToken",
 *     @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *     @OA\Property(
 *     property="token",
 *     type="string"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="successfull operation"
 *     ),
 *     security={
 *         {"main":{}},
 *      {"ClientCredentials":{}}
 *     }
 * )
 *
 * @OA\Post(
 *     path="/oauth2/token",
 *     tags={"oauth2"},
 *     operationId="getTokens",
 *     summary="getTokens",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="grant_type",
 *                 type="string",
 *                 example="password"
 *             ),
 *             @OA\Property(
 *                 property="username",
 *                 type="string"
 *             ),
 *             @OA\Property(
 *                 property="password",
 *                 type="string"
 *             ),
 *             @OA\Property(
 *                 property="client_id",
 *                 type="string"
 *             ),
 *             @OA\Property(
 *                 property="client_secret",
 *                 type="string"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="successfull operation",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="access_token",
 *                 type="string"
 *             ),
 *             @OA\Property(
 *                 property="expires_in",
 *                 type="integer",
 *                 example=86400
 *             ),
 *             @OA\Property(
 *                 property="token_type",
 *                 type="string",
 *                 example="bearer"
 *             ),
 *             @OA\Property(
 *                 property="scope",
 *                 type="string",
 *                 example=""
 *             ),
 *             @OA\Property(
 *                 property="refresh_token",
 *                 type="string"
 *             )
 *         )
 *     ),
 *     security={
 *         {"main":{}},
 *      {"ClientCredentials":{}}
 *     }
 * )
 * @OA\Post(
 *     path="/oauth2/refresh",
 *     tags={"oauth2"},
 *     operationId="refreshAccessToken",
 *     summary="refreshAccessToken",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="grant_type",
 *                 type="string",
 *                 example="refresh_token"
 *             ),
 *             @OA\Property(
 *                 property="refresh_token",
 *                 type="string"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="successfull operation",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="access_token",
 *                 type="string"
 *             ),
 *             @OA\Property(
 *                 property="expires_in",
 *                 type="integer",
 *                 example=86400
 *             ),
 *             @OA\Property(
 *                 property="token_type",
 *                 type="string",
 *                 example="bearer"
 *             ),
 *             @OA\Property(
 *                 property="scope",
 *                 type="string",
 *                 example=""
 *             )
 *         )
 *     ),
 *     security={
 *         {"httpBasic":{}},
 *      {"ClientCredentials":{}}
 *     }
 * )
 */
class RestController extends Controller
{
    public function actionRefresh()
    {
        return $this->actionToken();
    }

    public function actionToken()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('oauth2');
        $request = Request::createFromGlobals();
        /** @var ResponseInterface $response */
        $response = $module->getServer()->handleTokenRequest($request);
        Yii::$app->end(0, $response);
    }

    public function actionRevoke()
    {
        /** @var Module $module */
        $module = Yii::$app->getModule('oauth2');
        $response = $module->getServer()->handleRevokeRequest();
        return $response->getParameters();
    }
}


