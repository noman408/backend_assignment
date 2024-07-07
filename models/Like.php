<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "likes".
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 */
class Like extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%likes}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'post_id'], 'required'],
            [['user_id', 'post_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'post_id' => 'Post ID',
        ];
    }

    public static function isLiked($userId, $postId)
    {
        return self::find()->where(['user_id' => $userId, 'post_id' => $postId])->exists();
    }
}
