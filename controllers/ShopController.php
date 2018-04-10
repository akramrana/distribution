<?php

namespace app\controllers;

use Yii;
use app\models\Shop;
use app\models\ShopSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShopController implements the CRUD actions for Shop model.
 */
class ShopController extends Controller
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
     * Lists all Shop models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Shop model.
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
     * Creates a new Shop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Shop();
        if ($model->load(Yii::$app->request->post())) {
            $model->is_active = 1;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Shop successfully added');
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
     * Updates an existing Shop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at = date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Shop successfully updated');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Shop model.
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
            Yii::$app->session->setFlash('success', 'Shop successfully deleted');
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

    /**
     * Finds the Shop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Shop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shop::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
