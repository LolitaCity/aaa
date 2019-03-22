<link type="text/css" rel="stylesheet" href="<?php echo S_CSS;?>laydate.css">
<script src="<?php echo S_JS;?>laydate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo S_CSS;?>style.css">
<link type="text/css" rel="stylesheet" href="<?php echo S_CSS;?>user_center.css">

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
    function Applicationtransfer(usertaskid) {
        var isbank="<?php if (!empty($curbank)){echo 1;}else echo 0;?>";
        if(isbank==1){
            var url='/finance/applicationtransfer/usertaskid/'+usertaskid+'.html';
            window.location.href=url;
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
</script>
<style type="text/css">
    #MoneyManage
    {
        background: #a70101;
        color: White;
    }
    .Cash_state a
    {
        margin-left: 9px;
    }
</style>
<!-- 内容-->
<div class="sj-zjgl">
    <?php   echo $this->renderPartial('/finance/leftNav');  ?>
    <form action="<?php echo $this->createUrl('finance/takeoutcash');?>" id="fm" method="post">
        <div class="zjgl-right">
            <div class="menu">
                <ul>
                    <li id="one1" onclick="SetTab(this,'selleroutcash')">提现申请</li>
                    <li id="one2" onclick="SetTab(this,'transferdetailslist')" class="off">提现流水明细</li>
                </ul>
            </div>
            <!-- 搜索-->
            <form action="<?=$this->createUrl('finance/transferdetailslist')?>" id="fm" method="post">
                <div class="Cash_sz" style="margin-top: 20px">
                    <div class="Cash_state">
                        <label>
                            订单编号：</label>
                        <input class="input_140 right_25" id="PlatformOrderNumber" name="PlatformOrderNumber" type="text" value="">

                        <label style="margin-left: 30px">
                            到账时间：</label>
                        <input class="laydate-icon" id="BeginDate" maxlength="16" name="BeginDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:122px;height:28px;" type="text" value="">
                        <label>
                            ~</label>
                        <input class="laydate-icon" id="EndDate" maxlength="16" name="EndDate" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm'})" style="width:122px;height:28px;" type="text" value="">
                        <a href="javascript:void(0)" onclick="Search()" class="b_4882f0 anniu">查询</a>
                        <a href="<?=$this->createUrl('finance/transferdetailslist')?>" class="f90 anniu">刷新</a>
                        <!--<a href="javascript:void(0)" class="f90 anniu" onclick="" id="export" style="background: #52cc89">导出</a>-->
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
                                <th width="160px">
                                    提现银行卡
                                </th>
                                <th width="160px">
                                    转账银行卡
                                </th>
                                <th width="100px">
                                    转账人姓名
                                </th>
                                <th width="120px">
                                    到账时间
                                </th>
                            </tr>
                            <?php foreach ($list as $v):?>
                            <tr>
                                <td><?=$v['ordersn']?></td>
                                <td><em style="color: Red"><?=$v['money']?></em></td>
                                <td><?=$v['bankName'].'&nbsp;&nbsp;&nbsp;&nbsp;尾号&nbsp;'.substr($v['bankAccount'],-4);?></td>
                                <td>
                                    工商银行       尾号 8626
                                </td>
                                <td>
                                    妮**
                                </td>
                                <td><?=date('Y-m-d H:i:s',$v['updatetime']);?></td>
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
            </form>
        </div>

