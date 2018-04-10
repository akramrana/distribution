<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Manager */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Managers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
            <?= Html::a('Update', ['update', 'id' => $model->manager_id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->manager_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </p>

        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'distributor_id',
                    'value' => $model->distributor->name
                ],
                'name',
                'email:email',
                'phone',
                'created_at',
            ],
        ])
        ?>

    </div>

</div>
