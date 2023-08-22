<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "LoadController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class LoadController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Load';
}
