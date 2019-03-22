<link href="<?php echo S_CSS;?>user_index.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo S_CSS;?>laydate.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo S_JS;?>jquery.jBox-2.3.min.js" type="text/javascript"></script>
<script src="<?php echo S_JS;?>laydate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo S_JS;?>layui/layui.js"></script>
<script type="text/javascript" src="<?php echo S_JS;?>layui/css/layui.css"></script>
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

            var taskStatus = '<?=@$_GET['status'];?>';
            if (taskStatus == "" || taskStatus == "null" || taskStatus == null)
                $("#onenull").attr("class", "off");
            if (taskStatus == "1")
                $("#one1").attr("class", "off");
            if (taskStatus == "0")
                $("#one0").attr("class", "off");
            if (taskStatus == "2")
                $("#one2").attr("class", "off");
            if (taskStatus == "3")
                $("#one3").attr("class", "off");
            if (taskStatus == "4")
                $("#one4").attr("class", "off");
            if (taskStatus == "5")
                $("#one5").attr("class", "off");
        });

//点击任务状态跳转
        function SetTab(obj, taskStatus) {
            $(".menu>ul>li").removeClass("off");
            $(obj).attr("class", "off");
            window.location.href = '/task/taskmanage01/status/' + taskStatus+".html";
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
    </style>


<form action="<?php echo $this->createUrl('task/taskmanage01');?>" enctype="multipart/form-data" id="fm" method="post">
    <div class="sj-fprw">
        <!-- tab切换-->
        <div class="tab1" id="tab1">

            <div class="menu">
                <ul>
                    <li id="onenull" onclick="SetTab(this,null)">全部任务</li>
                    <li id="one0" onclick="SetTab(this,'0')">进行中</li>
                    <li id="one1" onclick="SetTab(this,'1')">待审核</li>
                    <li id="one5" onclick="SetTab(this,'5')">待评价</li>
                    <li id="one3" onclick="SetTab(this,'3')">待完成</li>
                    <li id="one4" onclick="SetTab(this,'4')">已完成</li>
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

                            <input class="input-butto100-ls" style="width: 90px" type="button" value="查询" onclick="Search()" /></p>
                        <p>
                            <input class="input-butto100-hs" style="width: 90px"  type="button" value="刷新" onclick="Refresh()" /></p>
                        <p>

                            <input class="input-butto100-ls" style="width: 110px"   type="button" value="一键获取佣金" onclick="this.disable=true;this.value='数据正在提交';shouhuo()" /></p>
                    </div>
                    <!-- 搜索-->
                    <!-- 表格-->
                    <div class="fprw-pg">
                        <table>
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
                            <?php if(empty($task)):?>
                                <tr>
                                    <td colspan="5" align="center">
                                        <span style="width: 20px; font-weight: bolder;">列表只展示近30天接手的任务数据，可输入任务编号/订单编号查询以前的数据</span>
                                    </td>
                                </tr>
                            <?php endif;?>
                            <?php foreach ($list as $key=>$val):?>
                            <tr>
                                <td>
                                    <p class="fpgl-td-rw">
                                        任务编号：<?=$val['tasksn'];?>
                                        <b style="color: Red">(<?php switch ($val['intlet']){
                                                case 1:echo '淘宝APP自然搜索';break;
                                                case 2:echo '淘宝PC自然搜索';break;
                                                case 3:echo '淘宝APP淘口令';break;
                                                case 4:echo '淘宝APP直通车';break;
                                                case 5:echo '淘宝PC直通车';break;
                                                case 6:echo '淘宝APP二维码';break;
                                            }
                                        ?>)</b>
                                    </p>
                                   <p class="fpgl-td-rw">
                                        订单编号：<?=$val['ordersn'];?></p>
                                    <p class="fpgl-td-rw">
                                        <label title="">
                                            任务说明：<?=$val['remark'];?></label>
                                    </p>
                                </td>
                                <td class="fpgl-td-zs">
                                    <p class="fpgl-td-rw">
                                        买号：<?=$tbname;?></p>
                                    <p class="fpgl-td-rw">
                                        店铺名称：<?php echo $this->substr_cut($val['shopname'])?>
                                        <b style="color: Red">(淘宝)</b>
                                    </p>
                                </td>
                                <td class="fpgl-td-zs">
                                    <p class="fpgl-td-rw">
                                        商品价格：
                                        <b><?php if ($val['status']>0){$str=empty($val['express'])?($val['price']*$val['auction']).'元':($val['price']*$val['auction']).'元('.$val['express'].'元快递费)';echo $str;}else{echo '???';}?></b>

                                    </p>
                                    <p class="fpgl-td-rw">
                                        佣金：<?=$val['commission'];?>元</p>
                                    <p class="fpgl-td-rw" style=" text-align: left">
                                        <a id="a1" style="color: red">货款由商家支付，<br />
                                            佣金从平台提现。</a>
                                    </p>
                                    <p class="fpgl-td-rw">
                                        <span style="color: Red; margin-left: 40px;"> </span>
                                    </p>
                                </td>
                                <td class="fpgl-td-zs" align="center">
                                    <p class="fpgl-td-rw">
                                    </p>
                                    <a href="javascript:void(0)"  style="cursor: pointer" >
                                        <font color="red" >                        
                                        <?php
                                        switch ($val['status']){
                                            case 0:echo '进行中';break;
                                            case 1:echo '待审核';break;
                                            case 2:echo '获取佣金';break;
                                            case 3:echo '商家确认';break;
                                            case 4:echo '完成';break;
                                            case $val['status']==5 && $val['doing']!=3:echo '待评价';break;
                                            case $val['status']==5 && $val['doing']==3:echo '已放弃评价';break;
                                            case 6:echo '已评价';break;
                                            case 7:echo '已完成';break;
                                        }
                                        ?>
                                        </font>
                                    </a>
                                    <p class="fpgl-td-rw">
                                        接手时间：<?=date('Y/m/d H:i:s',$val['addtime'])?></p>
                                </td>

                                <td>

                                    <?php if ($val['status']=='0'){?>
                                    <p>

                                        <input class="input-butto100-xhs" type="button" value="开始任务" onclick="BeginTask01('<?= $val['taskid']?>','PC')" />
                                        <input class="input-butto100-xhs" type="button" value="开始任务旧的" onclick="BeginTask('<?= $val['id']?>')" />

                                    </p>
                                    <p class="fpgl-td-mtop">
                                        <!--<input class="input-butto100-xls" type="button" value="退出任务" onclick="this.disable=true;this.value='数据正在提交';ExitTask('<?= $val['taskid']?>')" />-->
                                        <input class="input-butto100-xls" type="button" value="退出任务" onclick="BeginTask02('<?= $val['taskid']?>','PC')" />                                       
                                    </p>
                                    <?php }elseif ($val['status']==2){?>
                                    <p class="fpgl-td-mtop">
                                        <input class="input-butto100-xhs" type="button" value="获取佣金" onclick="this.disable=true;this.value='数据正在提交';comfirmTask('<?= $val['id']?>')"/>
                                    </p>
                                    <?php }elseif ($val['status']==5 && $taskeval->doing!=3){?>
                                        <p class="fpgl-td-mtop">
                                            <input class="input-butto100-xhs" type="button" value="立即评价" onclick="this.disable=true;this.value='数据正在提交';evaltask('<?= $val['id']?>')"/>
                                        </p>
                                        <p class="fpgl-td-mtop">
                                            <input class="input-butto100-xls"  type="button" value="放弃评价" onclick="this.disable=true;this.value='数据正在提交';setfreetask(<?=$val['id']?>)"/>
                                        </p>
                                    <?php }?>

                                </td>
                            </tr>
                            <?php endforeach;?>
                        </table>
                    </div>
                    <!-- 表格-->
                </div>
            </div>
            <div class="yyzx_1">
            	<div id="demo1"></div>
            	
                <!--<?php
                $this->widget('CLinkPager', array(
                    'selectedPageCssClass'=>'active',
                    'pages' => $pages,
                    'lastPageLabel' => '最后一页',
                    'firstPageLabel' => '第一页',
                    'header' => false,
                    'nextPageLabel' => "下一页",
                    'prevPageLabel' => "上一页",
                ));
                ?>-->
            </div>
            
            <script>
            	layui.use(['laypage', 'layer'], function(){
				  var laypage = layui.laypage
				  ,layer = layui.layer;     
		  				 //调用分页
						  laypage.render({
						    elem: 'demo1'
						    ,count: <?PHP echo $count?>
						    ,jump: function(obj){
						      //模拟渲染
						      document.getElementById('biuuu_city_list').innerHTML = function(){
						        var arr = []
						        ,thisData = data.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
						        layui.each(thisData, function(index, item){
						          arr.push('<li>'+ item +'</li>');
						        });
						        return arr.join('');
						      }();
						    }
						  });
  				});
            </script>

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

