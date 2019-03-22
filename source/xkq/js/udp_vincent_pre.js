$(function(){
	//localStorage.clear();
	$task_tag = $('#task_tag').val();
//	if (localStorage.task_tasg != $task_tag)
//	{
//		clear_localStorage(localStorage.task_tasg);
//	}
//	localStorage.task_tasg = $task_tag;
	if (localStorage.getItem('hasAuditShop' + $task_tag))  //已经验证了店铺名
	{
		$('label#auditShopState').html('已验证');
		$('div#auditShopDiv').remove();
	}
	else
	{
		$('label#auditShopState').html('待验证');
	}
	
	if (localStorage.getItem('imgUrl#lang1' + $task_tag))  //搜索图已经上传
	{
		$('img#lang1').attr('src', localStorage.getItem('imgUrl#lang1' + $task_tag));
		$('#stu1').val(localStorage.getItem('imgUrl#lang1' + $task_tag));
		$('div#showUpImg').html('已上传');
	}
	
	if (localStorage.getItem('imgUrl#lang2' + $task_tag))  //订单截图已经上传
	{
		$('img#lang2').attr('src', localStorage.getItem('imgUrl#lang2' + $task_tag));
		$('#stu2').val(localStorage.getItem('imgUrl#lang2' + $task_tag));
		$('div#showUpImg2').html('已上传');
	}
	if (localStorage.getItem('imgUrl#lang3' + $task_tag))  //订单截图已经上传
	{
		$('img#lang3').attr('src', localStorage.getItem('imgUrl#lang3' + $task_tag));
		$('#stu3').val(localStorage.getItem('imgUrl#lang3' + $task_tag));
		$('div#showUpImg3').html('已上传');
	}
	
	if (localStorage.getItem('hasAuditShop' + $task_tag) && localStorage.getItem('imgUrl#lang1' + $task_tag))  //店铺+搜索图已验证
	{
		getTime(function(data){
			if (data.num > 0)
			{
				localStorage.setItem('has_countdown' + $task_tag, 1);
//				localStorage.has_countdown = 1;
				var min = parseInt(data.num / 60);
		        var s = parseInt(data.num % 60);
		        $count_down = data.num;
		        Timesb(min, s);
		        $('#disan').show();
			}
			else
			{
				$('#browse_finished_btn').show();
				$("#dishi").css("display","block");
			}
		});
	}

	if (localStorage.getItem('hasStay' + $task_tag))  //已经停留了6分钟
	{
		$('#disan').hide();
		$("#dishi").css("display","block");
		$('#browse_finished_btn').show();
	}
	
	document.addEventListener('visibilitychange', function(){
		var $show_state = document.visibilityState;
		if($show_state == 'visible' && window.localStorage.getItem('has_countdown' + $task_tag))  //页面从后台显示到前端
		{
			getTime(function(data){
				if(data.num > 0)
				{
					var min = parseInt(data.num / 60),
		        	s = parseInt(data.num % 60);
		        	clearTimeout(stay_countdown);
		        	Timesb(min, s);
				}
				if (data.setfreetime > 0)
				{
					var min = parseInt(data.setfreetime / 60),
		        	s = parseInt(data.setfreetime % 60);
		        	clearTimeout(task_countdown);
		        	Timesa(min, s);
				}
			});
			
			
		}
	});
	
	/*
	 * 表单回填
	 */
	if(localStorage.getItem('step_four' + $task_tag))
	{
		localStorage.getItem('step_four' + $task_tag).split('&').forEach(function($param){
		   var $param = $param.split('='),
		   	   $name = $param[0],
		       $val = $param[1],
		       $this_input = $('input[name=' + $name + ']');
		    switch($this_input.attr('type'))
		    {
			  	case('checkbox'):
			  		$this_input.attr('checked', $val == 'true' ? true : false);
			  		break;
		  		case('text'):
			  		$this_input.val($val);
			  		break;
		    }
		})
	}
	
	
	/*
	 * 将表单的值序列化保存到本地存储中
	 */
	$step_four = localStorage.getItem('step_four' + $task_tag) ? unParam(localStorage.getItem('step_four' + $task_tag)) : {};
	$('input.step_four').each(function(index){
    	$(this).on('change', function(){
    		switch($(this).attr('type'))
		    {
			  	case('checkbox'):  //单选框
			  		$step_four[$(this).attr('name')] = $(this).is(':checked');
			  		break;
		  		case('text'):  //文本框
			  		$step_four[$(this).attr('name')] = $(this).val();
			  		break;
		    }
    		localStorage.setItem('step_four' + $task_tag, $.param($step_four));
    	})
   });
});


function m_alter($message, callback)
{
	layer.confirm($message, {title: '', btn: ['我知道了']});
	return false;
}


/*
 * 反序列化
 */
function unParam($value)
{
	var $res = {};
	$value.split('&').forEach(function($i)
	{
        var $j = $i.split('=');
        $res[$j[0]]=$j[1];
    });
    return $res;
}


/*
 *   使用方法 文件插件 id  预览图 id 类型 id 进度 id 结果id 保存值 id 发送地址 id 地址
 */
//选择图片
var su =0;
function ShowTu(id,lang,ty,po,son,stu,ur,ur1){
    var pic = $(""+id+"").get(0).files[0];
    su=po;
    var ty_z =/\/jpg$|\/jpeg$|\/gif$|\/png$|\/JPG&|\/JPEG&|\/GIF&|\/PNG&/;
    if(pic){
        var pic_typ = pic['type'];
        var pic_size= pic['size'];
        $(""+ty+"").html(pic_typ );
        if(ty_z.test(pic_typ)){
            $(""+lang+"").prop("src" , window.URL.createObjectURL(pic) );
            if(pic_size>=4194304){
                $(""+su+"").html(" ");
                $(""+stu+"").val("");
                $(""+lang+"").removeAttr("src");
                $(""+son+"").html("不能超过4M" );
            }else{
                uploadFile(id,son,stu,ur,ur1,lang);
            }
        }else{
            $(""+su+"").html(" ");
            $(""+stu+"").val("");
            $(""+lang+"").removeAttr("src");
            $(""+son+"").html("不支持该格式"+pic_typ );
        }
    }
    console.log(pic);
}

//上传图片
function uploadFile(id,son,stu,ur,ur1,lang){
    var pic = $(""+id+"").get(0).files[0];
    var formData = new FormData();
    formData.append("file" , pic);
    formData.append("url_v" , ur1);
    $.ajax({
        type: "POST",
        url: ur,
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
            if(obj.status == 1){
                $(""+stu+"").val(obj.url);
            }else{
                $(""+lang+"").removeProp("src");
                $(""+stu+"").val('');
            }
            $(""+son+"").html(obj.content);
            localStorage.setItem('imgUrl' + lang + $task_tag, obj.url);
            startCountdown();
        },
        error:function(xhr){ //上传失败
            alert("上传失败");
            $(""+son+"").html("上传失败" );
        }
    });
}
function onprogress(evt){
    var loaded = evt.loaded;     //已经上传大小情况
    var tot = evt.total;      //附件总大小
    var per = Math.floor(100*loaded/tot);  //已经上传的百分比
    $(""+su+"").html( per +"%" );
}
//店铺验证
function dianpu(taskid,$url){
    var shopname = $("#shopname").val();
    var taskid = taskid;
    var att = {"shopname":shopname,"taskid":taskid};
  if(shopname){
      $.ajax({
          type: "POST",
          data: att,
          url: $url,
          dataType:'json',
          success:function(data) {
             if(data.err_code==1){
             	alert(data.msg);
             	$("#shopname").html(data.msg);
             }else{
             	alert(data.msg);
             }
          },error:function(data){

          }
      });
  }
}

/*
 * 预览图
 */
function litutu(type,type1,type2,ty_url,id){
        var type=type;
        var type1=type1;
        var type2 = (type2 == '5' ? 1 : type2);
        console.log(type2);
        console.log(ty_url);
        if (type2 =="1" && type =="2") {
            //销量任务  淘宝PC自然搜索
            $(""+id+"").attr({"src":ty_url+"MyBuySearchPC.png"});
            $(""+id+"").attr({"onclick":"Kai(''+ty_url+'MyBuySearchPC.png')"});
        }else if(type2 == 2 && type ==1 ){
            //推送任务    淘宝APP自然搜索
            $(""+id+"").attr({"src":ty_url+"LLSearchAPP.png"});
            $(""+id+"").attr({"onclick":"Kai(''+ty_url+'LLSearchAPP.png')"});
        }else if(type == "3"){
            //淘宝APP淘口令
            $(""+id+"").attr({"src":ty_url+"ll_ztc.png"});
            $(""+id+"").attr({"onclick":"Kai(''+ty_url+'ll_ztc.png')"});
        }else if(type2 ==1 && type == 4){
            //销量任务   淘宝APP直通车
            $(""+id+"").attr({"src":ty_url+"APPZTC.png"});
            $(""+id+"").attr({"onclick":"Kai(''+ty_url+'APPZTC.png')"});
        }else if(type2 == 3 && type == 2){
            //复购任务  淘宝PC自然搜索
            $(""+id+"").attr({"src":"/Content/images/BuyCourse/MyBuySearchPC.png"});
            $(""+id+"").attr({"onclick":"Kai('/Content/images/BuyCourse/MyBuySearchPC.png')"});
        }else if(type2 == 3 && type == 1){
            //复购任务  淘宝APP自然搜索
            $(""+id+"").attr({"src":ty_url+"appfugoutuisong.png"});
            $(""+id+"").attr({"onclick":"Kai(''+ty_url+'appfugoutuisong.png')"});
        }else if(type2 == 3 && type == 4){
            //复购任务 淘宝APP直通车
            $(""+id+"").attr({"src":"/Content/images/BuyCourse/淘宝APP直通车复购推送.jpg"});
            $(""+id+"").attr({"onclick":"Kai('/Content/images/BuyCourse/淘宝APP直通车复购推送.jpg')"});
        }else if(type2 ==2 && type == 2){
            //推送任务   淘宝PC自然搜索
            $(""+id+"").attr({"src":"/Content/images/BuyCourse/MyShopCartSearchPC.png"});
            $(""+id+"").attr({"onclick":"Kai('/Content/images/BuyCourse/MyShopCartSearchPC.png')"});
        }else if(type2 == 2 && type ==1){
            $(""+id+"").attr({"src":ty_url+"MyShopCartSearchAPP.png"});
            $(""+id+"").attr({"onclick":"Kai(''+ty_url+'MyShopCartSearchAPP.png')"});
        }else if(type2 ==2 && type==4){
            $(""+id+"").attr({"src":"/Content/images/BuyCourse/gwc_ztc.png"});
            $(""+id+"").attr({"onclick":"Kai('/Content/images/BuyCourse/gwc_ztc.png')"});
        }else if(type == 5){
            $(""+id+"").attr({"src":"/Content/images/BuyCourse/MyShopCartPC.png"});
            $(""+id+"").attr({"onclick":"Kai('/Content/images/BuyCourse/MyShopCartPC.png')"});
        }else if(type == 4){
            $(""+id+"").attr({"src":"/Content/images/BuyCourse/MyShopCartAPP.png"});
            $(""+id+"").attr({"onclick":"Kai('/Content/images/BuyCourse/MyShopCartAPP.png')"});
        } else{
            if (type1 =="PC")
            {
                $(""+id+"").attr({"src":ty_url+"1.png"});
           		$(""+id+"").attr({"onclick":"Kai(''+ty_url+'1.png')"});
            }else if (type1 == "手机" && type=="1" && type2 == 1 )
            { 
                $(""+id+"").attr({"src":ty_url+"taobaoappziran.jpg"});
                $(""+id+"").attr({"onclick":"Kai(''+ty_url+'taobaoappziran.jpg')"});                
            }
            else if (type1 == "手机" )
            {
                $(""+id+"").attr({"src":"/Content/images/SearchImg/4.jpg"});
            	$(""+id+"").attr({"onclick":"Kai('/Content/images/SearchImg/4.jpg')"});
            }
            else
            {
                $(""+id+"").attr({"src":ty_url+"1.jpg"});
                $(""+id+"").attr({"onclick":"Kai(''+ty_url+'1.jpg')"});
            }
        }
}

/*店铺验正*/
    function Confirm(taskID,ty,ur, $table) {
        var validateValue = $("#txtValidateValue").val();
        if ($.trim(validateValue) == "" || $.trim(validateValue) == null) {
            alert("验证栏请输入");
            return ;
        }
        var type=ty;
        $.ajax({
            type: "post",
            url: ur,
            dataType: "json",
            data: { taskid: taskID, val: validateValue,type:type, table: $table },
            error: function () {
                alert('验证失败~');
            },
            success: function (data) {
            	console.log(data);
                if(data.err_code==0){ 
                    $(':input[name="textfield"]').attr('checkstatus',true);
                    $("#shopname").html(data.shopname);
                    $('label#auditShopState').html('已验证');
                    localStorage.setItem('hasAuditShop' + $task_tag, 1);
                    //localStorage.hasAuditShop = 1;
                    startCountdown();
                }else {
                    $(':input[name="textfield"]').attr('checkstatus',false);
                     $("#shopname").html("");
                }
              alert(data.msg);
            }
        });
    }
    
    
    function startCountdown()
    {
		if (localStorage.getItem('hasAuditShop' + $task_tag) && localStorage.getItem('imgUrl#lang1' + $task_tag) && !window.localStorage.getItem('has_countdown' + $task_tag))
    	{
    		$("#disan").css("display","inline");
    		localStorage.setItem('has_countdown' + $task_tag, 1);
    		getTime(function(data){
    			console.log(data);
				if(data.num > 0)
				{
					var min = parseInt(data.num / 60),
		        	s = parseInt(data.num % 60);
		        	Timesb(min, s);
				}
				else
				{
					localStorage.setItem('hasStay' + $task_tag, 1);
					var $finished_btn = $("#browse_finished_btn");
					if ($finished_btn.length)
					{
						$("#disan").remove();
						$finished_btn.show();
					}
					else
					{
						$("#disan").attr('disabled', false).html('下一步');
					}
				}
			});
    	}
    }
    
//弹出框
	var h = $(window).height()/2 - ($(window).height()/6)-($(window).height()/6)-($(window).height()/8);	
	var hh = $(window).height()- ($(window).height()/6);	
	function Guan(){
		$("#ifm").css({"display":"none"});
		$("#if1").css({"display":"none"});
		$("#if2").css({"display":"none"});
	}
	function Kai(v){
		$("#ifm").css({"display":"block"});
		$("#if1").css({"display":"block"});
		$("#ta").attr({"src":v});
	}
	function Kaiti(){
		$("#ifm").css({"display":"block"});
		$("#if2").css({"display":"block"});
	}
	
//金额

function clearNoNum(event, obj,sum) {
        //响应鼠标事件，允许左右方向键移动     
        event = window.event || event;
        if (event.keyCode == 37 | event.keyCode == 39) {
            return;
        }
        //先把非数字的都替换掉，除了数字和.
        obj.value = obj.value.replace(/[^\d.]/g, "");
        //必须保证第一个为数字而不是.
        obj.value = obj.value.replace(/^\./g, "");
        //保证只有出现一个.而没有多个.
        obj.value = obj.value.replace(/\.{2,}/g, ".");
        //保证.只出现一次，而不能出现两次以上
        obj.value = obj.value.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
        obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3'); //只能输入两个小数
        var mnum= $("#txtPayPrice").val(); 
        var su =sum-mnum;
        console.log(su);
        if(su>50 || su<-50){
             $("#sDifferencePrice").css({'color':'red'});
        }else{
        	 $("#sDifferencePrice").css({'color':'black'});
        }
        $("#sDifferencePrice").html(su);
   }
    function checkNum(obj) {
        //为了去除最后一个.
        obj.value = obj.value.replace(/\.$/g, "");
    }   
    
    function CheckOrderNumber() {
        var orderNumber = $("#txtPlatformOrderNumber").val();
        //var taskID = '<?=$taskinfo['id'];?>';
        if ($.trim(orderNumber) == "" || $.trim(orderNumber) == null) {
          return m_alter("平台订单编号请输入", "提示");
        }
        var platformType = "淘宝";
        if (orderNumber.indexOf(' ') > -1) {
            m_alter("订单编号不允许包含空格");
            return false;
        } else if (!/^\d+$/.test(orderNumber)) {

            return m_alter("订单编号必须为纯数字");
        }

        if (platformType == "淘宝") {
            if (orderNumber.length < 15) {
               return m_alter("淘宝订单编号不正确,订单编号为15-20位的纯数字");
            }

            if (orderNumber.length == 15) {
                var value = orderNumber.substring(0, 1);
                if (value != "8" && value != "9") {
                    return m_alter("订单编号出错，请仔细检查或联系客服");
                }
            }
        }
       return true; 
      }  
      function ShowChange() {
        var selPayMethodValue = $("#selPayMethod").val();
        if (selPayMethodValue == "1") {
        	console.log(selPayMethodValue);
            $("#spanViolationsAmount1").text("刷卡费用：");
            $("#spanViolationsRemark1").text("信用卡付款");
            $("#liTaskPunish1").show();
        } else if (selPayMethodValue == "3") {
            $("#spanViolationsAmount1").text("花呗费用：");
            $("#spanViolationsRemark1").text("花呗付款");
            $("#liTaskPunish1").show();
        } else {
            $("#liTaskPunish1").hide();
        }
    }
           
//时间
function Timesa(minuteke1, secondke1) {
    secondke1--;
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
        $(".jishi").text(minuteke1+"分"+secondke1+"秒");
    }
    else {
        $(".jishi").text(minuteke1+"分"+secondke1+"秒");
        task_countdown = setTimeout("Timesa('" + minuteke1 + "','" + secondke1 + "')", 1000);
    }
}
    
     function Timesake(minuteke, secondke) {
         secondke--;
         if (secondke <= -1 && minuteke > 0) {
             secondke = 59;
             minuteke--;
         }
         if (minuteke <= 0) {
             minuteke = 0;
         }
         if (minuteke <= 0 && secondke <= 0) {
             minuteke = 0;
             secondke = 0;
         }
         if (minuteke == 0 && secondke == 0) {
             $("#tijiaoshijian").text(minuteke);
             $("#tijiaoshijian1").text(secondke);
             $("#jindu").removeAttr("disabled");
             $("#jindu").text("提交");
         }
         else {
             $("#tijiaoshijian").text(minuteke);
             $("#tijiaoshijian1").text(secondke);
             setTimeout("Timesake('" + minuteke + "','" + secondke + "')", 1000);
         }
    }

    function Timesb(minute, second) 
    {
    	if(window.stay_countdown)
		{
			clearTimeout(stay_countdown);
		}
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
            localStorage.setItem('hasStay' + $task_tag, 1);
//          localStorage.hasStay = 1;  //已经停留6分钟
            $("#disan").html('下一步').removeAttr("disabled");
        }
        else {
            $("#lblMinute").text(minute);
            $("#lblSecond").text(second);
            stay_countdown = setTimeout("Timesb('" + minute + "','" + second + "')", 1000);
        }
    }
    
    /*
     * 清除对应任务的本地缓存
     */
    function clear_localStorage($tag)
 	{
 		localStorage.removeItem('hasStay' + $tag);
 		localStorage.removeItem('hasAuditShop' + $tag);
 		localStorage.removeItem('imgUrl#lang1' + $tag);
 		localStorage.removeItem('imgUrl#lang2' + $tag);
 		localStorage.removeItem('imgUrl#lang3' + $tag);
 		localStorage.removeItem('imgUrl#lang4' + $tag);
 		localStorage.removeItem('has_countdown' + $tag);
 		localStorage.removeItem('step_four' + $tag);
 	}
     
    