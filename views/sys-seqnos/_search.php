<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SysSeqnosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-seqnos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'DM') ?>

    <?= $form->field($model, 'TABLENAME') ?>

    <?= $form->field($model, 'FIELDNAME') ?>

    <?= $form->field($model, 'MAXSEQNO') ?>

    <?= $form->field($model, 'BZ') ?>

    <?php // echo $form->field($model, 'QLB') ?>

    <?php // echo $form->field($model, 'HLB') ?>

    <?php // echo $form->field($model, 'DQDM') ?>

    <?php // echo $form->field($model, 'SFSJBS') ?>

    <?php // echo $form->field($model, 'SX') ?>

    <?php // echo $form->field($model, 'WS') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
