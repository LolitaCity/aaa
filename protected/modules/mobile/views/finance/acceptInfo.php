
<!-- 内容-->
<div class="sj-zjgl">
    <?php   echo $this->renderPartial('/finance/leftNav');  $userinfo=User::model()->findByPk(Yii::app()->user->getId()); ?>
    <div class="zjgl-right">
        <!-- 搜索-->
        <form action="/Member/MemberInfo/AccpetSituation" id="fm" method="post">                <div class="fpgl-ss" style="margin-top: 0px;">
                <p class="zjgl-right_3" style="margin-right: 40px;">
                    接手情况汇总</p>
                <p style="line-height: 35px; margin-left: 100px;">
                    日期：</p>
                <p>
                    <input class="laydate-icon" id="BeginDate" maxlength="16" name="BeginDate" onclick="laydate({istime: false, format: 'YYYY-MM'})" style="width:128px;height:28px;" type="text" value="">~
                </p>
                <p>
                    <input class="laydate-icon" id="EndDate" maxlength="16" name="EndDate" onclick="laydate({istime: false, format: 'YYYY-MM'})" style="width:128px;height:28px;" type="text" value=""></p>
                <p>
                </p>
                <p>
                    <input class="input-butto100-ls" type="button" onclick="Search()" value="查询"></p>
                <p style="margin-right: 0px;">
                    <a href="/Member/MemberInfo/AccpetSituation">
                        <input class="input-butto100-hs" type="button" value="刷新"></a>
                </p>
            </div>
            <!-- 搜索-->
            <div class="zjgl-right_2">
                <table>
                    <tbody><tr>
                        <th width="120">
                            日期
                        </th>
                        <th width="120">
                            接手任务数
                        </th>
                        <th width="120">
                            所获佣金数
                        </th>
                        <th width="120">
                            违规扣分次数
                        </th>
                        <th width="120">
                            账户冻结次数
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div align="center" style="color: Red; font-weight: bolder;">
                                汇总：</div>
                        </td>
                        <td>
                            <div align="center" style="color: Red; font-weight: bolder;">
                                3</div>
                        </td>
                        <td>
                            <div align="center" style="color: Red; font-weight: bolder;">
                                30.00</div>
                        </td>
                        <td>
                            <div align="center" style="color: Red; font-weight: bolder;">
                                0</div>
                        </td>
                        <td>
                            <div align="center" style="color: Red; font-weight: bolder;">
                                0
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2017-10
                        </td>
                        <td>0
                        </td>
                        <td>0.00
                        </td>
                        <td>0
                        </td>
                        <td>0
                        </td>
                    </tr>
                    <tr>
                        <td>2017-09
                        </td>
                        <td>3
                        </td>
                        <td>30.00
                        </td>
                        <td>0
                        </td>
                        <td>0
                        </td>
                    </tr>
                    <tr>
                        <td>2017-08
                        </td>
                        <td>0
                        </td>
                        <td>0.00
                        </td>
                        <td>0
                        </td>
                        <td>0
                        </td>
                    </tr>
                    <tr>
                        <td>2017-07
                        </td>
                        <td>0
                        </td>
                        <td>0.00
                        </td>
                        <td>0
                        </td>
                        <td>0
                        </td>
                    </tr>
                    <tr>
                        <td>2017-06
                        </td>
                        <td>0
                        </td>
                        <td>0.00
                        </td>
                        <td>0
                        </td>
                        <td>0
                        </td>
                    </tr>
                    <tr>
                        <td>2017-05
                        </td>
                        <td>0
                        </td>
                        <td>0.00
                        </td>
                        <td>0
                        </td>
                        <td>0
                        </td>
                    </tr>
                    <tr>
                        <td>2017-04
                        </td>
                        <td>0
                        </td>
                        <td>0.00
                        </td>
                        <td>0
                        </td>
                        <td>0
                        </td>
                    </tr>
                    <tr>
                        <td>2017-03
                        </td>
                        <td>0
                        </td>
                        <td>0.00
                        </td>
                        <td>0
                        </td>
                        <td>0
                        </td>
                    </tr>
                    <tr>
                        <td>2017-02
                        </td>
                        <td>0
                        </td>
                        <td>0.00
                        </td>
                        <td>0
                        </td>
                        <td>0
                        </td>
                    </tr>
                    <tr>
                        <td>2017-01
                        </td>
                        <td>0
                        </td>
                        <td>0.00
                        </td>
                        <td>0
                        </td>
                        <td>0
                        </td>
                    </tr>
                    </tbody></table>
            </div>
            <script type="text/javascript">

                /**验证页码*/
                function validationPageIndex(t, maxCount) {
                    ifPageSize(maxCount);
                }

                /**跳转到指定页*/
                function redirectPage(url, maxCount) {
                    var pageIndex = $("#PageIndex").val();
                    if (ifPageSize(maxCount))
                        window.location = url + "&page=" + (pageIndex - 1);
                }

                /*下一页*/
                function nextPage(url, pageIndex, maxCount) {
                    if (pageIndex > maxCount) {
                        $.openAlter("没有了", "提示", { height: 210, width: 350 });
                        return;
                    }
                    window.location = url + "&page=" + (pageIndex - 1);
                }

                /*上一页*/
                function prePage(url, pageIndex, maxCount) {
                    if (pageIndex <= 0) {
                        $.openAlter("没有了", "提示", { height: 210, width: 350 });
                        return;
                    }
                    window.location = url + "&page=" + (pageIndex - 1);
                }

                function ifPageSize(maxCount) {

                    var pageIndex = $("#PageIndex").val();
                    if (pageIndex == '' || isNaN(pageIndex) || parseInt(pageIndex) < 1) {
                        $.openAlter("请正确输入页码", "提示", { height: 210, width: 350 });
                        return false;
                    }
                    if (parseInt(pageIndex) > maxCount) {
                        $.openAlter("输入的页码不能大于总页码", "提示", { height: 210, width: 350 });
                        return false;
                    }
                    return true;
                }

                function submitPage(event, maxCount) {
                    var pageIndex = $("#PageIndex").val();
                    if (pageIndex == '' || isNaN(pageIndex) || parseInt(pageIndex) < 1) {
                        return false;
                    }
                    if (parseInt(pageIndex) > maxCount) {
                        return false;
                    }
                    var e = event || window.event || arguments.callee.caller.arguments[0];
                    if (e && e.keyCode == 13) { // enter 键
                        //要做的事情
                        $("#paRedirect").click();
                    }
                }
            </script>
            <div class="yyzx_1">
                <p class="yyzx_2">
                    <a href="javascript:" onclick="prePage('/Member/MemberInfo/AccpetSituation?sz=1',0,2)">
                    </a>
                </p>
                <p style="margin-left: 5px; margin-right: 5px;">1/2</p>
                <p class="yyzx_3">
                    <a href="javascript:" onclick="nextPage('/Member/MemberInfo/AccpetSituation?sz=1',2,2)">
                    </a>
                </p>
                <p style="margin-left: 12px; margin-right: 8px;">
                    <input type="text" name="PageIndex" class="input_58" id="PageIndex" value="1" onkeyup="value=value.replace(/[^0-9]/g,'');submitPage(event,2)" maxlength="9">
                </p>
                <p class="ymfw-right-zgj_7">
                    <a href="javascript:" id="paRedirect" onclick="redirectPage('/Member/MemberInfo/AccpetSituation?sz=1',2)">
                        跳转</a></p>
            </div>
        </form>        </div>
</div>
<!-- 内容-->
