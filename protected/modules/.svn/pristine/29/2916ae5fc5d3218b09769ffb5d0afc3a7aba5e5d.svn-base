<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>css.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>weui.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>
    
	    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>/myUpload/css/upimg.css">
    <script type="text/javascript" src="<?=SITE_URL;?>/myUpload/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?=SITE_URL;?>/myUpload/js/myUploadmobile.js"></script>	
    <script src="<?=M_JS_URL;?>CustomFunc.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?=M_CSS_URL;?>index.css">


    <style type="text/css">
        .show_img img
        {
            width: 59px;
            height: 59px;
        }
        .title_h3
        {
            height: 35px;
            line-height: 35px;
            border-bottom: 1px solid #ddd;
            padding-left: 3%;
            color: #888;
        }
        .text p
        {
            margin-bottom: 6px;
            line-height: 20px;
        }
        .title_h5
        {
            height: 25px;
            line-height: 25px;
            font-size: 12px;
        }
        .app_submit
        {
            position: fixed;
            bottom: 0;
            height: 40px;
            line-height: 40px;
            text-align: center;
            width: 100%;
			left:0;
			z-index:1111111;
        }
        .app_submit a
        {
            display: block;
            background: #f90;
            color: #fff;
        }
        .textarea_2
        {
            background: #eee;
            min-height: 50px !important;
            padding: 5px;
        }
        .view_h2
        {
            padding-bottom: 2%;
            border-bottom: 1px dashed #ccc;
            isplay: block;
            margin-left: 5px;
            margin-top: 5px;
        }
        .show_img li
        {
            width: 18.2%;
            margin-right: 1.6%;
            float: left;
            display: block;
            margin-left: 0px;
        }
        .upload li
        {
            height: 70px !important;
        }
    </style>

    
</head>
<body>
    <div class="cm" style="padding-bottom: 50px;" id="bigbox" title="卖家提现">
           <?php $this->renderPartial("/public/header");?>
        
<form action="<?php echo $this->createUrl('finance/telkefu');?>" enctype="multipart/form-data" id="fm" method="post">
<input type="hidden" value="<?=$info->id?>" name="transferid">       <!--晒图评价页面-->

        <div class="View-reason">
            <h2 class="view_h2">
                <a href="javascript:void(0)" onclick="history.go(-1)">返回</a></h2>
        <div class="evaluate">
            <div class="title_h3">转账信息</div>
			<p>订单编号：<?=$info->ordersn?></p>
			<p>提现状态：<?php 
			if (@$info->arrivestatus==0) {
					switch ($info->transferstatus) {
						case 0:
							echo '未转账';
							break;
						case 1:
							echo '等待转账';
							break;
						case 2:
							echo '已转账';
							break;
						case 3:
							echo '转账失败';
							break;
						case 4:
							echo '未到账';
							break;
					}
				}else{
					echo '已到账';
				}
			?></p>
			<p>申请时间：<?=date('Y-m-d H:i:s',$info->addtime)?></p>            
        </div>				
				
        </div>
        <!--<div class="hxt">
        </div>-->
        <!--灰色条-->
       

        <!--灰色条-->
        <div class="View-reason show_img1">
            <div class="title_h3">上传截图：</div>
            <div class="padding_2_3">
                    <ul class="upload">                        
                        <div>
                            <div id="upimg1"></div>
                    <script language="javascript">
                        $("#upimg1").upload({isMulti:true, pictureInputName:'img1',defaultimg:"<?=@$tfinfo['img']?>"});
                    </script>
                        </div>
                    </ul>
					<div style="clear:both"></div>
            </div>
			<div class="title_h3">文字说明：</div>
				<div class="padding_2_3">
                    
					<textarea rows="4" cols="30"  name="content" id="contenttxt" class="textarea_1"><?=$tfinfo['content']?></textarea>
            </div>
			
				<div class="app_submit">
                <a href="javascript:void(0)" id="btnGetPoint" onclick="Submit()">提交审核</a></div>
			
            <!--提交审核的窗口-->

            <!--提交审核的窗口-->
        </div>

</form>    
	<script language="javascript">
    function Submit() {
        if ($(":input[name=img1]").val() == null) {
            $.openAlter('请上传截图', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        if ($("#contenttxt").val() == null||$("#contenttxt").val() =='') {
            $.openAlter('请填写文字说明', '提示', { width: 250, top: 280, height: 50 });
            return false;
        }
        $("#fm").submit();
    }
    </script>
    <!--晒图评价页面-->

    </div>
       <?php $this->renderPartial("/public/footer");?>  


</body></html>