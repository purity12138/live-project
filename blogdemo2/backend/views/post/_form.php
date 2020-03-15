<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Poststatus;
use yii\helpers\ArrayHelper;
use common\models\Adminuser;
use common\models\Classification;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
	
	
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
	

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

	<?php 
	/*$psObjs = Poststatus::find()->all();
	$allStatus = ArrayHelper::map($psObjs,'id','name');*/
	$allStatus = (new \yii\db\Query())
	->select(['name','id'])
	->from('poststatus')
	->indexBy('id')
	->column();
	
/*	echo "<hr><pre>";
	print_r($allStatus);
	echo "</pre>";
	
	exit(0);*/
	?>
	
   <?= $form->field($model,'status')
        ->dropDownList($allStatus,
            ['prompt'=>'请选择状态']); ?>

   
    <?= $form->field($model, 'author_id')
    
    ?>
<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    
    <?php ActiveForm::end(); ?>
	
</div>
