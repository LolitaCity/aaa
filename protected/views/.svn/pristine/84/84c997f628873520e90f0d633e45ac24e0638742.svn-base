<!DOCTYPE html>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link href="<?php echo S_CSS;?>common.css" rel="stylesheet" type="text/css">
    <link href="<?php echo S_CSS;?>open.win.css" rel="stylesheet" type="text/css">
    <link href="<?php echo S_CSS;?>index.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo S_JS;?>jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>open.win.js"></script>
</head>
<body>
<div class="htyg_tc">
    <ul>
        <li class="htyg_tc_1">
            <?php echo $barname;?>
        </li>
    </ul>
</div>
<script language="javascript">
    $(function () {
        $("#ok").attr("disabled", "disabled");
        $("#ok").attr("class", "input-butto100-shs");
        $("#ok").click(function () {
            $.post('<?php echo $this->createUrl('other/indexOk')?>', {}, function (result) {
                    self.parent.$.closeWin();
            });

        })
    });
    function run() {
        var s = document.getElementById("dd");
        if (s.innerHTML == 0) {
            $("#ok").removeAttr("disabled");
            $("#ok").attr("class", "input-butto100-ls");
            $("#ok").val("我知道了");
            return;
        }
        s.innerHTML = s.innerHTML * 1 - 1;
        var value = s.innerHTML;
        $("#ok").val("我知道了(" + value + ")");

    }
    window.setInterval("run();", 1000);
    function iFrameHeight() {
        var ifm = document.getElementById("iframepage");
        var subWeb = document.frames ? document.frames["iframepage"].document :ifm.contentDocument;
        if (ifm != null && subWeb != null) {
            ifm.height = subWeb.body.scrollHeight;
            $("#showContent").height(subWeb.body.scrollHeight);
        }
    }
</script>
<div style="height: 90%">
    <div class="yctc_458 ycgl_tc_1" style="overflow: auto; height: 430px; width: 730px;padding: 10px 30px;">
        <div id="showContent" >
            <iframe src="<?php echo $url;?>" style="width:100%; " frameborder="0" scrolling="no" id="iframepage" name="iframepage" onload="iFrameHeight()" >
            </iframe>
        </div>
    </div>
    <div class="fprw-xzgl_2">
        <input class="input-butto100-ls" type="button" id="ok" value=""><label id="dd" style="display: none">10</label>
    </div>
</div>
</body></html>