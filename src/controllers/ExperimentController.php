<?php

namespace app\controllers;

use Yii;
use app\models\Experiment;
use app\models\ExperimentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * ExperimentController implements the CRUD actions for Experiment model.
 */
class ExperimentController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Experiment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExperimentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Experiment model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $resResult = new ActiveDataProvider ([
                'query' => \app\models\Results::find()->where (['id_exp' => $model->id_exp]),
        ]);

        $resExperiment = new ActiveDataProvider ([
                'query' => \app\models\Experiment::find()->where (['id_exp' => $model->id_exp]),
        ]);

        return $this->render('view', [
            'model' => $model,
            'resResult' => $resResult,
            'resExperiment' => $resExperiment,
        ]);


    }

    /**
     * Creates a new Experiment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Experiment();
       // $model->date = date("m.d.y");
       // //$model->time = date("H:i:s");
        //$model->bones_num = 2;
       // $model->throws = 36000;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            return $this->redirect(['view', 'id' => $model->id_exp]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Experiment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_exp]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Experiment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Experiment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Experiment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Experiment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
