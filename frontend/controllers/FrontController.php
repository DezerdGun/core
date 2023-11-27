<?php

namespace frontend\controllers;

use yii\web\Controller;

class FrontController extends Controller
{
  public function actionIndex()
  {
      return $this->render('index'); 
  }
}