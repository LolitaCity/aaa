<?php
header ( 'Cache-Control:no-cache,must-revalidate' );
header ( 'Pragma:no-cache' );
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $webtitle?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
<link href="<?=M_CSS_URL;?>css.css" rel="stylesheet" type="text/css">
<link href="<?=M_CSS_URL;?>weui.css" rel="stylesheet" type="text/css">
<link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet"  type="text/css">
<link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet"  type="text/css">
<script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>
<script src="<?=M_JS_URL;?>CustomFunc.js" type="text/javascript"> </script>
<script src="<?=M_JS_URL;?>swiper.js" type="text/javascript"> </script>
<script type="text/javascript" src="<?php echo S_JS;?>layer/layer.js"></script>
</head>
<script type="text/javascript">
        $(document).ready(function () {
			if (!sessionStorage.has_show_notice)
        	{
        		layer.open({
					type: 2,
					title: '平台公告',
					shadeClose: true,
					shade: 0.8,
					area: ['95%', '95%'],
					content: '/other/openNews/gid/198.html',
				}); 
				sessionStorage.has_show_notice = 1;
        	}
            //这里获取输入框的金额
            var socket = null ;
            var priceValue= $("#TaskPriceEnd").val();
            if(priceValue!=null&&priceValue!='')
            {
                $("#TaskPriceEnd").val(parseInt(priceValue));
            }

            $(".checklist input:checked").parent().addClass("selected");
            $(".checklist .checkbox-select").click(
                function (event) {
                    event.preventDefault();
                    $(this).parent().addClass("selected");
                    $(this).parent().find(":checkbox").attr("checked", "checked");
                }
            );
            $(".checklist .checkbox-deselect").click(
                function (event) {
                    event.preventDefault();
                    $(this).parent().removeClass("selected");
                    $(this).parent().find(":checkbox").removeAttr("checked");
                }
            );
                 
            <?PHP if($list['id']){?>
            	<?PHP switch($list['tasktype']){
            		 case  in_array($list['tasktype'],array(1,3)): ?>
	              		   $("#showAccept").hide();
			               $("#showWait").hide();
			               $("#dSuccess").show();
			               $("#dFail").hide();
			               var urltask = "<?php echo SITE_URL?>/task/Tasktestone/taskid/<?php echo $list['taskid'];?>/shebei/TX.html"
			               $("#kaisi").attr("href",urltask);
			               $("#tui").attr("onclick","ExitTask(<?php echo $list['taskid'];?>)");
			               var str = '<?php echo str_replace("\r\n","",$list['remark']); ?>';
			               Getdengtime("15","01",<?php echo $list['taskid'];?>);
			               layer.confirm('店铺名称：<?php echo $list['shopname'];?><br/>任务说明：'+str+'<br/>佣金：<?php echo $list['commission'];?>' + '<br>若一直停留在当前页面，该任务倒计时<span id="count_down">15分0秒</span>之后将自动释放', {
					 		 btn: ['开始任务',  '取消任务'],
					 		 end:function(){
					 		 	clearTimeout(task_dengtime);
					 		 }
							}, function(index, layero){
								clearTimeout(task_dengtime);
					            window.location.href = "<?php echo SITE_URL?>/task/Tasktestone/taskid/<?php echo $list['taskid'];?>/shebei/TX.html";
							}, function(index){
								clearTimeout(task_dengtime);
					 		    ExitTask(<?php echo $list['taskid'];?>);
							})
            		 <?PHP break;
					 case  4: ?>
					 <?PHP if($list['status'] == 0){?>
					 	   $("#showAccept").hide();
			               $("#showWait").hide();
			               $("#dSuccess").show();
			               $("#dFail").hide();
			               var urltask = "<?php echo SITE_URL?>/task/Taskprelist/id/<?php echo $list['id'];?>/shebei/TX.html"
			               $("#kaisi").attr("href",urltask);
			               $("#tui").attr("onclick","BeginTask05(<?php echo $list['id'];?>,'TX')");
			               var str = '<?php echo str_replace("\r\n","",$list['remark']); ?>';
			               Getdengtimeyu("15","01",<?php echo $list['id'];?>);
			               layer.confirm('店铺名称：<?php echo $list['shopname'];?><br/>任务说明：'+str+'<br/>佣金：<?php echo $list['commission'];?>' + '<br>若一直停留在当前页面，该任务倒计时<span id="count_down">15分0秒</span>之后将自动释放', {
					 		 btn: ['开始任务',  '取消任务'],
			                    end: function(){ 
			                    	clearTimeout(task_dengtimeyu);
			 					 }
							}, function(index, layero){
								clearTimeout(task_dengtimeyu);
								window.location.href = "<?php echo SITE_URL?>/task/Taskprelist/id/<?php echo $list['id'];?>/shebei/TX.html";					      
							}, function(index){
								clearTimeout(task_dengtimeyu);
					 		    BeginTask05(<?php echo $list['id'];?>,'TX');
							})
					 <?PHP } ?>
					 <?PHP break;
					 case  5: ?>
					 <?PHP if($list['status'] == 0){?>
					 	   $("#showAccept").hide();
			               $("#showWait").hide();
			               $("#dSuccess").show();
			               $("#dFail").hide();
			               var urltask = "<?php echo SITE_URL?>/task/doReservationToBrowse/taskid/<?php echo $list['id'];?>/shebei/TX.html"
			               $("#kaisi").attr("href",urltask);
			               $("#tui").attr("onclick","BeginTask05(<?php echo $list['id'];?>,'TX')");
			               var str = '<?php echo str_replace("\r\n","",$list['remark']); ?>';
			               Getdengtimeyu("15","01",<?php echo $list['id'];?>);
			               layer.confirm('店铺名称：<?php echo $list['shopname'];?><br/>任务说明：'+str+'<br/>佣金：<?php echo $list['commission'];?>' + '' + '<br>若一直停留在当前页面，该任务倒计时<span id="count_down">15分0秒</span>之后将自动释放', {
					 		 btn: ['开始任务',  '取消任务'],
			                    end: function(){ 
			                    	clearTimeout(task_dengtimeyu);
			 					 }
							}, function(index, layero){
								clearTimeout(task_dengtimeyu);
					            window.location.href = "<?php echo SITE_URL?>/task/doReservationToBrowse/taskid/<?php echo $list['id'];?>/shebei/TX.html";		
							}, function(index){
								clearTimeout(task_dengtimeyu);
					 		      BeginTask05(<?php echo $list['id'];?>,'TX');
							})
					 <?PHP } break; ?>
//		               $("#showAccept").hide();
//		               $("#showWait").hide();
//		               $("#dSuccess").show();
//		               $("#dFail").hide();
//		               $("#kaisi").attr("onclick","BeginTask01(<?php echo $list['taskid'];?>,'TX')");
//		               $("#tui").attr("onclick","ExitTask(<?php echo $list['taskid'];?>)");
//		               var str = '<?php echo str_replace("\r\n","",$list['remark']); ?>';
//		               layer.confirm('店铺名称：<?php echo $list['shopname'];?><br/>任务说明：'+str+'<br/>佣金：<?php echo $list['commission'];?>', {
//				 		 btn: ['开始任务',  '取消任务'] //可以无限个按钮
//						}, function(index, layero){
//				              BeginTask01(<?php echo $list['taskid'];?>,'TX');
//						}, function(index){
//				 		      ExitTask(<?php echo $list['taskid'];?>);
//						})
				 <?php  }?>
             <?PHP } ?>          
        });

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
	        var url='/task/Taskpredel/id/'+Id+'/shebei/'+shebei+'.html';
	        var index =layer.open({
	            type: 2,
	            maxmin: true,
	            fixed: false, //不固定
	            content: url
	        });
	
	        layer.full(index);
	
	    }
    </script>
 <!-- css样式 -->
<style type="text/css">
.border_r_bl {
    border: 1px solid #457ee8;
    width: 7px;
    height: 7px;
    border-radius: 100%;
    float: left;
    margin-right: 10px;
    margin-top: 3px;
}

.weui_cell:before {
    left: 0px;
}

.sj_bannerx1 {
    height: 106px;
    justify-content: center;
    display: flex;
    flex-direction: column;
}

.sj_bannerx1 span {
    padding-top: 5px;
    display: block;
}

.banner {
    font-size: 17px;
    line-height: 45px;
    padding: 10px 5%;
}

.sh_11 {
    height: 6.125em;
    margin: 0px auto;
    padding: 15px;
    width: 16.500em;
}

.sh_11 a {
    background: #ce0a0a;
    border-radius: 35px;
    color: #fff;
    display: block;
    font-size: 1.5em;
    height: 3.125em;
    line-height: 3.125em;
    text-align: center;
}

.sh_11 p {
    color: Red;
    font-size: 1em;
    height: 2.500em;
    line-height: 2.500em;
}

div, img {
    border: 0;
    margin: 0;
    padding: 0;
}

h2, h3, h4, h5, h6 {
    font-size: 12px;
    font-weight: normal;
    margin: 0;
    padding: 0;
}

div, img {
    border: 0;
    margin: 0;
    padding: 0;
}

h2, h3, h4, h5, h6 {
    font-size: 12px;
    font-weight: normal;
    margin: 0;
    padding: 0;
}

.ddfb_1 {
    background: #fff;
    height: auto;
    margin: 0 auto;
    max-width: 1002px;
    padding: 20px 0px;
    text-align: center;
    width: 100%;
}

.ddfb_1 h2 {
    font-size: 24px;
}

.ddfb_1 h3 {
    font-size: 16px;
    height: 45px;
    line-height: 45px;
}

.ddfb_1 h3 b {
    color: #ff9900;
}

.ddfb_1 h4 a {
    background: #ce0a0a;
    border-radius: 30px;
    color: #fff;
    display: block;
    font-size: 18px;
    height: 35px;
    line-height: 35px;
    margin: 10px auto;
    text-decoration: none;
    width: 60%;
}

.tack_height {
    height: 282px;
}

.Sales_task h2, .Sales_task1 h2 {
    font-size: 16px;
    text-align: center;
}

.task {
    float: left;
    width: 55%;
    margin-top: 10px;
    padding-right: 5%;
    border-right: 1px dotted #ccc;
}

.tackTitle {
    float: right;
    width: 37%;
    min-height: 135px;
}

.task li {
    width: 100%;
    position: relative;
    margin-bottom: 7px;
}

.task li:last-child {
    margin-bottom: 0px;
}

input[type="checkbox"] {
    position: absolute;
    clip: rect(0, 0, 0, 0);
    z-index: 99;
}

.Sales_task1 {
    height: 258px;
}

.Sales_task_x1 {
    width: 94%;
    display: block;
    text-align: center;
    height: 160px;
    margin-top: 10px;
    display: flex;
    justify-content: center;
    flex-direction: column;
}

.Sales_task_x1 h3 {
    font-size: 18px;
    height: 45px;
    font-weight: bold;
    line-height: 45px;
    color: #ce0a0a;
}

.Sales_task_x1 h4 {
    line-height: 45px;
    font-size: 16px;
}

.Sales_task_x1 h4 b {
    color: #f90;
    margin: 0px 5px;
}

.Sales_task1 span img {
    width: 50%;
    margin: 0px auto;
}
/*选择任务类型的样式*/
input[type="checkbox"]+label {
    height: 30px;
    line-height: 30px;
    border: 1px dotted #ccc;
    border-radius: 3px;
    padding: 0px 5px;
    display: block;
    color: #999;
    font-weight: bold;
}

input[type="checkbox"]:checked+label, input[type="checkbox"]:active+label
    {
    border: 1px solid #ce0a0a;
    color: #ce0a0a;
}

input[type="checkbox"]:checked+label span, input[type="checkbox"]:active+label span
    {
    color: #222;
}

input[type="checkbox"]:checked+label b, input[type="checkbox"]:active+label b
    {
    color: red;
}

.task span {
    position: absolute;
    right: 5px;
    top: 0px;
    line-height: 30px;
    font-weight: normal;
    color: #999;
}

.task b {
    width: 25px;
    color: #999;
    float: right;
    margin-left: 4px;
    text-align: center;
}

.tackTitle span {
    background: url(<?=M_IMG_URL;?>yes.png) no-repeat left center;
    width: 100%;
    background-size: 18%;
    font-size: 16px;
    padding-left: 25%;
    display: block;
    height: 60px;
    line-height: 60px;
}

.tackTitle span.cur {
    background: url(<?=M_IMG_URL;?>yes1.png) no-repeat left center;
    width: 100%;
    background-size: 18%;
    color: #ce0a0a;
}

.task_two {
    display: none;
}

.task_p {
    border: 1px dotted #ccc;
    margin-top: 5px;
    padding: 8px 5px;
}

.task_p label {
    font-weight: bold;
    font-size: 14px;
    color: #ce0a0a;
}

.tack_input1 {
    position: relative;
    display: inline-block;
    width: 100%;
    margin-top: -15px;
}

.tack_input1 em {
    width: 30px;
    height: 30px;
    display: block;
    position: absolute;
    top: 10px;
    left: 10px;
    background: url(<?=M_IMG_URL;?>jin_e.gif) no-repeat left center;
    background-size: 100%;
}

.input_50 {
    text-indent: 50px;
}

.tack_input input {
    margin-top: 5px;
    border: 1px dotted #ccc;
    width: 100%;
    height: 37px;
    line-height: 37px;
}

.tack_input .bg_blue {
    margin-top: 10px;
    display: block;
    text-align: center;
    width: 100%;
    height: 43px;
    line-height: 43px;
    border-radius: 2px;
}

.tack_input input, .tack_fail input {
    margin-top: 5px;
    border: 1px dotted #ccc;
    width: 94%;
    height: 37px;
    line-height: 37px;
}

.tack_input .bg_blue {
    margin-top: 10px;
    display: block;
    text-align: center;
    width: 100%;
    height: 43px;
    line-height: 43px;
    border-radius: 2px;
}

.tack_fail a {
    width: 48%;
    height: 43px;
    line-height: 43px;
    text-align: center;
    border-radius: 3px;
    margin-top: 10px;
}

.ban_left {
    margin-right: 5%;
    width: 25%;
}

.ban_left img {
    border-radius: 50%;
    width: 80px;
    height: 80px;
    border: 3px solid #97b7f3;
    margin-top: 10px;
}
</style>
<script type="text/javascript">
	    socket = null ;
        var timer;
        //前端特效 排队是否大于100
        $(document).ready(function() {
             Bindingbankcard();
            // var ftype = '<?=!empty($isFG)?1:0?>';
            // if(ftype==0)
            // {
            //  alert("ftype：普通"+ftype);
            //     $("#acceptTask2").hide();
            //     $("#acceptTask3").show();
            //     $("#aFg").show();
            // }
            // else{
            //  alert("ftype复购：无");
            //     $("#acceptTask2").show();
            //     $("#acceptTask3").hide();
            //     $("#aFg").hide();
            // }
            // 点击普通
            $(".tack1").click(function(){
                //alert("点击：tack1");
                $(".task_one").show();
                $(".task_two").hide();
                $(".tack2").removeClass("cur");
                $(".tack1").addClass("cur");
            });
            // 点击复购
            $(".tack2").click(function(){
                //alert("点击：tack2");
                $(".task_two").show();
                $(".task_one").hide();
                $(".tack1").removeClass("cur");
                $(".tack2").addClass("cur");
            })

            //用判定人数
            // var isWait = '<?php if (!empty($length) && empty($acceptarr)){echo "true";}else{ echo "false";}?>';;
            // if (isWait == "true") {

            //     var totalwait = parseInt('<?=$length;?>');//等待人数
            //     var showWait = "";
            //     if (totalwait > 100) {
            //         showWait = "大于" + 100;
            //     } else {
            //         showWait = totalwait;
            //     }
            //     $("#waitCount").text(showWait);
            //     $("#showWait").show();
            //     $("#showAccept").hide();
            //     //timer = setInterval(function() { GetWait(); }, 1000 * 5);
            //    //进入排队发送排队的请求
            //     GetWait();
            // }

        });

        //判定是否绑银行卡
        function Bindingbankcard(){
            $.ajax({ type:'POST',
                url:"<?php echo SITE_URL.'site/Bindingbankcard';?>",
                data: {},
                dataType:'json',
                success:function(data){
                    if(data.msg>0){



                    }else{
                        layer.open({
                            type: 2,
                            area: ['500px', '350px'],
                            fixed: false, //不固定
                            content: '<?php echo SITE_URL.'site/Binding';?>'
                        });
                    }

                },error:function(data){
                    //alert("获取产品数量失败");
                }
            });
        }
 		//退出任务（销量任务）
        function ExitTask(taskId) {
            var url='/mobile/task/taskexit/taskid/'+taskId+'.html';
			$.openWin(260, 290, url);
        }
        //发送请求接单 
        function AcceptTask() {
            var selectType="0";//销量任务还是复购任务 状态
            var classFG=$("#fgSpan").attr("class");//复购类名
            alert("后去"+classFG);
           //判定任务的类型，进行赋值
            if(classFG=="tack2 cur")
            {
                selectType="1";
            }
            var taskPriceEnd = $("#TaskPriceEnd").val();            
            var platformTypeStr = "";//购物平台，淘宝
            var fineTaskClassType="销量任务";
            alert("后去"+classFG);
            if(selectType=="0")
            {
                //检测选择的平台
                var length = $("input[name='PlatformTypes']:checked").length;
                if (length == 0) {
                    $.openAlter("请先选择购物平台哦~", "提示");
                    return;
                }

                $("input[name='PlatformTypes']:checked").each(function() {
                    platformTypeStr += $(this).val() + ",";
                });
                if(platformTypeStr!="")
                    platformTypeStr = platformTypeStr.substr(0, platformTypeStr.length - 1);

                $("#FineTaskClassType").val('销量任务');
            }
            else
            {

                var length = $("input[name='FGPlatformTypes']:checked").length;
                if (length == 0) {
                    $.openAlter("请先选择购物平台哦~", "提示");
                    return;
                }

                $("#FineTaskClassType").val('复购任务');
                fineTaskClassType="复购任务";
            }

           // 发送接单请求
            $.ajax({
                type: "post",
                url: "<?php echo SITE_URL.'default/queuenum';?>",
                data: {tasktype:selectType},
                traditional: true,//这里设置为true
                dataType: "json",
                success: function(res) {
                     if(res.quenum>100){
                        $.openWin(220, 300, '/mobile/default/openconfirm/platformtype/'+ platformTypeStr+"/taskPriceEnd/"+taskPriceEnd+"/fineTaskClassType/"+fineTaskClassType+'.html');
                    }else{
                        ConfirmAccept();
                    }           
                    
                }
            });
        }
        //接单优化
        //获取产品数量
        // function qun(){
        //$.ajax({
        //    type:'POST',
        //    url:"<?php //echo SITE_URL.'site/queuenum'; ?>//",
        //    dataType:'json',
        //    success:function(data){
        //        if(data.quenum>100){
        //           alert('队伍大于100');
        //        }else{
        //            //$("#waitCount").text(data.quenum);
        //            if ($('#acceptTask').length > 0) $('#acceptTask').removeAttr("onclick");
        //            if ($('#acceptTask2').length > 0) $('#acceptTask2').removeAttr("onclick");
        //            $("#dSuccess").hide();
        //            $("#dFail").hide();
        //            $("#showAccept").hide();
        //            $("#showWait").show();
        //             //$("#fm").submit();
        //        }
        //    },error:function(data){
        //        alert("获取产品数量失败");
        //    }
        //     });
        //}
        
        AcceptTask01 = function(){

            var selectType="0";//销量任务还是复购任务 状态
            var classFG=$("#fgSpan").attr("class");//复购类名
            //获取金额的val
            var TaskPriceEnd = $("#TaskPriceEnd").val(); 
            var platformTypeStr = "";//购物平台，淘宝
            var outtime = <?=time();?>;
            var TaskCategory = 0;
           //判定任务的类型，进行赋值
            if(classFG=="tack2 cur")
            {
                selectType="1";
            }
            if(selectType=="0")
            {
                //检测选择的平台
                var length = $("input[name='PlatformTypes']:checked").length;
                if (length == 0) {
                    $.openAlter("请先选择购物平台哦~", "提示");
                    return;
                }

                $("input[name='PlatformTypes']:checked").each(function() {
                    platformTypeStr += $(this).val() + ",";
                });

                if(platformTypeStr!=""){
                    platformTypeStr = platformTypeStr.substr(0, platformTypeStr.length - 1);
                }

                $("#FineTaskClassType").val('销量任务');
                 var fineTaskClassType="销量任务";
                //alert("platformTypeStr"+fineTaskClassType);
                var att = {"outtime":outtime,"PlatformTypes":0,"TaskType":"无线端","TaskTypelen":length,"TaskPriceEnd":TaskPriceEnd,"FineTaskClassType":"销量任务"}
               TaskCategory = 0;
              }else{

                var length = $("input[name='FGPlatformTypes']:checked").length;
                if (length == 0) {
                    $.openAlter("请先选择购物平台哦~", "提示");
                    return;
                }
                $("#FineTaskClassType").val('复购任务');
                fineTaskClassType="复购任务";
                
                //alert("platformTypeStr"+fineTaskClassType);
                var FGPlatformTypes=$("input[name='FGPlatformTypes']:checked").val();
                var att = {"outtime":outtime,"PlatformTypes":0,"FGTaskType":"无线端","FGTaskTypelen":length,"FGTaskPriceEnd":TaskPriceEnd,"FineTaskClassType":"复购任务"}
                TaskCategory = 1;
            }
            //发送请求
             $.ajax({
            type:'POST',
            url:"<?php echo SITE_URL.'site/acceptTask01';?>",
            data: att,
            dataType:'json',
            success:function(data){
                if(data.acceptarr.err_code == 2 ) {
                    layer.msg(data.acceptarr.msg, {icon: 16});
                    window.location.href='<?php echo $this->createUrl('task/taskmanage');?>';
                }else if( parseInt(data.acceptarr.err_code) == 8 ){
                     layer.alert(data.acceptarr.msg, {icon: 7});
                    $('#acceptTask').attr("onclick","AcceptTask01()");
                    $('#acceptTask').val("开始排队");
					return false;

                }else{
                    layer.msg(data.acceptarr.msg, {icon: 16});
                    $('#acceptTask').attr("onclick","AcceptTask01()");
                    $('#acceptTask').val("开始排队");
                }
                if( data.length == 1 && data.acceptarr.err_code == 9 ){
                    var isQueue = "True";
                }else{
                    var isQueue = "False";
                }
                if (isQueue == "True") {
//                  if ($('#acceptTask').length > 0) $('#acceptTask').removeAttr("onclick");
//                  if ($('#acceptTask2').length > 0) $('#acceptTask2').removeAttr("onclick");
                    $("#dSuccess").hide();
                    $("#dFail").hide();
                    $("#showAccept").hide();
                    $("#showWait").show();
                   // GetQueueAcceptResult();
                     //钱      终端   任务类型
                    socket = null;
                    localStorage.clear();
                    
					if (data.is_black_buyer==0 <?=PLATFORM == 'esx' ? '' : '&& qrnumber < 2';?>)
                    {
                    	GetTask(TaskPriceEnd,'1',TaskCategory);
                    }
                }else{
                    $("#dSuccess").hide();
                    $("#dFail").hide();
                    $("#showAccept").show();
                    $("#showWait").hide();
                }
                    
            },error:function(data){
                $('#acceptTask').attr("onclick","AcceptTask01()");
                $('#acceptTask').val("开始排队");
                alert("接单失败");
            }
        });
         // qun();
         }
         uu = 0;
         //新接单机制
    function GetTask(TaskPrice,DownTaskPoint,TaskCategory){
        if(socket == null ) {
            //var socket = new WebSocket("ws://class.nxbtech.com:8055/MCR?v=1");
            socket = new WebSocket("<?php echo WS_TASK;?>/Task?UserID=<?=Yii::app ()->user->getId () ?>&TaskPrice="+TaskPrice+"&DownTaskPoint="+DownTaskPoint+"&TaskCategory="+TaskCategory+" ");
            console.log(socket);
            //监听连接服务
            socket.onopen = function (event) {
                //alert("socket.onopen==>" +  JSON.stringify(event));
                $("#btnTest").text( "任务匹配中..." );
            };
            // 监听Socket的关闭
            socket.onclose = function (event) {
                if(this != socket)
                    return ;
                    if(uu == 1){
                    	
                    }else{
                    	$('#acceptTask').attr("onclick","AcceptTask01()");
        	 			$('#acceptTask').val("开始接任务");
        	 			$("#showAccept").show();
             			$("#showWait").hide();
             			$("#dSuccess").hide();
                    }
                //alert('无法连接服务(WebSocket)或已关闭，', event);
                socket = null ;
            };
            //监听消息
            socket.onmessage = function (event) {
                console.log("==>接收的消息:" + event.data);
                var obj = JSON.parse(event.data);
               // layer.msg(obj.IsOK, {icon: 5});
                if(obj.IsOK){
                    if(obj.RType == 1){
                         //layer.msg(obj.Description, {icon: 16});
                        
						 if(obj.Data == 0){
							  $("#waitCount").text('正在为您匹配订单，请稍后！');
						 }else{
							  $("#waitCount").text(obj.Description);
						 }
                        return ;
                    }
                    if(obj.RType == 100){ 
                    	uu == 1;
                        localStorage.clear();
                        $("#showAccept").hide();
               			$("#showWait").hide();
               			$("#dSuccess").show();
               			$("#dFail").hide();
                        var urltask = "<?php echo SITE_URL?>/task/Tasktestone/taskid/"+obj.Data.TaskID+"/shebei/TX.html"
                        $("#kaisi").attr("href",urltask);
			            $("#tui").attr("onclick","ExitTask("+obj.Data.TaskID+")");
                        //$("#bntOk1").attr("onclick","BeginTask02("+obj.Data.id+",'PC')");
                        Getdengtime("15","01",obj.Data.TaskID);
                        layer.confirm('店铺名称：'+obj.Data.ShopName+'<br/>任务说明：'+obj.Data.Task_Remark+'<br/>佣金：'+obj.Data.UTask_Commission + '<br>若一直停留在当前页面，该任务倒计时<span id="count_down">15分0秒</span>之后将自动释放', {
 		 				btn: ['开始任务',  '取消任务'],
	                    end: function(){ 
	                    	clearTimeout(task_dengtime);
	 					 }
						}, function(index, layero){
							clearTimeout(task_dengtime);
 		 				window.location.href = "<?php echo SITE_URL?>/task/Tasktestone/taskid/"+obj.Data.TaskID+"/shebei/TX.html";
						}, function(index){
							clearTimeout(task_dengtime);
 		  				    ExitTask(obj.Data.TaskID);
						});
						if(socket){
                    	 	socket.close(); 
                    	 	} 
                        return ;
                    }
                    
                    if(obj.RType == 101){ 
                    	uu == 1;
                    	 if(obj.Data.TaskType == 4){
                    	 	    localStorage.clear();
		                        $("#showAccept").hide();
		               			$("#showWait").hide();
		               			$("#dSuccess").show();
		               			$("#dFail").hide();
		                        var urltask = "<?php echo SITE_URL?>/task/Taskprelist/id/"+obj.Data.PTaskID+"/shebei/TX.html";
		                        $("#kaisi").attr("href",urltask);
		                        $("#tui").attr("onclick","BeginTask05("+obj.Data.PTaskID+",'TX')");
		                        //$("#bntOk1").attr("onclick","BeginTask02("+obj.Data.id+",'PC')");
		                         Getdengtimeyu("15","01",obj.Data.PTaskID);
		                        layer.confirm('店铺名称：'+obj.Data.ShopName+'<br/>任务说明：'+obj.Data.Task_Remark+'<br/>佣金：'+obj.Data.PTask_Commission + '<br>若一直停留在当前页面，该任务倒计时<span id="count_down">15分0秒</span>之后将自动释放', {
		   		 				btn: ['开始任务',  '取消任务'],
				                      end: function(){ 
				                    	clearTimeout(task_dengtimeyu);
				 					 }
								}, function(index, layero){
									clearTimeout(task_dengtimeyu);
		   		 				  window.location.href = "<?php echo SITE_URL?>/task/Taskprelist/id/"+obj.Data.PTaskID+"/shebei/TX.html";
								}, function(index){
									clearTimeout(task_dengtimeyu);
		   		  				  BeginTask05(obj.Data.PTaskID,'TX')
								});
								if(socket){
		                    	 	socket.close(); 
		                    	 	} 
		                        return ;
                    	 }
                    	 
                    	 if(obj.Data.TaskType == 5){
                    	 	    localStorage.clear();
		                        $("#showAccept").hide();
		               			$("#showWait").hide();
		               			$("#dSuccess").show();
		               			$("#dFail").hide();
		                        var urltask = "<?php echo SITE_URL?>/task/doReservationToBrowse/taskid/"+obj.Data.PTaskID+"/shebei/TX.html";
		                        $("#kaisi").attr("href",urltask);
		                        $("#tui").attr("onclick","BeginTask05("+obj.Data.PTaskID+",'TX')");
		                        //$("#bntOk1").attr("onclick","BeginTask02("+obj.Data.id+",'PC')");
		                        Getdengtimeyu("15","01",obj.Data.PTaskID);
		                        layer.confirm('店铺名称：'+obj.Data.ShopName+'<br/>任务说明：'+obj.Data.Task_Remark+'<br/>佣金：'+obj.Data.PTask_Commission + '<br>若一直停留在当前页面，该任务倒计时<span id="count_down">15分0秒</span>之后将自动释放', {
		   		 				btn: ['开始任务',  '取消任务'],
				                      end: function(){ 
				                    	clearTimeout(task_dengtimeyu);
				 					 }
								}, function(index, layero){
									clearTimeout(task_dengtimeyu);
		   		 				 window.location.href = "<?php echo SITE_URL?>/task/doReservationToBrowse/taskid/"+obj.Data.PTaskID+"/shebei/TX.html";
								}, function(index){
									clearTimeout(task_dengtimeyu);
		   		  				  BeginTask05(obj.Data.PTaskID,'TX')
								});
								if(socket){
		                    	 	socket.close(); 
		                    	 	} 
		                        return ;
                    	 }
//                      localStorage.clear();
//                      $("#showAccept").hide();
//             			$("#showWait").hide();
//             			$("#dSuccess").show();
//             			$("#dFail").hide();
//                      var urltask = "<?php echo SITE_URL?>/task/Tasktestone/taskid/"+obj.Data.TaskID+"/shebei/TX.html"
//                      $("#kaisi").attr("href",urltask);
//                      $("#tui").attr("onclick","ExitTask("+obj.Data.TaskID+")");
//                      //$("#bntOk1").attr("onclick","BeginTask02("+obj.Data.id+",'PC')");
//                      layer.confirm('店铺名称：'+obj.Data.ShopName+'<br/>任务说明：'+obj.Data.Task_Remark+'<br/>佣金：'+obj.Data.UTask_Commission, {
// 		 				btn: ['开始任务',  '取消任务'] //可以无限个按钮
//						}, function(index, layero){
// 		 				 window.location.href = "<?php echo SITE_URL?>/task/Tasktestone/taskid/"+obj.Data.TaskID+"/shebei/TX.html";
//						}, function(index){
// 		  				ExitTask(obj.Data.TaskID);
//						});
//						if(socket){
//                  	 	socket.close(); 
//                  	 	} 
//                      return ;
                    }
                    
                }else{
                    if(obj.RType <0){
//                      if(obj.RType == -1){
//                          return ;
//                      }
                        layer.msg(obj.Description,
                            {icon: 5,time:5000,
                            shade: 0.01
                            });
                    }
                }
            };
        }
        else {
            if(socket.close){
                socket.close();
            }
        }

    	}
         
         function StopAcceptnow(){
        	 socket.close();
        	 $('#acceptTask').attr("onclick","AcceptTask01()");
        	 $('#acceptTask').val("开始接任务");
        	 $("#showAccept").show();
             $("#showWait").hide();
             $("#dSuccess").hide();
        }
        //计时器(等待弹框:销量)
    function Getdengtime(minuteke2,secondke2,$taskid){
		$('span#count_down').html(minuteke2+"分"+secondke2+"秒");
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
            	layer.alert('任务停留在首页超过15分钟，已自动释放', function(){
            		window.location.href="<?php echo SITE_URL?>/mobile/default/index.html";
            	});
            },error:function(data){ 
              
              
            }
        });
	    }
	    else {
	    	//console.log(minuteke2+"分"+secondke2+"秒"+$taskid);
	        task_dengtime = setTimeout("Getdengtime('" + minuteke2 + "','" + secondke2 + "','"+$taskid+"')", 1000);
	    }
    }
    
    //计时器(等待弹框:预定)
    function Getdengtimeyu(minuteke3,secondke3,$preid){
      	$('span#count_down').html(minuteke2+"分"+secondke2+"秒");
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
            	layer.alert('任务停留在首页超过15分钟，已自动释放', function(){
            		window.location.href="<?php echo SITE_URL?>/mobile/default/index.html";
            	});
            },error:function(data){ 
              
              
            }
        });
	    }
	    else {
	    	//console.log(minuteke3+"分"+secondke3+"秒"+$preid);
	        task_dengtimeyu = setTimeout("Getdengtimeyu('" + minuteke3 + "','" + secondke3 + "','"+$preid+"')", 1000);
	    }
    }
        
         
          //进入排队发送排队的请求 优化
        //function GetQueueAcceptResult() {
        //         var funCallback =function(data){
        //            if (data!=null) {
        //                if(data.queueCount>100)
        //                {
        //                    showWait = "大于" + data.queueCount;
        //                }else{
        //                    showWait =data.queueCount;
        //                }
        //
        //            $("#waitCount").text(showWait);
        //
        //            if(data.queueCount<=0){
        //                if(data.taskAcceptRes=='SUCCESS')
        //                {
        //                    $("#showAccept").hide();
        //                    $("#showWait").hide();
        //                    $("#dSuccess").show();
        //                    $("#dFail").hide();
        //                }
        //                else if(data.taskAcceptRes=='FAILED')
        //                {
        //                    $("#showAccept").hide();
        //                    $("#showWait").hide();
        //                    $("#dSuccess").hide();
        //                    $("#dFail").show();
        //
        //                    var remark = data.msg;
        //                    if (remark != "" && remark != null) {
        //                        $.openAlter(remark, '提示');
        //                        if(remark.indexOf('平台暂无任务') > -1)
        //                            $("#lblMsg").show();
        //                        else
        //                            $("#lblMsg").hide();
        //                    }
        //                }
        //                clearInterval(timer);
        //            }
        //            else {
        //                timer=setTimeout(function () {
        //                    GetQueueAcceptResult();
        //                  },8000) ;
        //                }
        //
        //        }
        //         }
        //         //排队请求 和 响应动作
        //$.ajax({
        //    type: 'POST', url:"<?php //echo SITE_URL.'site/GetQueAcceptRes.html?T=WX';?>//", data: {},
        //    success:funCallback ,
        //    error: function (jqXHR, textStatus, errorThrown) {
        //        $('#getG').html('排队失败！!');
        //        StopAccept();
        //        //console.log("jqXHR.status==>" + jqXHR.status + ",textStatus==>" + textStatus + ", errorThrown==>"  + errorThrown  ) ;
        //        timer=setTimeout(function () {
        //            GetQueueAcceptResult();
        //        },8000) ;
        //    }, dataType:'json' , async:true  } );
        //}
       
        
         function BeginTask02(taskId,shebei) {
            var url='/task/taskexit/taskid/'+taskId+'/shebei/'+shebei+'.html';
            layer.open({
                type: 2,
                area: ['260px', '290px'],
                fixed: false, //不固定
                content: url
            });
        }
        
        //显示接单中的特效
        function ConfirmAccept() {
//          if ($('#acceptTask').length > 0) $('#acceptTask').removeAttr("onclick");
//          if ($('#acceptTask2').length > 0) $('#acceptTask2').removeAttr("onclick");
            $("#dSuccess").hide();
            $("#dFail").hide();
            $("#showAccept").hide();
            $("#showWait").show();
            $("#fm").submit();
        }
        //停止接单请求
        function StopAccept() {
            $("#aStopAccept").text("停止中...");
            $("#aStopAccept").removeAttr("onclick");
            $("#fm5").submit();
        }
        
         
//        //进入排队发送排队的请求
//        function GetWait() {
//                     //alert("进入排队");
////var url = "<?php //echo $this->createUrl('default/GetQueAcceptRes');?>//" ;
//var url = "<?php //echo SITE_URL.'site/GetQueAcceptRes.html?T=WX';?>//" ;
//
//            $.ajax({
//                type: "post", url: url, data: {}, dataType:'json', async:true,
//                success: function(data) {
//                    if (data!=null) {
//                        if(data.queueCount>100)
//                        {
//                            showWait = "大于" + data.queueCount;
//                        }else{
//                            showWait =data.queueCount;
//                        }
//
//                    $("#waitCount").text(showWait);
//
//                    if(data.queueCount<=0){
//                        if(data.taskAcceptRes=='SUCCESS')
//                        {
//                            $("#showAccept").hide();
//                            $("#showWait").hide();
//                            $("#dSuccess").show();
//                            $("#dFail").hide();
//                        }
//                        else if(data.taskAcceptRes=='FAILED')
//                        {
//                            $("#showAccept").hide();
//                            $("#showWait").hide();
//                            $("#dSuccess").hide();
//                            $("#dFail").show();
//
//                            var remark = data.msg;
//                            if (remark != "" && remark != null) {
//                                $.openAlter(remark, '提示');
//
//                                if(remark.indexOf('平台暂无任务') > -1)
//                                    $("#lblMsg").show();
//                                else
//                                    $("#lblMsg").hide();
//                            }
//                        }
//                        clearInterval(timer);
//                    }
//                    else {
//                        timer=setTimeout(function () {
//                            GetWait();
//                          },8000) ;
//                        }
//
//                }
//                },
//                error: function (jqXHR, textStatus, errorThrown) {
//                    //console.log("jqXHR.status==>" + jqXHR.status + ",textStatus==>" + textStatus + ", errorThrown==>"  + errorThrown  ) ;
//                    timer=setTimeout(function () {
//                        GetWait();
//                      },8000) ;
//                }
//
//            });
//        }
//
        //选择复购任务
        function btnFg()
        {
            $("#fgSpan").attr("class","tack2 cur");
            AcceptTask();
        }


        
        //信用积分查看详情
        function ShowContent()
        {
            $.openAlter("<div style='text-align:left;'>&nbsp;&nbsp;&nbsp;&nbsp;信用积分=新手测试得分+完善资料个数*30+完成任务数*10-违规次数*对应积分。更多详情请登录电脑端查看。</div>", "提示",{ width: 250,height: 350 });
        }

    </script>
<style>
.pjnum {
    position: absolute;
    top: 0;
    left: 0;
    background: rgb(242, 35, 20);
    color: #fff;
    width: 15px;
    height: 15px;
    text-align: center;
    border-radius: 50%;
    font-size: 12px;
}

.task input[type="checkbox"]:checked+label, .task input[type="checkbox"]:active+label
    {
    border: 1px solid #ce0a0a;
    color: #ce0a0a;
}

.task_one_x1 input[type="checkbox"]+label {
    height: 60px;
    border: 1px dotted #ccc;
    border-radius: 3px;
    padding: 0px 5px;
    display: block;
    color: #999;
    font-weight: bold;
}

.task_one_x1 span {
    font-weight: normal;
    color: #999;
}

.task_fr span {
    display: block;
    font-weight: normal;
    height: 25px;
    line-height: 25px;
}

.task span {
    position: absolute;
    right: 5px;
    top: 0px;
    line-height: 30px;
    font-weight: normal;
    color: #999;
}

.tack_height {
    height: 258px;
}

.Sales_task h2, .Sales_task1 h2 {
    font-size: 16px;
    text-align: center;
}

.task {
    float: left;
    width: 55%;
    margin-top: 10px;
    padding-right: 5%;
    border-right: 1px dotted #ccc;
}

.tackTitle {
    float: right;
    width: 37%;
    min-height: 135px;
}

.task_fl {
    line-height: 60px;
}

.task_fr {
    position: absolute;
    right: 5px;
    top: 5px;
    padding-right: 5px;
}

.task_fr span {
    display: block;
    font-weight: normal;
    height: 25px;
    line-height: 25px;
}

.task_fr span:first-child {
    border-bottom: 1px dotted #ccc;
}

.task li {
    width: 100%;
    position: relative;
    margin-bottom: 17px;
}

.task li:last-child {
    margin-bottom: 0px;
}

.task input[type="checkbox"] {
    position: absolute;
    clip: rect(0, 0, 0, 0);
    z-index: 99;
}

.news_x1 ul li .border_r_bl {
    margin-top: 13px;
}
</style>
<!--<button id="btnTest"  TagVal=0 >开始任务</button>
<script type="text/javascript">

$(function(){
	  socket = null ;
	$("#btnTest").click(function(){
		var me = $(this) ;
		if(socket == null ) {
			//var socket = new WebSocket("ws://class.nxbtech.com:8055/MCR?v=1");
	        socket = new WebSocket("<?php echo WS_TASK;?>/Task?UserID=<?=Yii::app ()->user->getId () ?>&TaskPrice=&DownTaskPoint=&TaskCategory= ");
	        //监听连接服务
	        socket.onopen = function (event) {
	            alert("socket.onopen==>" +  JSON.stringify(event));
	            //var strData = JSON.stringify({Action:"RegUser" ,  UserID:"<?=Yii::app ()->user->getId () ?>" }  )
	            //socket.send ( strData  ) ;
	            $("#btnTest").text( "任务匹配中..." );
	        };
	     	// 监听Socket的关闭
	        socket.onclose = function (event) {
		        if(this != socket)
			        return ;
	            alert('无法连接服务(WebSocket)或已关闭，', event);
	            $("#btnTest").text( "开始任务" );
	            socket = null ;
	        };
	      	//监听消息
	        socket.onmessage = function (event) {
	            console.log("==>接收的消息:" + event.data);
	        };
		} 
		else {

			if(socket.close){
				socket.close() ;
			}
		}
	});

	$("#btnTest2").click(function(){

		if(socket == null) return ;
		var strData = JSON.stringify({Action:"RegUser22" ,  UserID:"<?=Yii::app ()->user->getId () ?>" }  )
        socket.send ( strData  ) ;
	});
	
});-->

</script>
</head>

<body>

<?php if (!empty($acceptarr) && $acceptarr['err_code']==2):?>
<script>
    $.openAlter("<?=$acceptarr['msg'];?>",'提示',{width:250,height:250},function () {
        window.location.href="<?php echo $this->createUrl('task/taskmanage');?>";
    },'知道了')
</script>
<?php elseif(!empty($acceptarr) && $acceptarr['err_code']!=2):?>
<script>
    $.openAlter("<?=$acceptarr['msg'];?>",'提示')
</script>
<?php endif;?>

<div class="cm" style="padding-bottom: 50px;" id="bigbox" title="首页">
   <?php $this->renderPartial("/public/header");?>
    <div class="sj_banner pdg15" style="height: 106px">
            <div class="ban_left  fl">
                <span><img src="<?=M_IMG_URL;?>boy.png"></span>
            </div>
            <div class="sj_bannerx1">
                <p style="font-size: 15px">
                会员帐号：<?=$userinfo['Username'];?>
                <br> <em>当前状态:
                <?php
                if ($userinfo ['Status'] == 0) {
                    if ($auth_statue == 1) {
                        switch ($authperson2){
                            case 0 :
                                echo '未审核';
                                break;
                            case 1 :
                                echo '审核通过';
                                break;
                            case 4 :
                                echo "未通过实名认证";
                            default :
                                '未通过';
                                break;
                        }
                    } else {
                        echo '未实名认证';
                    }
                } else {
                    echo '已冻结';
                }
                ?>
                </em>
                </p>
            <?php if($blindwangwangR==1):?>
            <span> <a id="aBindTB">绑定淘宝买号</a></span>
            <?php endif;?>
        </div>
        </div>
        <div class="yue_1 pdg15">
            <ul>
                <li>
                    <h3>
                        <span>账号余额（元）</span><?=$moneyall;?>
                </h3>
                </li>
                <li>
                    <h3>
                        <span style="margin-left: 0px">信用积分:<?=$userinfo['Score']?>分
                          </span> <a href="javascript:void(0);"
                            onclick="ShowContent()">查看详情</a>
                    </h3>
                </li>
            </ul>
        </div>
        <div class="hxt"></div>
        <!-- 简易菜单 -->
        <div class="zglq hauto">
        	
            <div class="zglq_1 hauto">
                <div class="zglq_3 hauto" style="width: 42%;">
                    <a href="<?=$this->createUrl('task/evaltasklist');?>">
                        <p style="position: relative">
                    <?php if(!empty($countte)):?>
                    <span class="pjnum"><?=$countte;?></span>
                    <?php endif;?>
                    <img src="<?=M_IMG_URL?>tu_11.jpg">
                        </p>
                        <p class="zglq_4">评价任务</p>
                    </a>
                </div>
            </div>
            
            <div class="zglq_2 hauto">
                <div class="zglq_3 hauto" style="width: 40%;">
                    <a href="<?=$this->createUrl('finance/takeoutcash');?>">
                        <p>
                            <img src="<?=M_IMG_URL?>tu_22.jpg">
                        </p>
                        <p class="zglq_4">平台提现</p>
                    </a>
                </div>

            </div>
            <!--11-->

            <!--11-->
        </div>
        <div class="hxt"></div>
        <!--灰色条-->
        <!--前期选择任务界面-->
        <div class="tack_height" id="showAccept" style="">
            <form action="<?php echo $this->createUrl('default/accepttask');?>"
                enctype="multipart/form-data" id="fm" method="post">
                <!-- 发送任务类型 -->
                <input id="FineTaskClassType" name="FineTaskClassType" type="hidden" value=""> 
                <input id="outtime" name="outtime" type="hidden" value="<?=time();?>">
                <div class="Sales_task pad_2_3">
                    <h2>销量任务</h2>
                    <div class="task task_one">
                        <ul>
                            <li id="ddTB"><input type="checkbox" name="PlatformTypes"
                                value="淘宝" id="cbTBPlatformTypes" checked="checked"> <label
                                for="cbTBPlatformTypes"> 淘宝<span>普通接手机会<b>3</b></span></label></li>
                            <div class="task_p">
                                <label>提示</label>
                                <p>一人最多能接3次任务哦</p>
                            </div>

                        </ul>

                    </div>
                    <div class="task task_two">
                        <ul>
                            <li id="ddTB1"><input type="checkbox" name="FGPlatformTypes"
                                value="淘宝" id="cbTBPlatformTypes1" checked="&#39;checked&#39;">
                                <label for="cbTBPlatformTypes1"> 淘宝<span>普通接手机会<b>3</b></span></label>
                            </li>
                        </ul>
                        <div class="task_p">
                            <label> 特点</label>
                            <p>再次购买曾接手过的商品/店铺，目标商品易查找。</p>
                        </div>
                    </div>
                </div>
                <div class="tackTitle">
                    <span id="ptSpan" class="cur tack1">普通任务</span> 
                    <span id="fgSpan" class="tack2" style="display: none;" >复购任务</span>
                </div>
                <div class="tack_input pad_2_3">
                    <div class="tack_input1">
                        <em></em> <input class="input_50" data-val="true"
                            data-val-number="字段 TaskPriceEnd 必须是一个数字。" id="TaskPriceEnd"
                            maxlength="5" name="TaskPriceEnd"
                            onblur="value=value.replace(/[^0-9]/g,&#39;&#39;)"
                            onkeyup="value=value.replace(/[^0-9]/g,&#39;&#39;)"
                            oninput="value=value.replace(/[^0-9]/g,&#39;&#39;)"
                            placeholder="价格上限默认等于信用积分" type="text" value="">
                    </div>
                    <!-- <a href="javascript:void(0);" class="bg_blue" id="acceptTask"
                        onclick="this.disable=true;this.innerHTML='等待排队';AcceptTask01()">
                        接手任务</a>
 -->                 
                    <input type="button" onclick="AcceptTask01()"  id="acceptTask" class="bg_blue" value="开始接任务">
                </div>
            </form>
        </div>
        <!-- 等待排队界面 -->
        <div id="showWait" class="ddfb_1" style="display: none;">
            <form action="<?=$this->createUrl('default/cancelqueue')?>"
                enctype="multipart/form-data" id="fm5" method="post">
                <h2>等待分配任务</h2>
                <h3>
                    <b id="waitCount">正在为您匹配订单，请稍后</b>
                </h3>
                <span> <img alt="loading..." src="<?=M_IMG_URL;?>loading.gif"></span><br>
                <span id="getG" ></span>
                <h4>
                    <a href="javascript:void(0);" id="aStopAccept"
                        onclick="StopAcceptnow() ">停止接单</a>
                </h4>
            </form>
        </div>
        <!-- 接单任务界面 -->
        <div id="dSuccess" class="ddfb_1" style="display: none;">
            <h2>恭喜你</h2>
            <h3>已经成功领取任务</h3>
            <span> <img alt="" src="<?=M_IMG_URL;?>loading1.gif"></span>
            <h4>
            	<a id="kaisi">开始任务</a>
            	<a href="javascript:void(0)" id="tui">退出任务</a>
                <!--<a href="<?php echo $this->createUrl('task/taskmanage');?>"> 开始任务</a>-->
            </h4>
        </div>
        <!-- 接单失败界面 -->
        <div id="dFail" class="ddfb_1" style="display: none; height: 122px;">
            <h2>接手失败</h2>
            <h4>
                <label id="lblMsg"
                    style="display: none; padding: 6px; line-height: 25px;">
                    亲，现在平台任务量较少，请尝试重新接单或者稍后再试</label>
            </h4>
            <span> <img alt="" src="<?=M_IMG_URL;?>loading1.gif"></span>
            <h4>
                <a href="<?=$this->createUrl('default/index');?>" id="acceptTask2">重新接单</a>
            </h4>
            <div class="tack_fail pad_2_3">
                <a style="display: none;"
                    href="<?=$this->createUrl('default/index');?>" id="acceptTask3"
                    class="bg_blue fl">重新接单</a> <a style="display: none;" id="aFg"
                    href="javascript:void(0);" class="bg_f90 fr" onclick="btnFg()">接手复购任务</a>
            </div>
        </div>
        <!-- <div class="hxt"></div> -->
        <div class="news_x1">
            <h2>最新公告</h2>
            <ul>
                <li>
                    <div class="weui_cell_hd">
                        <em class="border_r_bl"></em>
                    </div> <a
                    href="<?=$this->createUrl('other/newsinfo',array('id'=>204))?>">
                        <p>佣金标准</p>
                </a>
                </li>
                <li>
                    <div class="weui_cell_hd">
                        <em class="border_r_bl"></em>
                    </div> <a
                    href="<?=$this->createUrl('other/newsinfo',array('id'=>271))?>">
                        <p>佣金和本金获取方式</p>
                </a>
                </li>
                <li>
                    <div class="weui_cell_hd">
                        <em class="border_r_bl"></em>
                    </div> <a
                    href="<?=$this->createUrl('other/newsinfo',array('id'=>245))?>">
                        <p>花呗支付产生手续费</p>
                </a>
                </li>
            </ul>
            <h3>
                <a style="font-size: 14px"
                    href="<?=$this->createUrl('other/contentindex')?>">更多公告</a>
            </h3>
        </div>

    </div>
<?php $this->renderPartial('/public/footer');?>


</body>
</html>