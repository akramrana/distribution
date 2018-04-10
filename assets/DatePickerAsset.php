<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\assets;
use yii\web\AssetBundle;
/**
 * Description of DatePickerAsset
 *
 * @author Akram Hossain <akram_cse@yahoo.com>
 */
class DatePickerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/';
    public $css = [
        'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css',
    ];
    public $js = [
        'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
