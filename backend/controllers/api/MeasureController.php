<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "MeasureController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class MeasureController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Measure';
}
