<?php

namespace app\controllers;

use Yii;
use app\models\Distributor;
use app\models\DistributorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DistributorController implements the CRUD actions for Distributor model.
 */
class DistributorController extends Controller
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
     * Lists all Distributor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DistributorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Distributor model.
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
     * Creates a new Distributor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Distributor();
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post())) {
            $request = Yii::$app->request->bodyParams;
            $password = $request['Distributor']['password_hash'];
            $model->password = Yii::$app->security->generatePasswordHash($password);
            $model->is_active = 1;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Distributor successfully added');
                return $this->redirect(['index']);
            } else {
                //echo json_encode($model->errors);
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
     * Updates an existing Distributor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            $request = Yii::$app->request->bodyParams;
            if (isset($request['Distributor']['password_hash']) && $request['Distributor']['password_hash'] != "") {
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($request['Distributor']['password_hash']);
            }
            $model->updated_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Distributor successfully updated');
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
     * Deletes an existing Distributor model.
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
            Yii::$app->session->setFlash('success', 'Distributor successfully deleted');
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
     * Finds the Distributor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Distributor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Distributor::find()->where(['distributor_id' => $id, 'is_deleted' => 0])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
