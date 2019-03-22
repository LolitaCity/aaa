<link rel="stylesheet" type="text/css" href="<?php echo S_CSS;?>xyjf.css"/>

<script type="text/javascript">
    var auditStatus = '审核通过';
    var auyAuditStatus = '审核通过';
    $(document).ready(function () {
        $("#MemberCenter").addClass("#MemberCenter");
        $(".sj-nav li a").removeAttr("style");
        $("#MemberCenter").addClass("a_on");
    })

    function CreateSesameCredit() {
        $.openWin(550, 500, '<?php echo $this->createUrl('other/zhimacredit');?>');
    }
    //提交支付宝手机审核
    function CreateAlipayTelAudit() {
        $.openWin(520, 500, '<?php echo $this->createUrl('other/alipaycheck');?>');
    }

    //提交第二证件照审核
    function CreateSecondCradAudit() {
        $.openWin(580, 500, '<?php echo $this->createUrl('other/secondcard')?>');
    }

    //提交QQ审核
    function CreateQQAudit() {
        $.openWin(450, 500, '<?php echo $this->createUrl('other/qqcheck')?>');
    }
    //提交生活照审核
    function CreateLifeCradAudit() {
        $.openWin(440, 500, '<?php echo $this->createUrl('other/lifephoto');?>');
    }

    //提交紧急联系人
    function CreateUrgent() {
        $.openWin(440, 500, '<?php echo $this->createUrl('other/urgentcheck');?>');
    }

    function GetPointsLog() {
        $.openWin(600, 1000, '<?php echo $this->createUrl('other/scorelog')?>');
    }
</script>


<div class="sj-zjgl">

    <?php
    echo $this->renderPartial('/user/usercenterTopNav');
    $userInfo=User::model()->findByPk(Yii::app()->user->getId());
    ?>
    <div class="zjgl-right">
        <!--信用积分-->
        <div class="zjgl_xyzf">
            <div class="xyjf_1">
                <span>信用积分：<b><?php echo $userInfo->Score;?></b></span>
            </div>
            <div class="xyjf_2">
                <ul>
                    <li class="w_118"><span>淘宝完成任务个数</span><b>3</b></li>
                    <li class="w_90"><span>严重违规次数</span><b>0</b></li>
                    <li class="w_118"><span>普通违规次数</span><b>0</b></li>
                </ul>
                <h3>
                    <a href="javascript:void(0);" onclick="GetPointsLog()" class="f90">查看积分记录</a></h3>
            </div>
            <div class="xyjf_3">
                <h2>
                    信用积分分数 = 接手金额上限</h2>
                <span>如何获得信用积分</span>
                <ul class="xyjf3_ul">
                    <li>
                        <label>
                            新手测试</label>
                        <p>
                            通过得<b>50</b>分</p>
                    </li>
                    <li>
                        <label>
                            完善资料</label><p>
                            每项得<b>30</b>分，共<b>5</b>项</p>
                    </li>
                    <li>
                        <label>
                            完成任务数</label><p>
                            每个任务得<b>10</b>分</p>
                    </li>
                    <li>
                        <label>
                            违规次数</label><p>
                            普通违规扣<b>20</b>分，严重违规扣<b>200</b>分</p>
                    </li>
                </ul>
                <h4>
                    请戳我：<a href="<?php echo $this->createUrl('other/newsinfo',array('id'=>212));?>" target="_blank">违规处罚相关规定</a></h4>
            </div>
        </div>
        <!-- 信用积分 -->
        <!-- 新手测试 -->

        <!-- 新手测试 -->
        <div class="xscs_new blue_bg">
            <div class="xscs_div">
                    <span>新手<br />
                        测试</span>
                <div class="xscs_x1">
                    <?php if ($userInfo->ExamPass==1){?>
                        <p class="p_miaosu">
                            恭喜你成功通过测试，获得<b style="color: Red">50</b>分信用积分！</p>
                        <ul class="xscs_ul">
                            <li class="cur"><span>基础版</span></li>
                            <li class="cur"><span>进阶版</span></li>
                            <li class="cur"><span>终极版</span></li>
                            <li class="cur"><span style="margin-left: -3px">通过测试</span></li>
                        </ul>
                    <?php }else{ ?>
                        <p class="p_miaosu">
                            您尚未通过测试，<a style="color: blue" href="<?php echo $this->createUrl('user/userExam',array('type'=>1))?>" >点我立即前往测试</a>，测试通过将获得<b style="color: Red">50</b>分信用积分！</p>
                    <?php }?>
                </div>
            </div>
        </div>
        <!-- 新手测试 -->
        <!-- 新手测试 -->
        <!-- 加分项 -->
        <div class="fz_ziliao f90_bg">
            <span>加分项</span>
            <div class="xscs_x1">
                <p class="p_miaosu">
                    以下资料为信用积分的加分项，可选择性进行提交。资料审核通过后，每项可得<b style="color: Red">30</b>信用积分。</p>
                <table id="tb_clear">
                    <tr>
                        <th class="fzzl_xx">
                            <span>需补充的资料</span>
                        </th>
                        <th class="zt1">
                            状态
                        </th>
                        <th class="czanniu1">
                            操作按钮
                        </th>
                    </tr>
                    <tr>
                        <td class="fzzl_xx">
                            <span>上传第二证件照</span>
                        </td>
                        <td class="fzzl_zt">
                            <?php if (@$addscore->secondCard['status']){
                                switch ($addscore->secondCard['status']){
                                    case '未审核':
                                        echo '<font color="red">'.$addscore->secondCard['status'].'</font>';break;
                                    case '未通过':
                                        echo '<font color="red">'.$addscore->secondCard['status'].'   原因：'.$addscore->secondCard['msg'].'</font>';break;
                                    default:
                                        echo '<font color="green">已通过</font>';break;
                                }
                            }?>
                        </td>
                        <td class="czanniu1">
                            <?php if (empty($addscore->secondCard['status']) || $addscore->secondCard['status']=='未通过'){?>
                                <a href="javascript:void(0)" onclick="CreateSecondCradAudit()" class="blue">提交资料</a>
                            <?php }elseif ($addscore->secondCard['status']=='已通过'){?>
                                <a href="javascript:void(0)" onclick="CreateSecondCradAudit()" class="blue">查看资料</a>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fzzl_xx">
                            <span>支付宝绑定手机号</span>
                        </td>
                        <td class="fzzl_zt">
                            <?php if (@$addscore->taobaoinfo['status']){
                                switch ($addscore->taobaoinfo['status']){
                                    case '未审核':
                                        echo '<font color="red">'.$addscore->taobaoinfo['status'].'</font>';break;
                                    case '未通过':
                                        echo '<font color="red">'.$addscore->taobaoinfo['status'].'   原因：'.$addscore->taobaoinfo['msg'].'</font>';break;
                                    default:
                                        echo '<font color="green">已通过</font>';break;
                                }
                            }?>
                        </td>
                        <td class="czanniu1">
                            <?php if (empty($addscore->taobaoinfo['status']) || $addscore->taobaoinfo['status']=='未通过'){?>
                                <a href="javascript:void(0)" onclick="CreateAlipayTelAudit()" class="blue">提交资料</a>
                            <?php }elseif ($addscore->taobaoinfo['status']=='已通过'){?>
                                <a href="javascript:void(0)" onclick="CreateAlipayTelAudit()" class="blue">查看资料</a>
                            <?php }?>
                        </td>
                    </tr>

                    <tr>
                        <td class="fzzl_xx">
                            <span>芝麻信用分</span>
                        </td>
                        <td class="fzzl_zt">
                            <?php if (@$addscore->zhimainfo['status']){
                                switch ($addscore->zhimainfo['status']){
                                    case '未审核':
                                        echo '<font color="red">'.$addscore->zhimainfo['status'].'</font>';break;
                                    case '未通过':
                                        echo '<font color="red">'.$addscore->zhimainfo['status'].'   原因：'.$addscore->zhimainfo['msg'].'</font>';break;
                                    default:
                                        echo '<font color="green">已通过</font>';break;
                                }
                            }?>
                        </td>
                        <td class="czanniu1">
                            <?php if (empty($addscore->zhimainfo['status']) || $addscore->zhimainfo['status']=='未通过'){?>
                                <a href="javascript:void(0)" onclick="CreateSesameCredit()" class="blue">提交资料</a>
                            <?php }elseif ($addscore->zhimainfo['status']=='已通过'){?>
                                <a href="javascript:void(0)" onclick="CreateSesameCredit()" class="blue">查看资料</a>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fzzl_xx">
                            <span>上传生活照</span>
                        </td>
                        <td class="fzzl_zt">
                            <?php if (@$addscore->lifephoto['status']){
                                switch ($addscore->lifephoto['status']){
                                    case '未审核':
                                        echo '<font color="red">'.$addscore->lifephoto['status'].'</font>';break;
                                    case '未通过':
                                        echo '<font color="red">'.$addscore->lifephoto['status'].'   原因：'.$addscore->lifephoto['msg'].'</font>';break;
                                    default:
                                        echo '<font color="green">已通过</font>';break;
                                }
                            }?>
                        </td>
                        <td class="czanniu1">
                            <?php if (empty($addscore->lifephoto['status']) || $addscore->lifephoto['status']=='未通过'){?>
                                <a href="javascript:void(0)" onclick="CreateLifeCradAudit()" class="blue">提交资料</a>
                            <?php }elseif ($addscore->lifephoto['status']=='已通过'){?>
                                <a href="javascript:void(0)" onclick="CreateLifeCradAudit()" class="blue">查看资料</a>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fzzl_xx">
                            <span>提供QQ资料</span>
                        </td>
                        <td class="fzzl_zt">
                            <?php if (@$addscore->qqinfo['status']){
                                switch ($addscore->qqinfo['status']){
                                    case '未审核':
                                        echo '<font color="red">'.$addscore->qqinfo['status'].'</font>';break;
                                    case '未通过':
                                        echo '<font color="red">'.$addscore->qqinfo['status'].'   原因：'.$addscore->qqinfo['msg'].'</font>';break;
                                    default:
                                        echo '<font color="green">已通过</font>';break;
                                }
                            }?>
                        </td>
                        <td class="czanniu1">
                            <?php if (empty($addscore->qqinfo['status']) || $addscore->qqinfo['status']=='未通过'){?>
                                <a href="javascript:void(0)" onclick="CreateQQAudit()" class="blue">提交资料</a>
                            <?php }elseif ($addscore->qqinfo['status']=='已通过'){?>
                                <a href="javascript:void(0)" onclick="CreateQQAudit()" class="blue">查看资料</a>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fzzl_xx">
                            <span>提供紧急联系人信息</span>
                        </td>
                        <td class="fzzl_zt">
                            <?php if (@$addscore->urgentinfo['status']){
                                switch ($addscore->urgentinfo['status']){
                                    case '未审核':
                                        echo '<font color="red">'.$addscore->urgentinfo['status'].'</font>';break;
                                    case '未通过':
                                        echo '<font color="red">'.$addscore->urgentinfo['status'].'   原因：'.$addscore->urgentinfo['msg'].'</font>';break;
                                    default:
                                        echo '<font color="green">已通过</font>';break;
                                }
                            }?>
                        </td>
                        <td class="czanniu1">
                            <?php if (empty($addscore->urgentinfo['status']) || $addscore->urgentinfo['status']=='未通过'){?>
                                <a href="javascript:void(0)" onclick="CreateUrgent()" class="blue">提交资料</a>
                            <?php }elseif ($addscore->urgentinfo['status']=='已通过'){?>
                                <a href="javascript:void(0)" onclick="CreateUrgent()" class="blue">查看资料</a>
                            <?php }?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- 加分项 -->
    </div>
</div>


