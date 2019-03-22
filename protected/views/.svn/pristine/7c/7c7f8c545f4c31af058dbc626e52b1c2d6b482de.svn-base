<!DOCTYPE html>
<html>
<head>
    <title>实例</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?=S_CSS;?>bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=S_CSS;?>udp.css"/>
    <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
    <script src="<?=S_JS;?>jquery.js"></script>
    <script src="<?=S_JS;?>bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <!--第头部标题-->
    <div class="row redal " >
        <div class="col-sm-10 col-xs-10 hidden-xs" >
            <h4 style="color: #fff;" >原因:<?PHP echo $mag['msg']; ?></h4>
        </div>
        <div class="col-sm-10 col-xs-10 visible-xs" >
            <h4 style="color: #fff;font-size: 12px;" >原因:<?PHP echo $mag['msg']; ?></h4>
        </div>
        <div class="col-sm-2 col-xs-2 t_right " >
            <?php if($shebei=='PC'){?>
                <a href="javascript:void(0)" id="imgeColse"
                   onclick="javascript:self.parent.$.closeWin();self.parent.parent.$.closeWin();"> <h4 style="color: #fff;">X</h4>
                </a>
            <?php }?>

            <?php if($shebei=='TX'){?>
                <a href="<?php echo $this->createUrl('/mobile/task/taskmanage');?>" id="imgeColse" > <h4 style="color: #fff;">X</h4>
                </a>

            <?php } ?>
        </div>

    </div>
    <!--第头部标题:end-->
    <!--top 标题栏-->
<!--    <div class="row topk ">-->
<!--        <div class="col-sm-2 col-xs-0 " ></div>-->
<!--        <div class="col-sm-8 col-xs-12 greeR kunr" >-->
<!--            <h4 style="color: #fff;text-align: center;">请您取消任务，谢谢合作！！</h4>-->
<!--        </div>-->
<!--        <div class="col-sm-2  col-xs-0" ></div>-->
<!--    </div>-->
    <!--top 标题栏:end-->
    <!--top提示-->
    <div class="row toa">
        <div class="col-sm-2 col-xs-0"></div>
        <div class="col-sm-8 col-xs-12">
            <div class="col-sm-12 col-xs-12 kun kuny kunr alert-warning">
                <div class="row yan " style="border-radius: 10px 10px 0px 0;"><h4 style="text-align: center;" >温馨提示</h4></div>
                <div class="row">
                    <p style="padding: 3%;">请绑定银行卡，不然本金无法返现！</p>
                </div>
            </div>
        </div>
        <div class="col-sm-2 col-xs-0"></div>
    </div>
    <!--top提示：end-->
</div>
</body>
</html>