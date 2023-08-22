<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "TruckTypesController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class TruckTypesController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\TruckTypes';
}
