<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $message
 * @property int $service_request_id
 * @property int $user_id
 *
 * @property ServiceRequest $serviceRequest
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message', 'service_request_id', 'user_id'], 'required'],
            [['message'], 'string'],
            [['service_request_id', 'user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['service_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceRequest::class, 'targetAttribute' => ['service_request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'service_request_id' => 'Service Request ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[ServiceRequest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceRequest()
    {
        return $this->hasOne(ServiceRequest::class, ['id' => 'service_request_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
