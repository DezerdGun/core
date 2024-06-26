<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace backend\controllers\base;

use common\models\Equipment;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;

/**
* EquipmentController implements the CRUD actions for Equipment model.
*/
class EquipmentController extends Controller
{


/**
* @var boolean whether to enable CSRF validation for the actions in this controller.
* CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
*/
public $enableCsrfValidation = false;


/**
* Lists all Equipment models.
* @return mixed
*/
public function actionIndex()
{
    $dataProvider = new \yii\data\ActiveDataProvider([
    'query' => Equipment::find(),
    ]);

Tabs::clearLocalStorage();

Url::remember();
\Yii::$app->session['__crudReturnUrl'] = null;

return $this->render('index', [
'dataProvider' => $dataProvider,
]);
}

/**
* Displays a single Equipment model.
* @param string $code
	 * @param string $name
*
* @return mixed
*/
public function actionView($code, $name)
{
\Yii::$app->session['__crudReturnUrl'] = Url::previous();
Url::remember();
Tabs::rememberActiveState();

return $this->render('view', [
'model' => $this->findModel($code, $name),
]);
}

/**
* Creates a new Equipment model.
* If creation is successful, the browser will be redirected to the 'view' page.
* @return mixed
*/
public function actionCreate()
{
$model = new Equipment;

try {
if ($model->load($_POST) && $model->save()) {
return $this->redirect(['view', 'code' => $model->code, 'name' => $model->name]);
} elseif (!\Yii::$app->request->isPost) {
$model->load($_GET);
}
} catch (\Exception $e) {
$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
$model->addError('_exception', $msg);
}
return $this->render('create', ['model' => $model]);
}

/**
* Updates an existing Equipment model.
* If update is successful, the browser will be redirected to the 'view' page.
* @param string $code
	 * @param string $name
* @return mixed
*/
public function actionUpdate($code, $name)
{
$model = $this->findModel($code, $name);

if ($model->load($_POST) && $model->save()) {
return $this->redirect(Url::previous());
} else {
return $this->render('update', [
'model' => $model,
]);
}
}

/**
* Deletes an existing Equipment model.
* If deletion is successful, the browser will be redirected to the 'index' page.
* @param string $code
	 * @param string $name
* @return mixed
*/
public function actionDelete($code, $name)
{
try {
$this->findModel($code, $name)->delete();
} catch (\Exception $e) {
$msg = (isset($e->errorInfo[2]))?$e->errorInfo[2]:$e->getMessage();
\Yii::$app->getSession()->addFlash('error', $msg);
return $this->redirect(Url::previous());
}

// TODO: improve detection
$isPivot = strstr('$code, $name',',');
if ($isPivot == true) {
return $this->redirect(Url::previous());
} elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') {
Url::remember(null);
$url = \Yii::$app->session['__crudReturnUrl'];
\Yii::$app->session['__crudReturnUrl'] = null;

return $this->redirect($url);
} else {
return $this->redirect(['index']);
}
}

/**
* Finds the Equipment model based on its primary key value.
* If the model is not found, a 404 HTTP exception will be thrown.
* @param string $code
	 * @param string $name
* @return Equipment the loaded model
* @throws HttpException if the model cannot be found
*/
protected function findModel($code, $name)
{
if (($model = Equipment::findOne(['code' => $code, 'name' => $name])) !== null) {
return $model;
} else {
throw new HttpException(404, 'The requested page does not exist.');
}
}
}
