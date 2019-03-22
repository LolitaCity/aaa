<!DOCTYPE html>
<?php

    $webtitle=System::model()->findByAttributes(array("varname"=>"webtitle"));
?>
<html>
<head>
    <title><?php echo $webtitle->value;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>css.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>weui.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>pagination.css" rel="stylesheet" type="text/css">
     <style>
        p
        {
            font-size: 14px;
        }
        .border_r_bl{border:1px solid #bb0a0a; width:7px; height:7px; border-radius:100%; float:left; margin-right:10px; margin-top:3px;}
        .weui_cell:before{left:0px;}
    </style>  
</head>
<body>

<div class="cm" style="padding-bottom: 50px;" id="bigbox" title="平台公告">
   <?php $this->renderPartial("/public/header");
    $userInfo=User::model()->findByPk(Yii::app()->user->getId());?>        

    <div>
        <!-- 内容-->
        <div class="weui_panel" style="margin-top: 0px;">
            <div class="weui_panel_hd no_line" style="text-align: center; font-size: 17px; color: #fff;
                background-color: #bb0a0a">
                全部公告</div>
            <div class="weui_panel_bd">
                <div class="weui_media_box weui_media_small_appmsg">
                    <div class="weui_cells weui_cells_access">
					<?php
                    foreach($list as $v){
                    ?>
                            <a href="<?php echo $this->createUrl('other/newsinfo',array('id'=>$v->goods_id));?>" class="weui_cell">
                                <div class="weui_cell_hd">
                                    <em class="border_r_bl"></em></div>
                                <div class="weui_cell_bd weui_cell_primary">
                                        <p><?php echo $v->goods_name;?></p>
                                </div>
                                <span class="weui_cell_ft"></span>
							</a>
                     <?php }?>      
                    </div>
                </div>
            </div>
			
			
        </div>
    </div>
    <!-- 内容-->

    </div>

<?php $this->renderPartial('/public/footer');?>
	
</body>
</html>






















