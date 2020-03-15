<?php
use common\models\Comment;
use common\models\Likes;
use common\models\Lives;
use common\models\Post;
ini_set('date.timezone','Asia/Shanghai');
$this->title = '应援弹幕';
?> 
<link rel='stylesheet' href='css/comment.css' /> 
<div class='top'>
<h3>&nbsp&nbsp&nbsp您可以在此页面为喜爱的歌曲投稿应援弹幕</h3>
<h3>&nbsp&nbsp&nbsp也可以对参与投稿的应援词表达你的态度 </h3>
<h3>&nbsp&nbsp&nbsp期待您投稿或支持的应援弹幕在直播间大放异彩~ (仅显示未经管理员审核的投稿)</h3>
</div> 

<style>
    .butt{
	height:30px;
	width:30px;
	background:url('images/dz.jpg') no-repeat;
	background-size: cover;
	border-style: none;
	float:right;
	position:relative;
	top:-40px;
	right:150px;
    }
    .buttt{
	height:30px;
	width:30px;
	background:url('images/dc.png') no-repeat;
	background-size: cover;
	border-style: none;
	float:right;
	position:relative;
	top:-40px;
	right:50px;
    }
     body{
 	background-color:#B9D0FD;
 }
 .la{
		  background-color: #FFCDB5;
			display: block;/*将a变成块状*/
			height: 100%;/*设置块的长度*/
			line-height: 70px;/*设置字体在块中的高度*/
			margin: 0px 0px;/*块里的高宽通过margin设置*/
			text-align: center;/*字体居中*/
			text-decoration: none;/*去掉下划线*/
			font-size: 25px;
			color:black;
			z-index:999;
    background-color: #469A99;
	color:white;
}
</style>
<script src="clienthint.js"></script> 
<div class='side'>
	<?php 
	print_r("<table class=\"table\">
   <thead>
      <tr class='ptr'>
	    
        <th style=\"width:350px;\">急需应援弹幕歌曲top10</th>
      </tr>
      <tr class='ptr'>
	    
        <th style=\"width:350px;\">（点击歌名进行投稿）</th>
      </tr>
   </thead>
");
	$post = Post::find()->all();
	$arr=array();
	$aaa=array();
	for($i=0;$i<count($post);$i++){
	    $aaa['title']=$post[$i]->title;
	    $aaa['content']=$post[$i]->content;
	    if($post[$i]->content=="暂无"){
	        $aaa['jud']=1;
	    }
	    else{
	        $aaa['jud']=0;
	    }
	    $aaa['tags']=$post[$i]->tags;
	    $aaa['author']=$post[$i]->author_id;
	    $aaa['count']=Lives::find()->where(['name'=>trim($post[$i]->title)])->count();
	    //$aaa['count']=Lives::find()->where(['like','name',trim($post[$i]->title)])->count();
	    $aaa['url']=$post[$i]->url;
	    $arr[$i]=$aaa;
	}
	foreach ( $arr as $key => $row ){
	    $jud[$key] = $row ['jud'];
	    $count[$key] = $row ['count'];
	}
	array_multisort( $jud, SORT_DESC, $count, SORT_DESC,$arr);
	for($j=0;$j<10;$j++){
	    $tcond = ['like', 'name', $arr[$j][title]];
	    $temp = Lives::find()->where($tcond)->all();
	    foreach ( $temp as $key => $row ){
	        $date[$key] = $row ['date'];
	    }
	    array_multisort( $date, SORT_DESC,$temp);
	    // var_dump($temp);
	    print_r("
<tbody>
      <tr >
         <td  >"."<a target=\"blank\" href=\"".$arr[$j][url]."\">".$arr[$j][title]."</td>
      </tr>
</tbody>
");
	}
	print_r("</table>");
	?>
</div>
<?php
    $post=Post::find()->all();
    $arr=array();
    $aaa=array();
    for($i=0,$t=0;$t<count($post);$t++){
        $con=['post_id'=>$post[$t]->id,'status'=>'1'];
        
        $info=Comment::find()->where($con)->all();
        
        if(count($info)!=0){
            $aaa['id']=$post[$t]->id;
            $aaa['title']=$post[$t]->title;
            $aaa['content']=$post[$t]->content;
            if($post[$t]->content=="暂无"){
                $aaa['jud']=1;
            }
            else{
                $aaa['jud']=0;
            }
            $aaa['tags']=$post[$t]->tags;
            $aaa['author']=$post[$t]->author_id;
            $aaa['count']=Lives::find()->where(['name'=>trim($post[$t]->title)])->count();
            //$aaa['count']=Lives::find()->where(['like','name',trim($post[$i]->title)])->count();
            $aaa['url']=$post[$t]->url;
            $arr[$i]=$aaa;  
            $i++;
        }
    }
    foreach ( $arr as $key => $row ){
        $_jud[$key] = $row ['jud'];
        $_count[$key] = $row ['count'];
        $_date[$key] = $row ['date'];
    }
    array_multisort( $_jud, SORT_DESC, $_count, SORT_DESC, $_date, SORT_DESC,$arr);
    for($i=0;$i<count($arr);$i++){
        $con=['post_id'=>$arr[$i]['id']];
        $info=Comment::find()->where($con)->all();
        if(count($info)!=0){
            $ar=array();
            $aa=array();
            for($k=0;$k<count($info);$k++){
                $aa['id']=$info[$k]->id;
                $aa['name']=$info[$k]->name;
                $aa['content']=$info[$k]->content;
                $aa['create_time']=$info[$k]->create_time;
                $cond=['comment_id'=>$info[$k]->id];
                $pos = Likes::find()->where($cond)->all();
                $aa['count']=count($pos);
                $ar[$k]=$aa;
            }
            $sort=array_column($ar,'count');
            array_multisort($sort,SORT_DESC,$ar);
            echo "<div class='dcomment'>";
            
            print_r("<a href=\"".$arr[$i]['url']."\">");
            print_r("<h3 class='title'>&nbsp".$arr[$i]['title']."</h3></a>");
            for($j=0;$j<count($info);$j++){
                
                print_r("<em class='content'>&nbsp&nbsp&nbsp".$ar[$j]['content']."</em><br><br>");
                if($ar[$j]['name']==""){
                    echo "<em class='id'>&nbsp&nbsp&nbsp匿名毛怪</em>";
                }
                else{
                    echo "<em class='id'>&nbsp&nbsp&nbsp".$ar[$j]['name']."</em>";
                }
                print_r("<em class='time'>&nbsp&nbsp&nbsp".date('Y-m-d H:i:s',$ar[$j]['create_time'])."</em><br>");
                echo "<form>
<input class='butt' type=\"button\" id=\"txt1\"
value=''
onclick=\"showHint(".$ar[$j]['id'].",".$ar[$j]['count'].")\">
</form>
<p><span class='num' id=\"txtHint".$ar[$j]['id']."\">".$ar[$j]['count']."</span></p>";
                echo "<button class='buttt' disabled=\"true\"></button>";
                echo "<hr/>";
            }
            echo "&nbsp&nbsp&nbsp共".count($info)."条投稿";
            $commentModel =new Comment();
            echo $this->render('_guestform',array(
                'id'=>$arr[$i]['id'],
                'commentModel'=>$commentModel,
            ));
            echo "</div>";
            echo "<br>";
        }
        
    }
?>
<script>
var head=document.getElementById("yydm");
head.className='la';
var all_options = document.getElementById("where").options;
for (i=0; i<all_options.length; i++){
    if (all_options[i].id == '3')  // 根据option标签的ID来进行判断  测试的代码这里是两个等号
    {
       all_options[i].selected = true;
    }
 }
</script>