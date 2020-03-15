<?php
namespace frontend\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
class Navigation extends Widget
{
    public $Classfications;
    
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $tagString='';
        $fontStyle=array("6"=>"danger",
            "5"=>"info",
            "4"=>"warning",
            "3"=>"primary",
            "2"=>"success",
        );
        
        foreach ($this->Classfications as $Classfication=>$weight)
        {
            $url = Yii::$app->urlManager->createUrl(['post/index','PostSearch[type]'=>$Classfication]);
            $tagString.='<a href="'.$url.'">'.
                ' <h'.$weight.' style="display:inline-block;"><span class="label label-'
                    .$fontStyle[$weight].'">'.$Classfication.'</span></h'.$weight.'></a>';
        }
        return $tagString;
        
    }
    
    
    
    
    
    
    
    
    
}