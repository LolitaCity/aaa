<div class="sj-fprw">
    <form action="/NewSchedual/NewSchedual/BrushPunishLog" enctype="multipart/form-data" id="fm" method="post">            <!-- tab切换-->
        <div class="tab1" id="tab1">
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
            <div class="menu">
                <ul>
                    <li id="one1" onclick="location.href='/NewSchedual/NewSchedual/SchedualList?WorkOrderType=1'">
                        任务处罚详情<label id="lbl0"></label></li>
                    <li id="one2" class="off" onclick="location.href='/NewSchedual/NewSchedual/BrushPunishLog'">扣分记录列表<label id="lbl1"></label></li>
                </ul>
            </div>
            <div class="menudiv">
                <div id="con_one_2">
                    <div class="fpgl-ss">
                        <p>
                                <span id="spOne">工单类型：<select class="select_215" id="Category1ID" name="Category1ID" style="width:150px"><option value="-1">请选择</option>
<option value="订单信息错误">订单信息错误</option>
<option value="好评问题">好评问题</option>
<option value="其他导致卖家损失的行为">其他导致卖家损失的行为</option>
<option value="任务过程出错">任务过程出错</option>
</select>&nbsp;&nbsp;</span>
                            <span id="spTwo">问题分类：<select class="select_215" id="Category2ID" name="Category2ID" style="width:150px"><option value="">请选择</option>
</select>&nbsp;&nbsp;</span>
                            任务编号：<input class="input_417" id="TaskID" name="TaskID" style="width:150px;" type="text" value="">&nbsp;&nbsp;
                            订单编号：<input class="input_417" id="PlatformOrderNumber" name="PlatformOrderNumber" style="width:150px;" type="text" value="">
                        </p>
                        <p>
                            <input class="input-butto100-ls" style="width: 80px" type="button" onclick="search()" value="查询"></p>
                        <p>
                            <input class="input-butto100-hs" style="width: 80px" type="button" value="刷新" onclick="Refresh()"></p>
                        <span id="lblTime" style="float: right; display: none;">
                                <input class="laydate-icon" id="BeginDate" maxlength="16" name="BeginDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:128px;height:34px;margin-left:5px;" type="text" value="">
                                ~
                                <input class="laydate-icon" id="EndDate" maxlength="16" name="EndDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:128px;height:34px;" type="text" value="">
                                <input type="button" value="确定" id="btnOK" class="button-c" onclick="SearchByTime()">
                            </span>
                    </div>
                    <!-- 搜索-->
                    <!-- 表格-->
                    <div class="fprw-pg">
                        <table>
                            <tbody><tr align="center">
                                <th width="232">
                                    <center>
                                        任务编号</center>
                                </th>
                                <th width="232">
                                    <center>
                                        订单编号</center>
                                </th>
                                <th width="232">
                                    <center>
                                        工单类型
                                    </center>
                                </th>
                                <th width="232">
                                    <center>
                                        问题分类
                                    </center>
                                </th>
                                <th width="232">
                                    <center>
                                        违规类型</center>
                                </th>
                                <th width="232">
                                    <center>
                                        信用积分扣分</center>
                                </th>
                                <th width="232">
                                    <center>
                                        <select id="DateType" name="DateType" onchange="ChangeTime()" style="height: 25px;"><option value="">创建时间</option>
                                            <option value="0">今天</option>
                                            <option value="1">昨天</option>
                                            <option value="2">本周</option>
                                            <option value="3">上周</option>
                                            <option value="4">本月</option>
                                            <option value="5">上月</option>
                                            <option value="6">本年</option>
                                            <option value="7">自定义</option>
                                        </select></center>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    V7928000193
                                </td>
                                <td>
                                    76463209364282219
                                </td>
                                <td>
                                    其他导致卖家损失的行为
                                </td>
                                <td>
                                    买手从淘宝客进入
                                </td>
                                <td>
                                    严重
                                </td>
                                <td>
                                    <label>-200</label>
                                </td>
                                <td>
                                    2017/11/15 14:33:22
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                    <!-- 表格-->
                </div>
            </div>
        </div>
        <!-- tab切换-->
    </form>    </div>