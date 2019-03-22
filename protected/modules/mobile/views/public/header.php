
	<script>
	        //点击浮动层
        $(function () {
            $(".app_q1 span.right").on("click", function () {
                var val = $(this).attr('class');
                if (val.indexOf('on') == -1) {
                    $(this).addClass('on');
                    $(this).html("关闭窗口");
                    $(".menu_question").show(0).stop().animate({
                        height: '100%'
                    }, 0);
                } else {
                    var tree_one = $(".tree_box").find(".tree_one");
                    tree_one.slideUp();
                    $(this).removeClass('on');
                    $(this).html("常见问题");
                    $(".menu_question").hide(0).stop().animate({
                        height: '0'
                    }, 0);
                }
            });

            $(".menu_question a").on("click", function () {
                $(this).parents(".menu_question").hide();
                $(".app_q1 span.right").removeClass('on');
            });
        });
	        $(function () {

            ShowColor();
            var h3 = $(".tree_box").find("h3");
            var tree_one = $(".tree_box").find(".tree_one");
            var h4 = $(".tree_one").find("h4");
            var tree_two = $(".tree_one").find(".tree_two");

            h3.each(function (i) {
                $(this).click(function () {
                    tree_one.slideUp();
                    tree_one.children().find(".tree_two").slideUp();
                    $(this).next(".tree_one").toggle();
                    // tree_one.eq(i).slideToggle();
                    // tree_one.eq(i).parent().siblings().find(".tree_one").slideUp();
                });
            });
            h4.each(function (i) {
                $(this).click(function () {
                    tree_two.eq(i).slideToggle();
                    tree_two.eq(i).parent().siblings().find(".tree_two").slideUp();
                });
            });

        });	
	function ShowColor() {
            var href = window.location.href;
            if (href.indexOf('Member/Member') > -1) {
                $("#first").css('background-color', '#ce0a0a');
                $("#second").css('background-color', '#ce0a0a');
                $("#third").css('background-color', '#1e9223');
                $("#fourth").css('background-color', '#ce0a0a');
            }
            else if (href.indexOf('finance/takeoutcash') > -1 || href.indexOf('finance/cardmanage') > -1 || href.indexOf('finance/addbank') > -1 ) {
                if($("#third").text().trim()=="邀请好友")
                {
                    $("#first").css('background-color', '#1e9223');
                    $("#second").css('background-color', '#ce0a0a');
                    $("#third").css('background-color', '#ce0a0a');
                    $("#fourth").css('background-color', '#ce0a0a');
                }
                else{
                    $("#first").css('background-color', '#ce0a0a');
                    $("#second").css('background-color', '#ce0a0a');
                    $("#third").css('background-color', '#1e9223');
                    $("#fourth").css('background-color', '#ce0a0a');
                }
            }
            else if (href.indexOf('task/task') > -1) {
                $("#first").css('background-color', '#ce0a0a');
                $("#second").css('background-color', '#1e9223');
                $("#third").css('background-color', '#ce0a0a');
                $("#fourth").css('background-color', '#ce0a0a');

            }
            else if (href.indexOf('finance/selleroutcash') > -1 || href.indexOf('finance/transferlist') > -1)
            {
                if($("#fourth").text().trim()=="本金提现")
                {

                    $("#first").css('background-color', '#ce0a0a');
                    $("#second").css('background-color', '#ce0a0a');
                    $("#third").css('background-color', '#ce0a0a');
                    $("#fourth").css('background-color', '#1e9223');
                }
                else{
                    $("#first").css('background-color', '#1e9223');
                    $("#second").css('background-color', '#ce0a0a');
                    $("#third").css('background-color', '#ce0a0a');
                    $("#fourth").css('background-color', '#ce0a0a');
                }
            }
            else {
                $("#first").css('background-color', '#1e9223');
                $("#second").css('background-color', '#ce0a0a');
                $("#third").css('background-color', '#ce0a0a');
                $("#fourth").css('background-color', '#ce0a0a');
            }
        }
		$(function () {
			$("#aBindTB").click(function () {
				$.openAlter('亲，请使用电脑登录本平台进行绑定买号操作哦', '提示', { width: 250, height: 50 }, null, "我知道了");
			});

			$("#aTransfer").click(function () {
				var msg = "";
				var falseCount = '0';
				var imageCoun ='0';
				var filishCount ='0';
				var IndexFlag=3;
				if (falseCount > 0)
				{
					IndexFlag=3;
				}
				else if (imageCoun > 0||filishCount > 0)
				{
					IndexFlag=4;
				}
				if (falseCount > 0)
					msg += "<p>亲，您存在‘提现失败’的提现申请，请在表格中点击提现状态为‘提现失败’的数据查看原因，并重新申请提现。</p></br>";
				if (imageCoun > 0)
					msg += "<p>亲，商家已对您提交的未到账反馈上传了转账凭证，请在表格中点击提现状态为‘未到账’的数据查看凭证。</p></br>";
				if (filishCount > 0)
					msg += "<p>亲，管理员已对您申请的客服介入进行处理，请在表格中点击提现状态为‘未到账’的数据查看处理结果。</p>";
				if (msg != "") {
					$.openAlter("<div style=\"text-align:left\">" + msg + "</div>", "提示", { width: 250,height: 350 }, function () { parent.location.href="/Member/Transfer/TransferRecordList?Type="+IndexFlag}, "好的");
				}
				else{
					parent.location.href="/Member/Transfer/TransferList"
				}
			})
		})
		$(document).ready(function(){
			var ttt=$('#bigbox').attr('title');
			$('#toptitle').html(ttt)
			
		})

	</script>
    <div class="nav hauto">
        <p class="nav_1 hauto" style="float: left">
            <a href="<?=$this->createUrl('default/index')?>"><img src="<?=M_IMG_URL;?>login.jpg"></a></p>
        <p class="nav_3" style="margin-top: -36.45px; width: 100%; text-align: center">

            <a href="javascript:void(0)" id="toptitle"></a>

        </p>
        <p class="nav_2" style="margin-top: -32px">
            <a href="<?=$this->createUrl('user/loginout')?>">退出登录</a></p>
    </div>
<?php
//是否实名认证
$authinfo=User::model()->findByPk(Yii::app()->user->getId());
$buyer=Blindwangwang::model()->findByAttributes(array('userid'=>Yii::app()->user->getId()));
if($authinfo->AuthPerson==0){
?>
<script>
var siteurl='<?=SITE_URL;?>';
	$(function(){
		$.openAlter("您未通过实名认证，请登录到电脑版进行实名认证，电脑版网址："+siteurl, '提示', { width: 250, height: 50 }, function(){
			 window.location.href='<?php echo $this->createUrl('user/loginout');?>';
		});
	})
</script>
<?php 
//是否绑定买号或者买号审核没有通过
}elseif(empty($buyer->wangwang) || $buyer->statue==0|| $buyer->statue==4){ 
?>
<script>
var siteurl='<?=SITE_URL;?>';
	$(function(){
		$.openAlter('亲，您的买号未绑定或者买号未审核通过，请登录到电脑版完整信息，电脑版网址：'+siteurl, '提示', { width: 250, height: 50 }, function(){
			window.location.href='<?php echo $this->createUrl('user/loginout');?>';
		});

	})
</script>

<?php }?>
	<?php
		$sql = 'SELECT goods_desc FROM zxjy_article WHERE goods_name = "滚动公告"';
		$desc = Yii::app() -> db -> createCommand($sql) -> queryScalar();
	?>
	<?php if(!empty($desc)):?>
		 	<style type="text/css">
			    #box{width: 100%;height: 40px;background: red; line-height: 40px;padding:0 15px;overflow: hidden}
			    #box span{color: #fff;font-size: 14px;}
			    #box p{color: #fff;font-size: 14px;white-space: nowrap;display: inline-block;}
			    .boxCon{width: 3000%;}
			</style>
		     <div id="box">
				    <div class="boxCon">
				    	<p id="begin"><?=$desc;?>&nbsp;&nbsp;&nbsp;&nbsp;
				    	<p id=""><?=$desc;?>&nbsp;&nbsp;&nbsp;&nbsp;
				    	<p id=""><?=$desc;?>&nbsp;&nbsp;&nbsp;&nbsp;
				    </div>
			 </div>
			<script>
			    var box = document.getElementById("box");
			    var begin = document.getElementById("begin");
			    var beginw = getCss(begin,"width");
			    var timer = window.setInterval(function(){
			        box.scrollLeft++;
			        var curLeft = box.scrollLeft;
			        if(curLeft >= beginw){
			            box.scrollLeft = 0;
			        }
			    },8);
			
			    //获取元素具体样式方法
			    function getCss(curEle,attr){
			        var val = null,reg = null;
			        if("getComputedStyle" in window){
			            val = window.getComputedStyle(curEle,null)[attr];
			        }else{
			            if(attr === "opacity"){
			                val = curEle.currentStyle["filter"];
			                reg = /^alpha\(opacity=(\d+(?:\.\d+)?)\)$/i;
			                val = reg.test(val)?reg.exec(val)[1]/100:1;
			            }else{
			                val = curEle.currentStyle[attr];
			            }
			        }
			        reg = /^(-?\d+(\.\d+)?)(px|pt|rem|em)?$/i;
			        return reg.test(val)?parseFloat(val):val;
			    }
			</script>
		<?php endif;?>