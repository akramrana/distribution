<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalesPerson */

$this->title = 'Update Sales Person: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sales People', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->sales_person_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box box-primary">

    <div class="box-body">

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>

    </div>

</div>
