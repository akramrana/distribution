<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SalesPerson */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sales People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
            <?= Html::a('Update', ['update', 'id' => $model->sales_person_id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->sales_person_id], [
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
                'phone',
                'present_address:ntext',
                'permanent_address:ntext',
                'national_id_no',
                'joining_date',
            ],
        ])
        ?>

    </div>

</div>
