<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaiPicturesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pai-pictures-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fID') ?>

    <?= $form->field($model, 'fFileName') ?>

    <?= $form->field($model, 'fPreviewPath') ?>

    <?= $form->field($model, 'fDownloadPath') ?>

    <?= $form->field($model, 'fOwner') ?>

    <?php // echo $form->field($model, 'fUserName') ?>

    <?php // echo $form->field($model, 'fCreateTime') ?>

    <?php // echo $form->field($model, 'fDescription') ?>

    <?php // echo $form->field($model, 'fTaskID') ?>

    <?php // echo $form->field($model, 'fThumb') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
