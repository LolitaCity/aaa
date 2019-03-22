<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
     <link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>index.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>

</head>
<body style="background: #fff;">
    <!--列表 -->
    <div class="htyg_tc">
        <ul>
            <li class="htyg_tc_1">
    <h2>
        剩余退出任务次数：<b style="font-size:18px;  font-weight:900; color:Yellow"><?php echo $count;?></b> 次</h2>
</li>
            <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()" style="display: none;">
                <img src="<?=M_IMG_URL?>sj-tc.png"></a> </li>
        </ul>
    </div>
    
    <script type="text/javascript">
        $(function () {

            $("#task1").click(function () {
                if ($(this).is(":checked")) {
                    $("#BrushIsAbandon").val("True");
                }
                else {
                    $("#BrushIsAbandon").val("False");
                }
            });
            $("#task2").click(function () {
                if ($(this).is(":checked")) {
                    $("#BrushIsAbandonShop").val("True");
                }
                else {
                    $("#BrushIsAbandonShop").val("False");
                }
            })
            $("#imgeColse").hide();
            $("#btnSubmit").click(function () {
                var cnt = $("#submitCnt").val();
                if (cnt == "0") {
                    $("#btnSubmit").val("确认退出...");
                    $("#submitCnt").val("1");
                    $("#fm").submit(); 
                }
                else {
                    return false;
                }

            });
        })
        var isValiPass = 'True';

    </script>
    <style type="text/css">

    .htyg_tc {
    height: 43px;
    background: #4882f0;
}
    .black_overlay1 { position: fixed; top: 0%; left: 0%;  width: 100%;  height: 100%;  background-color: black;  z-index: 1001;  -moz-opacity: 0.2;  opacity: .2; filter: alpha(opacity=2);}
    .ycgl_tc1{position: fixed; z-index: 1002; font-size: 14px; font-family: "微软雅黑";}
    .ycgl_tc1{width:80%; margin-left:10%; top:25%;  min-height:250px;}
    .tc_exit{width:80%; margin-left:6%; top:20%; background:#fff;}
    .tc_exit h2{height:35px; line-height:35px; background:#4882f0; color:#fff; padding-left:15px; font-size:14px;}
    .tc_exit1{padding:0px;}
    .tc_exit1 h3{ font-size:14px;}
    .tc_exit_text{padding:5px 5%; width:100%; margin-top:8px; height:35px;}
    .tc_checkbox input[type="checkbox"] {
        position: absolute;
        clip: rect(0,0,0,0);
        z-index:99;
    }
    .tc_checkbox input[type="checkbox"] + label {
    background:url('<?=M_IMG_URL?>check_n.png') no-repeat left center;
    height:30px; line-height:30px;border-radius:3px; padding:0px 5px 0px 25px;
    display:block;
    color:#222;
    background-size:16px;
    }
    .tc_checkbox input[type="checkbox"]:checked + label,
    .tc_checkbox input[type="checkbox"]:active + label {
        background:url('<?=M_IMG_URL?>checked.png') no-repeat left center;
        background-size:16px;
    }
    .exit_anniu{width:170px; margin:6px 40px;}
    .exit_anniu .bg_blue{margin-right:10px;}
    .exit_anniu a{float:left;}

        .errorbox {
    background-color: #ffebe8;
    border: 1px solid #dd3c10;
    margin: 0 auto;
    margin-top: 38px;
    margin-bottom: 10px;
    color: #333333;
    padding: 5px;
    padding-left: 30px;
    font-size: 13px;
    --font-weight: bold;
    width: 85%;
}
</style>
    <!--添加弹窗 取消任务 -->
<form action="<?php echo $this->createUrl('task/taskexit')?>" enctype="multipart/form-data" id="fm" method="post">        <div style="width: 95%">
            <input id="TaskID" name="taskid" type="hidden" value="<?=$taskid;?>">
            <input data-val="true" data-val-required="BrushIsAbandon 字段是必需的。" id="BrushIsAbandon" name="reasonType" type="hidden" value="False">
            <input data-val="true" data-val-required="BrushIsAbandonShop 字段是必需的。" id="BrushIsAbandonShop" name="notaceeptshop" type="hidden" value="False">
        </div>  
        <div class="ycgl_tc1 tc_exit">
            <div class="tc_exit1">
                <h3 class="t_red">
                    请确认是否退出当前任务？</h3>
                
                <textarea class="tc_exit_text" cols="20" id="txtRemark" name="Remark" placeholder="动动小指头，说说你退出任务的原因吧~（选填）" rows="2"></textarea>
                <ul class="tc_checkbox">
            
                    <li>
                        <input type="checkbox" id="task2">
                        <label for="task2">
                            不再接手此店铺任务</label>
                    </li>
                </ul>
                
            </div>
            <div class="exit_anniu" style="margin-top:30px">
                <a href="javascript:void(0)" class="bg_blue anniu_80" id="btnSubmit">确定</a>
                <input type="hidden" id="submitCnt" value="0">
                <a href="javascript:void(0)" onclick="self.parent.$.closeWin()" class="bg_f90 anniu_80">
                    返回</a>
            </div>
          
        </div> 
</form>


</body></html>