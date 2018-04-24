<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;

use yii\web\AssetBundle;
/**
 * Description of SweetAlertAsset
 *
 * @author Akram Hossain <akram.lezasolutions@gmail.com>
 */
class SweetAlertAsset extends AssetBundle{
    
    public $sourcePath = '@vendor/almasaeed2010/adminlte/';

    public $css = [
        'plugins/sweetalert/lib/sweet-alert.css'
    ];

    public $js = [
        'plugins/sweetalert/lib/sweet-alert.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
