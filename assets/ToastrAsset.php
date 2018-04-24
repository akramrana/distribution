<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

use yii\web\AssetBundle;
/**
 * Description of ToastrAsset
 *
 * @author Akram Hossain <akram.lezasolutions@gmail.com>
 */
class ToastrAsset extends AssetBundle{
    
    public $sourcePath = '@vendor/almasaeed2010/adminlte/';

    public $css = [
        'plugins/toastr/build/toastr.min.css'
    ];

    public $js = [
        'plugins/toastr/build/toastr.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
