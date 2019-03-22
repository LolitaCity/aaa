<html><head>
    <title></title>
    <link href="<?=S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=S_JS;?>open.win.js"></script>
</head>
<body style="background: #fff;">
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            查看任务详情
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?=S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>
<?php

$task=Task::model()->findByPk($usertask->taskid);
$taskmodel=Taskmodel::model()->findByPk($usertask->taskmodelid);
$product=Product::model()->findByPk($usertask->proid);
$rukou=$this->liuliangrukou($task->intlet);
?>

<style type="text/css">
    .ftitle
    {
        border-bottom: 1px solid #ccc;
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px;
        padding: 5px 0;
    }
    .fitem label
    {
        display: inline-block;
        font-size: 14px;
        width: 100px;
        text-align: right;
    }
    .fitem span
    {
        display: inline-block;
        font-size: 14px;
        width: 210px;
        text-align: left;
    }
    element.style
    {
        margin-left: 0;
        margin-right: 0;
        padding-bottom: 3px;
        padding-top: 3px;
        width: 156px;
    }
    .textbox .textbox-text
    {
        border: 0 none;
        border-radius: 5px;
        font-size: 14px;
        margin: 0;
        outline-style: none;
        padding: 4px;
        resize: none;
        vertical-align: top;
        white-space: normal;
    }
    .fitem input
    {
        width: 160px;
    }
</style>
<div class="yctc_458 ycgl_tc_1" style="width: 650px; height: 610px; overflow: auto">
    <div class="ftitle">
        任务基本信息</div>
    <div class="fitem">
        <label for="FineTaskCategroy">
            任务分类：</label>
        <span><?php switch ($task->tasktype){
                case 1:echo '销量任务';break;
                case 2:echo '指定推送任务';break;
                case 3:echo '复购任务';break;
            }?></span>
        <label for="TaskID">
            任务编号：</label>
        <span><?=$usertask->tasksn;?></span>
    </div>
    <div class="fitem">
        <label for="PlatformOrderNumber">
            订单编号：</label>
        <span><?=$usertask->ordersn;?></span>
    </div>
    <div class="fitem">
        <label for="PlatformType"> 任务平台：</label>
        <span>淘宝</span>
        <label for="TaskType">
            任务类型：
        </label>
        <span><?=$rukou['terminal'];?></span>
    </div>
    <div class="fitem">
        <label for="ProductPrice">
            产品价格：</label><span><?=$taskmodel->price+$taskmodel->express;?></span>
    </div>
    <div class="fitem">
        <label for="BuyProductCount">
            拍下件数：</label>
        <span><?=$taskmodel->auction?></span>
        <label for="ProductModel">
            型号：
        </label>
        <span><?=$taskmodel->modelname?></span>
    </div>
    <div class="ftitle">
        搜索关键字</div>
    <div class="fitem">
        <label for="SearchKey">
            搜索关键字：</label>
        <input class="easyui-textbox" data-options="multiline:true" id="SearchKey" name="SearchKey" readonly="true" style="width:202px;height:35px;" type="text" value="<?=$task->keyword?>">
        <label for="SearchType">
            搜索来路：</label>
        <span><?=$rukou['intletarr'][$task->intlet]?></span>
    </div>
    <div class="fitem">
        <label for="SearchKey">
            发货城市：</label>
        <span><?=$task->sendaddress;?></span>
        <label for="SearchType">
            价格区间：</label>
        <span> <?=$task->price?> </span>
    </div>
    <div class="fitem">
        <label for="SortType">
            排序方式：</label>
        <span><?=$rukou['stype'][$task->order]?></span>
        <label for="OtherSearch">
            其他搜索：</label>
        <span><?=$task->other?></span>
    </div>
    <div class="fitem">
    </div>
    <div class="ftitle">
        任务要求</div>
    <div class="fitem" style="margin: 10px;">
        <?php if ($product->c_goods>=50){
        ?>
        <img src="<?=S_IMAGES?>2.png" title="收藏商品">
        <?php }if ($product->bookmark>=50){?>
            <img src="<?=S_IMAGES?>1.png" title="收藏店铺">
        <?php } if ($product->talk>=50){?>
            <img src="<?=S_IMAGES?>9.png" title="拍前聊">
        <?php }
        $max=0; $xhome=unserialize($product->x_home);
        if ($xhome['not']<40){
            array_shift($xhome);$max=array_search(max($xhome),$xhome);
        }
        if ($xhome[$max]>30){ 
        		$num=substr($max,-1);
        
		        switch ($num){
		            case 1:$aaa='4';break;
		            case 2:$aaa='5';break;
		            case 3:$aaa='6';break;
		            case 4:$aaa='7';break;
		            case 5:$aaa='8';break;
		        }
            ?>
            <img src="<?=S_IMAGES.$aaa?>.png" title="货比<?=$num?>家">

        <?php 
        }
        $maxsame=0; $deep=unserialize($product->deep);
        if ($deep['net']<40)
        {
            array_shift($deep);$max2=array_search(max($deep),$deep);
        }
        if ($deep[$max]>30){ 
        	$numdeep=substr($max2,-1);
        switch ($numdeep){
            case 1:$bbb='97';break;
            case 2:$bbb='98';break;
            case 3:$bbb='99';break;
        }?>

            <img src="<?=S_IMAGES.$bbb?>.png" title="店内<?=$bbb?>款其他商品">
        <?}?>

      <!--  <img src="/Content/images/AddTo/30.png" title="停5分钟">-->
    </div>
    <div class="fitem">
        <label for="TaskRemark">
            任务备注：</label>
        <textarea readonly="readonly" style="width: 70%; height: 30px; font-size: 14px"><?=$task->remark;?></textarea>
    </div>
    <div class="ftitle">
        商品信息</div>
    <div class="fitem">
        <label for="FullName">
            商品全称：</label>
        <span style="width: 500px"><?=$product->commodity_title;?></span>
    </div>
    <div class="fitem">
        <label for="Url">
            商品链接：</label>
        <textarea readonly="readonly" style="width: 70%; height: 30px; font-size: 14px"><?=$product->commodity_url;?></textarea>
    </div>
    <div class="fitem" style="margin-bottom: 20px;">
        <label for="FullName">
            商品展现图：</label>
        <a href="<?=$product->commodity_image;?>" onclick="javascript:void(0)" target="_blank" title="点击查看原图">
            <img style="width:350px;height:370px;" src="<?=$product->commodity_image;?>">
        </a>
    </div>
</div>



</body></html>