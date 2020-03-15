<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Live */

$this->title = 'Update Live: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->date]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="live-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
