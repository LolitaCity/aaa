<!--
<script src="<?php echo S_JS;?>laydate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo S_CSS;?>style.css">
//<link rel="stylesheet" type="text/css" href="<?php echo S_CSS;?>fabe.css">
    <link type="text/css" rel="stylesheet" href="<?php echo S_CSS;?>user_center.css">-->
<style>
    .cur_tab{background: #eee;color: #1e9223;}
</style>
    <div class="zjgl-left">
        <h2>
            资金管理</h2>
        <ul>
            <li>
                <a href="<?php echo $this->createUrl('finance/takeoutcash');?>" class="<?php if ($this->getAction()->getId()=='takeoutcash') echo 'cur_tab';?>">平台提现</a>
            </li>
            <li>
                <a href="<?php echo $this->createUrl('finance/selleroutcash');?>" class="<?php if ($this->getAction()->getId()=='selleroutcash') echo 'cur_tab';?>">本金提现</a>
            </li>
            <li>
                <a href="<?php echo $this->createUrl('finance/cardmanage');?>" class="<?php if ($this->getAction()->getId()=='cardmanage') echo 'cur_tab';?>">银行卡管理</a>
            </li>
            <li>
                <a href="<?php echo $this->createUrl('finance/recordlist');?>" class="<?php if ($this->getAction()->getId()=='recordlist') echo 'cur_tab';?>">收支明细</a>
            </li>
            <li>
                <a href="<?php echo $this->createUrl('finance/paylist');?>" class="<?php if ($this->getAction()->getId()=='paylist') echo 'cur_tab';?>">订单信息</a>
            </li>
           <!-- <li>
                <a href="<?php echo $this->createUrl('finance/acceptinfo');?>" class="<?php if ($this->getAction()->getId()=='acceptinfo') echo 'cur_tab';?>">接手情况</a>
            </li>-->
        </ul>
    </div>

    <?php
        $userInfo=User::model()->findByPk(Yii::app()->user->getId());
        if($userInfo->SafePwd==""){ 
    ?>
    <script>
        $(function(){
            //询问框
            $.openAlter('为了您的帐号安全，请先设置你的安全操作码','提示',{ width: 250, height: 250 },function (){
                window.location.href='<?php echo $this->createUrl('user/userSafePwdFirstSet');?>'; },'立即设置');
        })
    </script>
    <?php
        }
        if($userInfo->TrueName=="" && Yii::app()->controller->id=="user" && $this->getAction()->getId()!="userAccountCenter"){
    ?>
    <script>
        $(function(){
            //询问框
            $.openAlter('请完善您的真实姓名，否则很多操作会受到限制', '提示', { width: 250, height: 250 }, function(){
                window.location.href='<?php echo $this->createUrl('user/userAccountCenter');?>'
            }, '立即认证');
        })
    </script>
    <?php }?>