<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Distributor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Distributors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
        <?= Html::a('Update', ['update', 'id' => $model->distributor_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->distributor_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'email:email',
            'phone',
            'password',
            'address:ntext',
        ],
    ]) ?>

</div>

</div>
