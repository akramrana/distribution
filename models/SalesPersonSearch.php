<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SalesPerson;

/**
 * SalesPersonSearch represents the model behind the search form of `app\models\SalesPerson`.
 */
class SalesPersonSearch extends SalesPerson
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sales_person_id', 'distributor_id'], 'integer'],
            [['name', 'phone', 'present_address', 'permanent_address', 'national_id_no', 'joining_date', 'is_deleted', 'is_active', 'created_at', 'updated_at'], 'safe'],
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
        $query = SalesPerson::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['sales_person_id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'sales_person_id' => $this->sales_person_id,
            'distributor_id' => $this->distributor_id,
            'joining_date' => $this->joining_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'present_address', $this->present_address])
            ->andFilterWhere(['like', 'permanent_address', $this->permanent_address])
            ->andFilterWhere(['like', 'national_id_no', $this->national_id_no])
            ->andFilterWhere(['like', 'is_deleted', 0])
            ->andFilterWhere(['like', 'is_active', $this->is_active]);

        return $dataProvider;
    }
}
