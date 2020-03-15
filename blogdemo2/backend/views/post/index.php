
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Poststatus;
use yii\web\JsExpression;
use common\models\Lives;
use common\models\Post;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '歌单管理';
$this->params['breadcrumbs'][] = $this->title;

if(isset($_GET['submit'])){
    $model=new Lives();
    $title=str_replace("|", " ", $_GET['title']);
    $model->name=$title;
    $model->time=$_GET['time'];
    $model->date=$_GET['date'];
    if($model->save()){
        echo "保存成功";
    }
    echo "<meta http-equiv=\"refresh\"
content=\"0;url=index.php\"/>";
}
?>


<div class="post-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建歌单', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('为歌单添加附件', ['enclosure'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            /*['attribute'=>'id',
                'contentOptions'=>['width'=>'30px'],
            ],*/
            //'title',
            [
                'attribute'=>'title',
                'label'=>'歌名',
            ],
            'content',
            //'author_id',
            [
                'attribute'=>'author_id',
                'label'=>'歌手',
            ],
         /*   [
                'attribute'=>'authorName',
                'label'=>'歌曲作者',
                'value'=>'author.nickname',
                
            ],*/
           // 'tags:ntext',
            [
                'attribute'=>'tags',
                'label'=>'歌曲类型',
                
            ],
            //'status',
            /*['attribute'=>'status',
             'value'=>'status0.name',
             'filter'=>Poststatus::find()
                ->select(['name','id'])
                ->orderBy('position')
                ->indexBy('id')
                ->column(),
            ],*/
            // 'create_time:datetime',
             //'update_time:datetime',
            ['attribute'=>'update_time',
             'format'=>['date','php:Y-m-d H:i:s'],
            ],
            /*[
                'attribute'=>'type',
                'label'=>'文章类型',
                'value'=>'classification.type',
            ],*/
            
            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete} {add}',
                'buttons'=>[
                    
                
                'add'=>function($url,$model,$key)
                {
                    $options=[
                        'title'=>Yii::t('yii','添加'),
                        'aria-label'=>Yii::t('yii','添加'),
                        'data-pjax'=>'0',
                    ];
                    return Html::a('<span class="glyphicon glyphicon-plus"></span>',$url,$options);
                },
                
                ],
            ],
        ],
    ]); ?>
     <?php 
//          $post = Post::find()->all();
//          $arr=array();
//          $aaa=array();
//          $count=count($post);
//          for($i=0;$i<count($post);$i++){
//              $aaa['title']=$post[$i]->title;
//              $aaa['content']=$post[$i]->content;
//              $aaa['author_id']=$post[$i]->author_id;
//              $aaa['tags']=$post[$i]->tags;
//              $aaa['status']=$post[$i]->status;
//              $arr[$i]=$aaa;
//              $post[$i]->delete();
//          }
     
//          for($i=0;$i<$count;$i++){
//                          $model=new Post();
//                          $model->title=trim($arr[$i]['title']);
//                          $model->content=trim($arr[$i]['content']);
//                          $model->author_id=trim($arr[$i]['author_id']);
//                          $model->tags=trim($arr[$i]['tags']);
//                          $model->status=trim($arr[$i]['status']);
//                          if($model->save()){
//                              echo "wdnmd";
//                          }
//          }
         
//             $file = fopen("new.txt", "r") or exit("Unable to open file!");
//             $file1 = fopen("gqb.txt", "r") or exit("Unable to open file!");
//             while(!feof($file))
//              {
//                  $line=fgets($file);
             
//                  $line=str_replace("\t","_",$line);
             
//                  $arr = explode('_' , $line);
// //                 $line1=fgets($file1);
             
// //                 $line1=str_replace("\t","_",$line1);
         
// //                 $arr1 = explode('_' , $line1);
// //                 var_dump($arr[0]);
// //                   var_dump($arr[1]);
// //                   var_dump($arr[2]);
// //             var_dump($arr[3]);
//                    var_dump($arr);
//                  $model=new Post();
//                  $model->title=$arr[0];
//                  $model->content=$arr[1];
//                  $model->tags=$arr[2];
//                  $model->author_id=$arr[3];
//                  $model->status=2;
//                //  break;
// //                  if($model->save()){
// //                      echo "wdnmd";
// //                  }
//                  echo "<br>";
//              }
//              fclose($file);
         
     ?>
    </div>

