<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Distributor */

$this->title = 'Create Distributor';
$this->params['breadcrumbs'][] = ['label' => 'Distributors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

</div>
