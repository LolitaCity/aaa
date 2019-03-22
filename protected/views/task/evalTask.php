<!DOCTYPE html>
<html><head>
    <title></title>
    <link href="<?=S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=S_JS;?>open.win.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=S_IMAGES;?>weui.css">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>myUpload/css/upimg.css">
    <script type="text/javascript" src="<?=SITE_URL;?>myUpload/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?=SITE_URL;?>myUpload/js/myUpload.js"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>layer/layer.js"></script>
</head>
<body style="background: #fff;">
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            评价任务 <?=$info['tasksn']?>
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?=S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        if ($("#serviceValidation").length > 0) {
            $.openAlter($("#serviceValidation").text(), "提示");
        }

        $('#uploadify').change(function () {
            $("#txtfilename").val($("#uploadify").val());
            if ($.trim($("#txtfilename").val()) != "" && $("#txtfilename").val() != null) {
                $("#aShowImg").text("");
            }
        });
        
        $("#evaluate_content").bind("contextmenu", function(){
		    return false;
		});
    })

    function openBrowse() {
        document.getElementById("uploadify").click();
        document.getElementById("txtfilename").value = document.getElementById("uploadify").value;
    }


    function Submit() {
        var lj = $(":input[name=img1]").val();
        if (lj == "" || lj == null) {
            $.openAlter("请上传图片", "提示");
            return false;
        }
        layer.msg('正在提交数据...', {
		  icon: 16
		  ,shade: 0.01
		  ,time: 0
		});
        $.post('<?php echo $this->createUrl('task/evaltask')?>', $('#fm').serialize(), function(data){
        	console.log(data);
        	layer.close(layer.index);
        	if(data.status)
        	{
        		
        		$.openAlter(data.message, '提示');
        		parent.location.reload();
        	}
        	else
        	{
        		$.openAlter(data.message, '错误');
            	return false;
        	}
        }, 'JSON');
//      $("#fm").submit();
    }


</script>
<style type="text/css">
    .fpgl-tc-qxjs_6{margin-top:8px!important;}
    .tooltip
    {
        width: 98px;
        background: #fceeda;
        float: left;
        margin-right: 5px;
        display: block;
        overflow: hidden;
    }
    #tooltip
    {
        width: 290px;
        position: fixed;
        z-index: 9999;
    }
    #tooltip img
    {
        width: 290px;
        height: auto;
    }

    .sk-hygl_7
    {
        width: 430px;
    }
    .sk-hygl_7_r
    {
        width: 120px;
        text-align: right;
    }
    .fpgl-tc-qxjs_6 p
    {
        line-height: 15px;
    }
    .input-butto100-ls
    {
        background: #4882f0 none repeat scroll 0 0;
        border-radius: 28px;
        color: #fff;
        cursor: pointer;
        height: 28px;
        line-height: 28px;
        padding-left: 0;
        text-align: center;
        width: 128px;
    }

    #aAnswer a:hover
    {
        color: Black !important;;
    }
    .showimg a{float: left;margin-right: 8px;margin-bottom: 10px;}
    .showimg img{width: 100px;height: 70px}
</style>

<form action="<?php echo $this->createUrl('task/evaltask')?>" enctype="multipart/form-data" id="fm" method="post">        <!--列表 -->
    <div class="yctc_458 ycgl_tc_1" style="margin-top: 10px; width: 580px;">

        <ul>

            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7_r">
                    店铺名称：</p>
                <input id="TaskID" name="usertaskid" type="hidden" value="<?=$info['usertaskid']?>">
                <input id="PlatformOrderNumber" name="taskevalid" type="hidden" value="<?=$info['id'];?>">
                <p class="sk-hygl_7"><?=$info['shopname']?></p>
            </li>
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7_r">
                    商品名称：</p>
                <p class="sk-hygl_7" style="max-height: 40px;">
                    <?=$info['commodity_title']?>
                </p>
            </li>
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7_r">
                    订单编号：</p>
                <p class="sk-hygl_7"><?=$info['ordersn']?></p>
            </li>
            <li class="fpgl-tc-qxjs_6">
                <p class="sk-hygl_7_r">佣金：</p>
                <p class="sk-hygl_7"><?=$info['iscommission'] - $info['commission_house'];?>元</p>
            </li>
            <li class="fpgl-tc-qxjs_6" style="margin-bottom: 14px;">
            	<?php if(strrpos(trim($info['content']), '要求') === 0 || empty($info['content'])):?>
	                <p class="sk-hygl_7_r"><?=PLATFORM == 'esx' ? '五星好评' : '评价要求';?>：</p>
	                <p class="sk-hygl_7" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false">
	                	<strong onselectstart="return false" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false"><?=PLATFORM == 'esx' ? '<span style="font-size: 1.2em; font-weight: bold; color:red">此评价直接给五星即可，不用写评语</span>' : '切勿直接粘贴此内容直接评价，务必按照下列要求完成评价任务';?></strong><br />
	                	<p class="sk-hygl_7">
	                		<input onselectstart="return false" onpaste="return false" oncontextmenu="return false" oncopy="return false" oncut="return false" readonly="readonly" style="border:1px solid #DEDEDE; width: 100%; margin-left: 28%; margin-top: 2%; padding: 2px 1px 20px 3px; background-color: beige;" type="text" value="<?=PLATFORM == 'esx' ? '' : str_replace('要求：', '', $info['content']);?>"/>		                
                		</p>
                	</p>
        		<?php else:?>
        			<p class="sk-hygl_7_r" style="margin-top: 14px;">评价内容：</p>
	                <p class="sk-hygl_7">
	                    <textarea readonly class="input_44" cols="20" data-val="true" id="Question" maxlength="40" name="Question" rows="2" style="height: 80px; width: 400px;"><?=$info['content']?></textarea>
	                </p>
    			<?php endif;?>
            </li>
            <?php if ($info['status']==1):?>
                <li class="fpgl-tc-qxjs_6" style="margin-top: 10px;">
                    <p class="sk-hygl_7_r" style="position: relative; margin-top: 30px;">好评图片：</p>
                    <p class="sjzc_6_tu showimg" style="width: 450px">
                        <?php foreach ($info['imgcontent'] as $v):?>
                            <a target="_blank" href="<?=$v?>"><img src="<?=$v?>"></a>
                        <?php endforeach;?>
                    </p>
                </li>
            <?php endif;?>
            <li class="fpgl-tc-drp3">
                <p class="sk-hygl_7_r" style="position: relative; margin-top: 30px;">
                    上传评价图片：</p>
                <p class="sjzc_6_tu_3" style="margin-left: -1px;margin-right: 10px;">
                    <a target="_blank" href="" class="tooltip"></a>
                </p>
                <p class="sjzc_6_tu" style="margin-left: 10px;">
                <div id="upimg1"></div>
                <script language="javascript">
                    $("#upimg1").upload({isMulti:true, pictureInputName:'img1',defaultimg:""});
                </script>
                </p>
            </li>


            <li class="fpgl-tc-qxjs_6">
                <p style="width: 50%;">
                    <input class="input-butto100-hs" type="button" id="btnSubmint" value="提交" onclick="Submit();" style="float: right; margin-right: 5px; width: 127px; height: 35px;">
                </p>
                <p style="width: 50%;">
                    <input onclick="self.parent.$.closeWin()" class="input-butto100-ls" type="button" style="height: 35px; float: left; margin-left: 5px;" value="返回"></p>
            </li>
        </ul>
    </div>
    <div id="sUpload1" class="weui_loading_toast" style="display: none;">
        <div class="weui_mask_transparent">
        </div>
        <div class="weui_toast">
            <div class="weui_loading">
                <!-- :) -->
                <div class="weui_loading_leaf weui_loading_leaf_0">
                </div>
                <div class="weui_loading_leaf weui_loading_leaf_1">
                </div>
                <div class="weui_loading_leaf weui_loading_leaf_2">
                </div>
                <div class="weui_loading_leaf weui_loading_leaf_3">
                </div>
                <div class="weui_loading_leaf weui_loading_leaf_4">
                </div>
                <div class="weui_loading_leaf weui_loading_leaf_5">
                </div>
                <div class="weui_loading_leaf weui_loading_leaf_6">
                </div>
                <div class="weui_loading_leaf weui_loading_leaf_7">
                </div>
                <div class="weui_loading_leaf weui_loading_leaf_8">
                </div>
                <div class="weui_loading_leaf weui_loading_leaf_9">
                </div>
                <div class="weui_loading_leaf weui_loading_leaf_10">
                </div>
                <div class="weui_loading_leaf weui_loading_leaf_11">
                </div>
            </div>
            <p class="weui_toast_content">
                图片上传中</p>
        </div>
    </div>
    <div id="sUpload1Success" style="display: none;">
        <div class="weui_mask_transparent">
        </div>
        <div class="weui_toast">
            <i class="weui_icon_toast"></i>
            <p class="weui_toast_content">
                上传完成</p>
        </div>
    </div>
</form>


</body></html>