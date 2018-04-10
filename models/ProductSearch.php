<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'distributor_id', 'remaining_quantity', 'supplier_id', 'is_damage', 'is_active', 'is_deleted'], 'integer'],
            [['name', 'short_description', 'description', 'specification', 'SKU', 'manufacturer_number', 'created_at', 'updated_at'], 'safe'],
            [['regular_price', 'final_price', 'width', 'height', 'length', 'weight'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['product_id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'product_id' => $this->product_id,
            'distributor_id' => $this->distributor_id,
            'regular_price' => $this->regular_price,
            'final_price' => $this->final_price,
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
            'weight' => $this->weight,
            'remaining_quantity' => $this->remaining_quantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'supplier_id' => $this->supplier_id,
            'is_damage' => $this->is_damage,
            'is_active' => $this->is_active,
            'is_deleted' => 0,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'specification', $this->specification])
            ->andFilterWhere(['like', 'SKU', $this->SKU])
            ->andFilterWhere(['like', 'manufacturer_number', $this->manufacturer_number]);

        return $dataProvider;
    }
}
