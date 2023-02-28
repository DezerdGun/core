<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\forms\listing\ordinary\LoadOrdinaryDescriptionFrom;
use api\khalsa\interfaces\ServiceInterface;
use api\khalsa\repositories\LoadOrdinaryDescriptionRepository;
use common\models\LoadOrdinaryDescription;
use common\models\LoadOrdinaryDescriptionRows;
use yii\base\InvalidConfigException;
use yii\db\Exception;

class LoadOrdinaryDescriptionService implements ServiceInterface
{
    public $loadOrdinaryDescriptionRepository;
    public $loadOrdinaryDescriptionRows;

    public function __construct(
        LoadOrdinaryDescriptionRepository $loadOrdinaryDescriptionRepository,
        LoadOrdinaryDescriptionRows $loadOrdinaryDescriptionRows)
    {
        $this->loadOrdinaryDescriptionRepository = $loadOrdinaryDescriptionRepository;
        $this->loadOrdinaryDescriptionRows = $loadOrdinaryDescriptionRows;
    }

    /**
     * @throws InvalidConfigException
     * @throws HttpException|Exception
     */
    public function create(): LoadOrdinaryDescription
    {
        $model = new LoadOrdinaryDescription();
        $form = new LoadOrdinaryDescriptionRows();
        if ($model->load(\Yii::$app->request->post(),'Load')  && $model->validate() ) {
            $model->save();
            if ($form->load(\Yii::$app->request->post(),'From') && $model->validate() ){
                $form->load_ordinary_description_id = $model->id;
                $rows = [];
                for ($i = 0; $i < count($form->commodity); $i++) {
                    $rows[] = [
                        $form->load_ordinary_description_id,
                        $form->commodity[$i],
                        $form->description[$i],
                        $form->pieces[$i],
                        $form->pallets[$i],
                        $form->weight_KGs[$i],
                        $form->weight_LBs[$i],
                    ];
                }
                \Yii::$app->db->createCommand()->batchInsert(LoadOrdinaryDescriptionRows::tableName(),
                    ['load_ordinary_description_id','commodity'
                        ,'description',
                        'pieces','pallets','weight_KGs','weight_LBs'], $rows)->execute();

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

    public function update($id)
    {
        // TODO: Implement update() method.
    }
}