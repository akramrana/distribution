<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DamageProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="damage-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'damage_product_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'qty') ?>

    <?= $form->field($model, 'update_stock') ?>

    <?= $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
