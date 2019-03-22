
<script src="<?php echo S_JS;?>jquery.jBox-2.3.min.js" type="text/javascript"></script>
<script src="<?php echo S_JS;?>laydate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo S_CSS;?>jbox.css" />

<script type="text/javascript">
    $(document).ready(function () {
        $("#QA").addClass("#QA");
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

    function Search() {
        var txtSearch = $("#TxtSearch").val();
        var selSearch = $("#SelSearch").val();
        var beginDate = $("#BeginDate").val();
        var endDate = $("#EndDate").val();
        var FOpinionStatus = $("#FOpinionStatus").val();
        window.location.href = '/Task/BrushFTask/BrushReviewManage?TxtSearch=' + encodeURI(txtSearch) + "&SelSearch=" + selSearch + "&BeginDate=" + beginDate + "&EndDate=" + endDate + "&FOpinionStatus=" + FOpinionStatus;
    }
    function Refresh() {
        window.location.href = '/Task/BrushFTask/BrushReviewManage';
    }

    function ReviewTask(id) {
        $.openWin(650, 630, '/Task/BrushFTask/SetReview?id=' + id);
    }

    //拒绝
    function refuse(id) {
        $.openWin(290, 500, '/Task/BrushFTask/RefuseOpinion?id=' + id);
    }

    function TwoReviewTask(id) {
        $.openWin(680, 630, '/Task/BrushFTask/SetAgainReview?id=' + id);
    }

    //拒绝追评
    function TwoRefuse(id) {
        $.openWin(290, 500, '/Task/BrushFTask/RefuseAOpinion?id=' + id);
    }
    //回答提问
    function QATask(id) {
        $.openWin(680, 610, '/Task/BrushFTask/BrushAnswer?id=' + id);
    }
    //拒绝回答提问
    function QARefuseTask(id) {
        $.openWin(290, 500, '/Task/BrushFTask/BrushRefuseAnswer?id=' + id);
    }
    //查看原因
    function CheckReason(id,type) {
        $.openWin(610, 600, '/Task/BrushFTask/CheckReason?id=' + id + '&type=' + type);
    }
    function ShowSetMsg() {
        $.openAlter("付款四天后，您才可以进行好评。", "温馨提示");
    }
    $(document).ready(function () {

        var sel = $("#SelSearch").val();

    })

    function ChangeType() {

    }

    function SetTab(obj, url) {
        $(".menu>ul>li").removeClass("off");
        $(obj).attr("class", "off");
        window.location.href = url;
    }

    $(document).ready(function () {
        var url = location.href;
        if (url.indexOf('BrushReviewManage') > -1) {
            $(".menu>ul>li").removeClass("off");
            $("#one1").attr("class", "off");
        }

        GetOpinionNum();
        GetQANum();
    })

    function GetOpinionNum(){
        $.ajax({
            type: "post",
            cache:false,
            url: "/Task/BrushFTask/GetOpinionNum",
            dataType: "json",
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                //alert("error GetNoReadCnt:"+XmlHttpRequest.responseText);
            },
            success: function (data) {
                if(data!=0){
                    var info='评价任务<strong><font color=red>('+data+')</font></strong>';
                    $("#one1").html(info);
                }
            }
        });
    }

    function GetQANum(){
        $.ajax({
            type: "post",
            cache:false,
            url: "/Task/BrushFTask/GetQANum",
            dataType: "json",
            error: function (XmlHttpRequest, textStatus, errorThrown) {
                //alert("error GetNoReadCnt:"+XmlHttpRequest.responseText);
            },
            success: function (data) {
                if(data!=0){
                    var info='淘宝问大家<strong><font color=red>('+data+')</font></strong>';
                    $("#one2").html(info);
                }
            }
        });
    }
</script>


<form action="/Task/BrushFTask/BrushReviewManage" enctype="multipart/form-data" id="fm" method="post">        <div class="sj-fprw">
        <!-- tab切换-->
        <div class="tab1" id="tab1">
            <div style="display: none;">
                <style>
                    .infobox
                    {
                        background-color: #fff9d7;
                        border: 1px solid #e2c822;
                        color: #333333;
                        padding: 5px;
                        padding-left: 30px;
                        font-size: 13px;
                        --font-weight: bold;
                        margin: 0 auto;
                        margin-top: 10px;
                        margin-bottom: 10px;
                        width: 95%;
                        text-align: left;
                    }
                    .errorbox
                    {
                        background-color: #ffebe8;
                        border: 1px solid #dd3c10;
                        margin: 0 auto;
                        margin-top: 10px;
                        margin-bottom: 10px;
                        color: #333333;
                        padding: 5px;
                        padding-left: 30px;
                        font-size: 13px;
                        --font-weight: bold;
                        width: 85%;
                    }
                </style>
            </div>
            <div class="menu">
                <ul>
                    <li id="one1" onclick="SetTab(this,'BrushReviewManage')">评价任务</li>
                    <li id="one2" onclick="SetTab(this,'BrushQAListManageMent')">淘宝问大家</li>
                </ul>
            </div>
            <div class="menudiv">
                <div id="con_one_1" class="sj-fpgl">
                    <!-- 搜索-->
                    <div class="fpgl-ss">
                        <p>
                            <select class="select_215" id="FOpinionStatus" name="FOpinionStatus" style="width:130px;"><option value="">所有</option>
                                <option value="1">完成评价</option>
                                <option value="2">等待评价</option>
                                <option value="3">等待追评</option>
                                <option value="4">完成追评</option>
                                <option value="5">已取消评价</option>
                                <option value="6">已取消追评</option>
                                <option value="-11">待审核评价</option>
                                <option value="-12">待审核追评</option>
                                <option value="9">评价不通过</option>
                                <option value="12">追评不通过</option>
                                <option value="13">已忽略评价</option>
                            </select>
                        </p>
                        <p>
                            <select class="select_215" id="SelSearch" name="SelSearch" style="width:130px;"><option value="TaskID">任务编号</option>
                                <option value="PlatformOrderNumber">订单编号</option>
                                <option value="ShopName">店铺名称</option>
                            </select>
                        </p>
                        <p id="pTxtSearch">
                            <input class="input_417" id="TxtSearch" name="TxtSearch" style="width:170px;" type="text" value="" />
                        </p>
                        <p>
                            支付时间:<input class="laydate-icon" id="BeginDate" maxlength="16" name="BeginDate" onclick="laydate({istime: true, format: &#39;YYYY-MM-DD hh:mm&#39;})" style="width:128px;height:34px;margin-left:5px;" type="text" value="" />
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
                    <div class="fprw-pg" style="width: 99%;">
                        <table>
                            <tr>
                                <th width="250">
                                    任务/订单编号
                                </th>
                                <th width="232">
                                    买号/商品信息
                                </th>
                                <th width="232">
                                    任务类型和佣金
                                </th>
                                <th width="232">
                                    任务状态
                                </th>
                                <th width="132">
                                    操作按钮
                                </th>
                            </tr>
                            <tr>
                                <td colspan="5" align="center">
                                    <span style="width: 20px; font-weight: bolder; color: Red;">找不到相关数据</span>
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
                <li class="htyg_tc_1">确认删除</li>
                <li class="htyg_tc_2"><a href="javascript:void(0)" onclick="document.getElementById('light1').style.display='none';document.getElementById('fade').style.display='none'">
                        <img src="/Content/images/sj-tc.png"></a> </li>
            </ul>
        </div>
        <!--列表 -->
        <div class="yctc_458 ycgl_tc_1">
            <ul>
                <li class="fpgl-tc-qxjs">确定拒绝</li>
                <li class="fpgl-tc-qxjs_2">是否确定拒绝评论/好评？</li>
                <li class="fpgl-tc-qxjs_4">
                    <p>
                        <input class="input-butto100-hs" type="button" value="确定提交" id="delete" />
                    </p>
                    <p>
                        <input id="bntDel" onclick="document.getElementById('light1').style.display='none';document.getElementById('fade').style.display='none'"
                               class="input-butto100-ls" type="button" value="返回修改" /></p>
                </li>
            </ul>
        </div>
    </div>
    <div id="fade" class="black_overlay">
    </div>
</form>
</body>
