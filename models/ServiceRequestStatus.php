<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_request_status".
 *
 * @property int $id
 * @property string $name
 *
 * @property ServiceRequest[] $serviceRequests
 */
class ServiceRequestStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_request_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[ServiceRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceRequests()
    {
        return $this->hasMany(ServiceRequest::class, ['status_id' => 'id']);
    }
}
