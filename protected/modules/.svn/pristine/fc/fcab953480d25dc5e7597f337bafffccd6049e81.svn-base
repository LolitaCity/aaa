<!DOCTYPE html>
<?php

    $webtitle=System::model()->findByAttributes(array("varname"=>"webtitle"));
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $webtitle->value;?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>css.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>weui.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
	</head>
<body>
<div class="cm" style="padding-bottom: 50px;" id="bigbox" title="平台公告">
       <?php $this->renderPartial("/public/header");?>
        
<div class="jsgl_pt hauto">
        <ul>
            <li class="jsgl_pt_1"><a href="javascript:void(0);" onclick="window.history.go(-1)">返回</a></li>
        </ul>
    </div>
    <div class="weui_panel" style="margin-top:0px;">
        <div class="weui_panel_hd no_line" style="text-align:center;font-size:17px;color:#fff;background-color:#bb0a0a"><?php echo $info->goods_name;?><div style="margin-top:6px"><?php echo date('Y-m-d',$info->add_time);?></div></div>
    </div>
    <!-- 内容-->
    <article class="weui_article">
        <section>
            <?php echo $info->goods_desc;?>
        </section>
    </article>

</div>

<?php $this->renderPartial('/public/footer');?>
</body>
</html>
