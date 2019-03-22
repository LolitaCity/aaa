<html><head>
    <title></title>
    <link href="<?=S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?=S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=S_JS;?>open.win.js"></script>
</head>
<body style="background: #fff;">
<!--列表 -->
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            核对商品价格
        </li>
        <li class="htyg_tc_2"><a href="javascript:void(0)" id="imgeColse" onclick="javascript:self.parent.$.closeWin()">
                <img src="<?=S_IMAGES;?>sj-tc.png"></a> </li>
    </ul>
</div>

<style type="text/css">
    .black_overlay
    {
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index: 1001;
        -moz-opacity: 0.85;
        opacity: .85;
        filter: alpha(opacity=85);
    }
    .ycgl_tc
    {
        display:  block;
        height: auto;
        z-index: 1002;
        position: fixed;
        overflow: auto;
        margin: 0px auto;
        font-size: 14px;
        font-family: "微软雅黑";
        margin-top:20px;
    }
    .w_550_320
    {
        width: 580px;
        min-height: 320px;
        margin-left: -290px;
        margin-top: -135px;
        top: 54%;
        left: 50%;
    }
    .w_550_320 h2
    {
        width: 190px;
        margin: 0px auto;
        color: #fff;
        height: 38px;
        line-height: 38px;
        text-align: center;
        border-radius: 8px;
        position: relative;
        z-index: 55;
    }
    .bg_4882f0
    {
        background: #4882f0;
    }
    .bg_888
    {
        background: #888;
    }
    .hd_nr1
    {
        background: #fff;
        border-radius: 8px;
        border: 0px solid #888;
        width: 428px;
        margin: -40px auto 0px;
        padding: 40px 50px;
    }
    .hd_nr1 b
    {
        color: red;
    }
    .hd_nr1 p
    {
        text-align: center;
        margin: 15px 0px;
        line-height: 25px;
    }
    .hd_nr1 p a
    {
        text-decoration: underline;
    }
    .hg_ul li
    {
        height: 30px;
        line-height: 30px;
    }
    .hg_ul li input
    {
        margin-right: 10px;
        height: 30px;
        line-height: 30px;
    }
    .hg_ul li input, .hg_ul li label
    {
        float: left;
    }
    .hd_nr1 span
    {
        margin-top: 10px;
        display: block;
    }
    .hd_anniu
    {
        text-align: center;
    }
    .hd_anniu span
    {
        display: inline-block;
        height: 42px;
        font-size: 12px;
        text-align: center;
        position: relative;
    }
    .hd_anniu span input
    {
        padding: 6px 10px;
        border: none;
        color: #fff;
        margin: 10px;
        border-radius: 30px;
        cursor: pointer;
    }
    .hd_mbyh
    {
        float: left;
        margin-left: 50px;
        height: 30px;
        line-height: 30px;
        display: none;
        margin-top:-4px;
    }
    .close_x a img
    {
        z-index: 999;
        position: absolute;
        right: 5px;
        top: 5px;
        cursor: pointer;
    }
    .w_80
    {
        width: 80px;
        height: 20px;
        line-height: 20px;
        border: 1px solid #bbb;
        padding-left: 5px;
    }
    .radio_box ul li
    {
        background: url('<?=S_IMAGES;?>radio_01.png') left center no-repeat;
        padding-left: 20px;
        margin: 0 5px;
        height: 25px;
        line-height: 25px;
        width: 100%;
        color: #222;
        cursor: pointer;
    }
    .radio_box ul li.selected
    {
        background: url('<?=S_IMAGES;?>radio_02.png') left center no-repeat;
    }
</style>
<script type="text/javascript">
    $(function () {
        $("#emMsg").text("");
        if ($("#serviceValidation").length > 0) {
            if ($("#serviceValidation").text().trim() == "提交差价反馈成功") {
                $.openAlter("反馈提交成功，请到接手管理页面将该任务退出。多谢配合~", "提示", null, function () {
                    window.parent.parent.location.href = '/Task/BrushFTask/BrushAcceptManage?TaskStatus=1';
                }, "好的");
            }
            else {
                $.openAlter($("#serviceValidation").text(), "提示");
            }
        };


        $("#r2").click(function () {
            $(".hd_mbyh").show();
        });
        $("#r1").click(function () {
            $(".hd_mbyh").hide();
        });
        $("#btnSubPrice").click(function () {
            var price = $("#ProductMoney").val();
            var taskPrice = "<?=$taskinfo['price']?>";
            if (price == "" || price == null) {
                $.openAlter("请输入目标商品价格", "提示");
                return false;
            }
            if (parseFloat(price) <= 0) {
                $.openAlter("输入的目标商品价格必须大于0", "提示");
                return false;
            }
            if (Math.abs(parseFloat(taskPrice - price)) < 50) {
                $.openAlter("<p style=\"text-align:left\"> 输入的目标商品价格与任务担保金额差价小于50元，请重新核对。若目标商品存在多型号，请点击不同型号，看是否存在符合价格区间的商品。</p>", "提示");
                return false;
            }
            $("#fm").submit();
        });
        $("#btnNext").click(function () {
            self.parent.$.closeWin();
            $.openWin(560,840, "<?=$this->createUrl('task/taskthree',array('usertaskid'=>$taskinfo['id']))?>");

        });

        var productPrice = '';
        if (productPrice != "" && productPrice != null) {
            $("#r2").click();
        }
        else {
            if ('True' == "True") {
                $("#r1").click();
            }
        }
    });
    (function ($) {
        $.fn.JQRadio = function (settings) {
            var $div = this;
            var radioVal = $div.find(".radioVal");  //当前的radio选中项的value值
            var items = $div.find("ul > li");
            //每个li的点击事件
            $div.on("click", "ul > li", function () {
                radioVal.val($(this).attr("id"));
                $(this).addClass("selected").siblings("li").removeClass("selected");
                if ($(this).attr("id") == "r1") {
                    $("#emMsg").html("<b>提示：</b>请点击【核对无问题，下一步】按钮进行下一步操作，赚取任务佣金。");
                    $("#btnNext").attr("class", "bg_4882f0").removeAttr("disabled");
                    $("#btnSubPrice").attr("class", "bg_888").attr("disabled", "disabled");
                }
                else {

                    $("#emMsg").html("<b>提示：</b>请根据拍下件数和型号要求，输入相应的目标商品价格并提交反馈。");
                    $("#btnSubPrice").attr("class", "bg_999").removeAttr("disabled");
                    $("#btnNext").attr("class", "bg_888").attr("disabled", "disabled");
                }
            });
            items.each(function () {
                if ($(this).hasClass('selected')) {
                    $(this).trigger('click');
                }
            });
        };
    })(jQuery);
    function clearNoNum(obj) {
        var patt;
        //先把非数字的都替换掉，除了数字和.
        obj.value = obj.value.replace(/[^\d.]/g, "");
        //必须保证第一个为数字而不是.
        obj.value = obj.value.replace(/^\./g, "");
        //保证只有出现一个.而没有多个.
        obj.value = obj.value.replace(/\.{2,}/g, ".");
        //保证.只出现一次，而不能出现两次以上
        obj.value = obj.value.replace(".", "$#$").replace(/\./g, "").replace("$#$", ".");
        //只能输入小数点后两位
        obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/, '$1$2.$3');
    }

</script>
<!--添加弹窗 取消任务 -->
<form action="<?php echo $this->createUrl('task/checkPrice');?>" enctype="multipart/form-data" id="fm" method="post">
    <input id="TaskID" name="TaskID" type="hidden" value="<?=$taskinfo['id']?>">
    <input id="TaskSearchType" name="TaskSearchType" type="hidden" value="淘宝APP自然搜索">
    <input data-val="true" data-val-number="字段 TaskPrice 必须是一个数字。" data-val-required="TaskPrice 字段是必需的。" id="TaskPrice" name="TaskPrice" type="hidden" value="118.00">

    <div id="hd_Id1" class="ycgl_tc w_550_320">
            <span class="close_x"><a href="">
                <img src="<?=S_IMAGES;?>sj-tc.png"></a></span>
        <div class="hd_nr1">
            <p style="text-align: left">
                任务担保金额：<label style="font-weight: bolder;color:Red;"><?=$taskinfo['price'];?></label>元<br>
                <label>
                    拍下件数：<label style="font-weight: bolder;color:Red;">1</label><label style="margin-left: 20px;">型号：</label>
                    <label title="">
                        <label style="font-weight: bolder;color:Red;"><?=$taskinfo['modelname']?$taskinfo['modelname']:'默认';?></label>
                    </label>
                    <br>
                    <label>
                        请核对担保金额与目标商品价格是否一致。若两者<em style="text-decoration: underline">差价≥50元</em>，在最后一步将<em style="text-decoration: underline">无法提交订单</em>。请务必认真核对！</label></label></p>
            <div class="radio_box" id="radio01" style="margin-left: 10%">
                <input type="hidden" value="r1" class="radioVal" name="">
                <ul class="hg_ul">
                    <li id="r1" class="selected">
                        <label>
                            两者价格一致或存在小额差价</label></li>
                    <li id="r2">
                        <label>
                            两者差价≥50元</label><div class="hd_mbyh" style="display: none;">
                            <label>
                                目标商品价格：</label><input class="w_80" data-val="true" data-val-number="字段 ProductMoney 必须是一个数字。" id="ProductMoney" maxlength="10" name="ProductMoney" onkeyup="clearNoNum(this)" type="text" value="">
                            <label>元</label></div>
                    </li>
                </ul>
            </div>
            <span id="emMsg"><b>提示：</b>请点击【核对无问题，下一步】按钮进行下一步操作，赚取任务佣金。</span>
            <h4 class="hd_anniu">
                    <span>
                        <input id="btnNext" type="button" value="核对无问题，下一步" class="bg_4882f0">
                        <input disabled="disabled" id="btnSubPrice" type="button" value="差价过大，提交反馈" class="bg_888">
                    </span>
            </h4>
        </div>
    </div>
    <div id="fade" class="black_overlay">
    </div>
    <!--添加弹窗 核对商品价格 -->
</form>


</body></html>