<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $admin_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property int $is_active
 * @property int $is_deleted
 */
class Admin extends \yii\db\ActiveRecord
{

    public $password_hash, $confirm_password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'password'], 'required'],
            [['is_active', 'is_deleted'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 15],
            [['password'], 'string', 'max' => 100],
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
            'admin_id' => 'Admin ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'password_hash' => 'Password',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
        ];
    }

}
