# live-project
团队作业第二次——团队Github实战训练 

## 1. 最终服务器展示前端地址：[地址](http://129.204.247.165/blogdemo2/frontend/web/index.php?r=peroid%2Findex)  
## 2. 最终服务器展示后台地址：[地址](http://129.204.247.165/blogdemo2/backend/web/index.php?r=appointment%2Findex)
## 2. 题目需求  
&emsp;&emsp;在全国人民的共同努力下，新冠肺炎疫情得到逐步缓解，国内多地已经出现零确诊。然而当前国内形势严峻，多国疫情出现大爆发，国内出现了多例的输入病例，此时国人仍不可掉以轻心，外出需要注意个人防护，特别是要佩戴好口罩。虽然国内口罩等防护用品的产能和供应量在逐步增长，但目前还不能完全充分满足需求，仍然需要按需进行预约。  
&emsp;&emsp;假如，城市A需要开发一个向社会限量供应的口罩应用，现要外包给你们组完成这个任务。  
&emsp;&emsp;管理员发布预约摇号活动
* 管理员登录
* 设置预约的开放时间和截止时间
* 设置预约时单个用户最高可预约数量
* 设置口罩总数
* 导出某次中签的名单

## 3. 分析问题  
1. 预约功能：

    * 口罩预约定时开放
    * 开放预约后，市民可以进行登记；登记内容包括①真实姓名；②身份证号；③手机号；④预约口罩数量（如果中签，想要买几个口罩）
    * 如果手机号或者身份证号已经在本次摇号登记过了，预约失败
    * 如果手机号或者身份证号在此前三次预约中成功中签，预约失败
    * 否则预约成功，给出不重复的预约编号
    * 预约定时关闭
    * 为方便测试，请在预约页面提供两个按钮，作用分别是开始新的预约和结束当前预约；
    * 为方便测试，请在预约页面提供设置口罩总量的方法
    * 登记时单个用户最高可预约口罩数量，默认为3个

2. 中签查询功能：

    * 用户输入自己的预约编号，显示是否中签
    * 如果中签，生成购买凭证，包含姓名、身份证号、电话号和购买数量
&emsp;&emsp;
## 4. 分工情况  

<div align=center><img src="https://images.cnblogs.com/cnblogs_com/yjchen/1645851/o_200315135822fengong.png"/></div>   

## 5. 总结  
&emsp;&emsp;这次的作业十分贴合主题，我们今天早上接收到任务之后，要在晚上之前完成变成任务，对于大家来说都是不小的挑战，感谢的是，队友们上学期的web学的很好，也很好的应用了yii这个很好的php框架，完成了任务。同学们非常努力的完成了自己的编码任务，过程中能够更好的学习web，php语言，以及相互分工如何协调，最难的就是最后的整合问题了，相信每个小组也都是这样过五关斩六将，集体努力，慢慢发挥着自己的光和热。  

<div align=center><img src="https://images.cnblogs.com/cnblogs_com/yjchen/1645851/o_2003151145491.png"/></div>  
<div align=center><img src="https://images.cnblogs.com/cnblogs_com/yjchen/1645851/o_2003151145552.png"/></div>  
<div align=center><img src="https://images.cnblogs.com/cnblogs_com/yjchen/1645851/o_2003151146003.png"/></div>  

<div align=center><img src="https://images.cnblogs.com/cnblogs_com/yjchen/1645851/o_2003151232414.png"/></div>  
<div align=center><img src="https://images.cnblogs.com/cnblogs_com/yjchen/1645851/o_2003151232475.png"/></div>  
