<?php

use yii\helpers\Html;
use yii\grid\GridView;

\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
<?= Html::a('Create New Order', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'order_number',
                [
                    'attribute' => 'distributor_id',
                    'value' => function($model) {
                        return $model->distributor->name;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'distributor_id', app\helpers\AppHelper ::getAllDistributor(), ['class' => 'form-control select2', 'prompt' => 'Filter']),
                ],
                [
                    'attribute' => 'manager_id',
                    'value' => function($model) {
                        return $model->manager->name;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'manager_id', app\helpers\AppHelper ::getAllManager(), ['class' => 'form-control select2', 'prompt' => 'Filter']),
                ],
                'recipient_name',
                'recipient_phone',
                'create_date',
                //'update_date',
                //'is_processed',
                //'shop_id',
                [
                    'attribute' => 'sales_person_id',
                    'value' => function($model) {
                        return $model->salesPerson->name;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'sales_person_id', app\helpers\AppHelper ::getAllSalesPerson(), ['class' => 'form-control select2', 'prompt' => 'Filter']),
                ],
                //'delivery_time',
                //'delivery_charge',
                [
                    'attribute' => 'is_paid',
                    'value' => function($model) {
                        return ($model->is_paid == 1) ? "Yes" : "No";
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'is_paid', ['0' => 'No', '1' => 'Yes'], ['class' => 'form-control select2', 'prompt' => 'Filter']),
                ],
                //'discount',
                //'is_deleted',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>

</div>
<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');
