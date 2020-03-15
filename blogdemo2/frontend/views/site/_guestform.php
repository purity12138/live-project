    
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin([
    		'action'=>['post/details','id'=>$id,'#'=>'comments'],
    		'method'=>'post',
    		]); ?>

    
    <div class="row">
    	<div class="col-md-12"><?= $form->field($commentModel,'content')->textarea(['row'=>6,'placeholder'=> '请勿乱投稿，增加弹幕组成员的工作嗷。'])?></div>
    	<div class="col-md-2"><?= $form->field($commentModel,'name')->textarea(['row'=>1])?></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('投稿', ['class' =>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>