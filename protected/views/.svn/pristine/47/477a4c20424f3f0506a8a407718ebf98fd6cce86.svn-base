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
            查看我的截图
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?=S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>
<?php $taskeval=Taskevaluate::model()->find('usertaskid='.$usertask->id);?>

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
    .fitem input
    {
        width: 160px;
    }
</style>
<div class="yctc_458 ycgl_tc_1" style="width: 600px; height: 530px; overflow: auto">
    <div class="fitem" style="margin-bottom: 20px;">
        <?php if ($usertask->tasktwoimg){?>
        <div style=" width:280px; float:left">
            <label for="FullName">
                搜索截图：</label><br>
            <a href="<?=$usertask->tasktwoimg?>" onclick="javascript：void(0)" target="_blank" title="点击查看原图">
                <img src="<?=$usertask->tasktwoimg?>" style="width: 240px; height:240px;padding:0px;margin-left:30px;vertical-align:middle;">
            </a>
        </div>
        <?php }if ($usertask->orderimg){?>
        <div style=" width:280px; float:left">
            <label for="FullName">
                订单截图：</label><br>
            <a href="<?=$usertask->orderimg?>" onclick="javascript：void(0)" target="_blank" title="点击查看原图">
                <img src="<?=$usertask->orderimg?>" style="width: 240px; height:240px;padding:0px;margin-left:30px;vertical-align:middle;">
            </a>
        </div>
        <?php }if ($taskeval->postimg){?>
        <div style=" width:280px; float:left">
            <label for="FullName">
                好评截图：</label><br>
            <a href="<?=$taskeval->postimg?>" onclick="javascript：void(0)" target="_blank" title="点击查看原图">
                <img src="<?=$taskeval->postimg?>" style="width: 240px; height:240px;padding:0px;margin-left:30px;vertical-align:middle;">
            </a>
        </div>
        <?php }?>
    </div>
</div>
<div>
    <p class="jsgl_4" style="margin-left:240px;">
        <input onclick="javascript:self.parent.$.closeWin()" class="input-butto100-ls" type="button" value="关闭 "></p>
</div>



</body>
</html>