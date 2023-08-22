<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\khalsa\repositories\OrdinaryBidRepository;
use common\enums\BidEditCount;
use common\models\OrdinaryBid;
use common\models\search\SearchOrdinaryBid;
use yii\base\InvalidConfigException;
use yii\db\StaleObjectException;

class OrdinaryBidService
{
    public $repository;
    public function __construct
    (
        OrdinaryBidRepository $repository
    )
    {
        $this->repository = $repository;
    }
    public function index()
    {
        $model = new SearchOrdinaryBid();

        $model->load(\Yii::$app->request->queryParams);
        if ($model->validate()) {
            $query = $model->search();
        } else {
            throw new HttpException(400, ['SearchOrdinaryBid' => $model->getErrors()]);
        }
        return $query;
    }
    /**
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function create()
    {
        $model = new OrdinaryBid();
        $model->user_id = \Yii::$app->user->id;
        $model->edit_counting = BidEditCount::ZERO;

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $this->repository->create($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
        return $model;
    }

    /**
     * @throws HttpException
     */
    public function update($id)
    {
        $model = $this->repository->getById($id);
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $this->repository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->errors]);
        }
    }

    /**
     * @throws HttpException
     * @throws StaleObjectException
     */
    public function delete($id)
    {
        $model = $this->repository->getById($id);
        $this->repository->delete($model);
    }

    /**
     * @throws HttpException
     */
    public function editCount(OrdinaryBid $model)
    {
        $model->edit_counting = $model->edit_counting + 1;
        $this->repository->update($model);
    }

    /**
     * @throws HttpException
     */
    public function view($listing_ordinary_id): \yii\db\ActiveQuery
    {
        $model = new SearchOrdinaryBid();
        $model->listing_ordinary_id = $listing_ordinary_id;
        $model->load(\Yii::$app->request->queryParams);
        if ($model->validate()) {
            $query = $model->search();
        } else {
            throw new HttpException(400, ['SearchOrdinaryBid' => $model->getErrors()]);
        }
        return $query;
    }

    /**
     * @throws HttpException
     * @throws InvalidConfigException
     */
    public function favorite($id)
    {
        $model = $this->repository->getById($id);
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $this->repository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }
}