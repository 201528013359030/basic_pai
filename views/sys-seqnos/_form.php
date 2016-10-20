<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SysSeqnos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-seqnos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TABLENAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FIELDNAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MAXSEQNO')->textInput() ?>

    <?= $form->field($model, 'BZ')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QLB')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HLB')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DQDM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SFSJBS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SX')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'WS')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
