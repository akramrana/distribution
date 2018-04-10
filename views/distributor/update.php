<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Distributor */

$this->title = 'Update Distributor: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Distributors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->distributor_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box box-primary">

    <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

</div>
