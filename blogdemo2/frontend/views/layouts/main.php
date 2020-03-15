<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width, initial-scale=1,minimum-scale=0.5,maximum-scale=2.0"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style type="text/css">
    a:hover{
         text-decoration:none;
    }
		 .b{/*设置导航栏的框框*/
		 display: block;/*将a变成块状*/
		 width:100%;
		  height:75px;
		  background-color: black;
		  position:fixed; 
		  z-index:998;
		}
		@media (max-width: 1200px) {
		    .cc{
		      display:none;
		    }
		    .se{
		  background-color: black;
			color:white;
		  width:150px;
		  height:75px;
		  position:fixed;
		  left:calc(100% - 150px);
		  z-index:999;
		  font-size: 25px;
		}
		}
		 .cc{
		  width:200px;
		  background-color: black;
		  height:100%;
			list-style-type: none;/* 去掉li前的点 */
			float: left;/*将li设置成做浮动，变为联动*/
			text-align: center;/*字体居中*/
			position: relative;
			left:700px;
			color: white;
			z-index:998;
		}
		.cc:hover{
		  background-color:green;
		}
		 .a{
		 background-color: black;
			display: block;/*将a变成块状*/
			height: 100%;/*设置块的长度*/
			line-height: 70px;/*设置字体在块中的高度*/
			margin: 0px 0px;/*块里的高宽通过margin设置*/
			text-align: center;/*字体居中*/
			text-decoration: none;/*去掉下划线*/
			font-size: 25px;
			color:white;
			z-index:998;
		}
		.aa{
		  background-color: #FFCDB5;
			display: block;/*将a变成块状*/
			height: 100%;/*设置块的长度*/
			margin: 0px 0px;/*块里的高宽通过margin设置*/
			font-size: 0px;
			z-index:998;
			background: url('images/2.webp') no-repeat;
            background-size: cover;
            border-style: none;
		}
		.ccc{
		height:75px;
		    width:200px;
		   background-color: #FFCDB5;
			list-style-type: none;/* 去掉li前的点 */
			float: left;/*将li设置成做浮动，变为联动*/
			text-align: center;/*字体居中*/
			position: relative;
			left:21.7%;
			z-index:998;
			border-style: none;
			overflow: hidden;
			
		}
		.a:hover{
			background-color: #469A99;
			color:white;
		}
	
		.footer{
		  background-color:#000;
		  color:white;
		  position: relative;
          height: 100px;
		  font-size:20px;
		  bottom:0;
		  width:100%;
		  clear: both;
		}

		
		.header{
		  width:100%;
		  background-color:blue;
		}
		.op{
		  width:100px;
		  height:100px;
		}
	</style>
</head>
</html>
<body>
<?php $this->beginBody() ?>

<div class="wrap" >

	
<div class='header'>
		<ul class=b>
			<li class=cc><a id='yy' class=a href="/blogdemo2/frontend/web/index.php?r=peroid%2Findex"><font color="">预约</font></a></li>
			<li class=cc><a id='cx' class=a href="/blogdemo2/frontend/web/index.php?r=appointment%2Findex"><font color="">查询</font></a></li>
		</ul>
		<select id='where' class='se' name="select" onchange="self.location.href=options[selectedIndex].value">
<OPTION id='3' class='op' value='/blogdemo2/frontend/web/index.php?r=site%2Fassistance'>查询</OPTION>
</select>
</div>
		
		    <?php
        

  

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    ?>
    
     <div class="container" >
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
   

<footer class="footer" >
        <p style="position: absolute;right:80%;" class="pull-left">&copy; 第一小组 <?= date('Y') ?></p>

</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

