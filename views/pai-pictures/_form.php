<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaiPictures */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pai-pictures-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fFileName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fPreviewPath')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fDownloadPath')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fOwner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fUserName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fCreateTime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fDescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fTaskID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fThumb')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
