<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $createdAt
 * @property integer $updatedAt
 * @property string $username
 * @property string $authKey
 * @property string $emailConfirmToken
 * @property string $passwordHash
 * @property string $passwordResetToken
 * @property string $email
 * @property integer $status
 */
class UserGii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createdAt', 'updatedAt', 'username', 'passwordHash', 'email'], 'required'],
            [['createdAt', 'updatedAt', 'status'], 'integer'],
            [['username', 'emailConfirmToken', 'passwordHash', 'passwordResetToken', 'email'], 'string', 'max' => 255],
            [['authKey'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
            'username' => 'Username',
            'authKey' => 'Auth Key',
            'emailConfirmToken' => 'Email Confirm Token',
            'passwordHash' => 'Password Hash',
            'passwordResetToken' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\UserQuery(get_called_class());
    }
}
