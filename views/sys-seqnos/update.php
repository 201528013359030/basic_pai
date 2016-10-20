<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SysSeqnos */

$this->title = 'Update Sys Seqnos: ' . $model->DM;
$this->params['breadcrumbs'][] = ['label' => 'Sys Seqnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DM, 'url' => ['view', 'id' => $model->DM]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sys-seqnos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
