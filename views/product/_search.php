<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'distributor_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'short_description') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'specification') ?>

    <?php // echo $form->field($model, 'SKU') ?>

    <?php // echo $form->field($model, 'manufacturer_number') ?>

    <?php // echo $form->field($model, 'regular_price') ?>

    <?php // echo $form->field($model, 'final_price') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'length') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'remaining_quantity') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'supplier_id') ?>

    <?php // echo $form->field($model, 'is_damage') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
