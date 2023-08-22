<?php

namespace common\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use common\enums\I18nCategory;

abstract class BaseController extends Controller
{
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => $this->accessRules(),
                ],
            ]
        );
    }

    /*public function beforeAction($action)
    {
        if (!$this->isHasAllRequiredAttributes()) {
            throw new BadRequestHttpException(Yii::t('error', 'wrong-params-set'));
        }

        return parent::beforeAction($action);
    }*/

    protected function accessRules()
    {
        return [
            ['allow' => true, 'roles' => ['@']],
        ];
    }
}
