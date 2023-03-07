<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\ContainerBidRepository;
use common\enums\BidEditCount;
use common\models\ContainerBid;
use common\models\search\SearchContainerBid;
use yii\base\InvalidConfigException;

class ContainerBidService implements \api\khalsa\interfaces\ServiceInterface
{
    public $containerBidDetailService;
    public $containerBidRepository;

    public function __construct
    (
        ContainerBidRepository    $containerBidRepository,
        ContainerBidDetailService $containerBidDetailService
    )
    {
        $this->containerBidRepository = $containerBidRepository;
        $this->containerBidDetailService = $containerBidDetailService;
    }

    public function index()
    {
        $model = new SearchContainerBid();

        $model->load(\Yii::$app->request->queryParams);
        if ($model->validate()) {
            $query = $model->search();
        } else {
            throw new HttpException(400, ['SearchContainerBid' => $model->getErrors()]);
        }
        return $query;
    }

    public function create()
    {
        $model = new ContainerBid();
        $model->user_id = \Yii::$app->user->id;
        $model->edit_counting = BidEditCount::ZERO;

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $this->containerBidRepository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $model;
    }

    /**
     * @throws HttpException
     */
    public function delete($id)
    {
        $model = $this->containerBidRepository->getById($id);
        $this->containerBidRepository->delete($model);
    }

    /**
     * @throws HttpException
     */
    public function update($id)
    {
       $model = $this->containerBidRepository->getById($id);
       if ($model->edit_counting <= BidEditCount::TWO) {
           if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
               $this->containerBidRepository->update($model);
               $this->containerBidDetailService->update($model->id);
           } else {
               throw new HttpException(400, $model->errors);
           }
       } else {
           throw new HttpException(400, 'You can only 2 times.');
       }

    }

    /**
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function favorite($id)
    {
        $model = $this->containerBidRepository->getById($id);
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $this->containerBidRepository->favorite($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }

}
