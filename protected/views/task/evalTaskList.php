   <script src="<?php echo S_JS;?>laydate.js" type="text/javascript"></script>
   <link href="<?php echo S_CSS;?>laydate.css" rel="stylesheet" >
   <style>
       #QA{background: <?php echo PLATFORM == 'esx' ? '#a70101' : '#007efb'?>;}
   </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#QA").addClass("#QA");
            if ($("#serviceValidation").length > 0) {
                $.openAlter($("#serviceValidation").text(), "提示", { width: 250, top: 500, height: 50 });
            }
            var taskStatus = '<?=@$_GET['status'];?>';
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


        function Search() {
            var txtSearch = $("#TxtSearch").val();
            var selSearch = $("#SelSearch").val();
            var beginDate = $("#BeginDate").val()?Date.parse(new Date($("#BeginDate").val()))/1000:'';
            var endDate =$("#EndDate").val()?Date.parse(new Date($("#EndDate").val()))/1000:'';
            var optionstatus = $("#FOpinionStatus").val();
            window.location.href = '/task/evaltasklist/txtSearch/' + encodeURI(txtSearch) + "/SelSearch/" + selSearch + "/BeginDate/" + beginDate + "/EndDate/" + endDate + "/optionstatus/" + optionstatus;
        }
        function Refresh() {
            window.location.href = '<?=$this->createUrl('task/evaltasklist')?>';
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
<form action="<?=$this->createUrl('task/evaltasklist')?>" enctype="multipart/form-data" id="fm" method="post">        <div class="sj-fprw">
        <!-- tab切换-->
        <div class="tab1" id="tab1">

            <div class="menu">
                <ul>
                    <li id="one1" class="off">评价任务</li>
                </ul>
            </div>
            <div class="menudiv">
                <div id="con_one_1" class="sj-fpgl">
                    <!-- 搜索-->
                    <div class="fpgl-ss">
                        <p>
                            <select class="select_215" id="FOpinionStatus" name="FOpinionStatus" style="width:130px;">
                                <option value="">所有</option>
                                <option <?php if (@$search['optionstatus']==0)echo 'selected';?> value="0">待评价</option>
                                <option <?php if (@$search['optionstatus']==1)echo 'selected';?>  value="1">等待确认的评价</option>
                                <option <?php if (@$search['optionstatus']==2)echo 'selected';?>  value="2">已完成评价</option>
                                <option <?php if (@$search['optionstatus']==3)echo 'selected';?>  value="3">放弃的评价</option>
                            </select>
                        </p>
                        <p>
                            <select class="select_215" id="SelSearch" name="SelSearch" style="width:130px;">
                                <option <?php if (@$search['SelSearch']=='tasksn')echo 'selected';?>  value="tasksn">任务编号</option>
                                <option <?php if (@$search['SelSearch']=='ordersn')echo 'selected';?>  value="ordersn">订单编号</option>
                                <option <?php if (@$search['SelSearch']=='shopname')echo 'selected';?>  value="shopname">店铺名称</option>
                            </select>
                        </p>
                        <p id="pTxtSearch">
                            <input class="input_417" id="TxtSearch" name="TxtSearch" style="width:170px;" type="text" value="<?=@$search['txtSearch']?>" />
                        </p>
                        <p>
                            支付时间:<input class="laydate-icon" id="BeginDate" maxlength="16" name="BeginDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:128px;height:34px;margin-left:5px;" type="text" value="<?php if ($search['BeginDate'])echo date('Y-m-d h:m',$search['BeginDate']);?>" />
                            ~
                            <input class="laydate-icon" id="EndDate" maxlength="16" name="EndDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:128px;height:34px;" type="text" value="<?php if ($search['EndDate'])echo date('Y-m-d h:m',$search['EndDate']);?>" />
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
                            <tbody><tr>
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
                            <?php foreach ($evallist as $val):?>
                            <tr>
                                <td>
                                    <p class="fpgl-td-rw">任务编号：<?=$val['tasksn']?><b style="color: Red">(淘宝)</b>
                                    </p>
                                    <p class="fpgl-td-rw">订单编号：<?=$val['ordersn']?></p>
                                    <p class="fpgl-td-rw"><label><?=strtr($val['expressnum'],'&',':')?></label></p>
                                </td>
                                <td class="fpgl-td-zs">
                                    <p class="fpgl-td-rw">买号：<?=$val['wangwang']?></p>
                                    <p class="fpgl-td-rw">店铺名称：<?=$this->substr_cut($val['shopname'])?></p>
                                </td>
                                <td class="fpgl-td-zs">
                                    <p class="fpgl-td-rw"><span><?=($val['status']==1?'晒图好评':'文字好评');?>: <?= $val['iscommission']-$commission_house; ?>元</span><br>
                                    </p>
                                </td>
                                <td class="fpgl-td-zs" align="left">
                                    <p class="fpgl-td-rw">
                                        支付时间：<?=date('Y-m-d H:i:s',$val['updatetime'])?></p>
                                    <p class="fpgl-td-rw">
                                        评价状态: <?php
                                        switch ($val['doing']){
                                            case 0:echo '待评价';break;
                                            case 1;echo '已评价,等待商家确认';break;
                                            case 2;echo '评价完成';break;
                                            case 3;echo '已拒绝评价';break;
                                        }
                                        ?>
                                    </p>
                                </td>
                                <td>
                                    <?php if ($val['doing']==0){?>
                                    <p class="fpgl-td-mtop">
                                        <input class="input-butto100-xhs" type="button" value="立即评价" onclick="evaltask('<?= $val['usertaskid']?>')"/>
                                    </p>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody></table>
                    </div>


                    <!-- 表格-->
                </div>
            </div>
            <div class="yyzx_1">
                <?php
                $this->widget('CLinkPager', array(
                    'selectedPageCssClass'=>'active',
                    'pages' => $pages,
                    'lastPageLabel' => '最后一页',
                    'firstPageLabel' => '第一页',
                    'header' => false,
                    'nextPageLabel' => "下一页",
                    'prevPageLabel' => "上一页",
                ));
                ?>
            </div>

        </div>
        <!-- tab切换-->
    </div>
    <div id="light1" class="ycgl_tc yctc_498">
        <!--列表 -->
        <div class="htyg_tc">f
            <ul>
                <li class="htyg_tc_1">确认删除</li>
                <li class="htyg_tc_2"><a href="javascript:void(0)" onclick="document.getElementById('light1').style.display='none';document.getElementById('fade').style.display='none'">
                        <img src="<?=S_IMAGES;?>sj-tc.png"></a> </li>
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
