<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\DamageProduct */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="damage-product-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'product_id')->dropDownList(\app\helpers\AppHelper::getAllProducts(),[
                'prompt' => 'Please select',
                'class' => 'select2 form-control'
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'qty')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');