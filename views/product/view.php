<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
            <?= Html::a('Update', ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->product_id], [
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
                'short_description:ntext',
                'description:ntext',
                'specification:ntext',
                'SKU',
                'manufacturer_number',
                'regular_price',
                'final_price',
                'width',
                'height',
                'length',
                'weight',
                'remaining_quantity',
                //'supplier_id',
                [
                    'attribute' => 'supplier_id',
                    'value' => $model->supplier->name
                ],
            ],
        ])
        ?>

    </div>

</div>
