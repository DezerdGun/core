<?php

namespace common\behaviors;

use mohorev\file\UploadBehavior as BaseUploadBehavior;
use Yii;
use yii\db\BaseActiveRecord;
use yii\helpers\ArrayHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;


class UploadBehavior extends BaseUploadBehavior
{
    public $fileInfoAttributes = [];
    public function init()
    {
        if ($this->generateNewName === true) {
            $this->generateNewName = function ($file) {
                return Yii::$app->security->generateRandomString(50) . '.' . $file->extension;
            };
        }
    }

    public function beforeSave()
    {
        $model = $this->owner;
        if (ArrayHelper::isIn($model->getScenario(), $this->scenarios) && ($this->file instanceof UploadedFile)) {
            if ($name = ArrayHelper::getValue($this->fileInfoAttributes, 'mimeType')) {
                $model->setAttribute($name, $this->file->type);
            }
        }
        parent::beforeSave();
    }

}