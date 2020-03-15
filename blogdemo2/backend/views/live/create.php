<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Live */

$this->title = 'Create Live';
$this->params['breadcrumbs'][] = ['label' => 'Lives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
