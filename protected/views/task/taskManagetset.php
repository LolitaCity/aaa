<link href="<?php echo S_CSS;?>user_index.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo S_CSS;?>laydate.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo S_JS;?>jquery.jBox-2.3.min.js" type="text/javascript"></script>
<script src="<?php echo S_JS;?>laydate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo S_CSS;?>jbox.css" />
<style>
    #Home{background:none }
    #BrushAcceptManage{background: <?php echo PLATFORM == 'esx' ? '#a70101' : '#007efb'?>;}
</style>
<script>
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
<script type="text/javascript">
        $(document).ready(function () {
            $("#BrushAcceptManage").addClass("#BrushAcceptManage");
            $("#onenull").attr("class", "off");
            Msg(1);
            //禁止用F5键   
    		document.onkeydown = function(e){  
    		e = window.event || e;  
    		var keycode = e.keyCode || e.which;  
    		if(keycode == 116){  
        		if(window.event){// ie  
           			 try{e.keyCode = 0;}catch(e){}  
           			 e.returnValue = false;  
        		}else{// firefox  
            	e.preventDefault();  
       		 		}  
   			 	}  
				} 
        });

//点击任务状态跳转
        function SetTab(obj, taskStatus) {
            $(".menu>ul>li").removeClass("off");
            $(obj).attr("class", "off");
            window.location.href = '/task/taskmanage01/status/' + taskStatus+".html";
        }
         function SetTab01(obj, taskStatus) {
            $(".menu>ul>li").removeClass("off");
            $(obj).attr("class", "off");
            Msg(1);
        }
        function Search() {
            var taskStatus = '<?=@$_GET['status']?>';
            var txtSearch = $("#TxtSearch").val();
            var selSearch = $("#SelSearch").val();
            var beginDate = $("#BeginDate").val()?Date.parse(new Date($("#BeginDate").val()))/1000:'';
            var endDate =$("#EndDate").val()?Date.parse(new Date($("#EndDate").val()))/1000:'';
            window.location.href = '/Task/taskmanage/status/' + taskStatus + "/txtSearch/" + encodeURI(txtSearch) + "/selSearch/" + selSearch + "/beginDate/" + beginDate + "/endDate/" + endDate+".html";
        }
        //搜索
        function Refresh() {
            window.location.href = '<?=$this->createUrl('task/taskmanage')?>';
        }
        //一键获取用金
        function shouhuo() {
            openConfirm('<font color="red"> 确认提交？','提示',{width:250,height:250},function () {
                window.location.href='<?=$this->createUrl('task/comfirmalltask')?>';
            },'确认提交',function () {
                self.parent.$.closeWin();
            },'返回')
        }
        function BeginTask(taskId) {
            var url='/task/taskone/taskid/'+taskId+'.html';
            $.openWin(560, 860, url);
        }
        //ceshi
        function BeginTask01(taskId,shebei) {
        var url='/task/Tasktestone/taskid/'+taskId+'/shebei/'+shebei+'.html';
        layer.open({
  		type: 2,
  		area: ['840px', '560px'],
  		fixed: false, //不固定
  		content: url
		});
        }
        function BeginTask02(taskId,shebei) {
        var url='/task/taskexit/taskid/'+taskId+'/shebei/'+shebei+'.html';
        layer.open({
  		type: 2,
  		area: ['500px', '350px'],
  		fixed: false, //不固定
  		content: url
		});
        }
        function ExitTask(taskId) {
            var url='/task/taskexit/taskid/'+taskId+'.html';
            $.openWin(350, 500, url);
        }
        function comfirmTask(taskId) {
            var url='/task/comfirmtask/usertaskid/'+taskId+'.html';
            $.openWin(350, 500, url);
        }
        function evaltask(taskid) {
            var url='/task/evaltask/usertaskid/'+taskid+'.html';
            $.openWin(580,610,url)
        }
        function setfreetask(tvid) {
            var url='/task/SetfreeEvalTask/taskevalid/'+tvid+'.html';
            if(confirm('您确定要放弃任务吗？')) { window.location.href=url;}else{ return false};
        }
        
        function timestampToTime(timestamp) {
       		 var date = new Date(timestamp*1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
       		 Y = date.getFullYear() + '-';
        	 M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        	 D = date.getDate() + ' ';
       		 h = date.getHours() + ':';
             m = date.getMinutes() + ':';
        	 s = date.getSeconds();
             return Y+M+D+h+m+s;
    	}
    	
        function Msg($page){
        	//分页
        	var index =layer.msg('加载中', {
  				icon: 16
  				,shade: 0.01
				});
        	var taskStatus =$('.off').val();
            var txtSearch = $("#TxtSearch").val();
            var selSearch = $("#SelSearch").val();
            var beginDate = $("#BeginDate").val()?Date.parse(new Date($("#BeginDate").val()))/1000:'';
            var endDate =$("#EndDate").val()?Date.parse(new Date($("#EndDate").val()))/1000:''; 
            var page = $page;        
            var arr ={"taskStatus":taskStatus,"txtSearch":txtSearch,"selSearch":selSearch,"beginDate":beginDate,"endDate":endDate,"page":page};
        	$("#J_TbData").empty();
        	var ur = '<?php echo $this->createUrl('task/taskmanage02');?>';
        	$.ajax({
        		type:"POST",
        		url:ur,
        		async:true,
        		data:arr,
        		dataType:'json',
        		success:function(data){     
        		layer.close(index);   			
        		var count = data['count'];
        		var ofo = data['ofo']
        		var pageall =parseInt(count/ofo);
        		var pagenow =parseInt(data['page']);
        		if(pageall<1){
        			$('#gong').html(1);
        		}else{
        			$('#gong').html(pageall);
        		}
        		$('#di').html(pagenow);
        		if(pageall <= pagenow){
        			$('.xia').css("display","display");
        		}else{
        			$('.xia').attr("onclick","Msg("+(pagenow+1)+")");
        		} 
                if(pagenow<= 1){
        			$('.shang').css("display","display");
        		}else{
        			$('.shang').attr("onclick","Msg("+(pagenow-1)+")");
        		}
        		 for( var i = 0; i < data['list'].length; i++ ) {
                //动态创建一个tr行标签,并且转换成jQuery对象
                var $trTemp = $("<tr></tr>");
                //往行里面追加 td单元格
                var intlet = 0;
                switch(parseInt(data['list'][i]['intlet'])){
                	case 1:  intlet='淘宝APP自然搜索';break;
                    case 2:	 intlet='淘宝PC自然搜索';break;
                    case 3:  intlet='淘宝APP淘口令';break;
                    case 4:  intlet='淘宝APP直通车';break;
                    case 5:  intlet='淘宝PC直通车';break;
                    case 6:  intlet='淘宝APP二维码';break;
                }
                var money = 0;
                    if(parseInt(data['list'][i]['status'])>0){
                     money=(data['list'][i]['express']<=0)?(data['list'][i]['price']*data['list'][i]['auction'])+"元":(data['list'][i]['price']*data['list'][i]['auction'])+'元('+data['list'][i]['express']+'元快递费)';
                    }else if(data['list'][i]['status']==0){
                     money = "???";
                    }
                var status = 0 ;
                switch(parseInt(data['list'][i]['status'])){
                	case 0: status ='进行中';break;
                    case 1: status ='待审核';break;
                    case 2: status ='获取佣金';break;
                    case 3: status ='商家确认';break;
                    case 4: status ='完成';break;
                    case 5: if(data['list'][i]['doing'] == 3){status ='已放弃评价';break;}status ='待评价';break;
                    case 6: status ='已评价';break;
                    case 7: status ='已完成';break;
                }
                
                var one = "<td>";
                    one +="<p class='fpgl-td-rw'>任务编号："+ data['list'][i]['tasksn']+"<b style='color: Red'>"+intlet+"</b></p>";
                    one +="<p class='fpgl-td-rw'> 订单编号："+data['list'][i]['ordersn']+"</p>";
                    one +="<p class='fpgl-td-rw'><label title=''>任务说明："+data['list'][i]['remark']+"</label></p>";
                    one +="</td>";
                $trTemp.append(one);  
                
                var tow = "<td class='fpgl-td-zs'>";
                    tow += '<p class="fpgl-td-rw"> 买号：'+data['list'][i]['wangwang']+'</p>';
                    tow += '<p class="fpgl-td-rw">店铺名称：'+data['list'][i]['shopname']+'<b style="color: Red"></p>';
                    tow +="</td>";
                $trTemp.append(tow);  
                 
                var three = "<td class='fpgl-td-zs'>";
                    three += '<p class="fpgl-td-rw"> 商品价格：'+money+'</p>';
                    three += '<p class="fpgl-td-rw">佣金：'+data['list'][i]['commission']+'</p>';
                    three += '<p class="fpgl-td-rw" style=" text-align: left"> <a id="a1" style="color: red">货款由商家支付，<br /> 佣金从平台提现。</a> </p>';
                    three += '<p class="fpgl-td-rw"> <span style="color: Red; margin-left: 40px;"> </span> </p>';
                    three +="</td>";
                $trTemp.append(three);     
                
                var four = '<td class="fpgl-td-zs" align="center" >';
                    four += '<p class="fpgl-td-rw"> </p>';
                    four += '<a href="javascript:void(0)"  style="cursor: pointer" > <font color="red" >'+status+'</font> </a>';
                    four += '<p class="fpgl-td-rw"> 接手时间： '+timestampToTime(data['list'][i]['addtime'])+'</p>';
                    four +="</td>";
                
                $trTemp.append(four);
                    var taskid = data['list'][i]['taskid'];
                var five = '<td>';
                    if(data['list'][i]['status'] == 0){
	                    five += '<p > <input class="input-butto100-xhs" type="button" value="开始任务" onclick="BeginTask01('+"'"+taskid+"',"+"'"+'PC'+"'"+')" /></p>';
	 					five += '<p > <input class="input-butto100-xls" type="button" value="退出任务" onclick="BeginTask02('+"'"+taskid+"',"+"'"+'PC'+"'"+')" /></p>';
	 				}else if(data['list'][i]['status'] == 2){
	 					five += '<p > <input class="input-butto100-xhs" type="button" value="获取佣金" onclick="this.disable=true;this.value=\'数据正在提交\';comfirmTask('+"'"+data['list'][i]['id']+"'"+')" /></p>';
	 				}else if(data['list'][i]['status'] == 5 && data['list'][i]['doing'] != 3){
	 					five += '<p > <input class="input-butto100-xhs" type="button" value="立即评价" onclick="this.disable=true;this.value=\'数据正在提交\';evaltask('+"'"+data['list'][i]['id']+"'"+')" /></p>';
	 					five += '<p > <input class="input-butto100-xls" type="button" value="放弃评价" onclick="this.disable=true;this.value=\'数据正在提交\';setfreetask('+"'"+data['list'][i]['id']+"'"+')" /></p>';
	 				}
                    five +="</td>";               
                $trTemp.append(five);
                // $("#J_TbData").append($trTemp);
                $trTemp.appendTo("#J_TbData");
            }
            
        		},error:function(data){
        			
        		}
        	});
        }
         				
    </script>
    <style type="text/css">
        #ow_confirm002_fun
        {
            width: 120px;
            height: 35px;
            line-height: 35px;
            text-align: center;
            display: block;
            background: #ff9900;
            color: #fff;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            -ms-border-radius: 20px;
            -o-border-radius: 20px;
            border-radius: 20px;
        }
        #ow_confirm002_fun:hover
        {
            background: #e58a01;
        }

        #ow_confirm002_fun2
        {
            width: 120px;
            height: 35px;
            line-height: 35px;
            text-align: center;
            display: block;
            background: #4882f0;
            color: #fff;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            -ms-border-radius: 20px;
            -o-border-radius: 20px;
            border-radius: 20px;
        }
        #ow_confirm002_fun2:hover
        {
            background: #2f6fea;
        }
        .htyg_tc
        {
            height: 50px;
            background: #4882f0;
        }
        .htyg_tc_1
        {
            float: left;
            line-height: 50px;
            margin-left: 15px;
            font-size: 16px;
            color: #fff;
        }
        .ye1{float: left;}
        .ye{border: 1px solid rosybrown;text-align: center;line-height: 20px;padding: 3px;}
    </style>
<form action="<?php echo $this->createUrl('task/taskmanage01');?>" enctype="multipart/form-data" id="fm" method="post">
    <div class="sj-fprw">
        <!-- tab切换-->
        <div class="tab1" id="tab1">

            <div class="menu">
                <ul>
                    <li id="onenull"  onclick="SetTab01(this,null)" value="0" >全部任务</li>
                    <li  onclick="SetTab01(this,'0')" value="1" >进行中</li>
                    <li  onclick="SetTab01(this,'1')" value="2" >待审核</li>
                    <li  onclick="SetTab01(this,'5')" value="6" >待评价</li>
                    <li  onclick="SetTab01(this,'3')" value="4" >待完成</li>
                    <li  onclick="SetTab01(this,'4')" value="5" >已完成</li>
                </ul>
            </div>
            <div class="menudiv">
                <div id="con_one_1" class="sj-fpgl">
                    <!-- 搜索-->
                    <div class="fpgl-ss">
                        <p>
                            <select class="select_180" id="SelSearch" name="SelSearch">
                                <option <?php if (@$_GET['selSearch']=='tasksn'){echo 'selected';}?> value="tasksn">任务编号</option>
                                <option <?php if (@$_GET['selSearch']=='ordersn'){echo 'selected';}?>  value="ordersn">订单编号</option>
                                <option <?php if (@$_GET['selSearch']=='shopname'){echo 'selected';}?>  value="shopname">店铺名称</option>
                            </select>
                        </p>
                        <p>
                            <input class="input_417" id="TxtSearch" name="TxtSearch" style="width:200px;" type="text" value="<?=@$_GET['txtSearch']?>" />
                        </p>
                        <p>
                            接手时间:<input class="laydate-icon" id="BeginDate" maxlength="16" name="BeginDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:128px;height:34px;margin-left:5px;" type="text" value="<?php if ($_GET['beginDate'])echo date('Y-m-d h:m',$_GET['beginDate']);?>" />
                            ~
                            <input class="laydate-icon" id="EndDate" maxlength="16" name="EndDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:128px;height:34px;" type="text" value="<?php if ($_GET['endDate'])echo date('Y-m-d h:m',$_GET['endDate']);?>" />
                        </p>
                        <p>

                            <input class="input-butto100-ls" style="width: 90px" type="button" value="查询" onclick="Msg(1)" /></p>
                        <p>
                            <input class="input-butto100-hs" style="width: 90px"  type="button" value="刷新" onclick="Msg(1)" /></p>
                        <!--<p>

                            <input class="input-butto100-ls" style="width: 110px"   type="button" value="一键获取佣金" onclick="this.disable=true;this.value='数据正在提交';shouhuo()" /></p>-->
                    </div>
                    <!-- 搜索-->
                    <!-- 表格-->
                    <div class="fprw-pg">
                        <table>
                        	 <thead>
                            <tr>
                                <th width="332">
                                    任务/订单编号
                                </th>
                                <th width="232">
                                    买号/商品信息
                                </th>
                                <th width="232">
                                    商品价格/佣金
                                </th>
                                <th width="232">
                                    任务状态
                                </th>
                                <th width="132">
                                    操作按钮
                                </th>
                            </tr>
                           </thead>                           
                                <tr>
                                    <td colspan="5" align="center">
                                        <span style="width: 20px; font-weight: bolder;">列表只展示近30天接手的任务数据，可输入任务编号/订单编号查询以前的数据</span>
                                    </td>
                                </tr>
                         <tbody id="J_TbData">
                        	
                         </tbody>
                        </table>
                        
                    </div>
                    <!-- 表格-->
                </div>
            </div>
            <div class="yyzx_1">
            	<div id="demo1">
            		 <ul class="ye1">
            		 	<li class="ye ye1"><div class="shang" value="0" onclick="Msg(1)">上一页</div></li>
            		 	<!--<li class="ye ye1"><input type="text" name="" id="tiao" value="" style="width: 60px;"/></li>
            		 	<li class="ye ye1" onclick="Tiao()">跳转</li>-->
            		 	<li class="ye ye1"><div class="xia" value="1" onclick="Msg(1)">下一页</div></li>
            		 	<li class="ye ye1">第<span id="di"></span>页|共<span id="gong"></span>页</li>
            		 </ul>
            	</div>
            </div>
        </div>
        <!-- tab切换-->
    </div>
    <div id="light1" class="ycgl_tc yctc_498">
        <!--列表 -->
        <div class="htyg_tc">
            <ul>
                <li class="htyg_tc_1">查看备注</li>
                <li class="htyg_tc_2"><a href="javascript:void(0)" onclick="document.getElementById('light1').style.display='none';document.getElementById('fade').style.display='none'">
                        <img src="<?=S_IMAGES;?>sj-tc.png"></a> </li>
            </ul>
        </div>
        <!--列表 -->
        <div class="yctc_458 ycgl_tc_1">
            <ul>
                <li>
                    <p class="sk-hygl_7" id="pRemark" style="line-height: normal; height: 150px;">
                        备注内容：</p>
                    <div id="lblRemark" style="word-break: break-all">
                    </div>
                </li>
                <li class="fpgl-tc-qxjs_4">
                    <p style="float: right; margin-right: 170px;">
                        <input onclick="document.getElementById('light1').style.display = 'none'; document.getElementById('fade').style.display = 'none'"
                               class="input-butto100-hs" type="button" value="关闭" /></p>
                </li>
            </ul>
        </div>
    </div>
    <div id="fade" class="black_overlay">
    </div>
</form>
    <script type="text/javascript">
    $(function () {
        jQuery.closeConfirm = function () {
            $("#ow_confirm002").remove(); //2.删除主内容层
            $("#ow_confirm001").remove(); //1.删除透明层
        }
    });
</script>

