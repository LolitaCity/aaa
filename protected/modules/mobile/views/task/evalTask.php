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
    	<script type="text/javascript" src="<?php echo S_JS;?>layer/layer.js"></script>
    <style type="text/css">
        .nav
        {
            padding: 15px;
            background: #fff;
            border-bottom: 1px solid #ddd;
        }
        .hauto
        {
            height: auto;
            overflow: hidden;
        }
        .View-reason
        {
            padding: 0 !important;
            width: 100%;
        }
        .padding_2_3
        {
            padding: 2% 3%;
        }
    </style>

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
    <div class="cm" style="padding-bottom: 50px;">
           <?php $this->renderPartial("/public/header");?>
        
<form action="<?php echo $this->createUrl('/task/EvalTasktest')?>" enctype="multipart/form-data" id="fm" method="post">
<input id="TaskID" name="usertaskid" type="hidden" value="<?=$info['usertaskid']?>">
<input id="PlatformOrderNumber" name="taskevalid" type="hidden" value="<?=$info['id'];?>">        <!--晒图评价页面-->

        <div class="View-reason">
            <h2 class="view_h2">
                <a href="javascript:void(0)" onclick="history.go(-1)">返回</a></h2>
            <ul class="cncont view_img1">
                <li>
				<?php
					$usertask=Usertask::model()->findByPk($info['usertaskid']);
					$product=Product::model()->findByPk($usertask->proid);
				?>
                    <dl>
                        <dt>
                            <img width="96px" height="97px" style="margin-left:5px" src="<?=@$product->commodity_image;?>"></dt>
                        <dd>
                            <label>
                                店铺名：</label><span><b><?=$info['shopname']?></b></span></dd>
                        <dd>
                            <label>
                                好评类型：</label><span><?=($info['status']==1?'晒图好评':'文字好评');?></span></dd>
                        <dd>
                            <label>
                                订单编号：</label><span><?=$info['ordersn']?></span></dd>
                        <dd>
                            <label>
                                佣金：</label><span><?=$info['iscommission'] - $info['commission_house'];?>元</span></dd>
                    </dl>
                </li>
            </ul>
        </div>
        <div class="hxt">
        </div>
        <!--灰色条-->
        <div class="app_evaluate">
            <h3 class="title_h3">
                温馨提示</h3>
            <div class="text pad_2_3" style="font-size: 12px">
                    <p>
                        1、请点击晒图图片查看大图，长按进行保存，<font color="#ff0000">切勿通过截屏的方式</font>保存图片。</p>
                    <p>
                        2、请务必按照要求进行评价，并返回平台上传评价截图。截图不合规范或评价错误将<font color="#ff0000">无法领取佣金</font>。</p>
                    <p>
                        3、请确保物流显示已签收，确认收货后才可进行评价操作。</p>
            </div>
        </div>
        <div class="hxt">
        </div>
        <div class="View-reason show_img1">
        	<?php if(strrpos(trim($info['content']), '要求') === 0 || empty($info['content'])):?>
        		<div onselectstart="return false" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" class="title_h3 un_copy" topmargin="0">
        			<?=PLATFORM == 'esx' ? '<span style="font-size: 1.2em; font-weight: bold; color:red">此评价直接给五星即可，不用写评语</span>' : '评价要求[<strong>切勿粘贴此内容评价，务必按要求评价</strong>]' ?>
	           </div>
    		<?php else:?>
    			<div class="title_h3" topmargin="0">
	            	评价内容<a href="javascript:;" id="copy_btn" onclick="copyContent()">[点击复制]</a>	
	           </div>
			<?php endif;?>
            <div class="padding_2_3">
                <textarea id="evaluate_content" class="textarea_2 un_copy" readonly="readonly" style="width: 95%;"><?=PLATFORM == 'esx' && (strrpos(trim($info['content']), '要求') === 0) ? '' : str_replace('要求：', '', $info['content']);?></textarea >
				<?php if ($info['status']==1):?>
				
				<h5 class="t_999 title_h5" style="margin-top: 5px">晒图：</h5>
				<ul class="show_img" style="margin-top: -1px">
					<?php foreach ($info['imgcontent'] as $v):?>
						<li><a href="<?=str_replace ( 'pk1172' , '18zang' ,  $v);?>" title="点击查看原图">
							<img src="<?=str_replace ( 'pk1172' , '18zang' ,  $v);?>"></a></li>
					<?php endforeach;?>		
				</ul>
				<?php endif;?>
            </div>
        </div>
        <div class="hxt">
        </div>
        <!--灰色条-->
        <div class="View-reason show_img1">
		<?php if(empty($info['postimg'])):?>
            <div class="title_h3">
                上传评价截图</div>
            <div class="padding_2_3">
                    <h2 class="view_h2">
                        <b>截图位置：</b>淘宝APP--我的淘宝--我的评价</h2>
                    <ul class="upload">
                        <a href="<?=M_IMG_URL;?>evalexample.jpg" onclick="javascript:void(0)" title="点击查看大图">
                            <li class="weui_uploader_file weui_uploader_status" style="width: 100px; height: 70px;background-image:url(<?=SITE_URL.M_IMG_URL;?>evalexample.jpg)">
                                <div class="weui_uploader_status_content">
                                    示例</div>
                            </li>
                        </a>
                        <div>
                            <div id="upimg1"></div>
                    <script language="javascript">
                        $("#upimg1").upload({isMulti:true, pictureInputName:'img1',defaultimg:"<?=@$info['postimg']?>"});
                    </script>
                        </div>
                    </ul>
            </div>
		<?php else:?>	
		    <div class="title_h3">
                我的截图</div>
            <div class="padding_2_3">
                    <img src="<?=@$info['postimg']?>" width=100 height=50/>
            </div>
		<?php endif;?>
			<?php if(empty($info['postimg'])):?>
				<div class="app_submit">
                <a href="javascript:void(0)" id="btnGetPoint" onclick="Submit()">提交审核</a></div>
			<?php endif;?>
            <!--提交审核的窗口-->

            <!--提交审核的窗口-->
        </div>

</form>    
	<script language="javascript">
		$(function(){
			var u = navigator.userAgent;
			if (u.indexOf('iPhone') > -1)  //苹果手机，隐藏点击复制功能[不兼容]
			{
				$('#copy_btn').hide();
			}
			$(".un_copy").bind("contextmenu", function(){
			    return false;
			});
			
		});
		function copyContent()
		{
			var e = document.getElementById("evaluate_content");
			e.select();
			document.execCommand("Copy");
			$('#evaluate_content').blur();
			layer.msg('复制评价内容成功');
		}
		
        function Submit() {
            var lj = $(":input[name=img1]").val();
            if (lj == "" || lj == null) {
                $.openAlter("请上传图片", "提示")
                return false;
            }
            layer.msg('正在提交数据...', {
			  icon: 16
			  ,shade: 0.01
			  ,time: 0
			});
	        $.post('<?php echo $this->createUrl('/task/evaltask')?>', $('#fm').serialize(), function(data){
	        	console.log(data);
	        	layer.close(layer.index);
	        	if(data.status)
	        	{
	        		
	        		$.openAlter(data.message, '提示');
	        		location.href = '/mobile/task/evaltasklist';
	        	}
	        	else
	        	{
	        		$.openAlter(data.message, '错误');
	            	return false;
	        	}
	        }, 'JSON');
            //$("#fm").submit();
        }

    </script>
    <!--晒图评价页面-->

    </div>
       <?php $this->renderPartial("/public/footer");?>  


</body></html>