
<script>
    function GetLink(id) {
        window.location.href="/schedual/schedualdetail/scheduaid/"+id;
    }
    function Refresh() {
        window.location.href="<?=$this->createUrl('schedual/scheduallist')?>";
    }
    function search(){
        $('#fm').submit();
    }
</script>
<div class="sj-fprw">
    <form action="<?=$this->createUrl('schedual/scheduallist')?>" enctype="multipart/form-data" id="fm" method="post">            <!-- tab切换-->
        <div class="tab1" id="tab1">

            <input data-val="true" data-val-number="字段 WorkOrderType 必须是一个数字。" data-val-required="WorkOrderType 字段是必需的。" id="WorkOrderType" name="WorkOrderType" type="hidden" value="1">
            <div class="menu">
                <ul>
                    <li id="one1" class="off" onclick="location.href='<?=$this->createUrl('schedual/scheduallist')?>'">
                        任务处罚详情<label id="lbl0"></label></li>
                    <li id="one2" onclick="location.href='<?=$this->createUrl('schedual/schedualscorelist')?>'">扣分记录列表<label id="lbl4"></label></li>
                </ul>
            </div>
            <div class="menudiv">
                <div id="con_one_2">

                    <div class="fpgl-ss">
                        <p>
                                 <span id="spOne">工单类型：
                                     <select class="select_215" id="Category1ID" name="Category1ID" style="width:150px">
                                         <option value="0">请选择</option>
                                         <?php foreach ($cate as $val):?>
                                         <option <?php if (@$searchword['Category1ID']==$val->id)echo 'selected';?> value="<?=$val->id?>"><?=$val->typename;?></option>
                                         <?php endforeach;?>
                                        </select>&nbsp;&nbsp;
                                 </span>
                            <span id="spTwo"> 问题分类：<select class="select_215" id="Category2ID" name="Category2ID" style="width:150px">
                                    <option value="">请选择</option>
                                    <?php if (@$searchword['Category1ID']){
                                        $chidcate=$this->getChildCate($searchword['Category1ID']);
                                        if ($chidcate){
                                            foreach ($chidcate as $v){
                                                $se=$searchword['Category2ID']==$v->id?'selected':'';
                                                echo "<option $se value='$v->id'>".$v->typename."</option>";
                                            }
                                        }
                                        ?>
                                    <?php }?>

                            </select>&nbsp;
                                </span>
                            任务编号：<input type="text" id="TaskID" value="<?=@$searchword['tasksn']?>" name="tasksn" style="width: 150px;" class="input_417">&nbsp;&nbsp;
                            订单编号：<input type="text" value="<?=@$searchword['ordersn']?>"  id="PlatformOrderNumber" name="ordersn" style="width: 150px;" class="input_417">
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
                                        处罚金额</center>
                                </th>
                                <th width="232">
                                    处理状态
                                </th>
                                <th width="232">
                                    创建时间
                                </th>
                                <th width="132">
                                    <center>
                                        操作</center>
                                </th>
                            </tr>
                            <?php foreach ($list as $v):?>
                            <tr>
                                <td><?=$v['tasksn']?></td>
                                <td><?=$v['ordersn']?></td>
                                <td><?php $sceduatype=Schedualtype::model()->findByPk($v['typeid']);
                                echo $sceduatype->typename;?></td>
                                <td><?php $sceduatype=Schedualtype::model()->findByPk($v['questionid']);
                                    echo $sceduatype->typename;?></td>
                                <td><?=$v['penaltymoney']?></td>
                                <td><?php switch ($v['status']){
                                        case 0:echo '待处理';break;
                                        case 1:echo '跟进中';break;
                                        case 2:echo '待执行';break;
                                        case 3:echo '处理完成';break;
                                        case 4:echo '已撤销';break;
                                        case 5:echo '拒绝处理';break;
                                    }?></td>
                                <td>
                                    <?=date('Y-m-d H:i:s',$v['addtime']);?>
                                </td>
                                <td height="27">
                                    <p class="fpgl-td-mtop">
                                       <input onclick="GetLink('<?=$v['id']?>')" class="input-butto100-xls" type="button" value="查看">
                                    </p>
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
    </form>    </div>
<script>
    $('#Category1ID').change(function () {
        var tValue = $(this).val();
        if (tValue == "" || tValue == null) {
            return;
        }
        var url = '<?=$this->createUrl('schedual/getcategory')?>';
        $.ajax({
            url: url,
            type: "post",
           dataType: "json",
            data: { categroyID: tValue },
            success: function (data) {
                $("#Category2ID").empty();
                $.each(data, function (i, item) {
                    $("<option value='" + item.id + "'>" + item.typename + "</option>").appendTo($("#Category2ID"));
                });
            }
        });

    })
</script>