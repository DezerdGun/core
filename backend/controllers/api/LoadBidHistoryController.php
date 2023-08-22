<?php

namespace backend\controllers\api;

/**
* This is the class for REST controller "LoadBidHistoryController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class LoadBidHistoryController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\LoadNote';
}
