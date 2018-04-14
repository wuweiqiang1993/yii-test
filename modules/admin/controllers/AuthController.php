<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\AuthItem;
use app\models\AuthRule;
use app\modules\admin\controllers;
use yii\web\Response;

/**
 * Default controller for the `admin` module
 */
class AuthController extends AdminController
{
    public function actionIndex()
    {
        $searchModel = new AuthItem();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', ['dataProvider' => $dataProvider,'searchModel'=>$searchModel]);
    }

    public function actionAdditem()
    {
        $model = new AuthItem();
        if ($model->load(Yii::$app->request->post())&& $model->validate()) {
            $model->saveNewItem();
            return $this->redirect(['auth/index']);
        }
        $rule = new AuthRule();
        return $this->render('additem', [
            'model' => $model,
            'rule' => $rule,
        ]);
    }
}
