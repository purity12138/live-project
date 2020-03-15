    
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comment-form">

    <?php $form = ActiveForm::begin([
    		'action'=>['post/detail','id'=>$id,'#'=>'comments'],
    		'method'=>'post',
    		]); ?>

    
    <div class="row">
    	<div class="col-md-2"><?= $form->field($commentModel,'indentify')->textarea(['row'=>6])?></div>
    	<div class="col-md-2"><?= $form->field($commentModel,'tel')->textarea(['row'=>1])?></div>
    	
    </div>

    <div class="form-group">
        <?= Html::submitButton('投稿', ['class' =>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>