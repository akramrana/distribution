<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'distributor_id')->dropDownList(app\helpers\AppHelper::getAllDistributor(),[
                'prompt' => 'Please Select',
                'class' => 'select2 form-control',
            ]) ?>
        </div>
        <div class="col-md-6">
            &nbsp;
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'address')->textarea(['rows' => 4]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');