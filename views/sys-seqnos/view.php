<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SysSeqnos */

$this->title = $model->DM;
$this->params['breadcrumbs'][] = ['label' => 'Sys Seqnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-seqnos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->DM], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->DM], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'DM',
            'TABLENAME',
            'FIELDNAME',
            'MAXSEQNO',
            'BZ',
            'QLB',
            'HLB',
            'DQDM',
            'SFSJBS',
            'SX',
            'WS',
        ],
    ]) ?>

</div>
