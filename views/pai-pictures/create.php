<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PaiPictures */

$this->title = 'Create Pai Pictures';
$this->params['breadcrumbs'][] = ['label' => 'Pai Pictures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pai-pictures-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
