<script>
    function search(){
        $('#fm').submit();
    }
    function Refresh() {
        window.location.href="<?=$this->createUrl('schedual/schedualscorelist')?>";
    }
</script>
<div class="sj-fprw">
    <form action="<?=$this->createUrl('schedual/schedualscorelist')?>" enctype="multipart/form-data" id="fm" method="post">            <!-- tab切换-->
        <div class="tab1" id="tab1">

            <div class="menu">
                <ul>
                    <li id="one1" onclick="location.href='<?=$this->createUrl('schedual/scheduallist')?>'">
                        任务处罚详情<label id="lbl0"></label></li>
                    <li id="one2" class="off" onclick="location.href='<?=$this->createUrl('schedual/schedualscorelist')?>'">扣分记录列表<label id="lbl1"></label></li>
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
&nbsp;&nbsp;                                   </span>
                            <span id="spTwo">问题分类：
                                <select class="select_215" id="Category2ID" name="Category2ID" style="width:150px">
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

                                </select></span>
                            任务编号：<input class="input_417" id="TaskID" name="tasksn" style="width:150px;" type="text" value="<?=@$searchword['tasksn']?>">&nbsp;&nbsp;
                            订单编号：<input class="input_417" id="PlatformOrderNumber" name="ordersn" style="width:150px;" type="text" value="<?=@$searchword['ordersn']?>">
                        </p>
                        <p>
                            <input class="input-butto100-ls" style="width: 80px" type="button" onclick="search()" value="查询"></p>
                        <p>
                            <input class="input-butto100-hs" style="width: 80px" type="button" value="刷新" onclick="Refresh()"></p>
                        <span id="lblTime" style="float: right; display: none;">
                               <input type="button" value="确定" id="btnOK" class="button-c" onclick="SearchByTime()">
                            </span>
                    </div>
                    <!-- 搜索-->
                    <!-- 表格-->
                    <div class="fprw-pg">
                        <table>
                            <tbody><tr align="center">
                                <th width="232">任务编号</th>
                                <th width="232">订单编号</th>
                                <th width="232">工单类型</th>
                                <th width="232">问题分类</th>
                                <th width="232">违规类型</th>
                                <th width="232">信用积分扣分</th>
                                <th width="232">创建时间</th>
                            </tr>
                            <?php foreach ($list as $v):?>
                            <tr>
                                <td><?=$v['tasksn'];?></td>
                                <td><?=$v['ordersn'];?></td>
                                <td><?php $sceduatype=Schedualtype::model()->findByPk($v['typeid']);
                                    echo $sceduatype->typename;?></td>
                                <td><?php $sceduatype=Schedualtype::model()->findByPk($v['questionid']);
                                    echo $sceduatype->typename;?></td>
                                <td><?php switch ($v['seriousness']){
                                        case 0:echo '轻度';break;
                                        case 1:echo '中度';break;
                                        case 2:echo '严重';break;
                                    }?></td>
                                <td>
                                    <label>-<?=$v['penaltyscore'];?></label>
                                </td>
                                <td>
                                    <?=date('Y-m-d H:i:s',$v['updatetime']);?>
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