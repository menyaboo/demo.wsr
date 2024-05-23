<?php

namespace app\controllers;

use app\models\ServiceOrder;
use app\models\ServiceRequest;
use app\models\ServiceRequestSearch;
use app\models\ServiceRequestStatus;
use app\widgets\Alert;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServiceRequestController implements the CRUD actions for ServiceRequest model.
 */
class ServiceRequestController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ServiceRequest models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ServiceRequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if (Yii::$app->user->identity->roleMiddleware('client')) {
            $dataProvider->query->andWhere(['client_id' => Yii::$app->user->identity->id]);
        }

        if (Yii::$app->user->identity->roleMiddleware('master')) {
            $serviceOrders = ServiceOrder::find()->where(['employee_id' => Yii::$app->user->identity->id])->all();
            $dataProvider->query->orWhere([
                'client_id' => Yii::$app->user->identity->id
            ])->orWhere([
                'id' => array_column($serviceOrders, 'service_request_id')
            ]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceRequest model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ServiceRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ServiceRequest();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ServiceRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $oldStatus = ServiceRequestStatus::find()->where(['id' => $model->status_id])->one()->name;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $newStatus = ServiceRequestStatus::find()->where(['id' => $model->status_id])->one()->name;

            if ($oldStatus != $newStatus) {
                Yii::$app->session->setFlash('changeStatus', 'Статус заявки изменился с ' . $oldStatus . ' на ' . $newStatus);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ServiceRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiceRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ServiceRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceRequest::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
