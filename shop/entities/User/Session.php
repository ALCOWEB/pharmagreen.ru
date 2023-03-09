<?php

namespace shop\entities\User;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property int $id
 * @property string $uuid
 * @property int|null $user_id
 * @property int|null $logged
 * @property string $created_at
 * @property int|null $expires
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uuid'], 'required'],
            [['uuid'], 'string'],
            [['user_id', 'logged', 'expires'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }
}
