<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?=
            $form->field($model, 'distributor_id')->dropDownList(app\helpers\AppHelper::getAllDistributor(), [
                'prompt' => 'Please Select',
                'class' => 'select2 form-control',
            ])
            ?>
        </div>
        <div class="col-md-6">
            &nbsp;
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'SKU')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>

            <?= $form->field($model, 'regular_price')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'width')->textInput() ?>

            <?= $form->field($model, 'length')->textInput() ?>

            <?=
            $form->field($model, 'supplier_id')->dropDownList(app\helpers\AppHelper::getAllSupplier(), [
                'prompt' => 'Please Select',
                'class' => 'select2 form-control',
            ])
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'short_description')->textInput() ?>

            <?= $form->field($model, 'specification')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'manufacturer_number')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'final_price')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'height')->textInput() ?>

            <?= $form->field($model, 'weight')->textInput() ?>

            <?php
            if ($model->isNewRecord) {
                echo $form->field($model, 'quantity')->textInput();
            }
            ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');
