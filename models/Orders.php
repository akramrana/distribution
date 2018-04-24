<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $order_id
 * @property string $order_number
 * @property int $distributor_id
 * @property int $manager_id
 * @property string $recipient_name
 * @property string $recipient_phone
 * @property string $create_date
 * @property string $update_date
 * @property int $is_processed
 * @property int $shop_id
 * @property int $sales_person_id
 * @property string $delivery_time
 * @property double $delivery_charge
 * @property int $is_paid
 * @property double $discount
 * @property int $is_deleted
 *
 * @property OrderItems[] $orderItems
 * @property OrderStatus[] $orderStatuses
 * @property Distributor $distributor
 * @property Manager $manager
 * @property SalesPerson $salesPerson
 * @property Shop $shop
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_number', 'distributor_id', 'manager_id', 'create_date', 'item_total'], 'required'],
            [['order_number', 'distributor_id', 'manager_id', 'is_processed', 'shop_id', 'sales_person_id', 'is_paid', 'is_deleted'], 'integer'],
            [['create_date', 'update_date', 'delivery_time', 'item_total'], 'safe'],
            [['delivery_charge', 'discount'], 'number'],
            [['recipient_name'], 'string', 'max' => 255],
            [['recipient_phone'], 'string', 'max' => 15],
            [['distributor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Distributor::className(), 'targetAttribute' => ['distributor_id' => 'distributor_id']],
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manager::className(), 'targetAttribute' => ['manager_id' => 'manager_id']],
            [['sales_person_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesPerson::className(), 'targetAttribute' => ['sales_person_id' => 'sales_person_id']],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['shop_id' => 'shop_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'order_number' => 'Order Number',
            'distributor_id' => 'Distributor',
            'manager_id' => 'Manager',
            'recipient_name' => 'Recipient Name',
            'recipient_phone' => 'Recipient Phone',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'is_processed' => 'Is Processed',
            'shop_id' => 'Shop',
            'sales_person_id' => 'Sales Person',
            'delivery_time' => 'Delivery Time',
            'delivery_charge' => 'Delivery Charge',
            'is_paid' => 'Is Paid',
            'discount' => 'Discount',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderStatuses()
    {
        return $this->hasMany(OrderStatus::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistributor()
    {
        return $this->hasOne(Distributor::className(), ['distributor_id' => 'distributor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Manager::className(), ['manager_id' => 'manager_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesPerson()
    {
        return $this->hasOne(SalesPerson::className(), ['sales_person_id' => 'sales_person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['shop_id' => 'shop_id']);
    }
}
