<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_request".
 *
 * @property int $id
 * @property string $start_date
 * @property string $tech_type
 * @property string $tech_model
 * @property string $description
 * @property string $completion_date
 * @property int $status_id
 * @property int $client_id
 *
 * @property User $client
 * @property Comment[] $comments
 * @property ServiceOrder[] $serviceOrders
 * @property ServiceRequestStatus $status
 */
class ServiceRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'completion_date'], 'safe'],
            [['tech_type', 'tech_model', 'description', 'client_id'], 'required'],
            [['description'], 'string'],
            [['status_id', 'client_id'], 'integer'],
            [['tech_type', 'tech_model'], 'string', 'max' => 32],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['client_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceRequestStatus::class, 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_date' => 'Start Date',
            'tech_type' => 'Tech Type',
            'tech_model' => 'Tech Model',
            'description' => 'Description',
            'completion_date' => 'Completion Date',
            'status_id' => 'Status ID',
            'client_id' => 'Client ID',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(User::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['service_request_id' => 'id']);
    }

    /**
     * Gets query for [[ServiceOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceOrders()
    {
        return $this->hasMany(ServiceOrder::class, ['service_requests_id' => 'id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(ServiceRequestStatus::class, ['id' => 'status_id']);
    }
}
