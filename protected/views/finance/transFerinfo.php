<html><head>
    <title></title>
    <link href="<?=S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>open.win.css?v=4.1" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>index.css?t=4.7" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=S_JS;?>open.win.js"></script>
</head>
<body style="background: #fff;">
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            操作按钮使用指南
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?=S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>


<link href="<?=S_CSS;?>Common.css" rel="stylesheet" type="text/css">
<link href="<?=S_CSS;?>style.css" rel="stylesheet" type="text/css">
<style type="text/css">
    .htyg_tc
    {
        height: 50px;
        background: #4882f0;
        display: none;
    }
</style>
<div class="tc_775_630">
    <h2>提现状态说明</h2>
    <ul class="ztshuming">
        <li>
            <span><b>等待转账</b></span>
            <p>系统提交提现申请，等待商家在预计到账时间内对该笔订单完成转账。</p>
        </li>
        <li>
            <span><b>已转账</b></span>
            <p>商家已对该笔订单转账完毕，请核实网银。若查询未到账，可点击【提现未到账】按钮进行反馈。</p>
        </li>
        <li>
            <span><b>转账失败</b></span>
            <p>该笔订单转账失败，请根据转账失败原因点击【重新提现】按钮重新发起提现申请。</p>
        </li>
        <li>
            <span><b>未到账</b></span>
            <p>该状态用于标记买家已提交未到账反馈的订单，卖家会被要求对此类订单上传转账凭证。</p>
        </li>
    </ul>
    <h3><a href="javascript:void(0)" onclick="self.parent.$.closeWin()" class="close_anniu">关闭</a></h3>
</div>




</body></html>