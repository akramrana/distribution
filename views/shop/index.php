<?php

use yii\helpers\Html;
use yii\grid\GridView;

\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel app\models\ShopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shops';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
<?= Html::a('Create Shop', ['create'], ['class' => 'btn btn-success']) ?>
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
                'owner_name',
                'phone',
                'address:ntext',
                //'created_at',
                //'updated_at',
                [
                    'label' => 'Status',
                    'attribute' => 'is_active',
                    'format' => 'raw',
                    'value' => function ($model, $url) {
                        return '<div class="onoffswitch">'
                                . Html::checkbox('onoffswitch', $model->is_active, ['class' => "onoffswitch-checkbox", 'id' => "myonoffswitch" . $model->shop_id,
                                    'onclick' => 'App.status("shop/activate",this,' . $model->shop_id . ')'
                                ])
                                . '<label class="onoffswitch-label" for="myonoffswitch' . $model->shop_id . '"></label></div>';
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'is_active', [1 => 'Active', 0 => 'Inactive'], ['class' => 'form-control select2', 'prompt' => 'Filter']),
                ],
                //'is_deleted',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>

</div>

<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');
