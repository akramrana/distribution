<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\widgets\Pjax;

\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->order_number;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$orderItems = \app\models\OrderItems::find()
        ->where(['order_id' => $model->order_id]);

$orderStatus = \app\models\OrderStatus::find()
        ->where(['order_id' => $model->order_id])
        ->orderBy(['order_status_id' => SORT_DESC])
        ->one();
?>
<div class="box box-primary">

    <div class="box-body">

        <p class="pull pull-right">
            <?= Html::a('Update', ['update', 'id' => $model->order_id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->order_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </p>

        <?php
        $total = (($model->item_total - $model->discount) + $model->delivery_charge);
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'order_number',
                [
                    'attribute' => 'distributor_id',
                    'value' => $model->distributor->name
                ],
                [
                    'attribute' => 'manager_id',
                    'value' => $model->manager->name
                ],
                'recipient_name',
                'recipient_phone',
                'create_date',
                //'update_date',
                [
                    'attribute' => 'shop_id',
                    'value' => $model->shop->name
                ],
                [
                    'attribute' => 'sales_person_id',
                    'value' => $model->salesPerson->name
                ],
                //'delivery_time',
                'item_total',
                'discount',
                'delivery_charge',
                [
                    'attribute' => 'total',
                    'value' => number_format($total, 2)
                ],
                [
                    'attribute' => 'is_paid',
                    'value' => ($model->is_paid == 1) ? "Yes" : "No",
                ],
            ],
        ])
        ?>
        <hr/>
        <div class="row">
            <div class="col-md-12">

                <h3 class="text-center">Order Items</h3>

                <?php
                $dataProvider1 = new ActiveDataProvider([
                    'query' => $orderItems,
                    'pagination' => [
                        'pageSize' => 20,
                    ],
                ]);

                echo GridView::widget([
                    'dataProvider' => $dataProvider1,
                    //'filterModel' => $searchModel,
                    'formatter' => [
                        'class' => 'yii\i18n\Formatter',
                        'nullDisplay' => ''
                    ],
                    'summary' => '',
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],
                        [
                            'label' => 'Product',
                            'value' => function($data) {
                                return $data->product->name;
                            },
                            'format' => 'raw'
                        ],
                        [
                            'label' => 'Price',
                            'value' => function($data) {
                                return $data->price;
                            }
                        ],
                        [
                            'label' => 'Quantity',
                            'value' => function($data) {
                                return $data->quantity;
                            }
                        ],
                        [
                            'label' => 'Total',
                            'value' => function($data) {
                                return number_format(($data->quantity * $data->price), 3);
                            }
                        ]
                    ],
                ]);
                ?>
            </div>

        </div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Order Status</h3>
                <?php 
                Pjax::begin([
                    'timeout' => 60000,
                ]); ?>
                <div class="col-md-12" id="order-status-pjax">
                    <?php
                    $dataProvider2 = new ActiveDataProvider([
                        'query' => $model->getOrderStatuses()->orderBy(['order_status_id' => SORT_DESC]),
                        'pagination' => [
                            'pageSize' => 20,
                        ],
                    ]);

                    echo GridView::widget([
                        'dataProvider' => $dataProvider2,
                        'summary' => '',
                        'columns' => [
                            [
                                'label' => false,
                                'value' => function ($data) {
                                    $content = "<b>" . date("M d, Y", strtotime($data->status_date)) . "</b> " . date("h:i A", strtotime($data->status_date)) . " | <b>" . $data->status->name . "</b><br/><b>" . $data->comment . "</b>";
                                    return $content;
                                },
                                'format' => 'raw'
                            ]
                        ],
                    ]);
                    ?>
                </div>
                <?php Pjax::end(); ?>
                <div class="col-md-12">
                    <?php
                    if ($orderStatus->status_id != 4 && $orderStatus->status_id != 5) {
                        ?>
                        <div id="response"></div>
                        <h3 class="text-center">Add Order Status</h3>
                        <?php
                        echo Html::beginForm('', 'get', ['id' => 'order-status-form']);
                        echo Html::dropDownList('status', '', \app\helpers\AppHelper::getStatusList(), ['prompt' => 'Select Status', 'class' => 'form-control select2']) . '<br/>';
                        echo Html::textarea('comment', '', ['class' => 'form-control', 'style' => 'height: 100px; resize: none;']);
                        echo Html::hiddenInput('order_id', $model->order_id) . "<br/>";
                        echo Html::button('Submit Comment', ['type' => 'button', 'class' => 'btn btn-info pull pull-right', 'onclick' => 'App.addOrderStatus()']);
                        echo Html::endForm();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');
