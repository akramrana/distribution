<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            
            <?php
            if ($model->isNewRecord) {
                echo $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true, 'tabindex' => 6]);
            }
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true,'tabindex' => 5]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
