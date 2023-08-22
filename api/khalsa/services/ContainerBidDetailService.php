<?php

namespace api\khalsa\services;
use api\components\HttpException;
use api\khalsa\repositories\ContainerBidDetailRepository;
use common\enums\BidEditCount;
use common\models\ContainerBidDetail;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class ContainerBidDetailService
{
    public $repository;

    public function __construct
    (
        ContainerBidDetailRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create()
    {
        $model = new ContainerBidDetail();
        $model->setScenario(ContainerBidDetail::SCENARIO_CREATE);

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->containerBid->edit_counting <= BidEditCount::TWO) {
                $rows = [];
                for ($i = 0; $i < count($model->charge_id); $i++) {
                    $rows[] = [$model->container_bid_id, $model->charge_id[$i], $model->measure_id[$i], $model->price[$i], $model->free_unit[$i]];
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
     * @throws HttpException
     */
    public function update($id)
    {
        $model = new ContainerBidDetail();
        $ids = explode(',', $id);
        $containerBidDetail = $this->repository->getById($ids[0]);
        $model->container_bid_id = $containerBidDetail->container_bid_id;
        $model->scenario = ContainerBidDetail::SCENARIO_VALIDATE_ARRAY;
        if ($containerBidDetail->containerBid->edit_counting <= BidEditCount::TWO) {
            $model->load(Yii::$app->request->post());

            $transaction = Yii::$app->db->beginTransaction();
            for ($i = 0; $i < count($ids); $i++) {
                $bid_detail = $this->repository->getById($ids[$i]);
                $bid_detail->setScenario(ContainerBidDetail::SCENARIO_UPDATE);
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
     * @throws InvalidConfigException
     * @throws StaleObjectException
     */
    public function delete($ids)
    {
        $container_bid_detail_ids = explode(',', $ids); //array from string ex. 1,2,3 to [1,2,3]

        foreach ($container_bid_detail_ids as $container_bid_detail_id) {
            $model = $this->repository->getById($container_bid_detail_id);
            if ($model->containerBid->edit_counting <= BidEditCount::TWO &&
                $model->containerBid->user_id == Yii::$app->user->id) {
                $this->repository->delete($model);
            } else {
                throw new HttpException(400, "You can not change bids.");
            }
        }

    }
}
