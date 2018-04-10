<?php

use yii\helpers\Html;
use yii\grid\GridView;
\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel app\models\SalesPersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
            <?= Html::a('Create Sales Person', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'distributor_id',
                    'value' => function($model) {
                        return $model->distributor->name;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'distributor_id', app\helpers\AppHelper ::getAllDistributor(), ['class' => 'form-control select2', 'prompt' => 'Filter']),
                ],
                'name',
                'phone',
                'present_address:ntext',
                //'permanent_address:ntext',
                'national_id_no',
                'joining_date',
                //'is_deleted',
                [
                    'label' => 'Status',
                    'attribute' => 'is_active',
                    'format' => 'raw',
                    'value' => function ($model, $url) {
                        return '<div class="onoffswitch">'
                                . Html::checkbox('onoffswitch', $model->is_active, ['class' => "onoffswitch-checkbox", 'id' => "myonoffswitch" . $model->sales_person_id,
                                    'onclick' => 'App.status("sales-person/activate",this,' . $model->sales_person_id . ')'
                                ])
                                . '<label class="onoffswitch-label" for="myonoffswitch' . $model->sales_person_id . '"></label></div>';
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'is_active', [1 => 'Active', 0 => 'Inactive'], ['class' => 'form-control select2', 'prompt' => 'Filter']),
                ],
                //'created_at',
                //'updated_at',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>

</div>

<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');
