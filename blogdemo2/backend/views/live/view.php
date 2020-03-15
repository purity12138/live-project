<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Live */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '直播记录管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->date], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->date], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '您确定删除这篇文章吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date',
            'name:ntext',
            'author:ntext',
        ],
    ]) ?>

</div>
