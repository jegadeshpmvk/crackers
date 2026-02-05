<?php

namespace app\modules\admin\controllers;

use app\models\ContactRequest;
use app\modules\admin\components\Controller;
use app\modules\admin\models\ContactRequestSearch;
use Yii;
use yii\web\NotFoundHttpException;

class DashboardController extends Controller
{

    public $tab = "dashboard";

    public function behaviors()
    {
        return require __DIR__ . '/../filters/LoginCheck.php';
    }

    public function actionIndex()
    {
      

        return $this->render('index');
    }
}
