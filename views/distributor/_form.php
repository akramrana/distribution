<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Distributor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="distributor-form">

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
            
            <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
            
            
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
