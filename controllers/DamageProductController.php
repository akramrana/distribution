<?php

namespace app\controllers;

use Yii;
use app\models\DamageProduct;
use app\models\DamageProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DamageProductController implements the CRUD actions for DamageProduct model.
 */
class DamageProductController extends Controller {

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
     * Lists all DamageProduct models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new DamageProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DamageProduct model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found

      public function actionView($id) {
      return $this->render('view', [
      'model' => $this->findModel($id),
      ]);
      } */

    /**
     * Creates a new DamageProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new DamageProduct();
        $model->created_at = date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $product = \app\models\Product::findOne($model->product_id);
            $product->updateCounters(['remaining_quantity' => -$model->qty]);
            Yii::$app->session->setFlash('success', 'Damage product successfully added');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing DamageProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found

      public function actionUpdate($id)
      {
      $model = $this->findModel($id);

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->damage_product_id]);
      }

      return $this->render('update', [
      'model' => $model,
      ]);
      } */

    /**
     * Deletes an existing DamageProduct model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->is_deleted = 1;
        if ($model->save()) {

            $product = \app\models\Product::findOne($model->product_id);
            $product->updateCounters(['remaining_quantity' => $model->qty]);

            Yii::$app->session->setFlash('success', 'Damage product successfully deleted');
            return $this->redirect(['index']);
        }
        else{
            return json_encode($model->errors);
        }
    }

    /**
     * Finds the DamageProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DamageProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = DamageProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
