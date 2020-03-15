<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>
<link rel='stylesheet' href='css/comment.css' /> 
<div class="comment-form">

    <?php $form = ActiveForm::begin([
    		'action'=>['post/like','id'=>$id,'#'=>'like'],
    		'method'=>'post',
    		]); ?>


    <div class="form-group">
        <?= Html::submitButton('', ['class' =>'butt']) ?>
        <button class='buttt' disabled="true"></button>
    </div>

    <?php ActiveForm::end(); ?>

</div>