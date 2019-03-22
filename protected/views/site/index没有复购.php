<link href="<?php echo S_CSS;?>user_index.css" rel="stylesheet" type="text/css">
<?php
		$authinfo=User::model()->findByPk(Yii::app()->user->getId());
		$authperson=System::model()->findByAttributes(array("varname"=>"authperson"));//检测是否要求实名认证
        $wangwang=Blindwangwang::model()->find('userid='.Yii::app()->user->getId());
	if (Yii::app()->session['closeNews'] !=1 && $authinfo->AuthPerson==1 && $authperson->value==1 &&!empty($wangwang->statue)):?>
<script>
$.openWin(600,800,'<?php echo $this->createUrl('other/IndexWinopen');?>');
</script>
<?php endif;?>
<?php if (!empty($acceptarr) && $acceptarr['err_code']==2):?>
<script>
    $.openAlter('<?=$acceptarr['msg'];?>','提示',{width:250,height:250},function () {
        window.location.href='<?php echo $this->createUrl('task/taskmanage');?>';
    },'知道了')
</script>
<?php elseif(!empty($acceptarr) && $acceptarr['err_code']!=2):?>
<script>
    $.openAlter('<?=$acceptarr['msg'];?>','提示',{width:250,height:250})
</script>
<?php endif;?>
<script>
	$(document).ready(function(){
		$(".bannerleft img").animate({left:0,opacity:'1'},900);        
		$(".banneright").animate({right:0,opacity:'1'},500);
			$(".checklist .checkbox-select").click(
			  function(event) {
				event.preventDefault();
				$(this).parent().addClass("selected");
				$(this).parent().find(":checkbox").attr("checked","checked");
				
			  }
			);
			
			$(".checklist .select_type").click(
			  function(event) {
				event.preventDefault();
				$(this).parent().removeClass("selected");
				$(this).parent().find(":checkbox").removeAttr("checked");
			  }
			);


	})  
</script>
<script type="application/javascript">
    $(document).ready(function () {
        var isFG='False';
        if(isFG=="True")
        {
            $(".tack1").removeClass("cur");
            $(".tack2").addClass("cur");
            $("#divReAccept").hide();
        }
        IsAllowClick();
    })

    function IsAllowClick()
    {
        $(".tack1").click(function(){
            $(".task_one").show();
            $(".task_two").hide();
            $(".tack_laoding").hide();
            $(".tack2").removeClass("cur");
            $(".tack1").addClass("cur");
        });
        $(".tack2").click(function(){
            $(".task_two").show();
            $(".task_one").hide();
            $(".tack_laoding").hide();
            $(".tack1").removeClass("cur");
            $(".tack2").addClass("cur");
        });
    }
</script>

<script>
 var isQueue='<?php if (!empty($length) && empty($acceptarr)){echo "True";}else{ echo "False";}?>';
 var timer;
 $(document).ready(function () {
     if (isQueue=='True'){
         $('#ban1').hide();
         $('#ban2').show();
         timer=setInterval(function () {
            GetQueueAcceptResult();
         },5000)
     }


 })
 function GetQueueAcceptResult() {
     //var timestamp=new Date().getTime();
     $.post('<?php echo $this->createUrl('site/GetQueAcceptRes');?>', {}, function (data) {
         //alert(data);return false;
         if(data!=null){
             //document.write(data);return false;

             if(data.queueCount>100)
             {
                 $("#bCount").text("大于100");
             }
             else
             {
                 $("#bCount").text(data.queueCount);
             }
             if(data.queueCount<=0){
                 if(data.taskAcceptRes=='SUCCESS')
                 {
                     $("#hTask2").text("恭喜你");
                     $("#hTask3").text("已经成功领取任务");
                     $("#loading1").hide();
                     $("#loading2").show();
                     $("#bntOk").text("开始任务");
                     $("#bntOk").attr("onclick","");
                     $("#bntOk").attr("href","<?php echo $this->createUrl('task/taskmanage');?>");
                     IsAllowClick();
                 }
                 else if(data.taskAcceptRes=='FAILED')
                 {
                     $("#hTask2").text("接手失败！");
                     $("#hTask3").html("亲,现在平台任务量较少<br/>请尝试重新接单或者稍后再试");

                     $("#loading1").hide();
                     $("#loading2").show();
                     if($(".tack2").attr("class").indexOf("cur")>0)
                     {
                         $("#divReAccept").hide();
                         $("#bntOk").show();
                     }
                     else{
                         $("#divReAccept").show();
                         $("#bntOk").hide();
                     }

                     $("#bntOk").text("重新接单");
                     $("#bntOk").attr("onclick","");
                     $("#bntOk").attr("href","<?=$this->createUrl('site/index')?>");
                     if(data.msg!="")
                     {
                         $.openAlter(data.msg, '提示');
                     }
                     IsAllowClick();
                 }
                 clearInterval(timer);
             }
         }

     },'json');
//           setTimeout("GetQueueAcceptResult()", 1000 * 60 *0.2);

 }

    //开始接单
    function AcceptTask(i)
    {   //i判断是销量任务还是复购任务
        if(i=="0")
        {
            var tasklength=$(".task_one input[name='TaskType']:checked").length;
            $(".task_one input[name='TaskTypelen']").val(tasklength)
            if(tasklength==0)
            {
                $.openAlter("亲，请选择下单终端哦~", "提示");
                return;
            }
            $("#FineTaskClassType").val('销量任务');
        }
        else
        {
            var length=$(".task_two input[name='FGPlatformTypes']:checked").length;
            if(length==0)
            {
                $.openAlter("请先选择购物平台哦~", "提示");
                return;
            }

            $("#FineTaskClassType").val('复购任务');
        }

        $.ajaxSetup({
            async : true
        });
        //获取产品数量
        $.post('<?php echo $this->createUrl('site/queuenum');?>',{},function(res){
            if(res.quenum>100){
                var msg="当前排队人数大于100,你是否确认接单？";
                openConfirm(msg, "提示",{ width: 250,height: 50 }, function () {
                    $('#acceptTask').removeAttr("onclick");
                    $('#acceptTask1').removeAttr("onclick");
                    $("#fm").submit(); }, "继续接单",function () {  $.self.parent.$.closeAlert() }, "取消接单");
            }else{
                $('#acceptTask').removeAttr("onclick");
                $('#acceptTask1').removeAttr("onclick");
                $("#fm").submit();
            }
        },'json');
    }
    function CancelTaskQueue() {
     var timestamp=new Date().getTime();
     $.post('<?php echo $this->createUrl('site/cancelqueue');?>', function (r) {
         if(r==0)
         {             window.location.href="/";
         }
     });
    }


</script>
<form action="<?php echo $this->createUrl('site/accepttask'); ?>" style="min-width: 1200px;" enctype="multipart/form-data" id="fm" method="post">        <!--banner-->
<input id="FineTaskClassType" name="FineTaskClassType" type="hidden" value="">
<input id="outtime" name="outtime" type="hidden" value="<?=time();?>">
    <div class="banner_2" style="overflow: hidden">
              <div class="ban_1100">
                <span class="bannerleft">
                    <img src="<?php echo S_IMAGES;?>bannerleft.png" ></span>
                <div class="banneright" >
                    <div class="ban_tab">
                        <span class="tack1 cur">销量任务</span> <span class="tack2">复购任务</span>
                    </div>
                    <div class="task_one tabContant" id="ban1">
                        <div class="checklist_div1">
                            <dl class="checklist">
                                <dt>选择平台：</dt>
                                <dd class="selected">
                                    <input type="checkbox" name="PlatformTypes" id="cbTBPlatformTypess" value="0"checked="&#39;checked&#39;">
                                    <a disabled="disabled"  class="checkbox-select" id="cbTBPlatformTypes">淘宝</a> <a disabled="disabled"  class="checkbox-deselect">淘宝</a>
                                </dd>
                               <!-- <dd>
                                    <input type="checkbox" name="PlatformTypes" id="cbJDPlatformTypess" value="京东">
                                    <a class="checkbox-select" id="cbJDPlatformTypes" href="http://aaa.wkquan.com/#">京东</a><a class="checkbox-deselect" href="http://aaa.wkquan.com/#">京东</a>
                                </dd>-->
                            </dl>
                        </div>
                        <div class="checklist_div1">
                            <dl class="checklist">
                                <dt>下单终端：</dt>
                                <dd class="selected">
                                    <input type="checkbox" name="TaskType" id="pcTaskType" value="PC" checked="&#39;checked&#39;">
                                    <input type="hidden" name="TaskTypelen" value="" >
                                    <a class="checkbox-select" >电脑端</a> <a class="checkbox-deselect select_type" >电脑端</a>
                                </dd>
                                <dd class="selected">
                                    <input type="checkbox" name="TaskType" id="appTaskType" value="无线端" checked="&#39;checked&#39;">
                                    <a class="checkbox-select" >无线端</a> <a class="checkbox-deselect select_type" >无线端</a>
                                </dd>
                            </dl>
                        </div>

                        <div class="input_div1">
                            <label>
                                金额上限：</label>
                            <input class="inputjine" data-val="true" data-val-number="字段 TaskPriceEnd 必须是一个数字。" id="TaskPriceEnd" maxlength="5" name="TaskPriceEnd" onblur="value=value.replace(/[^0-9]/g,&#39;&#39;)" onkeyup="value=value.replace(/[^0-9]/g,&#39;&#39;)" oninput="value=value.replace(/[^0-9]/g,&#39;&#39;)" placeholder="默认等于信用积分总分" type="text" value="">
                        </div>
                        <div class="actionan">
                            <a href="javascript:void(0)" class="btn_action action" onclick="AcceptTask(&#39;0&#39;)" id="acceptTask">开始任务</a>
                        </div>
                    </div>
                    <div class="task_two tabContant">
                        <div class="checklist_div1">
                            <dl class="checklist">
                                <dt>选择平台：</dt>
                                <dd class="selected">
                                    <input type="checkbox" name="FGPlatformTypes" id="cbTBPlatformTypess1" value="淘宝" checked="&#39;checked&#39;">
                                    <a class="checkbox-select" id="cbTBPlatformTypes1">淘宝</a> <a class="checkbox-deselect " >淘宝</a>
                                </dd>
                            </dl>
                        </div>
                        <div class="checklist_div1">
                            <dl class="checklist">
                                <dt>下单终端：</dt>
                                <dd class="selected">
                                    <input type="checkbox" name="FGTaskType" id="pcTaskType1" value="PC" checked="&#39;checked&#39;">
                                    <a class="checkbox-select">电脑端</a> <a class="checkbox-deselect select_type" >电脑端</a>
                                </dd>
                                <dd class="selected">
                                    <input type="checkbox" name="FGTaskType" id="appTaskType1" value="无线端" checked="&#39;checked&#39;">
                                    <a class="checkbox-select">无线端</a> <a class="checkbox-deselect select_type" >无线端</a>
                                </dd>
                            </dl>
                        </div>
                        <div class="input_div1">
                            <label>
                                金额上限：</label>
                            <input class="inputjine" data-val="true" data-val-number="字段 FGTaskPriceEnd 必须是一个数字。" id="TaskPriceEnd1" maxlength="5" name="FGTaskPriceEnd" onblur="value=value.replace(/[^0-9]/g,&#39;&#39;)" onkeyup="value=value.replace(/[^0-9]/g,&#39;&#39;)" oninput="value=value.replace(/[^0-9]/g,&#39;&#39;)" placeholder="默认无上限" style="text-align:center;" type="text" value="">
                        </div>
                        <div class="actionan">
                            <a href="javascript:void(0)" class="btn_action action" onclick="AcceptTask(&#39;1&#39;)" id="acceptTask1">开始任务</a>
                        </div>
                        <div class="tabcontant2_txt1 clear">
                            <b style="font-weight: bolder;">特点</b>
                            <ul>
                                <li>目标商品易查找</li>
                                <li>同时受淘宝接手机会限制</li>
                            </ul>
                        </div>
                    </div>
                    <div class="tabContant tack_laoding" id="ban2">
                        <h2 id="hTask2">
                            等待分配任务</h2>
                        <h3 id="hTask3">
                            前面还有<b id="bCount"><?=@$length?></b>位小伙伴在排队</h3>
                        <span id="loading1">
                            <img src="<?php echo S_IMAGES;?>loading.gif"></span>
                        <span id="loading2" style="display: none">
                            <img src="<?php echo S_IMAGES;?>loading.png"></span>
                        <div class="actionan">
                            <a href="javascript:void(0)" class="btn_action" id="bntOk" onclick="CancelTaskQueue()">
                                停止接单</a>
                        </div>
                        <div class="actionan btn_fail" id="divReAccept" style="display:none">
                              <a href="<?=$this->createUrl('site/index');?>" class="b_4882f0 fl">重新接单</a>
                              <a href="javascript:" class="b_f90 fr dis_fg_block" onclick="AcceptTask(&#39;1&#39;)" style="background:#1e9223; color:White">接手复购任务
                                  <div class="dis_black_fg">
                                      <em></em>复购任务目标商品易查找，接手成功机率高
                                  </div>
                              </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--banner-->
</form>    <!--banner-->
    <!--sy_main-->
    <div class="skmain container">
        <div class="skmain1">
            <div class="skmain2_l1">
                <h3>
                    待办事项</h3>
                <h4>
                    <strong>温馨提示：</strong>需要对以下任务点击查看后才能继续接手任务！</h4>
                <table class="skmain1_t1">
                    <tbody><tr>
                        <td>
                            <span>评价任务</span>
                        </td>
                        <td style="text-align: left">
                            您存在<strong><?=empty($evaltaskcount)?0:$evaltaskcount;?></strong>个待评价任务！
                        </td>
                        <td>
                            <a href="<?=$this->createUrl('task/evaltasklist');?>">
                                立刻评价</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span>客服工单</span>
                        </td>
                        <td style="text-align: left">
                            您存在<strong>0</strong>个待确认的工单！
                        </td>
                        <td>
                            <a href="<?=$this->createUrl('schedual/scheduallist')?>">立即查看</a>
                        </td>
                    </tr>
                </tbody></table>
            </div>
            <div class="skmain2_l2">
                <h3>
                    账号余额</h3>
                <ul>
                    <li><a href="<?=$this->createUrl('user/index');?>" target="_blank">账户存款：<strong><?=$authinfo->Money;?>
                    </strong>元</a>
                        <div class="lihover">
                            <span><a href="<?=$this->createUrl('user/index')?>" target="_blank">点我查看</a></span></div>
                    </li>
                    <li><a href="<?=$this->createUrl('finance/recordlist')?>" target="_blank">累计赚取佣金：<strong><?=$countprice?></strong>元</a>
                        <div class="lihover">
                            <span><a href="<?=$this->createUrl('finance/recordlist')?>" target="_blank">点我查看</a></span></div>
                    </li>

                </ul>
            </div>
            <div class="skmain2_l3">
                <h3>
                    平台公告</h3>
                <div class="skmain_rx1">
                    <ul>
                        <li><a href="<?=$this->createUrl('other/newsinfo',array('id'=>204))?>" target="_blank">
                            <em class="syli5"></em><span>佣金标准</span></a></li>
                        <li><a href="<?=$this->createUrl('other/newsinfo',array('id'=>205))?>" target="_blank"><em class="syli6"></em><span>新手教程</span></a></li>
                        <li><a href="<?=$this->createUrl('other/contentindex');?>"><em class="syli7"></em><span>所有公告</span></a></li>
                        <li><a target="_blank" id="serviceQQ" href="http://wpa.qq.com/msgrd?v=3&uin=<?=@$kefu->value?>&site=&menu=yes">
                            <em class="syli8"></em><span>联系客服</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            jQuery.closeConfirm = function () {
                $("#ow_confirm002").remove(); //2.删除主内容层
                $("#ow_confirm001").remove(); //1.删除透明层
            }
        });

        function openConfirm(message, title, obj, fun1, buttonText1, fun2, buttonText2) {
            if ($("#ow_confirm002").length > 0) {
                return false;
            }
            if (obj == null) {
                obj = { width: 250, height: 50 };
            }
            if (buttonText1 == null || buttonText1 == "" || buttonText2 == null || buttonText2 == "") {
                return false;
            }
            //1.创建透明层
            //2.创建主内容层
            var height = obj.height < 210 ? 210 : obj.height;
            var width = obj.width < 350 ? 350 : obj.width;
            var scrollH = $(document).scrollTop();
            var scrollL = $(document).scrollLeft();
            var topVal = ($(window).height() - height) / 2 + scrollH;
            var leftVal = ($(window).width() - width) / 2 + scrollL;
            var aleft = width / 2 - 80/*关闭按钮宽度的一半-20px padding*/;
            if (topVal < 0) {
                topVal = 10;
            }
            var el = "<div class='sjzc_t' id='ow_confirm002'><div class='sjzc_1_t' style='color:Red; text-align:center;'>{title}</div><div class='sjzc_2_t'><div class='sjzc_5_t' style='margin-top: 10px; '><div style='overflow:auto'>{message}</div><div class='sjzc_5_t' style='margin-top: 20px;'><ul><li class='sjzc_7_t'><a href='javascript:void(0)' style='display:inline-block;background-color:#e58a01;' id='ow_confirm002_fun'></a><a href='javascript:void(0)' style='margin-left:10px; display:inline-block' class='ad' id='ow_confirm002_fun2'></a></li></ul></div></div></div></div>";
            el = el.replace(/{title}/, title);
            el = el.replace(/{message}/, message);
            //el = el.replace(/{aleft}/, aleft);
            //1.创建透明层
            $("<div id='ow_confirm001' class='ow_black_overlay' style='z-index: 1003'></div>")
                    .height($(document).height())
                    .width($(document).width())
                    .appendTo($("body"));
            //2.创建主内容层 
            $(el)
            //.height(height)
                    .width(width)
                    .css("left", leftVal)
                    .css("top", topVal)
                    .appendTo($("body"));

            $("#ow_confirm002_fun")
    .text(buttonText1)
    .click(function () {
        $.closeConfirm();
        if (typeof fun1 == 'function') {
            fun1(); //回调函数
        }
    });

            $("#ow_confirm002_fun2")
    .text(buttonText2)
    .click(function () {
        $.closeConfirm();
        if (typeof fun2 == 'function') {
            fun2(); //回调函数
        }
    });


        }
    </script>





