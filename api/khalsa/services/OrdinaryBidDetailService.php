<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\OrdinaryBidDetailRepository;
use common\enums\BidEditCount;
use common\models\OrdinaryBidDetail;
use Yii;
use yii\db\Exception;

class OrdinaryBidDetailService
{
    public $repository;
    public function __construct
    (
        OrdinaryBidDetailRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create()
    {
        $model = new OrdinaryBidDetail();
        $model->setScenario(OrdinaryBidDetail::SCENARIO_CREATE);

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->ordinaryBid->edit_counting <= BidEditCount::TWO) {
                $rows = [];
                for ($i = 0; $i < count($model->charge_id); $i++) {
                    $rows[] = [$model->ordinary_bid_id, $model->charge_id[$i], $model->measure_id[$i], $model->price[$i], $model->free_unit[$i]];
                }

                $this->repository->create($rows);
            } else {
                throw new HttpException(400, "You can change only 2 times.");
            }
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }


    /**
     * @throws Exception
     * @throws HttpException
     */
    public function update($id)
    {
        $model = new OrdinaryBidDetail();
        $ids = explode(',', $id);
        $ordinaryBidDetail = $this->repository->getById($ids[0]);
        $model->ordinary_bid_id = $ordinaryBidDetail->ordinary_bid_id;
        $model->scenario = OrdinaryBidDetail::SCENARIO_VALIDATE_ARRAY;
        if ($ordinaryBidDetail->ordinaryBid->edit_counting <= BidEditCount::TWO) {
            $model->load(Yii::$app->request->post());

            $transaction = Yii::$app->db->beginTransaction();
            for ($i = 0; $i < count($ids); $i++) {
                $bid_detail = $this->repository->getById($ids[$i]);
                $bid_detail->setScenario(OrdinaryBidDetail::SCENARIO_UPDATE);
                $bid_detail->charge_id = $model->charge_id[$i];
                $bid_detail->measure_id = $model->measure_id[$i];
                $bid_detail->price = $model->price[$i];
                $bid_detail->free_unit = $model->free_unit[$i];
                $this->repository->update($bid_detail);
            }
            $transaction->commit();
        } else {
            throw new HttpException(400, "You can edit only 2 times.");
        }

    }

    /**
     * @throws HttpException
     */
    public function delete($ids)
    {
        $ordinary_bid_detail_ids = explode(',', $ids); //array from string ex. 1,2,3 to [1,2,3]
        foreach ($ordinary_bid_detail_ids as $ordinary_bid_detail_id) {
            $model = $this->repository->getById($ordinary_bid_detail_id);
            if ($model->ordinaryBid->edit_counting <= BidEditCount::TWO &&
                $model->ordinaryBid->user_id == Yii::$app->user->id) {
                $this->repository->delete($model);
            } else {
                throw new HttpException(400, "You can not change bids.");
            }
        }

    }
}