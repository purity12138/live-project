<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PeroidSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peroids';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peroid-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Peroid', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'start_time',
            'endtime',
            'num',
            'total',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
