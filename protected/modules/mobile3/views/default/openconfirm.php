<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=M_JS_URL;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=M_JS_URL;?>open.win.js"></script>

</head>
<body style="background: #fff;">
    <!--列表 -->
    <div class="htyg_tc">
        <ul>
            <li class="htyg_tc_1">
确认接手
</li>
            <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?=M_IMG_URL;?>sj-tc.png"></a> </li>
        </ul>
    </div>
    
    <script type="text/javascript">
        function Submit() {
            var platformTypeStr = $("#PlatformTypeStr").val();
            var FineTaskClassType= $("#FineTaskClassType").val();
            var taskPriceEnd= $("#taskPriceEnd").val();
            window.parent.location.href = '/mobile/default/accepttask/platformtype/'+platformTypeStr+"/taskPriceEnd/"+taskPriceEnd+"/fineTaskClassType/"+FineTaskClassType+'.html';
        }
    </script>
    <!--添加弹窗 取消任务 -->
<form action="<?php echo $this->createUrl('default/accepttask');?>" id="fm" method="post"> 
       <div style="width: 95%">
<style>
    .infobox
    {
        background-color: #fff9d7;
        border: 1px solid #e2c822;
        color: #333333;
        padding: 5px;
        padding-left: 30px;
        font-size: 13px;
        --font-weight: bold;
        margin: 0 auto;
        margin-top: 10px;
        margin-bottom: 10px;
        width: 95%;
        text-align: left;
    }
    .errorbox
    {
        background-color: #ffebe8;
        border: 1px solid #dd3c10;
        margin: 0 auto;
        margin-top: 10px;
        margin-bottom: 10px;
        color: #333333;
        padding: 5px;
        padding-left: 30px;
        font-size: 13px;
        --font-weight: bold;
        width: 85%;
    }
</style>
        </div>  
        <div class="yctc_660 ycgl_tc_1" style="margin-top: 1px">
            <input id="PlatformTypeStr" name="PlatformTypeStr" type="hidden" value="<?=@$_GET['platformtype']?>">
            <input id="FineTaskClassType" name="FineTaskClassType" type="hidden" value="<?=@$_GET['fineTaskClassType']?>">     
			<input id="taskPriceEnd" name="taskPriceEnd" type="hidden" value="<?=@$_GET['taskPriceEnd']?>">
            <center>
                <ul>
                    <li class="fpgl-tc-qxjs" style="margin-right: 350px">确认接手 </li>
                    <li>
                        <p style="font-size: 14px; margin-left: 10px">
                            当前队伍人数大于100，确认接手？？</p>
                    </li>
                    <li class="fpgl-tc-qxjs_4" style="margin-left: 25px">
                        <p>
                            <input class="input-butto100-hs" type="button" id="btnSubmit" onclick="Submit()" value="确认">
                        </p>
                        <p>
                            <input onclick="self.parent.$.closeWin()" class="input-butto100-ls" type="button" value="取消"></p>
                    </li>
                </ul>
            </center>
        </div>
</form>


</body></html>