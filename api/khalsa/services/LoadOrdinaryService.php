<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LoadOrdinaryRepository;
use common\enums\LoadStatus;
use common\models\OrdinaryLoad;
use common\models\OrdinaryNeeded;
use yii\base\InvalidConfigException;
use yii\db\Exception;

class LoadOrdinaryService implements ServiceInterface
{
    public $LoadOrdinaryRepository;

    public function __construct(

        LoadOrdinaryRepository $LoadOrdinaryRepository)
    {

        $this->LoadOrdinaryRepository = $LoadOrdinaryRepository;
    }

    /**
     * @throws Exception
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function create(): OrdinaryLoad
    {
        $model = new OrdinaryLoad();
        $model->load_reference_number = rand(1000000,9999999);
        $model->user_id = \Yii::$app->user->id;
        $model->status =  LoadStatus::PENDING;
        $model->load(\Yii::$app->request->post(),'OrdinaryLoad');
        $form = new OrdinaryNeeded();
        if ($model->validate()) {
            $model->save();
            $model->load_reference_number($model);
            $form->load(\Yii::$app->request->post(),'OrdinaryNeeded');
            if ($model->validate()){
                $rows = [];
                for ($i = 0; $i < count($form->ordinary_need); $i++) {
                    $rows[] = [
                        $form->equipment_needed_id = $model->id,
                        $form->ordinary_need[$i],
                    ];
                }
                \Yii::$app->db->createCommand()->batchInsert(OrdinaryNeeded::tableName(),
                    ['equipment_needed_id','ordinary_need'], $rows)->execute();
                $model->hold($model);
            }else{
                throw new HttpException(400, [$form->formName() => $form->getErrors()]);
            }
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $model;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException
     */
    public function update($id)
    {
        $model = $this->LoadOrdinaryRepository->getById($id);
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $this->LoadOrdinaryRepository->update($model);
        } else throw new HttpException(400, [$model->formName() => $model->getErrors()]);
    }
}