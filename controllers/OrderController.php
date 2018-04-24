<?php

namespace app\controllers;

use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Orders model.
 */
class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionGetManagerShopSalesperson($id)
    {
        $manager = \app\models\Manager::find()
                ->select(['manager_id','name'])
                ->where(['distributor_id' => $id,'is_active' => 1, 'is_deleted' => 0])
                ->asArray()
                ->all();
        
        $shop = \app\models\Shop::find()
                ->select(['shop_id','name'])
                ->where(['distributor_id' => $id,'is_active' => 1, 'is_deleted' => 0])
                ->asArray()
                ->all();
        
        $salesPerson = \app\models\SalesPerson::find()
                ->select(['sales_person_id','name'])
                ->where(['distributor_id' => $id,'is_active' => 1, 'is_deleted' => 0])
                ->asArray()
                ->all();
        
        return json_encode([
            'manager' => $manager,
            'shop' => $shop,
            'sales_person' => $salesPerson,
        ]);
    }
    
    public function actionGetItem($query,$did=null)
    {
        $models = \app\models\Product::find()
                ->where(['is_deleted' => 0, 'is_active' => 1, 'distributor_id' => $did])
                ->andWhere(['like', 'name', $query])
                ->all();

        $data = [];
        foreach ($models as $row) {

            $d = [
                'id' => $row->product_id,
                'name' => $row->name,
            ];
            array_push($data, $d);
        }
        return json_encode($data);
    }
    
    public function actionGetItemInfo($item)
    {
        $model = \app\models\Product::find()
                ->where(['is_deleted' => 0, 'is_active' => 1, 'product_id' => $item])
                ->one();
        
        $data = [
            'id' => $model->product_id,
            'name' => $model->name,
            'description' => $model->description,
            'price' => $model->final_price,
        ];
        return json_encode($data);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
