<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "EquipmentController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class EquipmentController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Equipment';
}
