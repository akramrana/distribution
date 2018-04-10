<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $product_id
 * @property int $distributor_id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $specification
 * @property string $SKU
 * @property string $manufacturer_number
 * @property string $regular_price
 * @property string $final_price
 * @property double $width
 * @property double $height
 * @property double $length
 * @property double $weight
 * @property int $remaining_quantity
 * @property string $created_at
 * @property string $updated_at
 * @property int $supplier_id
 * @property int $is_damage
 * @property int $is_active
 * @property int $is_deleted
 *
 * @property Company $supplier
 * @property Distributor $distributor
 * @property ProductStock[] $productStocks
 */
class Product extends \yii\db\ActiveRecord
{
    public $quantity;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['distributor_id', 'name', 'SKU', 'final_price', 'created_at', 'updated_at'], 'required'],
            [['distributor_id', 'remaining_quantity', 'supplier_id', 'is_damage', 'is_active', 'is_deleted'], 'integer'],
            [['short_description', 'description', 'specification'], 'string'],
            [['regular_price', 'final_price', 'width', 'height', 'length', 'weight'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'SKU', 'manufacturer_number'], 'string', 'max' => 255],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['supplier_id' => 'company_id']],
            [['distributor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Distributor::className(), 'targetAttribute' => ['distributor_id' => 'distributor_id']],
            [['SKU'], 'unique'],
            ['quantity', 'compare', 'compareValue' => '0', 'operator' => '>'],
            [['final_price'], 'compare', 'compareAttribute' => 'regular_price', 'operator' => '<=', 'type' => 'number', 'on' => 'create'],
            [['final_price'], 'compare', 'compareAttribute' => 'regular_price', 'operator' => '<=', 'type' => 'number', 'on' => 'update'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'distributor_id' => 'Distributor',
            'name' => 'Name',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'specification' => 'Specification',
            'SKU' => 'Sku',
            'manufacturer_number' => 'Manufacturer Number',
            'regular_price' => 'Regular Price',
            'final_price' => 'Final Price',
            'width' => 'Width',
            'height' => 'Height',
            'length' => 'Length',
            'weight' => 'Weight',
            'remaining_quantity' => 'Remaining Quantity',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'supplier_id' => 'Supplier',
            'is_damage' => 'Is Damage',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Company::className(), ['company_id' => 'supplier_id']);
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
    public function getProductStocks()
    {
        return $this->hasMany(ProductStock::className(), ['product_id' => 'product_id']);
    }
}
