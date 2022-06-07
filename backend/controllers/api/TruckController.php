<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "TruckController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class TruckController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Truck';
}
