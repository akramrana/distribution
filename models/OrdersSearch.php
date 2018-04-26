<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form of `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'order_number', 'distributor_id', 'manager_id', 'is_processed', 'shop_id', 'sales_person_id', 'is_paid', 'is_deleted'], 'integer'],
            [['recipient_name', 'recipient_phone', 'create_date', 'update_date', 'delivery_time'], 'safe'],
            [['delivery_charge', 'discount'], 'number'],
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
        $query = Orders::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['order_id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'order_id' => $this->order_id,
            'order_number' => $this->order_number,
            'distributor_id' => $this->distributor_id,
            'manager_id' => $this->manager_id,
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
            'is_processed' => $this->is_processed,
            'shop_id' => $this->shop_id,
            'sales_person_id' => $this->sales_person_id,
            'delivery_time' => $this->delivery_time,
            'delivery_charge' => $this->delivery_charge,
            'is_paid' => $this->is_paid,
            'discount' => $this->discount,
            'is_deleted' => 0,
        ]);

        $query->andFilterWhere(['like', 'recipient_name', $this->recipient_name])
            ->andFilterWhere(['like', 'recipient_phone', $this->recipient_phone]);

        return $dataProvider;
    }
}
