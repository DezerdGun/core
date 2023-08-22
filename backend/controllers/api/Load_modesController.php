<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "Load_modesController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class Load_modesController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\load_modes';
}
