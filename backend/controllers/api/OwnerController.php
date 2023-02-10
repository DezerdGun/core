<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "OwnerController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class OwnerController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Owner';
}
