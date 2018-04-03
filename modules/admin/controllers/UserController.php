<?php

namespace app\modules\admin\controllers;

use app\models\User;
use app\modules\admin\controllers;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `admin` module
 */
class UserController extends AdminController
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);

    }

    public function actionAudit()
    {
        //var_dump(\Yii::$app->authManager->getAssignments(Yii::$app->user->id));

    }

}
