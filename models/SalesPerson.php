<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales_person".
 *
 * @property int $sales_person_id
 * @property int $distributor_id
 * @property string $name
 * @property string $phone
 * @property string $present_address
 * @property string $permanent_address
 * @property string $national_id_no
 * @property string $joining_date
 * @property int $is_deleted
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Distributor $distributor
 */
class SalesPerson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['distributor_id'], 'integer'],
            [['name', 'phone', 'created_at', 'updated_at'], 'required'],
            [['present_address', 'permanent_address'], 'string'],
            [['joining_date', 'created_at', 'updated_at'], 'safe'],
            [['name', 'phone', 'national_id_no'], 'string', 'max' => 50],
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
            'sales_person_id' => 'Sales Person ID',
            'distributor_id' => 'Distributor',
            'name' => 'Name',
            'phone' => 'Phone',
            'present_address' => 'Present Address',
            'permanent_address' => 'Permanent Address',
            'national_id_no' => 'National ID No',
            'joining_date' => 'Joining Date',
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
