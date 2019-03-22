<html><head>
    <title></title>
    <link href="<?php echo S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?php echo S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?php echo S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>open.win.js"></script>
</head>
<body >
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            查看买号信息
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?php echo S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>

<script type="text/javascript">

</script>
<style type="text/css">
    .sk-zjgl_4
    {
        width: 120px;
    }
    img
    {
        position: relative;
        margin-top: 9px;
    }
</style>
<style type="text/css">
    .wenhao_dis.alt1
    {
        background: url(<?php echo S_IMAGES;?>question.png) no-repeat left center;
        padding-left: 18px;
        height: 16px;
        width: 16px;
        top: 10px;
        position: absolute;
        display: block;
        left: -6px;
        color:#222
    }
    .wenhao_dis.alt1:hover
    {
        z-index: 2;
        display: block;
        color:  #4882f0;
    }
    .alt1:hover
    {
        z-index: 2;
        display: block;
    }
    .wenhao_dis .alt1 div
    {
        color: #222;
        display: none;
    }
    .wenhao_dis .alt1:hover > div
    {
        background: #fff;
        text-align: left;
        border-radius: 2px;
        padding: 10px;
        box-shadow: 0 5px 5px rgba(0, 0, 0, .10);
        position: absolute;
        display: block;
        width: 200px;
        top: 20px;
        border-radius: 5px;
        left: 0px;
        border: solid 1px #ccc;
        z-index: 1;
    }
    .wenhao_dis .alt1
    {
        display: block;
        float: left;
        width: 130px;
    }
    #divMain ul li{
        margin:6px
    }
    .yirun{float:left; position: relative;
        background: url(<?php echo S_IMAGES;?>question.png) no-repeat left 10px;
        padding-left:20px;
    }
    .yincang{display:none; position:absolute;
        width:200px;z-index: 2000;
        text-align:left;
        line-height:20px;
        top:30px;
        border:1px solid #ccc;
        padding:5px 5px; color:#222;
        border-radius:4px;
        box-shadow: 0 5px 5px rgba(0, 0, 0, .10);
        background:#fff; }
    .yctc_458 a:hover .yincang{ display:block;}
    #aday:hover .yincang{ display:block;}
</style>
<!--列表 -->
<div class="yctc_458 ycgl_tc_1">
    <ul>
        <li>
            <p class="sk-zjgl_4">
                淘宝会员名：
            </p>
            <p style="line-height: 35px;"><?php echo $list['wangwang'];?></p>
        </li>
        <li>
            <p class="sk-zjgl_4">
                &nbsp;性别：</p>
            <p style="line-height: 35px;"><?php echo $list['sex']==0?'男':'女';?></p>
        </li>
        <li>
            <p class="sk-zjgl_4">
                注册时间：</p>
            <p style="line-height: 35px;"><?php echo date('Y-m-d',$list['addtime']);?></p>
        </li>
        <li>
            <p class="sk-zjgl_4">
                淘宝等级：</p>
            <p style="line-height: 35px;">
                <img src="<?php echo S_IMAGES.$list['level'];?>.gif" title="买号的信誉值为 <?php echo $list['account_info_xy_val'];?>">
            </p>
        </li>
        <li>
            <p class="sk-zjgl_4">
                淘气值：</p>
            <p style="line-height: 35px;">
               <?php echo $list['account_info_tqz_val'];?>
            </p>
        </li>
        <li style="overflow: visible; height: 35px">
            <p class="sk-zjgl_4" style="margin-left: 16px; width: 105px">
                <a href="javascript:void(0)" class="yirun"><span class="yincang">您当天已接手的淘宝任务总数。每日接单不得超过<?php echo $buyerSet['day'];?>单。</span>
                    日接手数量：</a></p>
            <p style="line-height: 35px;"><?=$daycount?></p>
        </li>
        <li style="overflow: visible; height: 35px">
            <p class="sk-zjgl_4" style="margin-left: 16px; width: 105px">
                <a href="javascript:void(0)" class="yirun"><span class="yincang">您本周已接手的淘宝任务总数。本周指的是自然周（7天），
                            <em style="color: Red">从每周<label>1</label>开始计算</em> 。每周接单不得超过<?php echo $buyerSet['week'];?>单。</span>周接手数量：</a>
            </p>
            <p style="line-height: 35px;"><?=$weekcount?></p>
        </li>
        <li style="overflow: visible; height: 35px">
            <p class="sk-zjgl_4" style="margin-left: 16px; width: 105px">
                <a href="javascript:void(0)" class="yirun"><span class="yincang">您本月已接手的淘宝任务总数。本月指的是自然月，<em style="color: Red">从月结日开始计算</em>。每月接单不得超过<?php echo $buyerSet['month'];?>单。</span> 月接手数量：</a>
            </p>
            <p style="line-height: 35px;"><?=$monthcount?></p>
        </li>
        <li>
            <p class="sk-zjgl_4">
                总接手数量：</p>
            <p style="line-height: 35px;"><?php echo $buyerSet['day'];?></p>
        </li>
        <!--<li style="margin-left: 35px; margin-right: 1px; width: 395px;">
           <?php echo $article->goods_desc;?>
        </li>-->
        <li class="fpgl-tc-qxjs_4" style="position: fixed; bottom: 10px; right: 200px;">
            <p>
                <input onclick="self.parent.$.closeWin()" class="input-butto100-ls" type="button" value="关闭"></p>
        </li>
    </ul>
</div>



</body></html>