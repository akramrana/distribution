<?php

use yii\helpers\Html;
use yii\grid\GridView;

\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel app\models\DamageProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Damage Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
            <?= Html::a('Add Damage Product', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                //'damage_product_id',
                [
                    'attribute' => 'product_id',
                    'value' => function($model) {
                        return $model->product->name;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'product_id', app\helpers\AppHelper ::getAllProducts(), ['class' => 'form-control select2', 'prompt' => 'Filter']),
                ],
                'qty',
                'created_at',
                    ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
            ],
        ]);
        ?>
    </div>

</div>

<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');
