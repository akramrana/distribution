<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SalesPerson */

$this->title = 'Create Sales Person';
$this->params['breadcrumbs'][] = ['label' => 'Sales People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
