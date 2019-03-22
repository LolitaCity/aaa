
<script type="application/javascript" src="<?php echo S_JS;?>laydate.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo S_CSS;?>laydate.css">
<script>function  Search() {
    $('#fm').submit();

    }</script>
<!-- 内容-->
<div class="sj-zjgl">
    <?php   echo $this->renderPartial('/finance/leftNav');  $userinfo=User::model()->findByPk(Yii::app()->user->getId()); ?>
    <div class="zjgl-right">
        <!-- 搜索-->
        <form action="<?=$this->createUrl('finance/paylist')?>" id="fm" method="get">
            <div class="fpgl-ss" style="margin-top: 0px;">
                <p class="zjgl-right_3" style="margin-right: 40px;">
                    订单信息汇总</p>
                <p style="line-height: 35px; margin-left:100px;">
                    支付时间：</p>
                <p>
                    <input class="laydate-icon" id="BeginDate" maxlength="16" name="BeginDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:128px;height:28px;" type="text" value="<?php if ($serchword['BeginDate'])echo date('Y-m-d h:m',$serchword['BeginDate']);?>">~
                </p>
                <p>
                    <input class="laydate-icon" id="EndDate" maxlength="16" name="EndDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:128px;height:28px;" type="text" value="<?php if ($serchword['EndDate'])echo date('Y-m-d h:m',$serchword['EndDate']);?>"></p>
                <p>
                </p>
                <p>
                    <input class="input-butto100-ls" type="button" onclick="Search()" value="查询"></p>
                <p style="margin-right: 0px;">
                    <a href="<?=$this->createUrl('finance/paylist');?>">
                        <input class="input-butto100-hs" type="button" value="刷新"></a>
                </p>
            </div>
            <!-- 搜索-->
            <div class="zjgl-right_2">
                <table>
                    <tbody><tr>
                        <th width="157">任务编号</th>
                        <th width="120">订单编号</th>
                        <th width="250">店铺名</th>
                        <th width="150">买号</th>
                        <th width="100">担保金额
                        <th width="100">付款金额</th>
                        <th width="100">差价</th>
                        <th width="157">支付时间</th>
                    </tr>
                    <tr>
                        <td><div align="center" style="color: Red; font-weight: bolder;">汇总：</div></td>
                        <td></td>
                        <td></td>
                        <td><div align="center" style="color: Red; font-weight: bolder;"></div></td>
                        <td><div align="center" style="color: Red; font-weight: bolder;"><?=$countprice?></div></td>
                        <td><div align="center" style="color: Red; font-weight: bolder;"><?=$countorderprice?></div></td>
                        <td><div align="center" style="color: Red; font-weight: bolder;"><?=$diff?></div></td>
                        <td><div align="center" style="color: Red; font-weight: bolder;"></div></td>
                    </tr>
                    <?php foreach ($paylist as $k=>$v):?>
                    <tr>
                        <td><?=$v['tasksn']?></td>
                        <td><?=$v['ordersn']?></td>
                        <td><?=$v['shopname']?></td>
                        <td><?=$v['wangwang']?></td>
                        <td class="cff3430"><?=$v['price']+$v['express'];?></td>
                        <td class="cff3430"><?=$v['orderprice']?></td>
                        <td class="cff3430"><?=$v['orderprice']-($v['price']+$v['express']);?></td>
                        <td width="220" height="33" align="center" valign="middle"><div align="center"><?=date('Y-m-d H:i:s',$v['updatetime'])?></div>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    </tbody></table>
            </div>
            <div class="yyzx_1">
                <div class="breakpage"><!--分页开始-->
                    <?php
                    $this->widget('CLinkPager', array(
                        'selectedPageCssClass'=>'active',
                        'pages' => $pages,
                        'lastPageLabel' => '最后一页',
                        'firstPageLabel' => '第一页',
                        'header' => false,
                        'nextPageLabel' => ">>",
                        'prevPageLabel' => "<<",
                    ));
                    ?>
                </div>
            </div>
        </form>        </div>
</div>
<!-- 内容-->
