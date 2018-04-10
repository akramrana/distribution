<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
\app\assets\SelectAsset::register($this);
\app\assets\DatePickerAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\SalesPerson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-person-form">

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
            
            <?= $form->field($model, 'present_address')->textarea(['rows' => 6]) ?>
            
            <?= $form->field($model, 'national_id_no')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'permanent_address')->textarea(['rows' => 6]) ?>
            
            <?= $form->field($model, 'joining_date')->textInput(['class' => 'datepicker form-control']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');
$this->registerJs("$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    autoclose:true,
    endDate:new Date()
});", \yii\web\View::POS_END, 'date-picker');