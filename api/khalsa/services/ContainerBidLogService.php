<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\ContainerBidDetailRepository;
use api\khalsa\repositories\ContainerBidLogRepository;
use api\khalsa\repositories\ContainerBidRepository;
use common\enums\Action;
use common\enums\BidEditCount;
use common\models\ContainerBidLog;

class ContainerBidLogService
{
    public $repository;
    public $logService;

    public $containerBidRepository;
    public $containerBidService;

    public $containerBidDetailRepository;
    public function __construct
    (
        ContainerBidRepository $containerBidRepository,
        ContainerBidLogRepository $repository,
        LogService $logService,
        ContainerBidDetailRepository $containerBidDetailRepository,
        ContainerBidService $containerBidService
    )
    {
        $this->containerBidRepository = $containerBidRepository;
        $this->repository = $repository;
        $this->logService = $logService;
        $this->containerBidDetailRepository = $containerBidDetailRepository;
        $this->containerBidService = $containerBidService;
    }

    /**
     * @throws HttpException
     */
    public function create($container_bid_id)
    {
        $containerBid = $this->containerBidRepository->getById($container_bid_id);
        if ($containerBid->edit_counting < BidEditCount::TWO) {
            $rows = [];
            $bid_details = $this->containerBidDetailRepository->getByContainerBidId($container_bid_id);
            foreach ($bid_details as $bid_detail) {
                $rows[] = [
                    'charge_name' => $bid_detail->charge->name,
                    'measure_name' => $bid_detail->measure->name,
                    'price' => $bid_detail->price,
                    'free_unit' => $bid_detail->free_unit,

                ];
            }

            $log_data = [
                'broker_name' => $containerBid->listingContainer->user->name,
                'container_bid_detail' => $rows,
                'note_from_carrier' => $containerBid->note
            ];
            $log = $this->logService->create($log_data, Action::CONTAINER_BID_EDIT);

            $model = new ContainerBidLog();
            $model->container_bid_id = $container_bid_id;
            $model->log_id = $log->id;
            $this->repository->create($model);
            $this->containerBidService->editCount($containerBid);
        } else {
            throw new HttpException(400, 'You can log 2 times.');
        }


    }

    /**
     * @throws \Exception
     */
    public function index($container_bid_id): \yii\db\ActiveQuery
    {
        return $this->repository->index($container_bid_id);
    }

}