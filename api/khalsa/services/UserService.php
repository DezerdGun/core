<?php

namespace api\khalsa\services;

use api\components\HttpException;
use api\forms\user\UserChangePassword;
use api\khalsa\repositories\UserRepository;
use common\models\User;
use Yii;

class UserService
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function update(User $model)
    {
        if ($model->validate()) {
            $this->userRepository->update($model);
        } else {
            throw new HttpException(400, [$model->formName() => $model->getErrors()]);
        }
    }

    /**
     * @throws HttpException
     */
    public function uploadPhoto()
    {
        $model = $this->userRepository->getById(Yii::$app->user->id);
        $model->setScenario(User::SCENARIO_USER_PICTURE);

        if ($model->user_picture) {
            unlink(Yii::getAlias('@cdn-webroot') . '/' . $model->user_picture);
            $model->user_picture = null;
        }
        self::update($model);
    }

    public function deletePhoto()
    {
        $model = $this->userRepository->getById(Yii::$app->user->id);
        if ($model->user_picture) {
            unlink(Yii::getAlias('@cdn-webroot') . '/' . $model->user_picture);
            $model->user_picture = null;
            self::update($model);
        }
    }

    public function changePassword()
    {
        $form = new UserChangePassword();
        $form->setAttributes(Yii::$app->request->post());
        if ($form->validate()) {
            $model = $this->userRepository->getById(Yii::$app->user->id);
            $model->setPassword($form->new_password);
            $model->generateAuthKey();
            $model->save();
        } else {
            throw new HttpException(400, $form->getErrors());
        }
    }
}
