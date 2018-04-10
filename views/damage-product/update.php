<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DamageProduct */

$this->title = 'Update Damage Product: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Damage Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->damage_product_id, 'url' => ['view', 'id' => $model->damage_product_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box box-primary">

    <div class="box-body">

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>

    </div>

</div>
