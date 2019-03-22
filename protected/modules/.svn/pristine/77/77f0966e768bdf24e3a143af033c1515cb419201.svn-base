<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>css.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>weui.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>

</head>
<script>
    function Timesa(second) {
        second--;
        if (second <= 0) {
            second = 0;
        }
        if (second == 0) {
            $("#btnNext").css({background:'#bb0a0a'})
            $("#btnNext").attr("onclick", "Submit()");
            $("#btnNext").parent().attr("class", "login_4");
            $("#btnNext").text("下一步");

        }
        else {

            $("#btnNext").css({background:'#878787'})
            $("#btnNext").removeAttr("onclick");
            $("#btnNext").text("信息确认 " + second + " 秒");
            setTimeout("Timesa('" + second + "')", 1000);
        }
    }

    function Timesb(minute, second) {
        second--;
        if (second <= -1 && minute > 0) {
            second = 59;
            minute--;
        }
        if (minute <= 0) {
            minute = 0;
        }
        if (minute <= 0 && second <= 0) {
            minute = 0;
            second = 0;
        }
        if (minute == 0 && second == 0) {
            $("#lblMinute").text("0");
            $("#lblSecond").text("0");
        }
        else {
            $("#lblMinute").text(minute);
            $("#lblSecond").text(second);
            setTimeout("Timesb('" + minute + "','" + second + "')", 1000);
        }
    }

    function Submit() {
        var taskId = $("#TaskID").val();
        $("#fm").submit();
    }


</script>
<body>



<?php $this->renderPartial("/public/footer");?>


</body></html>