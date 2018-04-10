<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helpers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Distributor;

/**
 * Description of AppHelper
 *
 * @author Akram Hossain
 */
class AppHelper
{

    //put your code here
    static function getAllDistributor()
    {
        $model = Distributor::find()
                ->orderBy(['is_deleted' => 0])
                ->all();
        $list = ArrayHelper::map($model, 'distributor_id', 'name');
        return $list;
    }

    static function getAllSupplier()
    {
        $model = \app\models\Company::find()
                ->orderBy(['is_deleted' => 0])
                ->all();
        $list = ArrayHelper::map($model, 'company_id', 'name');
        return $list;
    }

    static function generateSkuProduct()
    {
        $alphabet = 'ADM';
        $countProduct = \app\models\Product::find()
                ->where(['is_deleted' => 0])
                ->count();

        $code = self::checkCodeExist($alphabet, $countProduct);

        return $code;
    }

    static function checkCodeExist($alphabet, $countProduct)
    {
        if ($countProduct < 1) {
            $counter = '0001';
        } elseif ($countProduct >= 1 && $countProduct <= 9) {
            $inc = $countProduct + 1;
            $counter = '000' . $inc;
        } elseif ($countProduct >= 10 && $countProduct <= 99) {
            $inc = $countProduct + 1;
            $counter = '00' . $inc;
        } elseif ($countProduct >= 100 && $countProduct <= 999) {
            $inc = $countProduct + 1;
            $counter = '0' . $inc;
        }
        $code = $alphabet . $counter;

        $model = \app\models\Product::find()
                ->where(['SKU' => $code])
                ->asArray()
                ->one();

        if (empty($model)) {
            return $code;
        } else {
            return self::checkCodeExist($alphabet, $countProduct + 1);
        }
    }
    
    static function getAllProducts()
    {
        $model = \app\models\Product::find()
                ->orderBy(['is_deleted' => 0])
                ->all();
        $list = ArrayHelper::map($model, 'product_id', 'name');
        return $list;
    }

}
