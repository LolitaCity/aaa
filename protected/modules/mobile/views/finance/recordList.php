<script src="<?php echo S_JS;?>laydate.js" type="text/javascript"></script>
<!-- 内容-->
<link href="<?php echo S_CSS;?>laydate.css" rel="stylesheet" type="text/css"/>
<div class="sj-zjgl">
    <?php   echo $this->renderPartial('/finance/leftNav');  $userinfo=User::model()->findByPk(Yii::app()->user->getId()); ?>
    <div class="zjgl-right">
        <!-- 搜索-->
        <form action="<?=$this->createUrl('/finance/recordList')?>" id="fm" method="post">
            <div class="fpgl-ss" style="margin-top: 0px;">
                <p class="zjgl-right_3" style="margin-right: 10px;">
                    收支流水明细</p>
            </div>
            <div class="fpgl-ss">
                <p style="line-height: 30px;">
                    消费时间：
                    <input class="laydate-icon" id="BeginDate" maxlength="16" name="BeginDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:122px;height:28px;" type="text" value="<?php if ($searchword['BeginDate'])echo date('Y-m-d h:m',$searchword['BeginDate']);?>">
                    ~
                    <input class="laydate-icon" id="EndDate" maxlength="16" name="EndDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:122px;height:28px;" type="text" value="<?php if ($searchword['EndDate'])echo date('Y-m-d h:m',$searchword['EndDate']);?>"></p>
                <p>
                    类型：<select class="select_160" id="FinanceType" name="FinanceType" style="width:144px;height:30px;"><option value="">请选择</option>
                        <option <?if ($searchword['FinanceType']=='提现'){echo "selected=selected";}?> value="提现">提现</option>
                        <option <?if ($searchword['FinanceType']=='任务佣金'){echo "selected=selected";}?>  value="任务佣金">任务佣金</option>

                    </select>
                </p>
                <p>
                    任务编号：<input class="select_215" id="FinanceKey" name="FinanceKey" style="width:145px;height:28px;" type="text" value="<?=$searchword['FinanceKey']?>">
                </p>
                <p>
                    <input class="input-butto100-ls" type="button"  onclick="Search()"   value="查询" style="width:60px;"></p>
                <p style="margin-right: 0px;">
                    <a href="<?=$this->createUrl('finance/recordlist')?>">
                        <input class="input-butto100-hs" type="button" value="刷新" style="width:60px;"></a>
                </p>
            </div>
            <!-- 搜索-->
            <div class="zjgl-right_2">
                <table>
                    <tbody><tr>
                        <th width="157">
                            消费ID
                        </th>
                        <th width="120">
                            消费类型
                        </th>
                        <th width="100">
                            消费存款
                        </th>
                        <th width="100">
                            剩余存款
                        </th>
                        <th width="157">
                            备注
                        </th>
                        <th>
                            消费时间
                        </th>
                    </tr>
                    <?php foreach ($recodlist as $value):?>
                    <tr>
                        <td><?=$value->usertaskid;?></td>
                        <td><?=$value->type;?></td>
                        <td class="cff3430"><?=$value->increase;?></td>
                        <td><?=$value->remoney;?></td>
                        <td><?=$value->beizhu;?></td>
                        <td><?=date('Y-m-d',$value->addtime);?></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody></table>
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

        </form>        </div>
</div>
<script>
    function Search() {
        var FinanceType = $("#FinanceType").val();
        var FinanceKey = $("#FinanceKey").val();
        var BeginDate = $("#BeginDate").val()?Date.parse(new Date($("#BeginDate").val()))/1000:'';
        var EndDate =$("#EndDate").val()?Date.parse(new Date($("#EndDate").val()))/1000:'';
        window.location.href = '/finance/recordlist/FinanceType/' + FinanceType + "/FinanceKey/" + FinanceKey + "/BeginDate/" + BeginDate + "/EndDate/" + EndDate;
    }
</script>
<!-- 内容-->
