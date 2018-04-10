<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DistributorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distributor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'distributor_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
