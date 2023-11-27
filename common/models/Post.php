<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $status
 * @property int|null $category_id
 * @property int|null $create_at
 * @property int|null $update_at
 * @property int|null $view_count
 * @property int|null $image_id
 * @property int|null $user_id
 * @property string|null $options
 * @property int|null $hash
 * @property int|null $news_category_id
 * @property string|null $promo_data
 * @property string|null $about_main_section_type
 * @property int|null $position_on_parent_list
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'create_at', 'update_at', 'view_count', 'image_id', 'user_id', 'hash', 'news_category_id', 'position_on_parent_list'], 'default', 'value' => null],
            [['category_id', 'create_at', 'update_at', 'view_count', 'image_id', 'user_id', 'hash', 'news_category_id', 'position_on_parent_list'], 'integer'],
            [['promo_data'], 'string'],
            [['type', 'status', 'options'], 'string', 'max' => 255],
            [['about_main_section_type'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'status' => 'Status',
            'category_id' => 'Category ID',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'view_count' => 'View Count',
            'image_id' => 'Image ID',
            'user_id' => 'User ID',
            'options' => 'Options',
            'hash' => 'Hash',
            'news_category_id' => 'News Category ID',
            'promo_data' => 'Promo Data',
            'about_main_section_type' => 'About Main Section Type',
            'position_on_parent_list' => 'Position On Parent List',
        ];
    }
}
