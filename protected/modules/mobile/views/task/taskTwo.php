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
    <script type="text/javascript">
        var searchType='淘宝APP自然搜索';
        var searchImgs="";
     function showtips() {
        var intlet='<?=$taskinfo['intlet'];?>';
        if($("#txtValidateValue").attr('checkstatus')=='false'){
            $.openAlter('请验证后再操作！','提示');return false;
        }
        if(!$(':input[name="img1"]').val() && intlet!=6 && intlet!=3){
            $.openAlter('请上传截图！','提示');return false;
        }
        $('#light1,#fade').show()
    }

        function Submit() {
           $("#fm").submit();
        }
		$(document).ready(function(){
			
			    $('#btnNext').click(function(){
        var img=$(':input[name="img1"]').val();
        var intlet='<?=$taskinfo['intlet'];?>';
        $.ajax({
            type: "post",
            url: "<?php echo $this->createUrl('task/taskTwo');?>",
            data: { usertaskid: '<?=$taskinfo['id']?>', tasktwoimg: img,intlet:intlet},
            success: function (data) {
            }
        });
        $('#light1,#fade').hide();
		window.parent.location.href = '/mobile/task/taskthree/usertaskid/'+'<?=$taskinfo['id']?>'+'.html';
        
    })	
			
			
		})

		

    function Confirm(taskID) {
        var validateValue = $("#txtValidateValue").val();
        if ($.trim(validateValue) == "" || $.trim(validateValue) == null) {
            $.openAlter('验证栏请输入', '提示');
            return;
        }
        var type='<?=$taskinfo['intlet']?>';
        $.ajax({
            type: "post",
            url: "<?php echo $this->createUrl('task/shopconfirm');?>",
            dataType: "json",
            data: { taskid: taskID, val: validateValue,type:type },
            error: function () {
                $.openAlter('验证失败', "提示");
            },
            success: function (data) {
                if(data.err_code==0){
                    $(':input[name="textfield"]').attr('checkstatus',true);
                }else {
                    $(':input[name="textfield"]').attr('checkstatus',false);
                }
                $.openAlter(data.msg, "提示");
            }
        });
    }


        function Timesb(minute, second) {
            second--;
            if (second <= -1 && minute > 0) {
                second = 59;
                minute--;
            }
            if (minute <= 0) {
                minute = 0;
            }
            if (minute <= 0 && second <= 0) {
                minute = 0;
                second = 0;
            }
            if (minute == 0 && second == 0) {
                $("#lblMinute").text("0");
                $("#lblSecond").text("0");
            }
            else {
                $("#lblMinute").text(minute);
                $("#lblSecond").text(second);
                setTimeout("Timesb('" + minute + "','" + second + "')", 1000);
            }
        }
		function copyUrl2()
        {
            var Url2=document.getElementById("taokouling");
            Url2.select(); // 选择对象
            document.execCommand("Copy"); // 执行浏览器复制命令
            alert("已复制好，可贴粘。");
        }
        function copy()
        {
            var str = document.getElementById("taokouling").value;
            var save = function (e){
                e.clipboardData.setData('text/plain',str);//下面会说到clipboardData对象
                e.preventDefault();//阻止默认行为
            }
            document.addEventListener('copy',save);
            document.execCommand("copy");//使文档处于可编辑状态，否则无效
            alert(' ['+str+"]  已复制好，可贴粘。");
        }
        var su= 0;
        //选择图片
        function showPic($url,$id,$sow,$lang){
            var pic = $(""+$id+"").get(0).files[0];
            su =$sow;
            if(pic){
                if(pic['size']>=2097152){
                    $(""+$sow+"").html("不能超过1M");
                }else{
                    $(""+$lang+"").prop("src" , window.URL.createObjectURL(pic) );
                    $(""+$sow+"").html( 0 +"%" );
                    uploadFile($url,$id,$sow);
                }
            }
        }
        //上传图片
        function uploadFile($url,$id,$sow){
            var pic = $(""+$id+"").get(0).files[0];
            var formData = new FormData();
            var u = $url;
            formData.append("file" , pic);
            /**
                * 必须false才会避开jQuery对 formdata 的默认处理
                * XMLHttpRequest会对 formdata 进行正确的处理
                */
            $.ajax({
                type: "POST",
                url: u,
                data: formData ,
                processData : false,
                //必须false才会自动加上正确的Content-Type
                contentType : false ,
                xhr: function(){
                    var xhr = $.ajaxSettings.xhr();
                    if(onprogress && xhr.upload) {
                        xhr.upload.addEventListener("progress" , onprogress, false);
                        return xhr;
                    }
                },success: function(data) {
                    var obj = JSON.parse(data);
                    if(obj.status==1){
                        alert(obj.content);
                        $("#tu").val("<?php echo SITE_URL ?>"+obj.url);
                    }else{
                        alert(obj.content);
                    }
                    $(""+$sow+"").html(obj.content);
                    $(""+$sow+"").css({"color":"#00FF00","border":"10px 10px 5px #888888"});
                },
                error:function(xhr){ //上传失败
                    alert("上传失败");
                    $(""+$sow+"").html("上传失败" );
                    $(""+$sow+"").css({"color":"red","border":"10px 10px 5px #888888"});
                }
            });
        }
        /**
           * 侦查附件上传情况 ,这个方法大概0.05-0.1秒执行一次
           */
        function onprogress(evt){
            var loaded = evt.loaded;     //已经上传大小情况
            var tot = evt.total;      //附件总大小
            var per = Math.floor(100*loaded/tot);  //已经上传的百分比
            $(""+su+"").html( per +"%" );
        }
    </script>
    <style type="text/css">


.bg_4882f0 {
    background: #bb0a0a;
}		
.ycgl_tc2 {
    width: 90%;
    margin-left: 5%;
    top: 15%;
    min-height: 250px;
}
.ycgl_tc2 {
    position: fixed;
    z-index: 1002;
    font-size: 14px;background:#fff;
    font-family: "微软雅黑";
}
.tjck_1 {
    padding: 10px;
    background: #fff;
    border-radius: 8px;
}
.close_x a img {
    z-index: 999;
    position: absolute;
    right: 0;    top: 8px;
    right: 10px;
    cursor: pointer;
    color: #999;
    font-size: 22px;
    width: 25px;
    height: 25px;
}
#focus {
    overflow: hidden;
    position: relative;
}
.s_xqxx h2 {
    height: 35px;
    line-height: 35px;
    color: #4882f0;
    font-size: 16px;
    text-align: center;
}
.s_xqxx dl {
    background: #e8e8e8;
    padding: 8px;
    border-radius: 5px;
}
.s_xqxx dl dt {
    font-size: 15px;
}
.radio_box ul {
    margin-top: 10px;
}
.hg_wxts {
    margin-top: 2px;
}
.focus b {
    color: red;
}

.hd_anniu span input {
    color: #fff;
    width: 100%;
    display: block;
    height: 35px;
    line-height: 35px;
    border-radius: 5px;
    margin-top: 15px;
}
.bg_888 {
    background: #888;
}
    </style>

   
</head>
<?php $rukou=$this->liuliangrukou($taskinfo['intlet'],$taskinfo['order']);?>
<body>
<!--弹框确认-->
<div id="light1" class="ycgl_tc2" style="display:none">
   <div class="tjck_1">
                <span class="close_x"><a href="">
                    <img onclick="document.getElementById('light1').style.display='none';document.getElementById('fade').style.display='none'" src="<?=M_IMG_URL;?>close.png"></a></span>
                <div id="focus" class="focus">
                    <div class="s_xqxx">
                        <h2>
                            核对商品价格</h2>
                        <dl>
                            <dt>任务担保金额(单件):<label style="font-weight: bolder;color:Red;"><?=$taskinfo['modelprice']?></label>元</dt>
                            <dt>拍下件数：<label style="font-weight: bolder;color:Red;"><?=$taskinfo['auction']?></label>
                            </dt>
                            <dt>型号：
                                <label>
                                        <label style="word-break: break-all; color: Red;font-weight: bolder;"><?=$taskinfo['modelname']?$taskinfo['modelname']:'默认'?></label>
                                </label>
                            </dt>
                            <dd>请核对担保金额与目标商品价格是否一致。若两者差价≥50元，请不要下单。请务必认真核对！</dd>
                        </dl>
                    </div>
                    <div class="radio_box" id="radio01">
                        
                        <p class="hg_wxts">
                            <b>温馨提示：</b>请点击【核对无问题，下一步】按钮进行下一步操作，赚取任务佣金。</p>
                    </div>
                    <h4 class="hd_anniu">
                        <span>
                            <input id="btnNext" type="button" value="核对无问题，下一步" class="bg_4882f0">
                            <input id="btnSubPrice" disabled="disabled" type="button" value="差价过大，请不要下单" class="bg_888">
                        </span>
                    </h4>
                </div>
            </div>
   
</div>
<div id="fade" class="black_overlay" ></div>


    <div class="cm" style="padding-bottom: 50px;">
         <?php $this->renderPartial("/public/header");?>
        
<form action="<?php echo $this->createUrl('task/tasktwo');?>" enctype="multipart/form-data" id="fm" method="post">        <!--列表 -->
        <div class="jsgl_pt hauto">
        <input id="TaskID" name="taskid" type="hidden" value="<?=$taskinfo['id'];?>">
        <input id="TaskSearchType" name="taskintlet" type="hidden" value="<?=$taskinfo['intlet'];?>">
        <input id="SearchImgs" name="proimg" type="hidden" value="<?=$taskinfo['commodity_image'];?>">
        <input id="TaskType" name="TaskType" type="hidden" value="<?=$rukou['terminal']?>">
        <input id="FineTaskCategroy" name="tasktype" type="hidden" value="<?=$taskinfo['tasktype']?>">

            <ul>
                <li class="jsgl_pt_1"><a href="<?php echo $this->createUrl('task/taskone',array('taskid'=>$taskinfo['id']));?>">上一步</a></li>
                <li class="jsgl_pt_2" style="position: absolute; z-index: -999; left: 0; top: 89px;
                    width: 100%; text-align: center">第二步</li>
                
            </ul>
        </div>
        <!--1 -->
        <div class="ksrf ksrf_hg hauto">
                <ul>
                        <li class="ksrf_1"><a href="<?=$taskinfo['commodity_image']?>" onclick="javascript:void(0)" title="点击查看原图">
                            <img src="<?=$taskinfo['commodity_image']?>"></a> </li>
                </ul>
<!--                <style type="text/css">-->
<!--                    body-->
<!--                    {-->
<!--                        -webkit-touch-callout: none;-->
<!--                        -webkit-user-select: none;-->
<!--                        -khtml-user-select: none;-->
<!--                        -moz-user-select: none;-->
<!--                        -ms-user-select: none;-->
<!--                        user-select: none;-->
<!--                    }-->
<!--                </style>-->
               
			   <ul>			
				<?php if ($taskinfo['intlet']!=6):?>
                    <li><span id="#spOne" style="word-break: break-all;" onselectstart="return false" oncontextmenu="return false"><?php if ($taskinfo['intlet']==3){echo'APP淘口令';}else{echo '搜索关键字';}?>：</span><em>
					 <?php if ($taskinfo['intlet']==3){ ?>
					 <textarea  rows="1" id="taokouling" readonly="readonly"  style="width:50%;bolder:none;"><?=$taskinfo['keyword']?></textarea>
					 <a onclick="copyUrl2()" href="javascript:;" style="color: blue;font-weight: bold">复制</a>
					<?php }else{?>					
					<span style="word-break: break-all;" ><?=$taskinfo['keyword']?>
                       <!-- <a onclick="copy()" href="javascript:;" style="color: blue;font-weight: bold">复制</a>
                        <textarea  rows="1" id="taokouling" readonly="readonly"  style="width:50%;bolder:none;  opacity:0;"><?=$taskinfo['keyword']?></textarea>-->
                    </span>
					<?php }?>
					</em><br>
                        排序方式：<?php if ($taskinfo['order']){ echo $rukou['stype'][$taskinfo['order']];}else{?>（无）<?php }?><br>
                        价格区间：
                            <label>
                                 <?php if ($taskinfo['price']){ echo $taskinfo['price'];}else{?>（无）<?php }?></label>
                        <br>
                            <label>
                                发货地：</label>
                            <label><?php if ($taskinfo['sendaddress']){ echo $taskinfo['sendaddress'];}else{?>（无）<?php }?></label><br>
                        其他条件：<label>
                            <?php if ($taskinfo['other']){ echo $taskinfo['other'];}else{?>（无）<?php }?></label>
                        <br>
                        任务类型：<label>
                            <?=$rukou['intletarr'][$taskinfo['intlet']]?></label>
                        <br>
                        
                        店铺名：
                        <?php echo $this->substr_cut($taskinfo['shopname']);?>
                    </li>
					<?php else:?>
					<li >
                        <span ><img width="200" src="<?=$taskinfo['qrcode'];?>"> </span >
                    
                    <br>
                        <label>
                            第一步：</label>
                        <label>打开淘宝app扫描上面的二维码</label><br>
                    <label>
                           第二步：：</label>
                            </p>
                        <label>进入到商品详情页中</label>
                    </li>
					
					<?php endif;?>
					
                    <li class="ksrf_4">
                        <p class="ksrf_2">
                            <input checkstatus="<?php  $coo = Yii::app()->request->getCookies();
                        if($coo['comfirmcookie'.$taskinfo['id']]->value){echo 1;}else{echo 'false';}?>"  type="text" name="textfield" class="txsq_100" id="txtValidateValue"></p>
                        <p class="jsgl_pt_1" style="float: right; margin-top: 5px;">
                                <a href="javascript:void(0)" onclick="Confirm('<?=$taskinfo['id']?>')">验证</a>
                        </p>
                    </li>
                </ul>
				<?php if ($taskinfo['intlet']!=6 && $taskinfo['intlet']!=3):?>
                <div class="weui_cell_bd weui_cell_primary" style="margin: 10px 0px">
                    <div class="weui_uploader">
                        <div class="weui_uploader_hd weui_cell">
                            <div class="weui_cell_bd weui_cell_primary">
                                搜索页面截图：</div>
                        </div>
                        <div class="weui_uploader_bd">
                            <div class="weui_uploader_input_wrp">

                                <div id="upimg1">
                                    <div class="myupload-container">
                                        <div class="table" role="myupload-file-input-btn"><div class="content table-cell defalut" style="">
                                                <input type="file" id="pic02" name="pic02" onchange="showPic('<?php echo SITE_URL.'task/TasktestOne01';?>','#pic02','#son02','#lang02')" style="background：red;width:88px;height:60px;opacity: 0"/>

                                            </div>
                                        </div>
                                        <input type="file" name="file" role="myupload-file-input" accept="image/*" style="display:none;">
                                        <div class="table" style="position:relative;"><div class="content table-cell" style="">
                                                <img class="simg" width="100" height="70" role="myupload-picture-show" id="lang02">
                                                <input type="hidden" name="img1" role="myupload-picture-input" value="" id="tu">
                                                <span id="son02" style="position:relative;bottom:40px;color:#00FF00;"></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
							<?php 
								switch($taskinfo['intlet']){
									case 1:
									$imgsrc=S_IMAGES.'taobaoappziran.jpg';
									break;
									case 4:
									$imgsrc=S_IMAGES.'ll_ztc.png';
									break;
									
								}
							?>
                            <ul class="weui_uploader_files">
                                    <a href="<?=S_IMAGES;?>taobaoappziran.jpg">
                                        <li class="weui_uploader_file weui_uploader_status" style="height:70px;background-image:url(<?=S_IMAGES;?>taobaoappziran.jpg)">
                                            <div class="weui_uploader_status_content">
                                                示例</div>
                                        </li>
                                    </a>
                            </ul>
                        </div>
                    </div>
                </div>
				<?php endif;?>
				
                <ul>
                    <li>任务释放倒计时：<span><label id="lblMinute" style="color: Red;">29</label>
                        分
                        <label id="lblSecond" style="color: Red;">43</label>
                        秒</span></li>
                </ul>
            <ul>
                
                <li class="login_4"><a href="javascript:void(0)" onclick="showtips()">下一步</a></li>
            </ul>
                <script type="text/javascript">
            var m='<?=floor($setfreetime/60);?>';
            var s='<?=$setfreetime%60;?>';
            Timesb(m, s)</script>
        </div>
</form>
    </div>
    
         <?php $this->renderPartial("/public/footer");?>
    


</body></html>