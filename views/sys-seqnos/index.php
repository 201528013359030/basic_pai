<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SysSeqnosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sys Seqnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-seqnos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sys Seqnos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'DM',
            'TABLENAME',
            'FIELDNAME',
            'MAXSEQNO',
            'BZ',
            // 'QLB',
            // 'HLB',
            // 'DQDM',
            // 'SFSJBS',
            // 'SX',
            // 'WS',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
