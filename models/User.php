<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

class User extends ActiveRecord implements \yii\web\IdentityInterface {

    public $authKey;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        if (\Yii::$app->session['_distributionAuth'] == 1) {
            return static::findOne(['admin_id' => $id, 'is_active' => self::STATUS_ACTIVE, 'is_deleted' => self::STATUS_DELETED]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['email' => $username, 'is_active' => self::STATUS_ACTIVE, 'is_deleted' => self::STATUS_DELETED]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

}
