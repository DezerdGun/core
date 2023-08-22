<?php

namespace api\khalsa\services\listing\ordinary;

use api\components\HttpException;
use api\forms\listing\ordinary\ListingOrdinaryForm;
use api\forms\listing\ordinary\UpdateStatusForm;
use common\enums\ListingStatus;
use common\models\ListingOrdinary;
use api\khalsa\repositories\listing\ordinary\OrdinaryRepository;
use common\models\OrdinaryEquipment;
use common\models\search\SearchListingOrdinary;
use Yii;

class OrdinaryService
{
    public $ordinaryRepository;

    public function __construct(OrdinaryRepository $ordinaryRepository)
    {
        $this->ordinaryRepository = $ordinaryRepository;
    }

    public function index()
    {
        $searchListingOrdinary = new SearchListingOrdinary();
        $searchListingOrdinary->load(Yii::$app->request->queryParams);

        if ($searchListingOrdinary->validate()) {
            $query = $searchListingOrdinary->search();
        } else {
            throw new HttpException(400, ['SearchListingOrdinary' => $searchListingOrdinary->getErrors()]);
        }
        return $query;
    }

    public function create()
    {
        $form = new ListingOrdinaryForm();
        $model = new ListingOrdinary();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            $model->origin_id = $form->origin_id;
            $model->destination_id = $form->destination_id;
            $model->pick_up = $form->pick_up;
            $model->user_id = Yii::$app->user->id;
            $model->status = ListingStatus::ACTIVE;
            $this->ordinaryRepository->create($model);

            // Привести equipment_code и id  вид [1, "v"] потому что barchInsert так требовает
            $i = 0;
            $data = [];
            foreach (array_unique($form->equipment_code) as $value) { // array_unique использовано потому что фронт может отправить несколько одинаковых equipment_code
                $data[$i++] = [$model->id, $value];
            }
            //Несколько записей в базу одним запросом
            Yii::$app->db->createCommand()->batchInsert(
                OrdinaryEquipment::tableName(),
                ['listing_ordinary_id', 'equipment_code'],
                $data
            )->execute();

        } else {
            throw new HttpException(400, [$form->formName() => $form->getErrors()]);
        }
        return $model;
    }

    public function updateStatus()
    {
        $form = new UpdateStatusForm();

        if ($form->load(\Yii::$app->request->post()) && $form->validate()) {
            $this->ordinaryRepository->updateStatus($form);
        } else {
            throw new HttpException(400, [$form->formName() => $form->getErrors()]);
        }
    }

    public function update($id)
    {
        $model = $this->ordinaryRepository->getById($id);
        $model->setAttributes(\Yii::$app->request->post());
        if ($model->validate()) {
            $this->ordinaryRepository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }
}
