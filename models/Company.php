<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $company_id
 * @property int $distributor_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property int $is_deleted
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Distributor $distributor
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['distributor_id', 'name', 'phone', 'created_at', 'updated_at'], 'required'],
            [['distributor_id'], 'integer'],
            [['address'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'phone', 'email'], 'string', 'max' => 50],
            ['email', 'email'],
            ['email', 'unique'],
            //[['is_deleted', 'is_active'], 'string', 'max' => 4],
            [['distributor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Distributor::className(), 'targetAttribute' => ['distributor_id' => 'distributor_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Company ID',
            'distributor_id' => 'Distributor',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'is_deleted' => 'Is Deleted',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
