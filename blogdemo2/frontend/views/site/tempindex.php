<?php

/* @var $this yii\web\View */

use common\models\Post;
use common\models\User;
use common\models\Comment;
use common\models\Lives;
use common\models\Adminuser;
$this->title = '憨八嘎';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width, initial-scale=1,minimum-scale=0.5,maximum-scale=2.0"/>
<!--可无视-->

<style>
body{
    background-color:pink;
}
#p{
	width:185px;
	margin:0px 10px 0px 10px;
	border:20px;
	solisd:#000;
	position:relative;
	left:3.5%;
}
</style>
</head>

<body>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
    <style>
    {
        color:black;
    }
    a:hover{
         text-decoration:none;
    }
        /* 大图尺寸 */
        #gallery.swiper-container {
            margin-top:20px;
            width: 1000px;
            height: 500px;
        }
        /* 照片墙尺寸 */
        #thumbs.swiper-container {
            width: 88%;
            height: 200px;
            display: none;
        }
        /* 图片 */
        .photo {
            width: 100%;
            height: 100%;
        }
        /* 轮播的图片 */
        .photo1 {
            background: url('images/zbgd.webp') no-repeat;
            background-size: cover;
        }
        .photo2 {
            background: url('images/yydm.webp') no-repeat;
            background-size: cover;
        }
        .photo3 {
            background: url('images/zbjl.webp') no-repeat;
            background-size: cover;
        }
        .photo4 {
            background: url('images/gywm.webp') no-repeat;
            background-size: cover;
        }
        #thumbs .swiper-slide {
            width: 25%;  
            height: 100%;  
            opacity: 0.4;  
            background-size: cover;  
            background-position: center;  
        }
        #thumbs .swiper-slide-thumb-active {
            opacity: 1;  
        }
    </style>
    
</head>
<body>
    <!-- 大图 -->
    <div id="gallery" class="swiper-container" style="margin-bottom: 10px;">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="/blogdemo2/frontend/web/index.php?r=lives%2Findex"><div class="photo photo1"></div></a>
            </div>
            <div class="swiper-slide">
                <a href="/blogdemo2/frontend/web/index.php?r=site%2Fassistance"><div class="photo photo2"></div></a>
            </div>
            <div class="swiper-slide">
                <a href="/blogdemo2/frontend/web/index.php?r=post%2Findex"><div class="photo photo3"></div></a>
            </div>
            <div class="swiper-slide">
                <a href="/blogdemo2/frontend/web/index.php?r=site%2Fabout"><div class="photo photo4"></div></a>
            </div>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <!-- 照片墙 -->
    <div id="thumbs" class="swiper-container" >
        <div class="swiper-wrapper" >
            <div class="swiper-slide">
                <div class="photo photo1"></div>
            </div>
            <div class="swiper-slide">
                <div class="photo photo2"></div>
            </div>
            <div class="swiper-slide">
                <div class="photo photo3"></div>
            </div>
            <div class="swiper-slide">
                <div class="photo photo4"></div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/swiper/js/swiper.min.js"> </script>
    <script>
        // 照片墙组件
        var thumbsSwiper = new Swiper('#thumbs',{
            spaceBetween: 10,
            slidesPerView: 4,
            watchSlidesVisibility: true     //防止不可点击
        })
        // 轮播对象
        var gallerySwiper = new Swiper('#gallery',{
            spaceBetween: 0,
            // 循环
            loop: true,
            // 自动播放
            autoplay: true,
            // 自动播放间隔
            delay: 5000,
            thumbs: {
                swiper: thumbsSwiper,
                // 照片墙上当前展示的照片的类
                slideThumbActiveClass: 'swiper-slide-thumb-active',
                // 照片墙上当前未展示的照片的类
                thumbsContainerClass: 'swiper-container-thumbs'
            },
            navigation: {
                // 下一张的箭头的类
                nextEl: '.swiper-button-next',
                // 上一张的箭头的类
                prevEl: '.swiper-button-prev'
            }
        })
    </script>
</body>
</html>


<div style="height: 200px;width:100%;background-color:pink;">
	<div>
		<a href="https://www.douyu.com/2550505" target="_blank"><img id="p" src="images/dy.webp" alt=""/></a>	
		<a href="https://space.bilibili.com/11073" target="_blank"><img id="p" src="images/blbl.webp" alt=""/></a>		
		<a href="https://music.163.com/#/artist/album?id=1049179" target="_blank"><img id="p" src="images/wyy.webp" alt=""/></a>
		<a href="http://5sing.kugou.com/hanser/default.html" target="_blank"><img id="p" src="images/5s.webp" alt=""/></a>
		<a href="https://jq.qq.com/?_wv=1027&k=5kADOR0" target="_blank"><img id="p" src="images/qq.webp" alt=""/></a>
		<br />
		<a href="https://yuba.douyu.com/group/765880" target="_blank"><img id="p" src="images/yb.webp" alt=""/></a>	
		<a href="https://weibo.com/hansersan" target="_blank"><img id="p" src="images/wb.webp" alt=""/></a>	
		<a href="https://y.qq.com/n/yqq/singer/000c2vQb13oq5I.html" target="_blank"><img id="p" src="images/qqyy.webp" alt=""/></a>	
		<a href="https://www.yy.com/25505055" target="_blank"><img id="p" src="images/yyyy.webp" alt=""/></a>	
		<a href="https://pan.baidu.com/s/1JDZT3VFTLfHTBRY-rys6Gw" target="_blank"><img id="p" src="images/mxmx.webp" alt=""/></a>
	</div>
</div>

</body>
</html>
