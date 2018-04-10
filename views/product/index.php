<?php

use yii\helpers\Html;
use yii\grid\GridView;

\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
            <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
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
                //'short_description:ntext',
                //'description:ntext',
                //'specification:ntext',
                'SKU',
                //'manufacturer_number',
                'regular_price',
                'final_price',
                //'width',
                //'height',
                //'length',
                //'weight',
                'remaining_quantity',
                //'created_at',
                //'updated_at',
                [
                    'attribute' => 'supplier_id',
                    'value' => function($model) {
                        return !empty($model->supplier) ? $model->supplier->name : "";
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'supplier_id', app\helpers\AppHelper ::getAllSupplier(), ['class' => 'form-control select2', 'prompt' => 'Filter']),
                ],
                //'is_damage',
                [
                    'label' => 'Status',
                    'attribute' => 'is_active',
                    'format' => 'raw',
                    'value' => function ($model, $url) {
                        return '<div class="onoffswitch">'
                                . Html::checkbox('onoffswitch', $model->is_active, ['class' => "onoffswitch-checkbox", 'id' => "myonoffswitch" . $model->product_id,
                                    'onclick' => 'App.status("product/activate",this,' . $model->product_id . ')'
                                ])
                                . '<label class="onoffswitch-label" for="myonoffswitch' . $model->product_id . '"></label></div>';
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'is_active', [1 => 'Active', 0 => 'Inactive'], ['class' => 'form-control select2', 'prompt' => 'Filter']),
                ],
                //'is_deleted',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{stock}{view}{update}{delete}',
                    'buttons' => [
                        'stock' => function($url, $model) {
                            return Html::a('<i title="Add stock" class="glyphicon glyphicon-download"></i> ', "javascript:;", [
                                        'title' => Yii::t('yii', 'Add stock'),
                                        'data-container' => 'body',
                                        'data-toggle' => 'popover',
                                        'data-placement' => 'left',
                                        'data-html' => "true",
                                        'data-content' => '<input placeholder="Enter stock" id="stkPop_' . $model->product_id . '" type="text" name="stock_' . $model->product_id . '" value="" class="form-control"/><div id="error_' . $model->product_id . '">&nbsp;</div><button onclick="App.addMoreStock(' . $model->product_id . ')" type="button" class="btn btn-sm btn-info"><i class="fa fa-check"></i> Save</button>'
                            ]);
                        },
                    ]
                ],
            ],
        ]);
        ?>
    </div>

</div>

<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');
$this->registerJs('$(function () {
            $(\'[data-toggle="popover"]\').popover();
            $(\'body\').on(\'click\', function (e) {
                  $(\'[data-toggle="popover"]\').each(function () {
                  //the \'is\' for buttons that trigger popups
                  //the \'has\' for icons within a button that triggers a popup
                      if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $(\'.popover\').has(e.target).length === 0) {
                          $(this).popover(\'hide\');
                      }
                  });
            });
            $(\'body\').on(\'hidden.bs.popover\', function (e) {
              $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
            });
          })', \yii\web\View::POS_END);