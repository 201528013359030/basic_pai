<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PaiPictures */

$this->title = $model->fID;
$this->params['breadcrumbs'][] = ['label' => 'Pai Pictures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pai-pictures-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->fID], [
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
            'fID',
            'fFileName',
            'fPreviewPath',
            'fDownloadPath',
            'fOwner',
            'fUserName',
            'fCreateTime',
            'fDescription',
            'fTaskID',
            'fThumb',
        ],
    ]) ?>

</div>
