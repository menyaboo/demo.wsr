<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_order_spare".
 *
 * @property int $id
 * @property int $service_order_id
 * @property int $spare_id
 *
 * @property ServiceOrder $serviceOrder
 * @property Spare $spare
 */
class ServiceOrderSpare extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_order_spare';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_order_id', 'spare_id'], 'required'],
            [['service_order_id', 'spare_id'], 'integer'],
            [['service_order_id'], 'unique'],
            [['service_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceOrder::class, 'targetAttribute' => ['service_order_id' => 'id']],
            [['spare_id'], 'exist', 'skipOnError' => true, 'targetClass' => Spare::class, 'targetAttribute' => ['spare_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_order_id' => 'Service Order ID',
            'spare_id' => 'Spare ID',
        ];
    }

    /**
     * Gets query for [[ServiceOrder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceOrder()
    {
        return $this->hasOne(ServiceOrder::class, ['id' => 'service_order_id']);
    }

    /**
     * Gets query for [[Spare]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpare()
    {
        return $this->hasOne(Spare::class, ['id' => 'spare_id']);
    }
}
