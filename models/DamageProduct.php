<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "damage_product".
 *
 * @property int $damage_product_id
 * @property int $product_id
 * @property int $qty
 * @property int $update_stock
 * @property string $created_at
 *
 * @property Product $product
 */
class DamageProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'damage_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'qty', 'created_at'], 'required'],
            [['product_id', 'qty'], 'integer'],
            [['created_at','is_deleted'], 'safe'],
            //[['update_stock'], 'string', 'max' => 4],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'product_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'damage_product_id' => 'Damage Product ID',
            'product_id' => 'Product',
            'qty' => 'Qty',
            'update_stock' => 'Update Stock',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['product_id' => 'product_id']);
    }
}
