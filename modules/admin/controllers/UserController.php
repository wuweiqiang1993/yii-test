<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use app\modules\admin\controllers;
use yii\web\Response;

/**
 * Default controller for the `admin` module
 */
class UserController extends AdminController
{
    public function actionIndex()
    {
        $searchModel = new User();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', ['dataProvider' => $dataProvider,'searchModel'=>$searchModel]);
    }

    public function actionAudit()
    {
        //var_dump(\Yii::$app->authManager->getAssignments(Yii::$app->user->id));

    }

}
