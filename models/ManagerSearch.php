<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Manager;

/**
 * ManagerSearch represents the model behind the search form of `app\models\Manager`.
 */
class ManagerSearch extends Manager
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manager_id', 'distributor_id', 'is_active', 'is_deleted'], 'integer'],
            [['name', 'email', 'phone', 'password'], 'safe'],
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
        $query = Manager::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['manager_id' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'manager_id' => $this->manager_id,
            'distributor_id' => $this->distributor_id,
            'is_active' => $this->is_active,
            'is_deleted' => 0,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
