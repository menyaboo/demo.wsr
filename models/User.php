<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $surname
 * @property string $name
 * @property string|null $patronymic
 * @property string $phone
 * @property string $login
 * @property string $password
 * @property int|null $role_id
 *
 * @property Comment[] $comments
 * @property Role $role
 * @property ServiceOrder[] $serviceOrders
 * @property ServiceRequest[] $serviceRequests
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['surname', 'name', 'phone', 'login', 'password'], 'required'],
            [['role_id'], 'integer'],
            [['surname', 'name', 'patronymic', 'login', 'password'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 16],
            [['login'], 'unique'],
            [['phone'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Surname',
            'name' => 'Name',
            'patronymic' => 'Patronymic',
            'phone' => 'Phone',
            'login' => 'Login',
            'password' => 'Password',
            'role_id' => 'Role ID',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    /**
     * Gets query for [[ServiceOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceOrders()
    {
        return $this->hasMany(ServiceOrder::class, ['employee_id' => 'id']);
    }

    /**
     * Gets query for [[ServiceRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceRequests()
    {
        return $this->hasMany(ServiceRequest::class, ['client_id' => 'id']);
    }

    public function getId()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }

    public function getAuthKey()
    {
        return null;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByUsername($login)
    {
        return User::findOne(['login' => $login]);
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    function roleMiddleware($roles): bool {
        return in_array(Yii::$app->user->identity->role->code, explode('|', $roles), true);
    }
}
