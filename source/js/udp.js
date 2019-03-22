
function  panding(intlet,tasktype){
	var tm =  "time_"+task_key;
	var shop = "shop_"+task_key;
	var stu1 = "#stu1_"+task_key;
	var stu2 = "#stu2_"+task_key;
	if (localStorage.task_key !=  task_key)
	{
	     localStorage.clear();
	}
	localStorage.setItem("task_key",task_key);
	if (localStorage.getItem(shop))  //已经验证了店铺名
	{
		$('label#auditShopState').html('已验证');
		$('div#auditShopDiv').remove();
	}else {
		$('label#auditShopState').html('待验证');
	}
	if (localStorage.getItem(stu1) && intlet!=6  )  //搜索图已经上传
	{
		$('img#lang1').attr('src', localStorage.getItem(stu1));
        $('#stu1').val(localStorage.getItem(stu1));
		$('div#showUpImg').html('已上传');
	}
	
	if (localStorage.getItem(stu2))  //搜索图已经上传
	{
		$('img#lang2').attr('src', localStorage.getItem(stu2));
		$('#stu2').val(localStorage.getItem(stu2));
		$('div#showUpImg2').html('已上传');
	}
	updatapage(intlet);
	document.addEventListener('visibilitychange', function(){
		var $show_state = document.visibilityState;
		    if(localStorage.getItem(tm)){
		    	if($show_state == 'visible')  //页面从后台显示到前端
				{
					getTime(function(data){
						if(data.num > 0)
						{
							var min = parseInt(data.num / 60),
				        	s = parseInt(data.num % 60);
				        	clearTimeout(stay_countdown);
				        	Timesa(min, s);
						}
						if (data.setfreetime > 0)
						{
							var min = parseInt(data.setfreetime / 60),
							s = parseInt(data.setfreetime % 60);
							clearTimeout(task_countdown);
				        	Times(min, s);
						}
					});	
				}
		    }
				
	});
}

/**
 *图片上传
 * @method ShowTu
 * @param id 文件插件的id
 * @param lang 预览图 id 
 * @param ty 类型 id
 * @param po 进度 id
 * @param son 结果id
 * @param stu 保存值 id
 * @param ur 发送地址
 * @param ur1 图片地址
 * @param Key 存储键值
 **/
function ShowTu(id,lang,ty,po,son,stu,ur,ur1){
	var Key=stu+"_"+task_key;
    var pic = $(""+id+"").get(0).files[0];
    su=po;
    var ty_z =/\/jpg$|\/jpeg$|\/gif$|\/png$|\/JPG$|\/JPEG$|\/GIF$|\/PNG$/;
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
                var formData = new FormData();
			    formData.append("file" , pic);
			    formData.append("url_v" , ur1);
			    $.ajax({
			        type: "POST",
			        url: ur,
			        data: formData ,
			        processData : false,
			        contentType : false ,
			        xhr: function(){
			            var xhr = $.ajaxSettings.xhr();
			            if(xhr.upload) {
			                xhr.upload.addEventListener("progress" , function (evt){
			                	var loaded = evt.loaded;     //已经上传大小情况
							    var tot = evt.total;      //附件总大小
							    var per = Math.floor(100*loaded/tot);  //已经上传的百分比
							    $(""+su+"").html( per +"%" );
			                }, false);
			                return xhr;
			            }
			        },success: function(data) {
			            var obj = JSON.parse(data);
			            if(obj.status == 1){
			                $(""+stu+"").val(obj.url);
			                localStorage.setItem(Key,obj.url);
			                updatapage(1);
			            }else{
			                $(""+lang+"").removeProp("src");
			                $(""+stu+"").val('');
			            }

			            $(""+son+"").html(obj.content);
			           
			        },
			        error:function(xhr){ //上传失败
			            alert("上传失败");
			            $(""+son+"").html("上传失败" );
			        }
			    });
            }
        }else{
            $(""+su+"").html(" ");
            $(""+stu+"").val("");
            $(""+lang+"").removeAttr("src");
            $(""+son+"").html("不支持该格式"+pic_typ );
        }
    }
}

/**
 *验证商品ID /验证商店
 * @method Confirm
 * @param taskid  [任务id]
 * @param intlet [流量入口] 1 -销量  2-  3-复购   4- 预定  5-预约 
 * @param id 被修改的id
 * @param ur 请求地址
 * @param Key 存储键值
 **/
    function Confirm(taskid,intlet,ur) {
        var Key = "shop_"+task_key;
        var validateValue = $("#txtValidateValue").val();
        if ($.trim(validateValue) == "" || $.trim(validateValue) == null) {
            alert("验证栏请输入");
            return ;
        }
        $.ajax({
            type: "post",
            url: ur,
            dataType: "json",
            data: { taskid: taskid, val: validateValue,type:intlet },
            error: function () {
                alert('验证失败~');
            },
            success: function (data) {
            	console.log(data);
                if(data.err_code==0){
                    $(':input[name="textfield"]').attr('checkstatus',true);
                    $('label#auditShopState').html('已验证');
                      $('input[name=has_shopname]').val($.trim(validateValue));
                      $('span#shopname').html($.trim(validateValue));
                      localStorage.setItem(Key,1);
                      updatapage(intlet);
                }else {
                    $(':input[name="textfield"]').attr('checkstatus',false);
                }
              alert(data.msg);
            }
        });
    }
    
/**
 * 时间计算器  任务等待时间
 * @method Timesa
 * @param {总时间秒} timesa
 * 
 */
function Timesa(minuteke,secondke) {
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
        $("#lblMinute").text(minuteke+"分"+secondke+"秒");
        $("#disan").css("display","initial");
        $("#disan").html("点击下一步");
        $("#disan").removeAttr("disabled");
    }
    else {
        $("#lblMinute").text(minuteke+"分"+secondke+"秒");
        stay_countdown = setTimeout("Timesa('" + minuteke + "','" + secondke + "')", 1000);
    }
}

/**
 * 时间计算器  任务过期时间
 * @method Times
 * @param {总时间秒} timesa
 * 
 */
function Times(minuteke1,secondke1) {
	
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
        $(".jishi").text(minuteke1+"分"+secondke1+"秒");
    }
    else {
        $(".jishi").text(minuteke1+"分"+secondke1+"秒");
        task_countdown = setTimeout("Times('" + minuteke1 + "','" + secondke1 + "')", 1000);
    }
}

/**
 * 检测是否提交信息
 * @method updatapage
 * @param {intlet [流量入口] 1 -销量  2-  3-复购   4- 预定  5-预约 } intlet
 */

function updatapage(intlet){
	var tm =  "time_"+task_key;
	var shop = "shop_"+task_key;
	var stu1 = "#stu1_"+task_key;
	var stu2 = "#stu2_"+task_key;
	var xuan = "xuan_"+task_key;
	if(intlet != 6){
        if (localStorage.getItem(shop) && localStorage.getItem(stu1) )  //店铺+搜索图已验证
        {
            getTime(function(data){
            	
                if (data.num > 0)
                {
                	localStorage.setItem(tm,1);
                	var minuteke =parseInt(data.num/60);
    				var secondke =parseInt(data.num%60);
	                Timesa(minuteke,secondke);
	                $("#tishi").css("display","initial");
                    $("#disan").css("display","initial");
                }else{
                	$("#tishi").css("display","initial");
                    $("#disan").css("display","initial");
                    $("#disan").html("点击下一步");
                    $("#disan").removeAttr("disabled");
                }
            });
        }
    }else{
        if (localStorage.getItem(shop) )  //店铺
        {
        	
           getTime(function(data){
                if (data.num > 0)
                {
                	localStorage.setItem(tm,1);
                	var minuteke =parseInt(data.num/60);
    				var secondke =parseInt(data.num%60);
	                Timesa(minuteke,secondke);	              
	                $("#tishi").css("display","initial");
                    $("#disan").css("display","initial");
                }else{
                	$("#tishi").css("display","initial");
                    $("#disan").css("display","initial");
                    $("#disan").html("点击下一步");
                    $("#disan").removeAttr("disabled");
                }
            });
        }
    }
}

/**
 * 浏览图弹出框 
 *
 */
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
	
/**
 * 金额计算
 *
 */
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
/**
 * 订单过滤器
 */
    function CheckOrderNumber() {
        var orderNumber = $("#txtPlatformOrderNumber").val();
        //var taskID = '<?=$taskinfo['id'];?>';
        if ($.trim(orderNumber) == "" || $.trim(orderNumber) == null) {
          layer.alert("平台订单编号请输入！",{icon: 7});
          return;
        }
        var platformType = "淘宝";
        if (orderNumber.indexOf(' ') > -1) {
        	layer.alert("订单编号不允许包含空格！",{icon: 7});
            return false;
        } else if (!/^\d+$/.test(orderNumber)) {
            layer.alert("订单编号必须为纯数字！",{icon: 7});
            return false;
        }

        if (platformType == "淘宝") {
            if (orderNumber.length < 15) {
            	layer.alert("淘宝订单编号不正确,订单编号为15-20位的纯数字！",{icon: 7});             
                return false;
            }

            if (orderNumber.length == 15) {
                var value = orderNumber.substring(0, 1);
                if (value != "8" && value != "9") {
                	layer.alert("订单编号出错，请仔细检查或联系客服！",{icon: 7});  
                    return false;
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