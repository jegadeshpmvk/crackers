<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;


class Category extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%category}}';
    }

    public static function find()
    {
        // Parent find() returns the custom Scope
        $query = parent::find();

        return $query->orderBy('order');
    }

    public function rules()
    {
        $rules = [
            [['name', 'discount'], 'required'],
            [['order'], 'safe']
        ];
        return ArrayHelper::merge(parent::rules(), $rules);
    }

    // public function beforeSave($insert) {
    //     if ($this->isNewRecord) {
    //         $this->json = json_encode($_SERVER);
    //     }
    //     return parent::beforeSave($insert);
    // }

}
