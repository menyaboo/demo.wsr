<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_order".
 *
 * @property int $id
 * @property int $is_executor
 * @property int $service_requests_id
 * @property int $employee_id
 *
 * @property User $employee
 * @property ServiceOrderSpare $serviceOrderSpare
 * @property ServiceRequest $serviceRequests
 */
class ServiceOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_executor', 'service_requests_id', 'employee_id'], 'integer'],
            [['service_requests_id', 'employee_id'], 'required'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['employee_id' => 'id']],
            [['service_requests_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceRequest::class, 'targetAttribute' => ['service_requests_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_executor' => 'Is Executor',
            'service_requests_id' => 'Service Requests ID',
            'employee_id' => 'Employee ID',
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(User::class, ['id' => 'employee_id']);
    }

    /**
     * Gets query for [[ServiceOrderSpare]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceOrderSpare()
    {
        return $this->hasOne(ServiceOrderSpare::class, ['service_order_id' => 'id']);
    }

    /**
     * Gets query for [[ServiceRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceRequests()
    {
        return $this->hasOne(ServiceRequest::class, ['id' => 'service_requests_id']);
    }
}
