<?php

/* @var $this yii\web\View */

use common\models\Post;
use common\models\User;
use common\models\Comment;
use common\models\Lives;
use common\models\Adminuser;
$this->title = '憨八嘎';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>歌单系统</h1>

        <p class="lead">Welcome</p>

        <p></p>
    </div>

    
	

    <table class="table">
    <caption>歌单系统统计信息</caption>
   <thead>
      <tr>
         <th>用户数</th>
         <th>直播记录数</th>
         <th>歌单数</th>
        
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><?= Adminuser::find()->count();?></td>
         <td><?= Lives::find()->count();?></td>
         <td><?= Post::find()->count();?></td>
      </tr>
   </tbody>
</table>
</div>
