<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DamageProduct;

/**
 * DamageProductSearch represents the model behind the search form of `app\models\DamageProduct`.
 */
class DamageProductSearch extends DamageProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['damage_product_id', 'product_id', 'qty'], 'integer'],
            [['update_stock', 'created_at'], 'safe'],
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
        $query = DamageProduct::find()->where(['is_deleted' => 0]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['damage_product_id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'damage_product_id' => $this->damage_product_id,
            'product_id' => $this->product_id,
            'qty' => $this->qty,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'update_stock', $this->update_stock]);

        return $dataProvider;
    }
}
