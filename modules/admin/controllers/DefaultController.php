<?php

namespace app\modules\admin\controllers;

use yii;
use app\modules\admin\controllers;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
