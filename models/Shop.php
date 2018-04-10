<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop".
 *
 * @property int $shop_id
 * @property int $distributor_id
 * @property string $name
 * @property string $owner_name
 * @property string $phone
 * @property string $address
 * @property string $created_at
 * @property string $updated_at
 * @property int $is_active
 * @property int $is_deleted
 *
 * @property Distributor $distributor
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['distributor_id', 'name', 'owner_name', 'phone', 'address', 'created_at', 'updated_at'], 'required'],
            [['distributor_id', 'is_active', 'is_deleted'], 'integer'],
            [['address'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'owner_name', 'phone'], 'string', 'max' => 50],
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
            'shop_id' => 'Shop ID',
            'distributor_id' => 'Distributor',
            'name' => 'Name',
            'owner_name' => 'Owner Name',
            'phone' => 'Phone',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
