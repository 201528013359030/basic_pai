<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PaiPictures */

$this->title = 'Update Pai Pictures: ' . $model->fID;
$this->params['breadcrumbs'][] = ['label' => 'Pai Pictures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fID, 'url' => ['view', 'id' => $model->fID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pai-pictures-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
