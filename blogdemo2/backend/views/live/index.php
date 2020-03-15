<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LiveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '直播记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="live-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建直播记录', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'date',
            [
                'attribute'=>'date',
                'label'=>'日期时间',
            ],
            //'name:ntext',
            [
                'attribute'=>'name',
                'label'=>'歌名',
            ],
            //'author:ntext',
            [
                'attribute'=>'author',
                'label'=>'歌手',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
