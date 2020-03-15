<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Lives */

$this->title = 'Create Lives';
$this->params['breadcrumbs'][] = ['label' => 'Lives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lives-create">

	<h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
