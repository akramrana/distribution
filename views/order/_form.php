<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\BaseUrl;

\app\assets\SelectAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\models\Orders */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile(BaseUrl::home() . 'js/bootstrap3-typeahead.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>#Order Info</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?=
                            $form->field($model, 'distributor_id')->dropDownList(app\helpers\AppHelper::getAllDistributor(), [
                                'prompt' => 'Please Select',
                                'class' => 'select2 form-control',
                            ])
                            ?>
                            
                            <?= $form->field($model, 'manager_id')->textInput() ?>
                            
                            <?= $form->field($model, 'order_number')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
                        
                            <?= $form->field($model, 'recipient_name')->textInput(['maxlength' => true]) ?>
                            
                            <?= $form->field($model, 'recipient_phone')->textInput(['maxlength' => true]) ?>
                            
                            <?= $form->field($model, 'shop_id')->textInput() ?>
                            
                            <?= $form->field($model, 'sales_person_id')->textInput() ?>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>#Order Items</h3>
                </div>
                <div class="panel-body">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </span>
                        <input type="text" class="typeahead form-control" placeholder="Enter product code or name" aria-describedby="basic-addon1">
                    </div>
                    <hr/>
                    <div style="max-height: 362px;overflow: auto;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="40%">Product</th>
                                    <th width="35%">Comment</th>
                                    <th width="10%">Price</th>
                                    <th width="5%">Qty</th>
                                    <th width="10%">Total</th>
                                    <th width="60px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>#Payment Info</h3>
                </div>
                <div class="panel-body">
                    <?= $form->field($model, 'discount')->textInput() ?>
                    
                    <?= $form->field($model, 'delivery_charge')->textInput() ?>
                    
                    <?= $form->field($model, 'is_paid')->checkbox() ?>
                </div>
            </div>
        </div>
    </div>


    <div class="form-group pull pull-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs("$('.select2').select2();", \yii\web\View::POS_END, 'select-picker');
$js = "	$('input.typeahead').typeahead({
	    source:  function (query, process) {
                return $.get(baseUrl+'order/get-item', { query: query }, function (data) {
                    //console.log(data);
                    data = $.parseJSON(data);
	            return process(data);
	        });
	    },
            updater:function (item) {
               common.getItemSalesItem(item.id);
               return item;
            }
	});";
$this->registerJs($js, yii\web\View::POS_END);
