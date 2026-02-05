<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use app\components\Controller;
use app\components\AuthHandler;


class SiteController extends Controller
{
    
    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }

    public function actionIndex()
    {
        // $model = CustomPage::find()->andWhere(['url' => 'home'])->active()->one();
        // if ($model && trim(@$model->parent_page) == "") {
        //     $title = '';
        //     if (trim(@$model->name) != '') {
        //         $title = @$model->name . ' | Crackers';
        //     }

        //     $this->setupMeta(@$model->meta_tag, $title);
        //     return $this->render('index', [
        //         "model" => $model,
        //         'page' => $model->url,
        //         "contetWidgets" => $model->content_widgets
        //     ]);
        // }
        // throw new \yii\web\NotFoundHttpException();

        return $this->render('index', [
                'page' => 'Home',
            ]);
    }
}
