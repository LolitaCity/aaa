<link href="<?php echo S_CSS;?>user_index.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo S_CSS;?>laydate.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo S_JS;?>jquery.jBox-2.3.min.js" type="text/javascript"></script>
<script src="<?php echo S_JS;?>laydate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo S_CSS;?>jbox.css" />

<script type="text/javascript">
        $(document).ready(function () {
            $("#BrushAcceptManage").addClass("#BrushAcceptManage");
            if ($("#serviceValidation").length > 0) {
                $.openAlter($("#serviceValidation").text(), "提示", { width: 250, top: 500, height: 50 });
            }
            var taskStatus = request("TaskStatus");
            if (taskStatus == "" || taskStatus == "null" || taskStatus == null)
                $("#one1").attr("class", "off");
            if (taskStatus == "1")
                $("#one2").attr("class", "off");
            if (taskStatus == "2")
                $("#one3").attr("class", "off");
            if (taskStatus == "3")
                $("#one4").attr("class", "off");
            if (taskStatus == "4")
                $("#one5").attr("class", "off");
            if (taskStatus == "5")
                $("#one6").attr("class", "off");

            if ($("#serviceValidation").length > 0) {
                $.openAlter($("#serviceValidation").text(), "提示", { width: 250, height: 50 });
            }
        });

        function request(paras) {
            var url = location.href;
            var paraString = url.substring(url.indexOf("?") + 1, url.length).split("&");
            var paraObj = {};
            for (var i = 0; j = paraString[i]; i++) {
                paraObj[j.substring(0, j.indexOf("=")).toLowerCase()] = j.substring(j.indexOf("=") + 1, j.length);
            }
            var returnValue = paraObj[paras.toLowerCase()];
            if (typeof (returnValue) == "undefined") {
                return "";
            } else {
                return returnValue;
            }
        }
        function clearNoNum(event, obj) {
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
        }
        function checkNum(obj) {
            //为了去除最后一个.
            obj.value = obj.value.replace(/\.$/g, "");
        }
        function SetTab(obj, taskStatus) {
            //            $(".menu>ul>li").each(function () {
            //                if($(this).attr("class")=="off") {
            //                    $(this).attr("class","")
            //                }
            //            })
            $(".menu>ul>li").removeClass("off");
            $(obj).attr("class", "off");
            window.location.href = '/Task/BrushFTask/BrushAcceptManage?TaskStatus=' + taskStatus;
        }
        function Search() {
            var taskStatus = request("TaskStatus");
            var txtSearch = $("#TxtSearch").val();
            var selSearch = $("#SelSearch").val();
            var beginDate = $("#BeginDate").val();
            var endDate = $("#EndDate").val();
            window.location.href = '/Task/BrushFTask/BrushAcceptManage?TaskStatus=' + taskStatus + "&TxtSearch=" + encodeURI(txtSearch) + "&SelSearch=" + selSearch + "&BeginDate=" + beginDate + "&EndDate=" + endDate;
        }
        function Refresh() {
            var taskStatus = request("TaskStatus");
            window.location.href = '/Task/BrushFTask/BrushAcceptManage?TaskStatus=' + taskStatus;
        }


        function BeginBespeakTaskOne(taskId) {
            $.openWin(560, 840, '/Task/BrushFTask/BeginBespeakTaskOne?taskID=' + taskId);
        }
        function BeginTask(taskId) {
            $.openWin(560, 840, '/Task/BrushFTask/BeginTaskOne?taskID=' + taskId);
        }
        function BeginBespeakTaskFour(taskId) {
            $.openWin(560, 840, '/Task/BrushFTask/BeginBespeakTaskFour?taskID=' + taskId);
        }
        function CheckData(taskId) {
            $.openWin(560, 500, '/Task/BrushFTask/CheckAuditData?taskID=' + taskId);
        }
        function ReSubmit(taskId, msg) {
            var msg = "<h3 style=\"text-align:left\"> 订单审核不通过！</h3><br><h3 style=\"text-align:left\"><em style=\"color:red;\">原因：</em>" + msg + "</h3>";
            openConfirm(msg, "查看订单审核结果", { width: 400, height: 50 }, function () { $.openWin(560, 840, '/Task/BrushFTask/BeginTaskFour?taskID=' + taskId + "&SubmitData=" + '重新提交'); }, "重新开始", function () { $.self.parent.$.closeAlert() }, "好的");

            //   $.openWin(320, 480, '/Task/BrushFTask/PayAuditNot?taskID=' + taskId);
            //            $.openWin(560, 840, '/Task/BrushFTask/BeginTaskFour?taskID=' + taskId + "&SubmitData=" + '重新提交');
        }
        function ReBespeakSubmit(taskId, msg) {
            var msg = "<h3 style=\"text-align:left\"> 订单审核不通过！</h3><h3 style=\"text-align:left;margin-top:10px;\"><em style=\"color:red;\">原因：</em>" + msg + "</h3>";
            openConfirm(msg, "查看订单审核结果", { width: 400, height: 50 }, function () { $.openWin(560, 840, '/Task/BrushFTask/BeginBespeakTaskFive?taskID=' + taskId + "&SubmitData=" + '重新提交'); }, "重新开始", function () { $.self.parent.$.closeAlert() }, "好的");

        }
        function ExitTask(taskId) {
            $.openWin(350, 500, '/Task/BrushFTask/ExitTask?taskID=' + taskId);
        }
        function LogisticInfo(taskId) {
            $.openWin(250, 500, '/Task/BrushFTask/GetLogisticInfo?taskID=' + taskId);
        }
        function ConfirmReceive(taskId) {
            $.openWin(250, 500, '/Task/BrushFTask/ConfirmReceive?taskID=' + taskId);
        }
        function ReturnFirst(taskId) {
            $.openWin(250, 500, '/Task/BrushFTask/ReturnFirst?taskID=' + taskId);
        }
        function ShowRemark(remark) {
            $("#fade").height($(document).height());
            $("#fade").width($(document).width());

            var scrollH = $(document).scrollTop();
            var scrollL = $(document).scrollLeft();
            var topVal = ($(window).height() - $("#light1").height()) / 2 + scrollH;
            var leftVal = ($(window).width() - $("#light1").width()) / 2 + scrollL;
            if (topVal < 0) {
                topVal = 10;
            }
            $("#light1").css("left", leftVal).css("top", topVal);

            document.getElementById('light1').style.display = 'block';
            document.getElementById('fade').style.display = 'block';
            $("#lblRemark").text(remark);
            $("#pRemark").css({ "line-height": $("#lblRemark").height() + "px" });
        }

        function ShowOptLog(taskID) {
            $.openWin(500, 850, '/Task/BrushFTask/TaskOptLog?taskID=' + taskID);
        }

        function AnswerTask(taskID) {
            $.openWin(540, 610, '/Task/BrushFTask/AnswerTask?taskID=' + taskID);
        }
        function GetDifferenceInfo(taskID) {
            $.openWin(340, 480, '/Task/BrushFTask/GetDifferencePriceInfo?taskID=' + taskID);
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
        .sjzc_1_t
        {
            height: 50px;
            background: #4882f0;
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


<form action="/Task/BrushFTask/BrushAcceptManage" enctype="multipart/form-data" id="fm" method="post">            <div class="sj-fprw">
        <!-- tab切换-->
        <div class="tab1" id="tab1">

            <div class="menu">
                <ul>
                    <li id="one1" onclick="SetTab(this,null)">全部任务</li>
                    <li id="one2" onclick="SetTab(this,'1')">进行中</li>
                    <li id="one3" onclick="SetTab(this,'2')">待发货</li>
                    <li id="one4" onclick="SetTab(this,'3')">待评价</li>
                    <li id="one5" onclick="SetTab(this,'4')">待完成</li>
                    <li id="one6" onclick="SetTab(this,'5')">已完成</li>
                </ul>
            </div>
            <div class="menudiv">
                <div id="con_one_1" class="sj-fpgl">
                    <!-- 搜索-->
                    <div class="fpgl-ss">
                        <p>
                            <select class="select_215" id="SelSearch" name="SelSearch"><option value="TaskID">任务编号</option>
                                <option value="PlatformOrderNumber">订单编号</option>
                                <option value="ShopName">店铺名称</option>
                            </select>
                        </p>
                        <p>
                            <input class="input_417" id="TxtSearch" name="TxtSearch" style="width:200px;" type="text" value="" />
                        </p>
                        <p>
                            接手时间:<input class="laydate-icon" id="BeginDate" maxlength="16" name="BeginDate" onclick="laydate({istime: true, format: &#39;YYYY-MM-DD hh:mm&#39;})" style="width:128px;height:34px;margin-left:5px;" type="text" value="" />
                            ~
                            <input class="laydate-icon" id="EndDate" maxlength="16" name="EndDate" onclick="laydate({istime: true, format: &#39;YYYY-MM-DD hh:mm&#39;})" style="width:128px;height:34px;" type="text" value="" />
                        </p>
                        <p>

                            <input class="input-butto100-ls" type="button" value="查询" onclick="Search()" /></p>
                        <p>
                            <input class="input-butto100-hs" type="button" value="刷新" onclick="Refresh()" /></p>
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
                            <tr>
                                <td>
                                    <p class="fpgl-td-rw">
                                        任务编号：V5425014532
                                        <b style="color: Red">(淘宝APP自然搜索)</b>
                                    </p>
                                    <p class="fpgl-td-rw">
                                        订单编号：</p>
                                    <p class="fpgl-td-rw">
                                        <label title="">
                                            任务说明：</label>
                                    </p>
                                </td>
                                <td class="fpgl-td-zs">
                                    <p class="fpgl-td-rw">
                                        买号：张涛b</p>
                                    <p class="fpgl-td-rw">
                                        店铺名称：d*****店
                                        <b style="color: Red">(天猫)</b>
                                    </p>
                                </td>
                                <td class="fpgl-td-zs">
                                    <p class="fpgl-td-rw">
                                        商品价格：
                                        <b>???</b>
                                        元
                                    </p>
                                    <p class="fpgl-td-rw">
                                        佣金：<??>元</p>
                                    <p class="fpgl-td-rw" style="color: Red; text-align: left">
                                        <a id="a1" href="/Member/Transfer/TransferList">货款由商家支付，<br />
                                            佣金从平台提现。</a>
                                    </p>
                                    <p class="fpgl-td-rw">
                                        <span style="color: Red; margin-left: 40px;"> </span>
                                    </p>
                                </td>
                                <td class="fpgl-td-zs" align="center">
                                    <p class="fpgl-td-rw">
                                    </p>
                                    <a href="javascript:void(0)" onclick="ShowOptLog('V5425014532')" style="cursor: pointer" >进行中</a>
                                    <p class="fpgl-td-rw">
                                        接手时间：2017/10/28 16:13:39</p>
                                </td>
                                <td>
                                    <p>
                                        <input class="input-butto100-xls" type="button" value="开始任务" onclick="BeginTask('V5425014532')" />
                                    </p>
                                    <p class="fpgl-td-mtop">
                                        <input class="input-butto100-xhs" type="button" value="退出任务" onclick="ExitTask('V5425014532')" /></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- 表格-->
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
                        <img src="/Content/images/sj-tc.png"></a> </li>
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
        var el = "<div class='sjzc_t1' id='ow_confirm002'><div class='sjzc_1_t' style='color:White; text-align:left;'>&nbsp;&nbsp;{title}<a  style='margin-left: 200px; ' href='javascript:void(0)' id='imgeColse'><img src='/Content/images/sj-tc.png'></a></div><div class='sjzc_2_t'><div class='sjzc_5_t' style='margin-top: 10px; '><div style='overflow-y:auto;height:120px;word-wrap: break-word;'>{message}</div><div class='sjzc_5_t' style='margin-top: 20px;'><ul><li class='sjzc_7_t1'><a href='javascript:void(0)' style='display:inline-block' id='ow_confirm002_fun'></a><a href='javascript:void(0)' style='margin-left:10px; display:inline-block' class='ad' id='ow_confirm002_fun2'></a></li></ul></div></div></div></div>";
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
        $("#imgeColse").click(function(){
            $.closeConfirm();
        })
    }
</script>

