<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SysSeqnos */

$this->title = 'Create Sys Seqnos';
$this->params['breadcrumbs'][] = ['label' => 'Sys Seqnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-seqnos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
