<?php

namespace app\controllers;

use Yii;
use app\models\Vendor;
use app\models\VendorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\widgets\GeneratePassword;

/**
 * VendorController implements the CRUD actions for Vendor model.
 */
class VendorController extends Controller
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
     * Lists all Vendor models.
     * @return json
     */
    public function actionGetVendorInfo($id) 
    {
        $modelVendor = Vendor::find()->where(['vendor.id' => $id, 'vendor.active' => 1])->asArray()->one();
        echo json_encode($modelVendor);
    }

    /**
     * Lists all Vendor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VendorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Vendor model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Vendor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelVendor = new Vendor();
        $generate = new GeneratePassword();

        if ($modelVendor->load(Yii::$app->request->post())) {
            $modelVendor->user_id = Yii::$app->user->getId();
            $modelVendor->time = date('Y-m-d H:i:s');
            if(empty($modelVendor->number))
                $modelVendor->number = 'VE-'.$generate->Generate(8,1,0,1).'-'.$generate->Generate(2,1,0,0);
            $modelVendor->save();
            return $this->redirect(['view', 'id' => $modelVendor->id]);
        } else {
            return $this->render('create', [
                'modelVendor' => $modelVendor,
            ]);
        }
    }

    /**
     * Updates an existing Vendor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $modelVendor = $this->findModel($id);
        $generate = new GeneratePassword();

        if ($modelVendor->load(Yii::$app->request->post())) {
            $modelVendor->user_id = Yii::$app->user->getId();
            $modelVendor->time = date('Y-m-d H:i:s');
            if(empty($modelVendor->number))
                $modelVendor->number = 'VE-'.$generate->Generate(8,1,0,1).'-'.$generate->Generate(2,1,0,0);
            $modelVendor->save();
            return $this->redirect(['view', 'id' => $modelVendor->id]);
        } else {
            return $this->render('update', [
                'modelVendor' => $modelVendor,
            ]);
        }
    }

    /**
     * Deletes an existing Vendor model.
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
     * Finds the Vendor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vendor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vendor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
