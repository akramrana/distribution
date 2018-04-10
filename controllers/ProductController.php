<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $model->scenario = 'create';
        $sku = \app\helpers\AppHelper::generateSkuProduct();
        $model->SKU = $sku;
        if ($model->load(Yii::$app->request->post())) {
            $request = Yii::$app->request->bodyParams;
            $model->is_active = 1;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            if (isset($request['Product']['quantity']) && $request['Product']['quantity'] != "") {
                $model->remaining_quantity = $request['Product']['quantity'];
            }
            if ($model->save()) {
                if (isset($request['Product']['quantity']) && $request['Product']['quantity'] != "") {
                    $productQty = new \app\models\ProductStock();
                    $productQty->product_id = $model->product_id;
                    $productQty->quantity = $request['Product']['quantity'];
                    $productQty->created_date = date('Y-m-d H:i:s');
                    $productQty->save();
                }
                Yii::$app->session->setFlash('success', 'Product successfully added');
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                            'model' => $model,
                ]);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Product successfully updated');
                return $this->redirect(['index']);
            } else {
                return $this->render('update', [
                            'model' => $model,
                ]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_deleted = 1;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Product successfully deleted');
            return $this->redirect(['index']);
        }
    }

    public function actionActivate($id)
    {
        $model = $this->findModel($id);

        if ($model->is_active == 0)
            $model->is_active = 1;
        else
            $model->is_active = 0;

        if ($model->validate() && $model->save()) {
            return '1';
        } else {

            return json_encode($model->errors);
        }
    }
    
    public function actionAddProductStock($id, $stock)
    {
        if (isset($id) && isset($stock)) {
            $productModel = Product::find()
                        ->where(['product_id' => $id, 'is_deleted' => 0])
                        ->one();
            if (!empty($productModel)) {
                $model = new \app\models\ProductStock();
                $model->product_id = $id;
                $model->quantity = $stock;
                $model->created_date = date('Y-m-d H:i:s');
                if ($model->save()) {
                    $remainingQty = $productModel->remaining_quantity;
                    $productModel->remaining_quantity = $remainingQty + $model->quantity;
                    $productModel->save();
                    return '1';
                } else {
                    return json_encode($model->errors);
                }
            } else {
                return 'Product does not exist';
            }
        }
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
