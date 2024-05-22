<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spare".
 *
 * @property int $id
 * @property int $name
 * @property int $price
 *
 * @property ServiceOrderSpare[] $serviceOrderSpares
 */
class Spare extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'spare';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['name', 'price'], 'integer'],
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
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[ServiceOrderSpares]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceOrderSpares()
    {
        return $this->hasMany(ServiceOrderSpare::class, ['spare_id' => 'id']);
    }
}
