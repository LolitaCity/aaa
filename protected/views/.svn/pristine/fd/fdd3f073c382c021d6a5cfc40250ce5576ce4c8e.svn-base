<!DOCTYPE html>
<html><head>
    <title></title>
    <link href="<?= S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?= S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?= S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?= S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?= S_JS;?>open.win.js"></script>
    <link type="text/css" rel="stylesheet" href="<?= S_CSS;?>laydate.css">
    <script src="<?= S_JS;?>laydate.js" type="text/javascript"></script>
</head>
<body style="background: #fff;">
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            信用积分历史记录
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?= S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>



<script type="text/javascript">
    function Search() {
        $("#fm").submit();
    }
</script>
<style type="text/css">

</style>

<form action="<?php echo $this->createUrl('other/scorelog');?>" enctype="multipart/form-data" id="fm" method="post">
    <div class="sj-fprw" style="width: 97%; position: relative; top: -20px; height: 600px;">
        <div class="fpgl-ss" style="margin: 0px;">
            <p style="line-height: 30px;">
                操作时间：
                <input class="laydate-icon" id="BeginDate" maxlength="16" name="BeginDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:132px;height:35px;" type="text" value="<?=@$strdate['BeginDate'];?>">
                ~
                <input class="laydate-icon" id="EndDate" maxlength="16" name="EndDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:132px;height:35px;" type="text" value="<?=@$strdate['EndDate'];?>"></p>
            <p>
            </p><p>
                <input class="input-butto100-ls" type="button" onclick="Search()" value="查询" style="width: 110px;"></p>
            <p style="margin-right: 0px;">
                <a href="<?php echo $this->createUrl('other/scorelog');?>">
                    <input class="input-butto100-hs" type="button" value="刷新" style="width: 110px;"></a>
            </p>
        </div>
        <div class="menudiv" style="height: 430px; overflow-y: auto;">
            <div id="con_one_1" class="sj-fpgl">
                <div class="fprw-pg">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody><tr style="background-color: #f5f5f5">
                            <td width="14%">
                                积分增减情况
                            </td>
                            <td width="15%">
                                原信用积分总分
                            </td>
                            <td width="15%">
                                现信用积分总分
                            </td>
                            <td width="40%">
                                备注
                            </td>
                            <td width="20%">
                                操作时间
                            </td>
                        </tr>
                        <?php foreach ($loglist as $k=>$v):?>
                        <tr>
                            <td>
                                <label style="color: Red; font-weight: bold;"><?=$v->score_info;?></label>
                            </td>
                            <td>
                                <?=$v->original_score;?>.00
                            </td>
                            <td>
                                <?=$v->score_now;?>.00
                            </td>
                            <td>
                                <div style="word-break: break-all;"><?=$v->description;?></div>
                            </td>
                            <td>
                                <?=date('Y/m/d H:s:i',$v->add_time);?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody></table>
                </div>
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
                'nextPageLabel' => ">>",
                'prevPageLabel' => "<<",
            ));
            ?>
        </div>

    </div>
</form>



</body></html>