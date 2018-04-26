<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_status".
 *
 * @property int $order_status_id
 * @property string $status_date
 * @property int $order_id
 * @property int $status_id
 * @property int $manager_id
 * @property string $comment
 *
 * @property Manager $manager
 * @property Orders $order
 * @property Status $status
 */
class OrderStatus extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'order_status';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['status_date', 'order_id', 'status_id', 'user_id'], 'required'],
            [['status_date', 'user_id', 'user_type'], 'safe'],
            [['order_id', 'status_id', 'user_id'], 'integer'],
            [['comment'], 'string'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'order_id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'status_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'order_status_id' => 'Order Status ID',
            'status_date' => 'Status Date',
            'order_id' => 'Order ID',
            'status_id' => 'Status ID',
            'user_id' => 'User ID',
            'user_type' => 'User Type',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder() {
        return $this->hasOne(Orders::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus() {
        return $this->hasOne(Status::className(), ['status_id' => 'status_id']);
    }

}
