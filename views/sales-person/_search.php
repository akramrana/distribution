<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SalesPersonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sales_person_id') ?>

    <?= $form->field($model, 'distributor_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'present_address') ?>

    <?php // echo $form->field($model, 'permanent_address') ?>

    <?php // echo $form->field($model, 'national_id_no') ?>

    <?php // echo $form->field($model, 'joining_date') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
