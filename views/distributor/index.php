<?php

use yii\helpers\Html;
use yii\grid\GridView;
\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel app\models\DistributorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Distributors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
        <?= Html::a('Create Distributor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'email:email',
            'phone',
            'address:ntext',
            [
                    'label' => 'Status',
                    'attribute' => 'is_active',
                    'format' => 'raw',
                    'value' => function ($model, $url) {
                        return '<div class="onoffswitch">'
                                . Html::checkbox('onoffswitch', $model->is_active, ['class' => "onoffswitch-checkbox", 'id' => "myonoffswitch" . $model->distributor_id,
                                    'onclick' => 'App.status("distributor/activate",this,' . $model->distributor_id . ')'
                                ])
                                . '<label class="onoffswitch-label" for="myonoffswitch' . $model->distributor_id . '"></label></div>';
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'is_active', [1 => 'Active', 0 => 'Inactive'], ['class' => 'form-control select2', 'prompt' => 'Filter']),
                ],
            //'created_at',
            //'updated_at',
            //'is_active',
            //'is_deleted',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
 </div>

</div>
<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');
