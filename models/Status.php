<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $status_id
 * @property string $name
 * @property string $color
 * @property int $is_default
 *
 * @property OrderStatus[] $orderStatuses
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
            [['color'], 'string', 'max' => 7],
            [['is_default'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status ID',
            'name' => 'Name',
            'color' => 'Color',
            'is_default' => 'Is Default',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderStatuses()
    {
        return $this->hasMany(OrderStatus::className(), ['status_id' => 'status_id']);
    }
}
