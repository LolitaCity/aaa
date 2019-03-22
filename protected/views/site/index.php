<link href="<?php echo S_CSS;?>user_index.css" rel="stylesheet" type="text/css">
<?php
$authinfo = User::model ()->findByPk ( Yii::app ()->user->getId () );
$authperson = System::model ()->findByAttributes ( array (
    "varname" => "authperson"
) ); // 检测是否要求实名认证
$wangwang = Blindwangwang::model ()->find ( 'userid=' . Yii::app ()->user->getId () );
if (Yii::app ()->session ['closeNews'] != 1 && $authinfo->AuthPerson == 1 && $authperson->value == 1 && ! empty ( $wangwang->statue )) :
    ?>
    <script>
        $.openWin(600,800,'<?php echo $this->createUrl('other/IndexWinopen');?>');
    </script>
<?php endif;?>

<?php if (!empty($acceptarr) && $acceptarr['err_code'] == 2):?>
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
<!-- 特效初始化-->
<script>
    $(document).ready(function(){
        $(".bannerleft img").animate({left:0,opacity:'1'},900);
        //控制销量任务top 特效
        $(".banneright").animate({right:0,opacity:'1'},500);
        //选择平台特效
        $(".checklist .checkbox-select").click(
            function(event) {
                event.preventDefault();
                $(this).parent().addClass("selected");
                $(this).parent().find(":checkbox").attr("checked","checked");
            }
        );
        //选择终端特效
        $(".checklist .select_type").click(
            function(event) {
                event.preventDefault();
                //遍历 selected
                $(this).parent().removeClass("selected");
                $(this).parent().find(":checkbox").removeAttr("checked");
            }
        );
    })
	
	 var guid ="<?php echo $guid;?>"; 
</script>
<!--首页加载默认销量任务-->
<script type="application/javascript">

    function tack1(){
        $(".task_one").show();
        $(".task_two").hide();
        $(".tack_laoding").hide();
        $(".tack2").removeClass("cur");
        $(".tack1").addClass("cur");
    }
    function tack2(){
        $(".task_two").show();
        $(".task_one").hide();
        $(".tack_laoding").hide();
        $(".tack1").removeClass("cur");
        $(".tack2").addClass("cur");
    }
</script>

<!--排队关键处理-->
<script>
    //判定表单是否提交成功 状态改变 isQueue 为显示等待排队特效并发送请求
    socket = null ;
    $(document).ready(function () {
    	<?php if ($has_pre > 0):?>
    		layer.alert('您今日有待付款的预约单，请前往完成该预约单', {closeBtn: false, btn: ['前往完成'], shade: 0.8, title: '系统提示'}, function(){
    			location.href = '/task/showPretask';
			});
    	<?php endif;?>
               // Bindingbankcard();
        <?PHP if($list['id']){?>
                <?PHP switch ($list['tasktype']){
                case  in_array($list['tasktype'],array(1,3)):  ?>
                $('#acceptTask').removeAttr("onclick");
                $('#acceptTask1').removeAttr("onclick");
                $('#ban1').hide();
                $('#ban3').hide();
                $('#ban2').show();
                $("#hTask2").text("恭喜你");
                $("#hTask3").text("已经成功领取任务");
                $("#loading1").hide();
                $("#loading2").show();
                $("#tack1").attr("onclick","");
                $("#tack2").attr("onclick","");
                $("#bntOk1").css({'display':'block'});
                $("#bntOk").text("开始任务");
                $("#bntOk1").text("取消任务");
                $("#bntOk").attr("onclick","BeginTask01('<?php echo $list['taskid'];?>','PC')");
                $("#bntOk1").attr("onclick","BeginTask02('<?php echo $list['taskid'];?>','PC')");
                var str = '<?php echo str_replace("\r\n","",$list['remark']); ?>';
                var taskid = <?php echo $list['taskid'];?>;
                Getdengtime("15","01",taskid);
                layer.confirm('店铺名称：<?php echo $list['shopname'];?><br/>任务说明:'+str+'<br/>佣金：<?php echo $list['commission'];?>', {
                    btn: ['开始任务',  '取消任务'],
                    end: function(){ 
                    	clearTimeout(task_dengtime);
 					 }
                },function(index, layero){
                    clearTimeout(task_dengtime);
                    BeginTask01('<?php echo $list['taskid'];?>','PC');
                },function(index){
                	clearTimeout(task_dengtime);
                    BeginTask02('<?php echo $list['taskid'];?>','PC');
                });
                <?PHP break;
                case  4:   ?>
                <?PHP if($list['status'] == 0){?>
                $('#acceptTask').removeAttr("onclick");
                $('#acceptTask1').removeAttr("onclick");
                $('#ban1').hide();
                $('#ban3').hide();
                $('#ban2').show();
                $("#hTask2").text("恭喜你");
                $("#hTask3").text("已经成功领取任务");
                $("#loading1").hide();
                $("#loading2").show();
                $("#tack1").attr("onclick","");
                $("#tack2").attr("onclick","");
                $("#bntOk1").css({'display':'block'});
                $("#bntOk").text("开始任务");
                $("#bntOk1").text("取消任务");
                $("#bntOk").attr("onclick","BeginTask03('<?php echo $list['id'];?>','PC')");
                $("#bntOk1").attr("onclick","BeginTask05('<?php echo $list['id'];?>','PC')");
                var str = '<?php echo str_replace("\r\n","",$list['remark']); ?>';
                 Getdengtimeyu("15","01",<?php echo $list['id'];?>);
                layer.confirm('店铺名称：<?php echo $list['shopname'];?><br/>任务说明:'+str+'<br/>佣金：<?php echo $list['commission'];?>', {
                    btn: ['开始任务',  '取消任务'],
                    end: function(){ 
                    	clearTimeout(task_dengtimeyu);
 					 }
                }, function(index, layero){
                	clearTimeout(task_dengtimeyu)
                    BeginTask03('<?php echo $list['id'];?>','PC');
                }, function(index){
                	clearTimeout(task_dengtimeyu)
                    BeginTask05('<?php echo $list['id'];?>','PC');
                });
                <?PHP } ?>

                <?PHP break;
                case  5:   ?>
                <?PHP if($list['status'] == 0){?>
                $('#acceptTask').removeAttr("onclick");
                $('#acceptTask1').removeAttr("onclick");
                $('#ban1').hide();
                $('#ban3').hide();
                $('#ban2').show();
                $("#hTask2").text("恭喜你");
                $("#hTask3").text("已经成功领取任务");
                $("#loading1").hide();
                $("#loading2").show();
                $("#tack1").attr("onclick","");
                $("#tack2").attr("onclick","");
                $("#bntOk1").css({'display':'block'});
                $("#bntOk").text("开始任务");
                $("#bntOk1").text("取消任务");
                $("#bntOk").attr("onclick","BeginTask04('<?php echo $list['id'];?>','PC')");
                $("#bntOk1").attr("onclick","BeginTask05('<?php echo $list['id'];?>','PC')");
                var str = '<?php echo str_replace("\r\n","",$list['remark']); ?>';
                Getdengtimeyu("15","01",<?php echo $list['id'];?>);
                layer.confirm('店铺名称：<?php echo $list['shopname'];?><br/>任务说明:'+str+'<br/>佣金：<?php echo $list['commission'];?>', {
                    btn: ['开始任务',  '取消任务'],
                    end: function(){ 
                    	clearTimeout(task_dengtimeyu);
 					 }
                }, function(index, layero){
                	clearTimeout(task_dengtimeyu);
                    BeginTask04('<?php echo $list['id'];?>','PC');
                }, function(index){
                	clearTimeout(task_dengtimeyu);
                    BeginTask05('<?php echo $list['id'];?>','PC');
                });
                <?PHP } 
                	break;?>
                <?PHP }?>


        <?PHP } ?>
    })
    //开始任务(销量任务)
    function BeginTask01(taskId,shebei) {
        var url='/task/Tasktestone/taskid/'+taskId+'/shebei/'+shebei+'.html';
        var index =layer.open({
            type: 2,
            maxmin: true,
            fixed: false, //不固定
            content: url
        });
        layer.full(index);

    }

    //开始任务(预订单任务)
    function BeginTask03(Id,shebei) {
        var url='/task/Taskprelist/id/'+Id+'/shebei/'+shebei+'.html';
        var index =layer.open({
            type: 2,
            maxmin: true,
            fixed: false, //不固定
            content: url
        });

        layer.full(index);

    }

	//开始任务(预约单任务)
    function BeginTask04(Id,shebei) {
        var url='/task/doReservationToBrowse/taskid/'+Id+'/shebei/'+shebei+'.html';
        var index =layer.open({
            type: 2,
            maxmin: true,
            fixed: false, //不固定
            content: url
        });

        layer.full(index);

    }
    
    //取消任务(预订/预约单任务)
    function BeginTask05(Id,shebei) {
    	layer.confirm('每日接完3单销量任务，还可额外做多一单预约单。您是否还要继续取消呢？', function(index){
		    var url='/task/Taskpredel/id/'+Id+'/shebei/'+shebei+'.html';
	        var index =layer.open({
	            type: 2,
	            maxmin: true,
	            fixed: false, //不固定
	            content: url
	        });
	        layer.full(index);
		});
    }
    
    //取消任务(销量任务)
    function BeginTask02(taskId,shebei) {
        var url='/task/taskexit/taskid/'+taskId+'/shebei/'+shebei+'.html';
        layer.open({
            type: 2,
            area: ['500px', '350px'],
            fixed: false, //不固定
            content: url
        });
    }

    //获取产品数量
    function qun(){
        $.ajax({
            type:'POST',
            url:"<?php echo $this->createUrl('site/queuenum') ?>",
            dataType:'json',
            success:function(data){
                if(data.quenum>100){
                    var msg="当前排队人数大于100,你是否确认接单？";
                    openConfirm(msg, "提示",{ width: 250,height: 50 }, function () {
                        $('#acceptTask').removeAttr("onclick");
                        $('#acceptTask1').removeAttr("onclick");
                    }, "继续接单",function () {   GetTasktop(); }, "取消接单");
                }else{
                    $('#acceptTask').removeAttr("onclick");
                    $('#acceptTask1').removeAttr("onclick");
                }
            },error:function(data){

            }
        });
    }
	function Queuedl(){
        var ur = '<?php echo $this->createUrl('site/Queuedl') ?>';
        $.ajax({
            type:'POST',
            url:ur,
            dataType:'json',
            success:function(data) {

            },error:function(data){

            }
        });
    }
    //判定是否绑银行卡
    function Bindingbankcard() {
        $.ajax({ type:'POST',
            url:"<?php echo $this->createUrl('site/Bindingbankcard');?>",
            data: {},
            dataType:'json',
            success:function(data){
                if(data.msg>0){

                }else{
                    layer.open({
                        type: 2,
                        area: ['500px', '350px'],
                        fixed: false, //不固定
                        content: '<?php echo $this->createUrl('site/Binding');?>'
                    });
                }

            },error:function(data){
                //alert("获取产品数量失败");
            }
        });
    }
    DownTaskPoint = 0;
    //开始接单  优化
    function AcceptTask01(i)
    {
		Queuedl();
        //i判断是销量任务还是复购任务
        var TaskCategory = 0;
        if(i=="0")
        {
            var tasklength=$(".task_one input[name='TaskType']:checked").length;
            $(".task_one input[name='TaskTypelen']").val(tasklength)
            if(tasklength==0)
            {
                $.openAlter("亲，请选择下单终端哦~", "提示");
                return;
            }
            var tasktype = $(".task_one input[name='TaskType']:checked").val();
            if(tasktype == 'PC'){
                var DownTaskPoint = 0;
                layer.msg("下单终端:"+tasktype, {icon: 16});
            }else if(tasktype == '无线端' ){
                var DownTaskPoint = 1;
                layer.msg("下单终端:"+tasktype, {icon: 16});
            }
            $("#FineTaskClassType").val('销量任务');
            $("#acceptTask").val("等待排队......");
            var outtime = <?=time();?>;
            var PlatformTypes = 0;
            var TaskType = "无线端";
            var TaskTypelen = $(".task_one input[name='TaskType']:checked").length;
            var TaskPriceEnd = $(".inputjine").val();
            var att = {"outtime":outtime,"PlatformTypes":PlatformTypes,"TaskType":TaskType,"TaskTypelen":TaskTypelen
                ,"TaskPriceEnd":TaskPriceEnd,"FineTaskClassType":"销量任务"}
            var TaskCategory = 0;
        }
        else
        {
            var length=$(".task_two input[name='FGTaskType']:checked").length;
            $(".task_two input[name='FGTaskTypelen']").val(length)
            if(length==0)
            {
                $.openAlter("亲，请选择下单终端哦~", "提示");
                return;
            }
            var FGtasktype = $(".task_one input[name='FGTaskTyp']:checked").val();
            if(FGtasktype == 'PC'){
                var DownTaskPoint = 0;
                layer.msg("下单终端:"+FGtasktype, {icon: 16});
            }else if(FGtasktype == '无线端' ){
                var DownTaskPoint = 1;
                layer.msg("下单终端:"+FGtasktype, {icon: 16});
            }
            $("#FineTaskClassType").val('复购任务');
            $("#acceptTask1").val("等待排队......");
            var outtime = <?=time();?>;
            var FGPlatformTypes = 0;
            var FGTaskType = "无线端";
            var FGTaskTypelen = length;
            var FGTaskPriceEnd = $(".inputjine").val();
            var att = {"outtime":outtime,"FGPlatformTypes":PlatformTypes,"FGTaskType":TaskType,"FGTaskTypelen":TaskTypelen
                ,"FGTaskPriceEnd":TaskPriceEnd,"FineTaskClassType":"复购任务"}
            var TaskCategory = 1;
        }
        $.ajax({
            type:'POST',
            url:"<?php echo $this->createUrl('site/acceptTask01');?>",
            data: att,
			timeout: 0,
            dataType:'json',
            success:function(data){
                if(data.acceptarr.err_code == 2){
                    layer.msg(data.acceptarr.msg, {icon: 16});
                    window.location.href='<?php echo $this->createUrl('site/index');?>';
                }else{

                    layer.msg(data.acceptarr.msg, {icon: 16});
                    $('#acceptTask').attr({"onclick":"AcceptTask01(0)"})
                    $('#acceptTask1').attr({"onclick":"AcceptTask01(1)"})
                    $('#acceptTask').val("开始排队");
                }
                if( data.length == 1 && data.acceptarr.err_code == 9 ){
                    var isQueue = "True";
                }else{
                    var isQueue = "False";
                }
                var timer;
                if (isQueue=='True'){
                    GetTime("0","31");
                    $("#bntOk").attr("onclick","GetTasktop01()");
                    //钱   终端   任务类型
                    localStorage.clear();		
					if (data.is_black_buyer==0 && data.qrnumber < 2)
                    {
                    	$("#bntOk").attr("onclick","GetTasktop()");
                    	GetTask(TaskPriceEnd,DownTaskPoint,TaskCategory);
                    }else{      	
                    }
                }
                //控制特效销售还是复购
                var isFG=data.isFG;
                if(isFG=="True"||isFG=="true"||isFG==true)
                {
                    $(".tack1").removeClass("cur");
                    $(".tack2").addClass("cur");
                    $("#divReAccept").hide();
                }
            },error:function(data){
                $('#acceptTask').removeAttr("disabled");
                $('#acceptTask').val("开始排队");
            }
        });
    }
    //新接单机制
    uu =0;
    function GetTask(TaskPrice,DownTaskPoint,TaskCategory){
        if(socket == null ) {
            //var socket = new WebSocket("ws://class.nxbtech.com:8055/MCR?v=1");
			if(guid == "" || guid ==null){
							layer.alert("链接有误请刷新",
															{icon: 5,time:5000,
															shade: 0.01
															});
						}
           // socket = new WebSocket("<?php echo WS_TASK;?>/Task?UserID=<?=Yii::app ()->user->getId () ?>&TaskPrice="+TaskPrice+"&DownTaskPoint="+DownTaskPoint+"&TaskCategory="+TaskCategory+" ");
			socket = new WebSocket("<?php echo WS_TASK;?>/Task?UserID=<?=Yii::app ()->user->getId () ?>&TaskPrice="+TaskPrice+"&DownTaskPoint="+DownTaskPoint+"&TaskCategory="+TaskCategory+"&token="+guid+" ");
            console.log(socket);
            h = socket;
            //监听连接服务
            socket.onopen = function (event) {
				socket.send("hearbear_xx<?PHP echo Yii::app()->user->getId();?>");
            };
            // 监听Socket的关闭
            socket.onclose = function (event) {
            	clearTimeout(task_countdown);
                if(this != socket)
                    return ;
                //alert('无法连接服务(WebSocket)或已关闭，', event);
                if(uu == 1){

                }else{
                    $("#tack1").attr("onclick","tack1()");
                    $("#tack2").attr("onclick","tack2()")
                    $('#acceptTask').val("开始接任务");
                    $('#acceptTask1').val("开始接任务");
                    $('#acceptTask').attr({"onclick":"AcceptTask01(0)"})
                    $('#acceptTask1').attr({"onclick":"AcceptTask01(1)"})
                    $('#ban1').show();
                    $('#ban3').hide();
                    $('#ban2').hide();
                }
                socket = null ;
            };
            //监听消息
            socket.onmessage = function (event) {
                console.log("==>接收的消息:" + event.data);
                var obj = JSON.parse(event.data);
                // layer.msg(obj.IsOK, {icon: 5});
                if(obj.IsOK){
                    if(obj.RType == 1){
//						if(obj.Data == 0){
//                          $("#bCount").text('正在为您匹配订单，请稍后！');
//                      }else{
//                          $("#bCount").text(obj.Description);
//                      }
                        //$("#bCount").text(obj.Description);
                    }
                    if(obj.RType == 100){
                    	clearTimeout(task_countdown);
                        if(socket){
                            socket.close();
                        }
                        uu = 1;
                        localStorage.clear();
                        $('#acceptTask').removeAttr("onclick");
                        $('#acceptTask1').removeAttr("onclick");
                        $('#ban1').hide();
                        $('#ban3').hide();
                        $('#ban2').show();
                        $("#hTask2").text("恭喜你");
                        $("#hTask3").text("已经成功领取任务");
                        $("#loading1").hide();
                        $("#loading2").show();
                        $("#tack1").attr("onclick","");
                        $("#tack2").attr("onclick","");
                        $("#bntOk1").css({'display':'block'});
                        $("#bntOk").text("开始任务");
                        $("#bntOk1").text("取消任务");
                        $("#bntOk").attr("onclick","BeginTask01("+obj.Data.TaskID+",'PC')");
                        $("#bntOk1").attr("onclick","BeginTask02("+obj.Data.TaskID+",'PC')");
                        Getdengtime("15","01",obj.Data.TaskID);
                        layer.confirm('店铺名称：'+obj.Data.ShopName+'<br/>任务说明：'+obj.Data.Task_Remark+'<br/>佣金：'+obj.Data.UTask_Commission,{
                            btn: ['开始任务',  '取消任务'],
		                    end: function(){ 
		                    	clearTimeout(task_dengtime);
		 					 }       
                        }, function(index, layero){
                        	clearTimeout(task_dengtime);
                            BeginTask01(obj.Data.TaskID,'PC');
                        }, function(index){
                        	clearTimeout(task_dengtime);
                            BeginTask02(obj.Data.TaskID,'PC');
                        });
                    }
                    
                    if(obj.RType == 101){
                    	clearTimeout(task_countdown);
                        if(socket){
                        	clearTimeout(task_countdown)
                            socket.close();
                        }
                        uu = 1;
                        if(obj.Data.TaskType == 4){
		                        localStorage.clear();
		                        $('#acceptTask').removeAttr("onclick");
		                        $('#acceptTask1').removeAttr("onclick");
		                        $('#ban1').hide();
		                        $('#ban3').hide();
		                        $('#ban2').show();
		                        $("#hTask2").text("恭喜你");
		                        $("#hTask3").text("已经成功领取任务");
		                        $("#loading1").hide();
		                        $("#loading2").show();
		                        $("#tack1").attr("onclick","");
		                        $("#tack2").attr("onclick","");
		                        $("#bntOk1").css({'display':'block'});
		                        $("#bntOk").text("开始任务");
		                        $("#bntOk1").text("取消任务");
		                        $("#bntOk").attr("onclick","BeginTask03("+obj.Data.PTaskID+",'PC')");
		                        $("#bntOk1").attr("onclick","BeginTask05("+obj.Data.PTaskID+",'PC')");
		                        Getdengtimeyu("15","01",obj.Data.PTaskID);
		                        layer.confirm('店铺名称：'+obj.Data.ShopName+'<br/>任务说明：'+obj.Data.Task_Remark+'<br/>佣金：'+obj.Data.PTask_Commission,{
		                            btn: ['开始任务',  '取消任务'],
		                            end: function(){ 
				                    	clearTimeout(task_dengtimeyu);
				 					}     
		                        }, function(index, layero){
		                        	clearTimeout(task_dengtimeyu);
		                            BeginTask03(obj.Data.PTaskID,'PC');
		                        }, function(index){
		                        	clearTimeout(task_dengtimeyu);
		                            BeginTask05(obj.Data.PTaskID,'PC');
		                        });
                        }
                        
                        if(obj.Data.TaskType == 5){
		                        localStorage.clear();
		                        $('#acceptTask').removeAttr("onclick");
		                        $('#acceptTask1').removeAttr("onclick");
		                        $('#ban1').hide();
		                        $('#ban3').hide();
		                        $('#ban2').show();
		                        $("#hTask2").text("恭喜你");
		                        $("#hTask3").text("已经成功领取任务");
		                        $("#loading1").hide();
		                        $("#loading2").show();
		                        $("#tack1").attr("onclick","");
		                        $("#tack2").attr("onclick","");
		                        $("#bntOk1").css({'display':'block'});
		                        $("#bntOk").text("开始任务");
		                        $("#bntOk1").text("取消任务");
		                        $("#bntOk").attr("onclick","BeginTask04("+obj.Data.PTaskID+",'PC')");
		                        $("#bntOk1").attr("onclick","BeginTask05("+obj.Data.PTaskID+",'PC')");
		                        Getdengtimeyu("15","01",obj.Data.PTaskID);
		                        layer.confirm('店铺名称：'+obj.Data.ShopName+'<br/>任务说明：'+obj.Data.Task_Remark+'<br/>佣金：'+obj.Data.PTask_Commission,{
		                            btn: ['开始任务',  '取消任务'],
		                            end: function(){ 
				                    	clearTimeout(task_dengtimeyu);
				 					}     
		                        }, function(index, layero){
		                        	clearTimeout(task_dengtimeyu);
		                            BeginTask04(obj.Data.PTaskID,'PC');
		                        }, function(index){
		                        	clearTimeout(task_dengtimeyu);
		                            BeginTask05(obj.Data.PTaskID,'PC');
		                        });
                        }
                    }
                    
                }else{
                    if(obj.RType <0){
                       // layer.msg(obj.Description, {icon: 5});
                        clearTimeout(task_countdown);
						layer.alert(obj.Description,
                            {icon: 5,time:5000,
                            shade: 0.01
                            });
                    }
                }
            };
        }
        else {
            if(socket.close){
            	clearTimeout(task_countdown);
                socket.close() ;
            }
        }
    }
    //取消接单
	function GetTasktop(){
		clearTimeout(task_countdown);
    	if(typeof(socket) != 'undefined')
    	{
    		socket.close();
    	}
        $("#tack1").attr("onclick","tack1()");
        $("#tack2").attr("onclick","tack2()")
        $('#acceptTask').val("开始接任务");
        $('#acceptTask1').val("开始接任务");
        $('#acceptTask').attr({"onclick":"AcceptTask01(0)"})
        $('#acceptTask1').attr({"onclick":"AcceptTask01(1)"})
        $('#ban1').show();
        $('#ban3').hide();
        $('#ban2').hide();
    }
    //取消接单（没建立连接）
    function GetTasktop01(){
    	clearTimeout(task_countdown);
        $("#tack1").attr("onclick","tack1()");
        $("#tack2").attr("onclick","tack2()")
        $('#acceptTask').val("开始接任务");
        $('#acceptTask1').val("开始接任务");
        $('#acceptTask').attr({"onclick":"AcceptTask01(0)"})
        $('#acceptTask1').attr({"onclick":"AcceptTask01(1)"})
        $('#ban1').show();
        $('#ban3').hide();
        $('#ban2').hide();
    }
    //计时器(接任务)
    function GetTime(minuteke1,secondke1){
    	$('#ban1').hide();
        $('#ban3').hide();
        $('#ban2').show();
        $("#tack1").attr("onclick","");
	    $("#tack2").attr("onclick","");
    	secondke1--;
	    if(window.task_countdown)
		{
			clearTimeout(task_countdown);
		}
	    if (secondke1 <= -1 && minuteke1 > 0) {
	        secondke1 = 59;
	        minuteke1--;
	    }
	    if (minuteke1 <= 0) {
	        minuteke1 = 0;
	    }
	    if (minuteke1 <= 0 && secondke1 <= 0) {
	        minuteke1 = 0;
	        secondke1 = 0;
	    }
	    if (minuteke1 == 0 && secondke1 == 0) {
	    	clearTimeout(task_countdown);
	    	layer.msg('暂无匹配任务，建议重新接取',{
				  icon: 1,
				  time: 2000},
            function(){
                $("#tack1").attr("onclick","tack1()");
		        $("#tack2").attr("onclick","tack2()")
		        $('#acceptTask').val("开始接任务");
		        $('#acceptTask1').val("开始接任务");
		        $('#acceptTask').attr({"onclick":"AcceptTask02(0)"})
		        $('#acceptTask1').attr({"onclick":"AcceptTask02(1)"})
		        $('#ban1').show();
		        $('#ban3').hide();
		        $('#ban2').hide();
			}); 	        
	    }
	    else {
	        $("#bCount").text(secondke1+"秒");
	        task_countdown = setTimeout("GetTime('" + minuteke1 + "','" + secondke1 + "')", 1000);
	    }
    }
    //接单还原界面
    function AcceptTask02(i)
    {
        //i判断是销量任务还是复购任务
        var TaskCategory = 0;
        if(i=="0")
        {
            var tasklength=$(".task_one input[name='TaskType']:checked").length;
            $(".task_one input[name='TaskTypelen']").val(tasklength)
            if(tasklength==0)
            {
                $.openAlter("亲，请选择下单终端哦~", "提示");
                return;
            }
            var tasktype = $(".task_one input[name='TaskType']:checked").val();
            if(tasktype == 'PC'){
                var DownTaskPoint = 0;
                layer.msg("下单终端:"+tasktype, {icon: 16});
            }else if(tasktype == '无线端' ){
                var DownTaskPoint = 1;
                layer.msg("下单终端:"+tasktype, {icon: 16});
            }
            $("#FineTaskClassType").val('销量任务');
            $("#acceptTask").val("等待排队......");
            var outtime = <?=time();?>;
            var PlatformTypes = 0;
            var TaskType = "无线端";
            var TaskTypelen = $(".task_one input[name='TaskType']:checked").length;
            var TaskPriceEnd = $(".inputjine").val();
            var att = {"outtime":outtime,"PlatformTypes":PlatformTypes,"TaskType":TaskType,"TaskTypelen":TaskTypelen
                ,"TaskPriceEnd":TaskPriceEnd,"FineTaskClassType":"销量任务"}
            var TaskCategory = 0;
        }else{
            var length=$(".task_two input[name='FGTaskType']:checked").length;
            $(".task_two input[name='FGTaskTypelen']").val(length)
            if(length==0)
            {
                $.openAlter("亲，请选择下单终端哦~", "提示");
                return;
            }
            var FGtasktype = $(".task_one input[name='FGTaskTyp']:checked").val();
            if(FGtasktype == 'PC'){
                var DownTaskPoint = 0;
                layer.msg("下单终端:"+FGtasktype, {icon: 16});
            }else if(FGtasktype == '无线端' ){
                var DownTaskPoint = 1;
                layer.msg("下单终端:"+FGtasktype, {icon: 16});
            }
            $("#FineTaskClassType").val('复购任务');
            $("#acceptTask1").val("等待排队......");
            var outtime = <?=time();?>;
            var FGPlatformTypes = 0;
            var FGTaskType = "无线端";
            var FGTaskTypelen = length;
            var FGTaskPriceEnd = $(".inputjine").val();
            var att = {"outtime":outtime,"FGPlatformTypes":PlatformTypes,"FGTaskType":TaskType,"FGTaskTypelen":TaskTypelen
                ,"FGTaskPriceEnd":TaskPriceEnd,"FineTaskClassType":"复购任务"}
            var TaskCategory = 1;
        }
        GetTime("0","31");
        $('#ban1').hide();
	    $('#ban3').hide();
	    $('#ban2').show();
	    $("#tack1").attr("onclick","");
	    $("#tack2").attr("onclick","");
	    localStorage.clear();                
    }
    
    
     //计时器(等待弹框:销量)
    function Getdengtime(minuteke2,secondke2,$taskid){

    	secondke2--;
	    if(window.task_dengtime)
		{
			clearTimeout(task_dengtime);
		}
	    if (secondke2 <= -1 && minuteke2 > 0) {
	        secondke2 = 59;
	        minuteke2--;
	    }
	    if (minuteke2 <= 0) {
	        minuteke2 = 0;
	    }
	    if (minuteke2 <= 0 && secondke2 <= 0) {
	        minuteke2 = 0;
	        secondke2 = 0;
	    }
	    if (minuteke2 == 0 && secondke2 == 0) {
	    	clearTimeout(task_dengtime);      
	    	var urr = "<?php echo SITE_URL?>/task/Delall.html";
	    	var att = {"taskid":$taskid};
	    	$.ajax({
            type:'POST',
            url:urr,
            data: att,
            dataType:'json',
            success:function(data){
            	
                 window.location.href="<?php echo SITE_URL?>/site/index.html";
            },error:function(data){ 
              
              
            }
        });
	    }
	    else {
	    	console.log(minuteke2+"分"+secondke2+"秒"+$taskid);
	        task_dengtime = setTimeout("Getdengtime('" + minuteke2 + "','" + secondke2 + "','"+$taskid+"')", 1000);
	    }
    }
    
    //计时器(等待弹框:预定)
    function Getdengtimeyu(minuteke3,secondke3,$preid){

    	secondke3--;
	    if(window.task_dengtimeyu)
		{
			clearTimeout(task_dengtimeyu);
		}
	    if (secondke3 <= -1 && minuteke3 > 0) {
	        secondke3 = 59;
	        minuteke3--;
	    }
	    if (minuteke3 <= 0) {
	        minuteke3 = 0;
	    }
	    if (minuteke3 <= 0 && secondke3 <= 0) {
	        minuteke3 = 0;
	        secondke3 = 0;
	    }
	    if (minuteke3 == 0 && secondke3 == 0) {
	    	clearTimeout(task_dengtimeyu);      
	    	var urr = "<?php echo SITE_URL?>/task/Delallyu.html";
	    	var att = {"preid":$preid};
	    	$.ajax({
            type:'POST',
            url:urr,
            data: att,
            dataType:'json',
            success:function(data){
            	
                 window.location.href="<?php echo SITE_URL?>/site/index.html";
            },error:function(data){ 
              
              
            }
        });
	    }
	    else {
	    	console.log(minuteke3+"分"+secondke3+"秒"+$preid);
	        task_dengtimeyu = setTimeout("Getdengtimeyu('" + minuteke3 + "','" + secondke3 + "','"+$preid+"')", 1000);
	    }
    }
    
</script>

<form  style="min-width: 1200px;" enctype="multipart/form-data" id="fm"  method="post" >
    <!--banner-->
    <!--    任务类型-->
    <input id="FineTaskClassType" name="FineTaskClassType" type="hidden" value="">
    <!--    提交的时间-->
    <input id="outtime" name="outtime" type="hidden"  value="<?=time();?>">
    <!--   接任务的夫容器 -->
    <div class="banner_2" style="overflow: hidden">
        <div class="ban_1100">
            <!--背景-->
            <?php if(PLATFORM == 'esx'):?>
            	<span class="bannerleft"> <img  src="<?php echo S_IMAGES;?>bannerleft.png"> </span>
            <?php endif;?>
            <!-- 表特效容器-->
            <div class="banneright">

                <div class="ban_tab">
                    <span class="tack1 cur" onclick="tack1()" id ='tack1'>销量任务</span> <span class="tack2" onclick="tack2()" id ='tack2' style="display: none;">复购任务</span>
                </div>
                <!--       销量任务的表单         -->
                <div class="task_one tabContant" id="ban1">
                    <div class="checklist_div1">

                        <dl class="checklist">
                            <dt>选择平台：</dt>
                            <dd class="selected">
                                <input type="checkbox" name="PlatformTypes"  id="cbTBPlatformTypess" value="0" checked="&#39;checked&#39;">
                                <a disabled="disabled" class="checkbox-select"
                                   id="cbTBPlatformTypes">淘宝</a> <a disabled="disabled"
                                                                    class="checkbox-deselect">淘宝</a>
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
                                <input type="checkbox" name="TaskType" id="pcTaskType"  value="PC" checked="checked">
                                <input type="hidden"  name="TaskTypelen" value=""> <a class="checkbox-select">电脑端</a>
                                <a class="checkbox-deselect select_type">电脑端</a>
                            </dd>
                            <dd class="selected">
                                <input type="checkbox" name="TaskType" id="appTaskType" value="无线端" checked="checked">
                                <a class="checkbox-select">无线端</a>
                                <a class="checkbox-deselect select_type">无线端</a>
                            </dd>
                        </dl>
                    </div>

                    <div class="input_div1">
                        <label> 金额上限：</label> <input class="inputjine" data-val="true"
                                                     data-val-number="字段 TaskPriceEnd 必须是一个数字。" id="TaskPriceEnd"
                                                     maxlength="5" name="TaskPriceEnd"
                                                     onblur="value=value.replace(/[^0-9]/g,&#39;&#39;)"
                                                     onkeyup="value=value.replace(/[^0-9]/g,&#39;&#39;)"
                                                     oninput="value=value.replace(/[^0-9]/g,&#39;&#39;)"
                                                     placeholder="默认等于信用积分总分" type="text" value="">
                    </div>
                    <div class="actionan">
                        <!--                        <a href="javascript:void(0)" class="btn_action action"-->
                        <!--                           onclick="this.disabled=true;this.innerHTML='等待排队';AcceptTask(0)"-->
                        <!--                           id="acceptTask">开始任务</a>-->

                        <input type="button" onclick="AcceptTask01(0)"  id="acceptTask" class="btn_action action" value="开始接任务" >
                    </div>
                </div>
                <!--       复购任务的表单         -->
                <div class="task_two tabContant" id="ban3">
                    <div class="checklist_div1">
                        <dl class="checklist">
                            <dt>选择平台：<?PHP echo $list['id']; ?></dt>
                            <dd class="selected">
                                <input type="checkbox" name="FGPlatformTypes" id="cbTBPlatformTypess1" value="淘宝" checked="checked"> <a
                                        class="checkbox-select" id="cbTBPlatformTypes1">淘宝</a> <a
                                        class="checkbox-deselect ">淘宝</a>
                            </dd>
                        </dl>
                    </div>
                    <div class="checklist_div1">
                        <dl class="checklist">
                            <dt>下单终端：</dt>
                            <dd class="selected">
                                <input type="checkbox" name="FGTaskType" id="pcTaskType1"
                                       value="PC" checked="checked"> <input type="hidden"
                                                                            name="FGTaskTypelen" value=""> <a class="checkbox-select">电脑端</a>
                                <a class="checkbox-deselect select_type">电脑端</a>
                            </dd>
                            <dd class="selected">
                                <input type="checkbox" name="FGTaskType" id="appTaskType1"
                                       value="无线端" checked="checked"> <a class="checkbox-select">无线端</a>
                                <a class="checkbox-deselect select_type">无线端</a>
                            </dd>
                        </dl>
                    </div>
                    <div class="input_div1">
                        <label> 金额上限：</label> <input class="inputjine" data-val="true"
                                                     data-val-number="字段 FGTaskPriceEnd 必须是一个数字。" id="TaskPriceEnd1"
                                                     maxlength="5" name="FGTaskPriceEnd"
                                                     onblur="value=value.replace(/[^0-9]/g,&#39;&#39;)"
                                                     onkeyup="value=value.replace(/[^0-9]/g,&#39;&#39;)"
                                                     oninput="value=value.replace(/[^0-9]/g,&#39;&#39;)"
                                                     placeholder="默认无上限" style="text-align: center;" type="text"
                                                     value="">
                    </div>
                    <div class="actionan">
                        <!--                        <a href="javascript:void(0)" class="btn_action action"-->
                        <!--                           onclick="this.disable=true;this.value='正在提交数据';AcceptTask(1)"-->
                        <!--                           id="acceptTask1">开始任务</a>-->
                        <input type="button" onclick="AcceptTask01(1)"  id="acceptTask1" class="btn_action action" value="开始接任务" >
                    </div>
                    <div class="tabcontant2_txt1 clear">
                        <b style="font-weight: bolder;">特点</b>
                        <ul>
                            <li>目标商品易查找</li>
                            <li>同时受淘宝接手机会限制</li>
                        </ul>
                    </div>
                </div>
                <!--      接到任务的特效          -->
                <div class="tabContant tack_laoding" id="ban2">
                    <h2 id="hTask2">等待分配任务</h2>
                    <h3 id="hTask3">
                        <b id="bCount">正在为您匹配订单，请稍后！</b>
                    </h3>
                    <span id="loading1"> <img src="<?php echo S_IMAGES;?>loading.gif"></span>
                    <span id="getG" style="color: red;font-size: 20px;"></span>
                    <span id="loading2" style="display: none"> <img
                                src="<?php echo S_IMAGES;?>loading.png"></span>
                    <div class="actionan">
                        <a href="javascript:void(0)" class="btn_action" id="bntOk"
                           onclick="GetTasktop()"> 停止接单</a>
                        <a href="javascript:void(0)" class="btn_action" id="bntOk1"
                           onclick="" style="display: none;"> 停止接单</a>
                    </div>
                    <div class="actionan btn_fail" id="divReAccept"
                         style="display: none">
                        <a href="<?=$this->createUrl('site/index');?>" class="b_4882f0 fl">重新接单</a>
                        <a href="javascript:" class="b_f90 fr dis_fg_block"
                           onclick="AcceptTask(1)" style="background: #1e9223; color: White">接手复购任务
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
</form>
<!--banner-->
<!--sy_main 底部菜单-->
<div class="skmain container">
    <div class="skmain1">
        <div class="skmain2_l1">
            <h3>待办事项</h3>
            <h4>
                <strong>温馨提示：</strong>需要对以下任务点击查看后才能继续接手任务！
            </h4>
            <table class="skmain1_t1">
                <tbody>
                <tr>
                    <td><span>评价任务</span></td>
                    <td style="text-align: left">您存在<strong><?=empty($evaluatecount)?0:$evaluatecount;?></strong>个待评价任务！
                    </td>
                    <td><a href="<?=$this->createUrl('task/evaltasklist');?>"> 立刻评价</a>
                    </td>
                </tr>
                <tr>
                    <td><span>客服工单</span></td>
                    <td style="text-align: left">您存在<strong><?=$eschedual?></strong>个待确认的工单！
                    </td>
                    <td><a href="<?=$this->createUrl('schedual/scheduallist')?>">立即查看</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="skmain2_l2">
            <h3>账号余额</h3>
            <ul>
                <li><a href="<?=$this->createUrl('user/index');?>" target="_blank">账户存款：<strong><?=$moneyall;?>
                        </strong>元
                    </a>
                    <div class="lihover">
						<span><a href="<?=$this->createUrl('finance/recordlist')?>"
                                 target="_blank">点我查看</a></span>
                    </div></li>
                <li><a href="<?=$this->createUrl('finance/recordlist')?>"
                       target="_blank">累计赚取佣金：<strong><?=$customer?></strong>元
                    </a>
                    <div class="lihover">
						<span><a href="<?=$this->createUrl('finance/recordlist')?>"
                                 target="_blank">点我查看</a></span>
                    </div></li>

            </ul>
        </div>
        <div class="skmain2_l3">
            <h3>平台公告</h3>
            <div class="skmain_rx1">
                <ul>
                    <li><a
                                href="<?=$this->createUrl('other/newsinfo',array('id'=>204))?>"
                                target="_blank"> <em class="syli5"></em><span>佣金标准</span></a></li>
                    <li><a
                                href="<?=$this->createUrl('other/newsinfo',array('id'=>205))?>"
                                target="_blank"><em class="syli6"></em><span>新手教程</span></a></li>
                    <li><a href="<?=$this->createUrl('other/contentindex');?>"><em
                                    class="syli7"></em><span>所有公告</span></a></li>
                    <li><a target="_blank" id="serviceQQ"
                           href="http://wpa.qq.com/msgrd?v=3&uin=<?=@$kefu?>&site=&menu=yes">
                            <em class="syli8"></em><span>联系客服</span>
                        </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--大于100提示的js 处理特效-->
<script type="text/javascript">
    $(function () {
        jQuery.closeConfirm = function () {
            $("#ow_confirm002").remove(); //2.删除主内容层
            $("#ow_confirm001").remove(); //1.删除透明层
        }
    });
    //内容 标题 窗口大小  方法1 方法1的按钮文本  方法2 方法2的按钮文本 这里用于提示队列大于100后显示的特效
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

