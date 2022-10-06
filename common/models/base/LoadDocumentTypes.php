<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "load_document_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property \common\models\LoadDocuments[] $loadDocuments
 * @property string $aliasModel
 */
abstract class LoadDocumentTypes extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'load_document_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLoadDocuments()
    {
        return $this->hasMany(\common\models\LoadDocuments::className(), ['doc_type' => 'id']);
    }




}