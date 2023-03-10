<?php

namespace api\khalsa\services;
use api\components\HttpException;
use api\khalsa\repositories\ContainerBidDetailRepository;
use common\enums\BidEditCount;
use common\models\base\ContainerBidDetail as ContainerBidDetailAlias;
use common\models\ContainerBidDetail;
use Yii;

class ContainerBidDetailService
{
    public $containerBidDetailRepository;

    public function __construct
    (
        ContainerBidDetailRepository $containerBidDetailRepository
    )
    {
        $this->containerBidDetailRepository = $containerBidDetailRepository;
    }

    public function create()
    {
        $model = new ContainerBidDetail();
        $model->setScenario(ContainerBidDetail::SCENARIO_CREATE);

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $rows = [];
            for ($i = 0; $i < count($model->charge_id); $i++) {
                $rows[] = [$model->container_bid_id, $model->charge_id[$i], $model->measure_id[$i], $model->price[$i], $model->free_unit[$i]];
            }

            $this->containerBidDetailRepository->create($rows);
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
        $containerBidDetail = $this->containerBidDetailRepository->getById($ids[0]);
        $model->container_bid_id = $containerBidDetail->container_bid_id;
        if ($containerBidDetail->containerBid->edit_counting < BidEditCount::TWO) {
            $model->load(Yii::$app->request->post());

            $transaction = Yii::$app->db->beginTransaction();
            for ($i = 0; $i < count($ids); $i++) {
                $bid_detail = $this->containerBidDetailRepository->getById($ids[$i]);
                $bid_detail->setScenario(ContainerBidDetail::SCENARIO_UPDATE);
                $bid_detail->charge_id = $model->charge_id[$i];
                $bid_detail->measure_id = $model->measure_id[$i];
                $bid_detail->price = $model->price[$i];
                $bid_detail->free_unit = $model->free_unit[$i];
                $this->containerBidDetailRepository->update($bid_detail);
            }
            $transaction->commit();
        } else {
            throw new HttpException(400, "You can edit only 2 times.");
        }

    }

    public function delete($ids)
    {
        $container_bid_detail_ids = explode(',', $ids); //array from string ex. 1,2,3 to [1,2,3]
        $containerBid = $this->containerBidDetailRepository->getById($container_bid_detail_ids[0])->containerBid;
        if ($containerBid->edit_counting < BidEditCount::TWO) {
            $this->containerBidDetailRepository->delete($container_bid_detail_ids);
        } else {
            throw new HttpException(400, "You can change bids only 2 times.");
        }

    }
}
