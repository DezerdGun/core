<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "ContainerController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class ContainerController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Container';
}
