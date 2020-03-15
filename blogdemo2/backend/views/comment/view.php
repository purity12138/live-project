<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定删除这条记录吗？',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content:ntext',
            //'status',
            [
                'attribute'=>'status',
                'value'=>$model->status0->name,
            ],
            //'create_time:datetime',
            [
                'attribute'=>'create_time',
                'value'=>date('Y-m-d H:i:s',$model->create_time),
            ],
            //'userid',
            [
                'attribute'=>'userid',
                'value'=>$model->user->username,
            ],
            'email:email',
            'url:url',
            //'post_id',
            [
                'attribute'=>'post_id',
                'value'=>$model->post->title,
            ],
        ],
    ]) ?>

</div>
