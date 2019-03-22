
    <?php
        $userInfo=User::model()->findByPk(Yii::app()->user->getId());
        $txActionArr=array('userTxList','userCashToBank');
        $mxActionArr=array('userPayDetail','userPayDetailMinLi','userPayDetailTask','userPayDetailTX','userLoginDetail');
    ?>

    <link type="text/css" rel="stylesheet" href="<?php echo S_CSS;?>user_center.css">
<style>
    .cur_tab{background: #eee;color: #1e9223;}
</style>
    <div class="d_hy">
        <div class="zjgl-left">
            <h2>
                会员中心</h2>
            <ul>
                <li>
                    <a href="<?php echo $this->createUrl('user/index');?>" class="<?php if ($this->getAction()->getId()=='index') echo 'cur_tab';?>"  >基本资料</a>
                </li>
                <li>
                    <a class="<?php if ($this->getAction()->getId()=='buyerlist') echo 'cur_tab';?>" href="<?php echo $this->createUrl('other/buyerlist');?>">买号管理</a>
                </li>
                <li id="ContentIndex">
                    <a class="<?php if ($this->getAction()->getId()=='contentindex'||$this->getAction()->getId()=='newsinfo') echo 'cur_tab';?>" href="<?php echo $this->createUrl('other/contentindex');?>" >平台公告</a>
                </li>
                <li id="ContentIndex">
                    <a class="<?php if ($this->getAction()->getId()=='auxiliaryinfo') echo 'cur_tab';?>" href="<?php echo $this->createUrl('other/auxiliaryinfo');?>" >信用积分</a>
                </li>
                <?php if ($userInfo->ispromoter==1){?>
                    <li id="ContentIndex">
                    <a class="<?php if ($this->getAction()->getId()=='invitefriends') echo 'cur_tab';?>" href="<?php echo $this->createUrl('user/invitefriends');?>" >邀请好友</a>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>

    <?php

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