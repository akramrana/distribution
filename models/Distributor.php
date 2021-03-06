<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "distributor".
 *
 * @property int $distributor_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $address
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_active
 * @property int $is_deleted
 */
class Distributor extends \yii\db\ActiveRecord
{
    public $password_hash, $confirm_password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'distributor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'password', 'address', 'created_at', 'updated_at'], 'required'],
            [['address'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'phone'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 128],
            ['email', 'email'],
            ['email', 'unique'],
            [['password_hash', 'confirm_password'], 'required', 'on' => 'create'],
            [['password_hash'], 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password_hash', 'message' => Yii::t('yii', 'Confirm Password must be equal to "Password"')],
            ['phone', 'match', 'pattern' => '/^[0-9-+]+$/', 'message' => Yii::t('yii', 'Your phone can only contain numeric characters with +/-')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'distributor_id' => 'Distributor ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'password_hash' => 'Password',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
