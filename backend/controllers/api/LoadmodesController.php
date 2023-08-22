<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "LoadmodesController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class LoadmodesController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\load_modes';
}
