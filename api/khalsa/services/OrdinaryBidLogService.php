<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\OrdinaryBidDetailRepository;
use api\khalsa\repositories\OrdinaryBidLogRepository;
use api\khalsa\repositories\OrdinaryBidRepository;
use common\enums\Action;
use common\enums\BidEditCount;
use common\models\OrdinaryBidLog;
use yii\base\InvalidConfigException;

class OrdinaryBidLogService
{
    public $repository;
    public $logService;

    public $ordinaryBidRepository;
    public $ordinaryBidService;

    public $ordinaryBidDetailRepository;
    public function __construct
    (
        OrdinaryBidRepository $ordinaryBidRepository,
        OrdinaryBidLogRepository $repository,
        LogService $logService,
        OrdinaryBidDetailRepository $ordinaryBidDetailRepository,
        OrdinaryBidService $ordinaryBidService
    )
    {
        $this->ordinaryBidRepository = $ordinaryBidRepository;
        $this->repository = $repository;
        $this->logService = $logService;
        $this->ordinaryBidDetailRepository = $ordinaryBidDetailRepository;
        $this->ordinaryBidService = $ordinaryBidService;
    }

    /**
     * @throws HttpException|InvalidConfigException
     */
    public function create($ordinary_bid_id)
    {
        $ordinaryBid = $this->ordinaryBidRepository->getById($ordinary_bid_id);
        if ($ordinaryBid->edit_counting <= BidEditCount::TWO) {
            $rows = [];
            $bid_details = $this->ordinaryBidDetailRepository->getByOrdinaryBidId($ordinary_bid_id);
            foreach ($bid_details as $bid_detail) {
                $rows[] = [
                    'charge_name' => $bid_detail->charge->name,
                    'measure_name' => $bid_detail->measure->name,
                    'price' => $bid_detail->price,
                    'free_unit' => $bid_detail->free_unit,

                ];
            }

            $log_data = [
                'ordinary_bid_detail' => $rows,
                'note_from_carrier' => $ordinaryBid->note
            ];
            $log = $this->logService->create($log_data, Action::ORDINARY_BID_EDIT);

            $model = new OrdinaryBidLog();
            $model->ordinary_bid_id = $ordinary_bid_id;
            $model->log_id = $log->id;
            $this->repository->create($model);
            $this->ordinaryBidService->editCount($ordinaryBid);
        } else {
            throw new HttpException(400, 'You can log 2 times.');
        }


    }

    /**
     * @throws \Exception
     */
    public function index($ordinary_bid_id): \yii\db\ActiveQuery
    {
        return $this->repository->index($ordinary_bid_id);
    }
}