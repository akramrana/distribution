<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DamageProduct */

$this->title = $model->damage_product_id;
$this->params['breadcrumbs'][] = ['label' => 'Damage Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
            <?=
            Html::a('Delete', ['delete', 'id' => $model->damage_product_id], [
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
                'product_id',
                'qty',
                'update_stock',
                'created_at',
            ],
        ])
        ?>

    </div>

</div>
