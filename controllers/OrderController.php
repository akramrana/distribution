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
class OrderController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
    public function actionIndex() {
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
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Orders();
        $model->order_number = $this->getNextOrderNumber();
        if ($model->load(Yii::$app->request->post())) {
            $request = Yii::$app->request->bodyParams;
            $model->create_date = date("Y-m-d H:i:s");
            $model->update_date = date("Y-m-d H:i:s");
            $model->is_processed = 1;
            //debugPrint($request);exit;
            $transaction = Orders::getDb()->beginTransaction();
            if ($model->save()) {
                if (!empty($request['product_id'])) {
                    $success = true;
                    foreach ($request['product_id'] as $k => $pid) {
                        $productModel = \app\models\Product::findOne($pid);
                        $orderItem = new \app\models\OrderItems();
                        $orderItem->order_id = $model->order_id;
                        $orderItem->product_id = $pid;
                        $orderItem->quantity = $request['qty'][$k];
                        $orderItem->price = $productModel->final_price;
                        if (!$orderItem->save()) {
                            $success = false;
                        }
                    }
                }
                $defaultStatus = \app\models\Status::find()
                        ->where(['is_default' => 1])
                        ->one();

                $orderStatusModel = new \app\models\OrderStatus();
                $orderStatusModel->order_id = $model->order_id;
                $orderStatusModel->status_id = $defaultStatus->status_id;
                $orderStatusModel->status_date = date("Y-m-d H:i:s");
                $orderStatusModel->user_id = Yii::$app->user->identity->admin_id;
                $orderStatusModel->user_type = 'A';

                if ($success && $orderStatusModel->save()) {
                    $transaction->commit();
                }
                Yii::$app->session->setFlash('success', 'Order successfully created');
                return $this->redirect(['index']);
            } else {
                echo json_encode($model->errors);
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    private function getNextOrderNumber() {
        $order = \app\models\Orders::find()
                ->select(['MAX(`order_number`) AS order_number'])
                ->asArray()
                ->one();

        if (!empty($order) && $order['order_number'] != 0) {
            return $order['order_number'] + 1;
        } else {
            return 100001;
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
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
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->is_deleted = 1;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Order successfully deleted');
            return $this->redirect(['index']);
        }
    }

    public function actionGetManagerShopSalesperson($id) {
        $manager = \app\models\Manager::find()
                ->select(['manager_id', 'name'])
                ->where(['distributor_id' => $id, 'is_active' => 1, 'is_deleted' => 0])
                ->asArray()
                ->all();

        $shop = \app\models\Shop::find()
                ->select(['shop_id', 'name'])
                ->where(['distributor_id' => $id, 'is_active' => 1, 'is_deleted' => 0])
                ->asArray()
                ->all();

        $salesPerson = \app\models\SalesPerson::find()
                ->select(['sales_person_id', 'name'])
                ->where(['distributor_id' => $id, 'is_active' => 1, 'is_deleted' => 0])
                ->asArray()
                ->all();

        return json_encode([
            'manager' => $manager,
            'shop' => $shop,
            'sales_person' => $salesPerson,
        ]);
    }

    public function actionGetItem($query, $did = null) {
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

    public function actionGetItemInfo($item) {
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

    public function actionAddStatus() {
        $request = Yii::$app->request->bodyParams;
        $model = Orders::find()
                ->where(['order_id' => $request['order_id']])
                ->one();
        if (!empty($model)) {
            $check = \app\models\OrderStatus::find()
                    ->where(['status_id' => $request['status'], 'order_id' => $model->order_id])
                    ->one();
            if (!empty($check)) {
                return json_encode(['status' => 201, 'msg' => 'The order is already in "' . strtoupper($check->status->name) . '" status']);
            }
            $status = new \app\models\OrderStatus();
            $status->order_id = $request['order_id'];
            $status->status_id = $request['status'];
            $status->user_id = Yii::$app->user->identity->admin_id;
            $status->user_type = 'A';
            $status->comment = $request['comment'];
            $status->status_date = date('Y-m-d H:i:s');
            if ($status->save()) {
                if ($status->status_id == 6) {
                    foreach ($model->orderItems as $item) {
                        $qtyToAdd = $item->quantity;
                        $product = \app\models\Product::findOne($item->product_id);
                        $existingQty = $product->remaining_quantity;
                        $finalQty = $qtyToAdd + $existingQty;
                        $product->remaining_quantity = $finalQty;
                        $product->save(false);
                    }
                }
                return json_encode(['status' => 200, 'msg' => 'Order status successfully updated.']);
            } else {
                return json_encode($status->errors);
            }
        }
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Orders::find()->where(['order_id' => $id, 'is_deleted' => 0])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
