<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\web\HttpException;
use yii\db\Expression;
use app\models\HeaderFooter;
use app\models\Category;
use app\models\Product;
use app\models\Coupon;
use app\components\ApiController;

class PageController extends ApiController
{
    public function behaviors()
    {
        $b = parent::behaviors();
        $b['authenticator']['except'] = ['header-footer', 'get-categories', 'get-products', 'get-coupon'];
        $b['access']['except'] = ['header-footer', 'get-categories', 'get-products', 'get-coupon'];
        return $b;
    }

    public function actionHeaderFooter()
    {
        return HeaderFooter::find()->active()->one();
    }

    public function actionGetCategories()
    {
        return Category::find()->active()->all();
    }

    public function actionGetProducts()
    {
        $search = Yii::$app->request->get('search', "");
        $catId  = Yii::$app->request->get('cat_id', "");
        $sort   = Yii::$app->request->get('sort', "");
        $query = Product::find()->active();

        if (!empty($search)) {
            $query->andFilterWhere(['like', 'name', $search]);
        }

        if (!empty($catId)) {
            $query->andFilterWhere(['category_id' => $catId]);
        }

        if ($sort == "low_to_high") {
            $query->orderBy(['price' => SORT_ASC]);
        } elseif ($sort == "high_to_low") {
            $query->orderBy(['price' => SORT_DESC]);
        } elseif ($sort == "latest") {
            $query->orderBy(['id' => SORT_DESC]);
        }

        return $query->all();
    }

    public function actionGetCoupon()
    {
        $code = Yii::$app->request->post('code', "");
        $query = Coupon::find()->active();

        if (!empty($code)) {
            $query->andFilterWhere(['code' => $code]);
        }

        return $query->one();
    }
}
