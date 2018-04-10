<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manager".
 *
 * @property int $manager_id
 * @property int $distributor_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property int $is_active
 * @property int $is_deleted
 *
 * @property Distributor $distributor
 */
class Manager extends \yii\db\ActiveRecord
{
    public $password_hash, $confirm_password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['distributor_id', 'name', 'email', 'phone', 'password'], 'required'],
            [['distributor_id', 'is_active', 'is_deleted'], 'integer'],
            [['name', 'email', 'phone'], 'string', 'max' => 50],
            ['email', 'email'],
            ['email', 'unique'],
            [['password_hash', 'confirm_password'], 'required', 'on' => 'create'],
            [['password_hash'], 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password_hash', 'message' => Yii::t('yii', 'Confirm Password must be equal to "Password"')],
            ['phone', 'match', 'pattern' => '/^[0-9-+]+$/', 'message' => Yii::t('yii', 'Your phone can only contain numeric characters with +/-')],
            [['distributor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Distributor::className(), 'targetAttribute' => ['distributor_id' => 'distributor_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'manager_id' => 'Manager ID',
            'distributor_id' => 'Distributor',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'password_hash' => 'Password',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistributor()
    {
        return $this->hasOne(Distributor::className(), ['distributor_id' => 'distributor_id']);
    }
}
