<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Peroid */

$this->title = 'Create Peroid';
$this->params['breadcrumbs'][] = ['label' => 'Peroids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peroid-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
