<link type="text/css" rel="stylesheet" href="<?php echo S_CSS;?>laydate.css">
<script src="<?php echo S_JS;?>laydate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo S_CSS;?>style.css">
<link type="text/css" rel="stylesheet" href="<?php echo S_CSS;?>user_center.css">
<style>
    .mt10{margin-top: 5px;}
</style>
<script type="text/javascript">
    $(function () {
        jQuery.closeConfirm = function () {
            $("#ow_confirm002").remove(); //2.删除主内容层
            $("#ow_confirm001").remove(); //1.删除透明层
        }
    });

    $(document).ready(function () {
        $("#MoneyManage").addClass("#MoneyManage");
        $("#MoneyMange").addClass("a_on");
        $("#TransferList").addClass("a_on1");
        $("#fp").click(function () {
            $("#sj").slideToggle("slow");
        });
    });
    $(document).ready(function () {
        $("#cs").click(function () {
            $("#zd").slideToggle("slow");
        });
    });
    function Search() {
        $("#fm").submit();
    }
    function SetTab(obj, url) {
        $(".menu>ul>li").removeClass("off");
        $(obj).attr("class", "off");
        window.location.href = url;
    }

    function openConfirm(message, title, obj, fun1, buttonText1, fun2, buttonText2) {
        if ($("#ow_confirm002").length > 0) {
            return false;
        }
        if (obj == null) {
            obj = { width: 250, height: 50 };
        }
        if (buttonText1 == null || buttonText1 == "" || buttonText2 == null || buttonText2 == "") {
            return false;
        }
        //1.创建透明层
        //2.创建主内容层
        var height = obj.height < 210 ? 210 : obj.height;
        var width = obj.width < 350 ? 350 : obj.width;
        var scrollH = $(document).scrollTop();
        var scrollL = $(document).scrollLeft();
        var topVal = ($(window).height() - height) / 2 + scrollH;
        var leftVal = ($(window).width() - width) / 2 + scrollL;
        var aleft = width / 2 - 80/*关闭按钮宽度的一半-20px padding*/;
        if (topVal < 0) {
            topVal = 10;
        }
        var el = "<div class='sjzc_t' id='ow_confirm002'><div class='sjzc_1_t' style='color:Red; text-align:center;'>{title}</div><div class='sjzc_2_t'><div class='sjzc_5_t' style='margin-top: 10px; '><div style='overflow:auto'>{message}</div><div class='sjzc_5_t' style='margin-top: 20px;'><ul><li class='sjzc_7_t'><a href='javascript:void(0)' style='display:inline-block;background-color:#e58a01;' id='ow_confirm002_fun'></a><a href='javascript:void(0)' style='margin-left:10px; display:inline-block' class='ad' id='ow_confirm002_fun2'></a></li></ul></div></div></div></div>";
        el = el.replace(/{title}/, title);
        el = el.replace(/{message}/, message);
        //el = el.replace(/{aleft}/, aleft);
        //1.创建透明层
        $("<div id='ow_confirm001' class='ow_black_overlay' style='z-index: 1003'></div>")
            .height($(document).height())
            .width($(document).width())
            .appendTo($("body"));
        //2.创建主内容层
        $(el)
        //.height(height)
            .width(width)
            .css("left", leftVal)
            .css("top", topVal)
            .appendTo($("body"));

        $("#ow_confirm002_fun")
            .text(buttonText1)
            .click(function () {
                $.closeConfirm();
                if (typeof fun1 == 'function') {
                    fun1(); //回调函数
                }
            });

        $("#ow_confirm002_fun2")
            .text(buttonText2)
            .click(function () {
                $.closeConfirm();
                if (typeof fun2 == 'function') {
                    fun2(); //回调函数
                }
            });


    }


    //修改默认银行卡
    function EditBankCard() {
        $.openWin(350, 450, '<?php echo $this->createUrl('finance/editbankcard')?>');
    }

    //操作指南
    function BtnOperation(){
        $.openWin(680, 810, '<?=$this->createUrl('finance/btnintro');?>');
    }
    //提现状态说明
    function BtnTransfer(){
        $.openWin(680,810,'<?=$this->createUrl('finance/transferinfo')?>');
    }
    function Applicationtransfer(usertaskid, $this) {
        var isbank="<?php if (!empty($curbank)){echo 1;}else echo 0;?>";
        if(isbank==1){
        	$this = $($this);
        	$this.html('处理中...');
			$this.attr('disabled', true).css('pointer-events', 'none');
        	var url='/finance/applicationtransfer/usertaskid/'+usertaskid;
        	$.get(url, function(datas){
        		if (datas.status)
        		{
        			$.openAlter(datas.message, "提示");
        			location.href = '/finance/selleroutcash';
        		}
        		else
        		{
        			$this.html('申请提现');
        			$this.attr('disabled', false).css('pointer-events', 'auto');
        			$.openAlter(datas.message, "错误");
        		}
        	}, 'JSON'); 
        }else {
            $.openAlter('请设置默认银行卡后再操作！','提示',{width:250,height:250});
        }

    }
    function SubmitFeedback(id)
    {
        $.post('<?=$this->createUrl('finance/untransfer')?>',{id:id},function(result){

            if(result.err_code=="0")
            {
                window.location.reload();
            }
            else{
                $.openAlter(result.msg,"提示");
            }
        },'json');
    }

    function remindTranster1(id) {
        openConfirm("<div style=\"text-align:left\">请先登录网银进行确认，确认未到账后再提交反馈。反馈提交后，卖家会在24小时内上传转账凭证。若凭证无误，但仍未收到款项，平台客服会介入处理。请不要私自退款，多谢配合~</div>","提示",{ width: 250,height: 50 }, function () {SubmitFeedback(id)}, "确认提交",function () {  $.self.parent.$.closeAlert() }, "返回");
    }
    function submitarriced(id) {
        $.post('<?=$this->createUrl('finance/alreadyarrived')?>',{id:id},function(result){//alert(result);return false
            if(result.err_code=="0")
            {
                window.location.reload();
            }
            else{
                $.openAlter(result.msg,"提示");
            }
        },'json');
    }
    function readtransferimg(o) {
       var img=$(o).attr('alt');
       if(img){
           window.open(img);
       }else {
           $.openAlter('商家未上传截图，如果点击提现未到账，一天后还未到账且商家不上传截图，就请申请客服介入','提示');
       }
    }
    function arrived(id) {
        openConfirm("<div style=\"text-align:left\">确认已到账？</div>","提示",{ width: 250,height: 50 }, function () {submitarriced(id)}, "确认到账",function () {  $.self.parent.$.closeAlert() }, "返回");

    }
    function kefu(id) {
        $.openWin(420,500,'/finance/telkefu/id/'+id+'.html');
    }
</script>
<!-- 内容-->
<div class="sj-zjgl">
    <?php   echo $this->renderPartial('/finance/leftNav');  $userinfo=User::model()->findByPk(Yii::app()->user->getId()); ?>
    <div class="zjgl-right">
        <div class="menu">
            <ul>
                <li id="one1" onclick="this.disable=true;this.value='数据正在提交';SetTab(this,'selleroutcash')" class="off">提现申请</li>
                <li id="one2" onclick="this.disable=true;this.value='数据正在提交';SetTab(this,'transferdetailslist')">提现流水明细</li>
            </ul>
        </div>
        <!-- 搜索-->
        <form action="<?=$this->createUrl('finance/selleroutcash');?>" id="fm" method="post">                <div class="Cash_bz">
                <div class="Cashfl">
                    <h3 class="t_red">
                        重要温馨提示：</h3>
                    <!--<p></p>-->
                    <ul>
                        <li style="background-color:yellow">1.货款提现：完成任务后请第一时间点击（提现本金）按钮，否则卖家收不到买家银行信息无法返款，点击（提现本金）货款会由卖家在第二天14:00前返款给买家
</li>
                        <li style="background-color:yellow">2.佣金提现：为确保任务更规范，需要做两步操作才能获取佣金，任务提交后，卖家审核任务合格通过，买家点击（获取佣金），卖家确认支付佣金，佣金才会到达买家账户，请严格按照任务要求完成，觉得任务麻烦，可以放弃任务！</li>
                        <li style="background-color:yellow">3.货款超时反馈：如在第二天14:00后仍然没有收到货款，请在下面表格对应订单处反馈
</li>
                    </ul>
                    <p>
                        <b class="t_red">备注：</b>请登录网银确认货款未到账后再向平台反馈。</p>
                </div>
                <div class="Cashfr">
                    <ul class="Cashul">
                        <li class="bg_f9"><a href="javascript:void(0)" onclick="BtnOperation()">操作按钮使用指南</a></li>
                        <li class="bg_f9"><a href="javascript:void(0)" onclick="BtnTransfer()">提现状态说明</a></li>
                        <li class="bg_bl"><a href="<?=$this->createUrl('other/newsinfo',array('id'=>203))?>" target="_blank">卖家转账常见问题</a></li>
                    </ul>
                </div>
            </div>
            <!--内容区域-->
            <div class="Cash_sz">
                <div class="p_float">
                    <?php if(@$curbank){
                        $text=$curbank->bankName.'&nbsp;&nbsp;&nbsp;&nbsp;尾号&nbsp;'.substr($curbank->bankAccount,-4);
                        $btntext='修改';
                    }else{
                        $text='未设置'; $btntext='添加';
                    }?>
                    <span>默认提现银行卡：</span> <b class="t_red" id="bankbtn"><?php echo $text;?></b>
                    <a href="javascript:void(0)" class="b_4882f0 anniu" onclick="EditBankCard()"><?php echo $btntext;?></a>
                </div>
                <div class="Cash_state">
                    <label>
                        订单编号：</label>
                    <input class="input_417" id="PlatformOrderNumber" name="PlatformOrderNumber" style="width:130px;height:30px;" type="text" value="<?=@$search['PlatformOrderNumber']?>" />
                    <label style="margin-left: 20px">
                        提现状态：</label>
                    <select Class="select_160" id="TransferStatus" name="TransferStatus" style="width:80px;height:30px;">
                        <option value="0"> 请选择</option>
                        <option <?php if ($search['TransferStatus']==1){echo 'selected';}?> value="1">未转账</option>
                        <option <?php if ($search['TransferStatus']==2){echo 'selected';}?> value="2">等待转账</option>
                        <option <?php if ($search['TransferStatus']==3){echo 'selected';}?> value="3">已转账</option>
                        <option <?php if ($search['TransferStatus']==4){echo 'selected';}?> value="4">转账失败</option>
                        <option <?php if ($search['TransferStatus']==5){echo 'selected';}?> value="5">未到账</option>
                    </select>
                    <label style="margin-left: 20px">
                        申请时间：</label>
                    <input class="laydate-icon" id="BeginDate" maxlength="16" name="BeginDate" onclick="laydate({istime: true, format: &#39;YYYY-MM-DD hh:mm&#39;})" style="width:102px;height:28px;" type="text" value="<?=@$search['BeginDate']?>" />
                    <label>
                        ~</label>
                    <input class="laydate-icon" id="EndDate" maxlength="16" name="EndDate" onclick="laydate({istime: true, format: &#39;YYYY-MM-DD hh:mm&#39;})" style="width:102px;height:28px;" type="text" value="<?=@$search['EndDate']?>" />
                    <a href="javascript:void(0)" onclick="Search()" class="b_4882f0 anniu">查询</a>
                    <a href="<?=$this->createUrl('finance/selleroutcash');?>" class="f90 anniu">
                        刷新</a>
                </div>
                <div class="Cash_table">
                    <table>
                        <tbody>
                        <tr>
                            <th width="130px">
                                订单编号
                            </th>
                            <th width="60px">
                                提现金额
                            </th>
                            <th width="130px">
                                银行卡
                            </th>
                            <th width="90px">
                                提现状态
                            </th>
                            <th width="130px">
                                申请时间
                            </th>
                            <th width="180px">
                                到账时间
                            </th>
                            <th width="80px">
                                操作按钮
                            </th>
                        </tr>
                        <?php foreach ($list as $v):?>
                        <tr>
                            <td ><?=$v['osn']?></td>
                            <td><em style="color: Red"><?=$v['orderprice']?></em>
                            </td>
                            <td ><?php if(@$v['bankAccount']){
                                echo $v['bankName'].'&nbsp;&nbsp;&nbsp;&nbsp;尾号&nbsp;'.substr($v['bankAccount'],-4);}?>
                            </td>
                            <td>
                                <em><?php
                                    if ($v['arrivestatus']==0) {
                                        switch ($v['transferstatus']) {
                                            case 0:
                                                echo '未转账';
                                                break;
                                            case 1:
                                                echo '等待转账';
                                                break;
                                            case 2:
                                                echo '已转账';
                                                break;
                                            case 3:
                                                echo '转账失败';
                                                break;
                                            case 4:
                                                echo '未到账';
                                                break;
                                        }
                                    }else{
                                        echo '已到账';
                                    }
                                    ?></em>
                            </td>
                            <td >
                                <?php if ($v['addtime'])echo date('Y-m-d H:i:s',$v['addtime']);?>

                            </td>
                            <td>
                                <?php if ($v['updatetime'])echo date('Y-m-d H:i:s',$v['updatetime']);?>
                            </td>
                            <td>
                                <?php if ($v['can_manual']){?>
                                    <a href="javascript:void(0)" onclick="Applicationtransfer('<?=$v['utaskid']?>', this)" class="f90 anniu">申请提现</a>
                                <?php }elseif ($v['transferstatus']==2 && $v['arrivestatus']==0){?>
                                    <a href="javascript:void(0)" onclick="remindTranster1('<?=$v['id']?>')" class="b_4882f0 anniu">提现未到账</a>
                                    <a href="javascript:void(0)"  onclick="arrived(<?=$v['id']?>)" class="f90  mt10 anniu">已到账</a>
                                <?php }elseif ($v['transferstatus']==4 && $v['arrivestatus']==0){?>
                                    <a href="javascript:void(0)" alt="<?=$v['transferimg']?>" onclick="readtransferimg(this)" class="f90  mt10 anniu">查看凭证</a>
                                    <a href="javascript:void(0)"  onclick="arrived(<?=$v['id']?>)" class="f90  mt10 anniu">原来已到账</a>
                                    <a href="javascript:void(0)" onclick="kefu('<?=$v['id']?>')" class="b_4882f0 mt10 anniu">客服介入</a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="yyzx_1">
                <div class="breakpage"><!--分页开始-->
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
        </form>        </div>
</div>

