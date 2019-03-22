<!DOCTYPE html>
<html>
<head>
    <title>销量任务界面</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?=S_CSS;?>bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=S_CSS;?>udp.css"/>
    <script src="<?=S_JS;?>jquery.js"></script>
    <script src="<?=S_JS;?>bootstrap.min.js"></script>
    <script src="<?=S_JS;?>udp.js?ver=2.0"></script>
    <script src="<?=S_JS;?>liulantu.js"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>layer/layer.js"></script>
	<script type="text/javascript" src="<?php echo S_JS;?>layer/leftTime.min.js"></script>
</head>
<style>
	.touch_action
	{
		-webkit-touch-callout:none;
		-webkit-user-select:none;
		-khtml-user-select:none;
		-moz-user-select:none;
		-ms-user-select:none;
		user-select:none;
	}
	img{ pointer-events: none; }
</style>
<script type="text/javascript">
    var	task_key = "<?PHP echo  $taskinfo['userid']."_".$taskinfo['taskid']; ?>"; 
    var task_id = "<?PHP echo $taskinfo['taskid']; ?>"; 
	var second =<?php echo $setfreetime;?>;
	//任务过期时间计算
	var minuteke =parseInt(second/60);
    var secondke =parseInt(second%60);
    $(document).ready(function (){
        panding(<?=$taskinfo['intlet']?>,<?=$taskinfo['tasktype']?>);
		Times(minuteke,secondke);
		$("div.tdoa").bind("contextmenu", function(){
		    return false;
		});
    })  
   
	
    function FouX()
    {
		var $task_request = $('input.task_request');
		if ($task_request.lenght > 0)
		{
			$task_request.each(function(){
	    		if (!$(this).is(':checked'))
	    		{
					layer.alert("请勾选您已模拟的任务过程！",{icon: 7});
					return false;
	    		}
	    	});
		}
		else
		{
			$("#dishi").css("display","block");
			$("#disan").css("display","none");
		}
    	
    }
    
    function getTime(callback) 
	{
        $.ajax({
            type: "POST",
            data: {"taskid":<?=$taskinfo['taskid']?>},
            url: '<?php echo SITE_URL.'task/Tasksuo';?>',
            dataType:'json',
            success:function(data) {
                callback(data);
            },error:function(data){

            }
        });
    }
    

</script>
<!-- <p class="navbar navbar-default navbar-fixed-top text-center" style="min-height: 1px!important; padding: 0.2em;"> -->
    <!-- 任务过期时间还有:<span class="jishi" ></span> -->
		<span>
				<div class="data-show-box navbar navbar-default navbar-fixed-top text-center" id="dateShow1" style="min-height: 1px!important; padding: 0.2em;">
					<span class="date-tiem-span d">00</span>天
					<span class="date-tiem-span h">00</span>时
					<span class="date-tiem-span m">00</span>分
					<span class="date-s-span s">00</span>秒
				</div>
		</span>
<!-- </p> -->
<script type="text/javascript">
			$(function(){
				//日期倒计时
			$.leftTime("<?php echo date('Y/m/d H:i:s',$setfreetimenow);?>",function(d){
				if(d.status){
					var $dateShow1=$("#dateShow1");
					$dateShow1.find(".d").html(d.d);
					$dateShow1.find(".h").html(d.h);
					$dateShow1.find(".m").html(d.m);
					$dateShow1.find(".s").html(d.s);
				}
			});
			});
</script>
<div class="container-fluid navbar-fixed-top" id="ifm" style="display: none;">
	<!--浏览图片-->
    <div class="row " id="if1"  style="display: none">      
        	<div class="col-sm-2 col-xs-0" >
        		<button type="button" class="btn btn-info" onclick="Guan()">关闭</button>
        	</div>
        		<div class="col-sm-8 col-xs-12  kunr" >
        			<div class="row">
        				<div class="col-sm-7 col-xs-11">
        					 <img src="" class="img-responsive img-rounded kuny" id="ta"/>
        				</div>
        			</div>         			 
       			</div>
       		<div class="col-sm-2  col-xs-0 doa" ></div>    
    </div>
    <!--浏览图片:end-->
    <!--浏览图片-->
    <div class="row " id="if2"  style="display: none" >      
        	<div class="col-sm-2 col-xs-0" >
        	</div>
        		<div class="col-sm-8 col-xs-12  kunr" >
        			<div class="row">
        				<div class="col-sm-7 col-xs-11" style="padding-top: 50%;">
        					   正在提交。。。
        					 <div class="progress">
									<div class="progress-bar" role="progressbar" aria-valuenow="60"  aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="tijiaodu">
									</div>
							</div>
        				</div>
        			</div>         			 
       			</div>
       		<div class="col-sm-2  col-xs-0 doa" ></div>    
    </div>
</div>
<br>
<div class="container-fluid">
    <!--第头部标题-->
    <div class="row redal " >
        <div class="col-sm-10 col-xs-10 hidden-xs" >
            <h4 style="color: #fff;" >任务编号:<?=$taskinfo['tasksn']?>(<?=$rukou['intletarr'][$taskinfo['intlet']]?>)</h4>
        </div>
        <div class="col-sm-10 col-xs-10 visible-xs" >
            <h4 style="color: #fff;font-size: 12px;" >任务编号:<?=$taskinfo['tasksn']?>(<?=$rukou['intletarr'][$taskinfo['intlet']]?>)</h4>
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
 <input type="hidden" name="taskid" value="<?php echo $taskinfo['taskid'];?>" id="taskid">
 <input type="hidden" value="<?php echo $taskinfo['userid'] . '_' . $taskinfo['taskid']; ?>" id="task_tag">
    <div class="row topk ">
        <div class="col-sm-2 col-xs-0 " ></div>
        <div class="col-sm-8 col-xs-12 greeR kunr" >
            <h4 style="color: #fff;text-align: center;">第一步:进入购物平台</h4>
        </div>
        <div class="col-sm-2  col-xs-0" ></div>
    </div>
    <!--top 标题栏:end-->
    <!--列表-->
    <div class="row toa">
        <div class="col-sm-2 col-xs-0"></div>
        <div class="col-sm-8 col-xs-12">
        	<div class="col-sm-12 col-xs-12 kung kunr tran" style="padding:3% ;">
            <!--文本列表-->
            <div class="row ">
                <div class="col-sm-5 col-xs-5 t_right tdoa">
                    <label>任务类型:</label>
                </div>
                <div class="col-sm-5 col-xs-5 t_left tdoa">
                    <label><?=$rukou['intletarr'][$taskinfo['intlet']]?></label>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-5 col-xs-5 t_right tdoa">
                    <label>下单终端:</label>
                </div>
                <div class="col-sm-5 col-xs-5 t_left tdoa">
                    <label><?=$rukou['terminal']?></label>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-5 col-xs-5 t_right tdoa">
                    <label>入口:</label>
                </div>
                <div class="col-sm-5 col-xs-5 t_left tdoa">
                    <label><?=$rukou['entrance']?></label>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-5 col-xs-5 t_right tdoa">
                    <label>进入商品页方式:</label>
                </div>
                <div class="col-sm-5 col-xs-5 t_left tdoa">
                    <label><?=$rukou['searchtype']?></label>
                </div>
            </div>
            <!--控件文本内容-->
            <div class="row ">
                <div class="col-sm-5 col-xs-5 t_right">
                    <label >任务说明:</label>
                </div>
                <div class="col-sm-5 col-xs-5 t_left">
                    <?php if ($taskinfo['remark']):?>
                        <label style="color: #0cb7fe;"><?=$taskinfo['remark'] ?> </label>
                    <?php else:?>
                        <label>无 </label>
                    <?php endif;?>
                </div>
            </div>
            <!--控件文本内容：end-->
            <div class="row ">
            <?php if ($rukou['entrance']=='淘宝App'):?>
                <div class="col-sm-12 col-xs-12 t_cen">
                    <li style="margin-top: 0px; margin-left: 100px">
                        <img src="<?=S_IMAGES;?>tmapp.png" title="禁用天猫APP" width="70px" height="70px" style=" margin-left:70px">
                        <img src="<?=S_IMAGES;?>tbapp.png" title="使用淘宝APP" width="70px" height="70px">
                        <img src="<?=S_IMAGES;?>downloadtb.png" title="下载淘宝APP" width="70px" height="70px">
                    </li>
                </div>
            <?php endif;?>
            </div>
            </div>
        </div>
        <div class="col-sm-2 col-xs-0"></div>
    </div>
    <!--列表:end-->
    <!--top提示-->
    <div class="row toa">
        <div class="col-sm-2 col-xs-0"></div>
        <div class="col-sm-8 col-xs-12">
        <div class="col-sm-12 col-xs-12 kun kunr alert-warning trand">
            <div class="row yan " style="border-radius: 10px 10px 0px 0;"><h4 style="text-align: center;" >温馨提示</h4></div>
            <div class="row">
                <p style="padding: 3%;">若支付金额与担保金额的<span class="red">差额>50元</span>，在平台将<span class="red">无法提交订单</span>。遇到这种情况时，请勿在淘宝进行下单操作。</p>
            </div>
        </div>
        </div>
        <div class="col-sm-2 col-xs-0"></div>
    </div>
    <!--top提示：end-->

    <!--第二步-->
    <!--top 标题栏-->
    <div class="row topk ">
        <div class="col-sm-2 col-xs-0 " ></div>
        <div class="col-sm-8 col-xs-12 greeR kunr" >
            <h4 style="color: #fff;text-align: center;">第二步:找到目标</h4>
        </div>
        <div class="col-sm-2  col-xs-0" ></div>
    </div>
    <!--top 标题栏:end-->
    <!--图-->
    <div class="row topk ">
        <div class="col-sm-2 col-xs-0 " ></div>
        <div class="col-sm-8 col-xs-12 kunr" >
        <div class="row tdoa">
            <h4 style="color: #000;text-align: center;">产品图:</h4>  
        </div>        
    	<div class="row tdoa">
    			<div class="col-sm-3 col-xs-2"></div>
    				<div class="col-sm-6 col-xs-8 touch_action">
               		 <div class="row touch_action">
               		 	<div class="touch_action" id="" style="background: url(<?=S_IMAGES;?>mopan2.png);background-repeat:no-repeat; background-size:100% 100%;-moz-background-size:100% 100%;">
               		 		<img src="<?=$this -> getProductImg($taskinfo);?>" class="img-responsive img-rounded kuny"  style= "opacity:0.7;"/>
              		  	</div>
               		 </div>
       				</div>
      		  	<div class="col-sm-3 col-xs-2"></div>
    	</div>     
        </div>
        <div class="col-sm-2  col-xs-0" ></div>
    </div>
    <!--图：end-->
    <div class="row toa ">
        <div class="col-sm-2 col-xs-0"></div>
        <div class="col-sm-8 col-xs-12">
            <!--文笔-->
            <div class="col-sm-12 col-xs-12 kung kunr tran" style="font-size: 12px;">
                <!--文本列表-->
                <!--这是非二维码任务：开始-->
                <?php if ($taskinfo['intlet']!=6){?>
                <div class="row ">
                    <div class="col-sm-5 col-xs-5 t_right tdoa">
                        <label><?php if ($taskinfo['intlet']==3){echo'APP淘口令';}else{echo '搜索关键字';}?>:</label>
                    </div>
                    <div class="col-sm-7 col-xs-7 t_left tdoa">     
                    	 <label >
                    	 	 <?php if ($taskinfo['intlet']==3){ ?>            
                                <?=$taskinfo['keyword']?>                                                     
                             <?php }else{?>
                                    <?=$taskinfo['keyword']?>
                             <?php } ?>
                    	 </label>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-sm-5 col-xs-5 t_right tdoa">
                        <label>排序方式选择:</label>
                    </div>
                    <div class="col-sm-7 col-xs-7 t_left tdoa">
                        <label>
                            <?php if ($taskinfo['order']){ echo $rukou['stype'][$taskinfo['order']];}else{?>（无）<?php }?>
                       </label>
                    </div>
                </div>
<!--                <div class="row ">-->
<!--                    <div class="col-sm-5 col-xs-5 t_right tdoa">-->
<!--                        <label>价格区间设置:</label>-->
<!--                    </div>-->
<!--                    <div class="col-sm-7 col-xs-7 t_left tdoa">-->
<!--                        <label>--><?php //if ($taskinfo['price']){ echo $taskinfo['price'];}else{?><!--（无）--><?php //}?><!--</label>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="row ">
                    <div class="col-sm-5 col-xs-5 t_right tdoa">
                        <label>发货地:</label>
                    </div>
                    <div class="col-sm-7 col-xs-7 t_left tdoa">
                        <label><?php if ($taskinfo['sendaddress']){ echo $taskinfo['sendaddress'];}else{?>（无）<?php }?></label>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-sm-5 col-xs-5 t_right tdoa">
                        <label>其他筛选条件:</label>
                    </div>
                    <div class="col-sm-7 col-xs-7 t_left tdoa">
                        <label><?php if ($taskinfo['other']){ echo $taskinfo['other'];}else{?>（无）<?php }?></label>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-sm-5 col-xs-5 t_right tdoa">
                        <label>任务类型:</label>
                    </div>
                    <div class="col-sm-7 col-xs-7 t_left tdoa">
                        <label><?=$rukou['intletarr'][$taskinfo['intlet']]?></label>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-sm-5 col-xs-5 t_right tdoa">
                        <label>寻找目标商品:</label>
                    </div>
                    <div class="col-sm-7 col-xs-7 t_left tdoa">
                        <label>根据右侧图片找到店铺名为“<?php echo $this->substr_cut($taskinfo['shopname']);?>”的商品</label>
                    </div>
                </div>
                <?php }else{?>
                    <!--                这是非二维码任务：结束-->
                    <!--                这是二维码任务：开始-->
                    <div class="row">
                        <div class="row">
                            <div class="col-sm-5 col-xs-5" >
                            </div>
                            <div class="col-sm-7 col-xs-7" >
                                <img src="<?=$taskinfo['qrcode'];?>" alt="" class="img-rounded" style="width: 100%;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 col-xs-5" >
                                <ul style="text-align: right;">
                                    <li><p>第一步</p></li>
                                    <li><p>第二步</p></li>
                                </ul>
                            </div>
                            <!--文字框-->
                            <div class="col-sm-7 col-xs-7" >
                                <ul>
                                    <ul style="text-align: left;">
                                        <li><p>打开淘宝app扫描上面的二维码</p></li>
                                        <li><p>进入到商品详情页中</p></li>
                                    </ul>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- 这是非二维码任务：结束-->               
                <div class="row ">
                    <div class="col-sm-5 col-xs-5 t_right tdoa">
                        <label>
                        	<?php if ($taskinfo['intlet']==1||$taskinfo['intlet']==3||$taskinfo['intlet']==4||$taskinfo['intlet']==6){?> 验证店铺名：<?php }else{?>验证商品ID：<?php }?>
                        </label>
                    </div>
                    <div class="col-sm-7 col-xs-7 t_left tdoa">
                        <label id="auditShopState"></label>
                    </div>
                </div>
                <!--控件文本-->
                <div class="row doa">
                    <div class="col-sm-12 col-xs-12" >
                        <div class="row">
                            <div id="auditShopDiv" class="col-md-12 col-sm-12 col-xs-12" >
                                <div class="col-md-11 col-sm-11 col-xs-11" >
                                    <input type="text" class="form-control"  placeholder="请输入验证信息"  id= "txtValidateValue" name="textfield"  checkstatus="
								<?php
								$coo = Yii::app ()->request->getCookies ();
								if ($coo ['comfirmcookie' . $taskinfo ['id']]->value) {
									echo 1;
								} else {
									echo 'false';
								}
								?>">
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-1" >
                                    <button type="button" class="btn btn-info" onclick="Confirm('<?=$taskinfo['taskid']?>','<?=$taskinfo['intlet']?>','<?php echo $this->createUrl('task/TasktestOne02');?>')">验证</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--控件文本：end-->
                <?php if ($taskinfo['intlet']==2||$taskinfo['intlet']==5):?>
                <div class="row ">
                    <div class="col-sm-5 col-xs-5 t_right tdoa">
                        <label>查看示例:</label>
                    </div>
                    <div class="col-sm-5 col-xs-5 t_left tdoa">
                        <label onclick=" Kai('<?=S_IMAGES;?>goodsid.jpg')">点击吧！</label>
                    </div>
                </div>
                <?php endif;?>
            </div>
            <!--文笔：end-->                    
        </div>
        <div class="col-sm-2 col-xs-0"></div>
    </div> 
    <!--列表加图:end-->
    <?php if ($taskinfo['intlet']!=6):?>
    <!--上传图片-->
    <div class="row tdoa"  >
        <div class="col-sm-2 col-xs-0"></div>
        <div class="col-sm-8 col-xs-12">
        	<div class="col-sm-12 col-xs-12 kung kunr tran">
                上传搜索图：
            <div class="row tdoa">
                <div class="col-sm-4 col-xs-4 ">
                    <div style="width: 80px;height: 80px;border: 1px dashed goldenrod;">
                        <input type="file" id="pic1" name="pic1" style="width: 79px;height: 79px; position: absolute;opacity:0;" onchange="ShowTu('#pic1','#lang1','#typ1','#pon1','#son1','#stu1','<?php echo SITE_URL.'task/TasktestOne01';?>','<?php echo SITE_URL ?>')"/>
                        <img  class="img-responsive img-rounded" id="lang1" style="width: 80px;height: 80px;object-fit: cover;" id="liulantu"/>
                    </div>
                    <input type="hidden" name="tasktwoimg" role="myupload-picture-input" value="" id="stu1">
                </div>
                <div id="showUpImg" class="col-sm-4 col-xs-4" style="height: 100px;">
                    <div class="row">类型：<span id="typ1"></span></div>
                    <div class="row"> 进度：<span id="pon1" ></span></div>
                    <div class="row">结果：<span id="son1"></span></div>
                </div>
                <div class="col-sm-4 col-xs-4">
                	<div style="width: 80px;height: 80px;border: 1px dashed goldenrod;"  >
                        <img style="height: 80px;width: 80px;object-fit: cover;" id="liulantu" />
                   </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-sm-2 col-xs-0"></div>
    </div>
    
    <!--上传图片：end-->
    <?php endif;?>
    <div id="tishi" style="display: none">
    <!--top提示-->
    <div class="row toa">
        <div class="col-sm-2 col-xs-0"></div>
        <div class="col-sm-8 col-xs-12">
        <div class="col-sm-12 col-xs-12 kun kuny kunr alert-warning">
            <div class="row redal " style="border-radius: 10px 10px 0px 0;"><h4 style="text-align: center;color: #fff;" >核对商品价格</h4></div>
            <div class="row">
                <div class="col-sm-6 col-xs-7 t_right ">
                    <label>任务担保金额(单件):</label>
                </div>
                <div class="col-sm-6 col-xs-5 t_left ">
                    <label>
                    	<span class="red">
                    		<?=$taskinfo['price']?>
                    		<?php if ($taskinfo['express']){?>
                    		元(运费:<?=$taskinfo['express'];?>
                    		)<?php }?></span>元
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-7 t_right">
                    <label>拍下件数:</label>
                </div>
                <div class="col-sm-6 col-xs-5 t_left">
                    <label><span class="red"><?=$taskinfo['auction']?></span>件</label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-xs-7 t_right ">
                    <label>型号:</label>
                </div>
                <div class="col-sm-6 col-xs-5 t_left ">
                    <label><span class="red"><?=$taskinfo['modelname']?$taskinfo['modelname']:'默认'?></span></label>
                </div>
            </div>
            <div class="row">
                <p style="padding: 3%;">若支付金额与担保金额的<span class="red">差额>50元</span>，在平台将<span class="red">无法提交订单</span>。遇到这种情况时，请勿在淘宝进行下单操作。</p>
            </div>
        </div>

        </div>
        <div class="col-sm-2 col-xs-0"></div>
    </div>
    <!--top提示：end-->
    </div>

    <!--第二步：end-->
    <div class="san" style="display: inline">
        <!--第三步-->
        <!--top 标题栏-->
        <div class="row topk ">
            <div class="col-sm-2 col-xs-0 " ></div>
            <div class="col-sm-8 col-xs-12 greeR kunr" >
                <h4 style="color: #fff;text-align: center;">第三步:模拟任务过程</h4>
            </div>
            <div class="col-sm-2  col-xs-0" ></div>
        </div>
        <!--top 标题栏:end-->
        <!--列表-->
        <div class="row tdoa">
            <div class="col-sm-2 col-xs-0"></div>
            <div class="col-sm-8 col-xs-12">
                <div class="col-sm-12 col-xs-12 kunr kung " style="padding-bottom:3% ;">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 t_cen">
                            <h4 style="color: #000;text-align: center;"> 请完成以下操作，并在完成后勾选对应按钮</h4>
                        </div>
                    </div>
                    <?php if ($this -> getHandlePercent_collect($taskinfo['c_goods'], 'c_goods'. $taskinfo['id'])){?>
                        <!--控件文本-->
                        <div class="row toa">
                            <div class="col-sm-12 col-xs-12 t_red">
                                <div class="checkbox"> <label><input type="checkbox" value="" class="task_request step_four" name="has_collect_pro">收藏商品</label> </div>
                            </div>
                        </div>
                        <!--控件文本：end-->
                    <?php } if ($this -> getHandlePercent_collect($taskinfo['bookmark'], 'bookmark'. $taskinfo['id'])){?>
                        <!--控件文本-->
                        <div class="row toa">
                            <div class="col-sm-12 col-xs-12 t_red">
                                <div class="checkbox"> <label><input type="checkbox" value="" class="task_request step_four" name="has_collect_shop">收藏店铺</label> </div>
                            </div>
                        </div>
                        <!--控件文本：end-->
                    <?php } if ($this -> getHandlePercent_collect($taskinfo['talk'], 'talk'. $taskinfo['id'])){?>
                        <!--控件文本-->
                        <div class="row tdoa">
                            <div class="col-sm-12 col-xs-12 t_red">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" class="task_request step_four" name="has_talk">买前咨询聊天(店铺旺旺对话几句，聊天内容严禁出现平台任务字眼)
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--控件文本：end-->
                    <?php } ?>
                    <?php
                    $xhome = unserialize($taskinfo['x_home']);
                    $contrast_num = $this -> getHandlePercent($xhome, 'x_home' . $taskinfo['id']);
                    if ($contrast_num != 'not')  //不是为 ‘不货比’
                    {
                        $num = substr($contrast_num, -1);
                        ?>
                        <!--控件文本-->
                        <div class="row tdoa">
                            <div class="col-sm-12 col-xs-12 t_red">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="checkbox5" name="tongjia"  value="货比<?=@$num;?>家"  class="task_request step_four">浏览<?=@$num;?>家同类店铺的一款同类商品
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--控件文本：end-->
                    <?php } ?>
                    <?php
                    $deep = unserialize($taskinfo['deep']);
                    $contrast_num = $this -> getHandlePercent($deep, 'deep' . $taskinfo['id']);
                    if ($contrast_num != 'net')
                    {
                        $numdeep = substr($contrast_num, -1);
                        ?>
                        <!--控件文本-->
                        <div class="row toa">
                            <div class="col-sm-12 col-xs-12 t_red">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="checkbox4" name="liulanqita"  value="浏览店内<?=@$numdeep;?>款其他商品"  class="task_request step_four" > 浏览店内<?=@$numdeep;?>款其他商品
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--控件文本：end-->
                    <?php }?>
                    <!--控件文本内容-->
                    <div class="row toa">
                    	&nbsp;&nbsp;&nbsp;&nbsp;任务说明：<?=$taskinfo['remark'] ? $taskinfo['remark'] : '无'?>
                    </div>


                    <div class="row toa t_cen">
                        <button id="disan" type="button" class="btn btn-info"  onclick="FouX()" disabled="disabled" style="display: none;">主产品要停留:<span id="lblMinute"></span></button>
                    </div>
                    <!--控件文本内容：end-->
                </div>
            </div>
            <div class="col-sm-2 col-xs-0"></div>
        </div>
        <!--列表:end-->
        <!--第三步：end-->
    </div>


    <div id = "dishi"  style="display: none" >
    <!--第四步-->
    <!--top 标题栏-->  
    <div class="row topk ">
        <div class="col-sm-2 col-xs-0 " ></div>
        <div class="col-sm-8 col-xs-12 greeR kunr" >
            <h4 style="color: #fff;text-align: center;">第四步:下单付款</h4>
        </div>
        <div class="col-sm-2  col-xs-0" ></div>
    </div>
    <!--top 标题栏:end-->
     <div class="row topk ">
        <div class="col-sm-2 col-xs-0 " ></div>
        <div class="col-sm-8 col-xs-12  kunr" >
        <div class="row tdoa">
            <h4 style="color: #000;text-align: center;">产品图:</h4>  
        </div>        
            <!--图-->
    	<div class="row tdoa">
    			<div class="col-sm-3 col-xs-2"></div>
    				<div class="col-sm-6 col-xs-8">
               		 <div class="row ">
                  		<img src="<?=$this -> getProductImg($taskinfo);?>" class="img-responsive img-rounded kuny"/>
<!--//              		<img src="<?php $through_train_img = 'through_train_' . $taskinfo['car_img']; echo $taskinfo['car_img'] == 0 ? $taskinfo['commodity_image'] : $taskinfo[$through_train_img];?>" class="img-responsive img-rounded kuny"/>-->
               		 </div>
       				</div>
      		  	<div class="col-sm-3 col-xs-2"></div>
    	</div>
     <!--图：end-->
        </div>
        <div class="col-sm-2  col-xs-0" ></div>
    </div>
    
    <!--列表加图-->
    <div class="row toa">
        <div class="col-sm-2 col-xs-0"></div>
        <div class="col-sm-8 col-xs-12">
        <div class="col-sm-12 col-xs-12 kung kunr ">
            <!--文笔-->
            <div class="col-sm-12 col-xs-12" style="font-size: 12px;">
                <!--文本列表-->
               
                <div class="row ">
                    <div class="col-sm-6 col-xs-6 t_left ">
                        <div class="checkbox" ?> 
                 			<label>
                 				<input class="step_four" type="checkbox"  name="has_shopname"  value="<?=$this->substr_cut($taskinfo['shopname']);?>" />店铺名:<span  style="color:#000" id="shopname"><?=$this->substr_cut($taskinfo['shopname']);?></span>
                 			</label> 
                 		</div>
                    </div>
                    <div class="col-sm-6 col-xs-6 t_left ">
                        <div class="checkbox" ?> 
                 			<label>
                 				<input class="step_four" type="checkbox" id="checkbox3" name="has_talk"  value="买前咨询聊天" />型号:<span class="shopanmeg" style="color:#000"><?=$taskinfo['modelname']?$taskinfo['modelname']:'默认';?></span>
                 			</label> 
                 		</div>
                    </div>
                </div>
                 <!--文本列表-->
                 <!--文本列表-->
                <div class="row ">
                    <div class="col-sm-6 col-xs-6 t_left ">
                        <div class="checkbox" ?> 
                 			<label>
                 				<input class="step_four" type="checkbox" d="checkbox3" name="pro_num"  value="买前咨询聊天" />件数:<span class="shopanmeg" style="color:#000"><?=$taskinfo['auction']?></span>
                 			</label> 
                 		</div>
                    </div>
                    <div class="col-sm-6 col-xs-6 t_left ">
                        <div class="checkbox" ?> 
                 			<label>
                 				<input class="step_four" type="checkbox" type="checkbox" id="pay_money" name="checkbox"  value="买前咨询聊天" >付款金额:<span class="shopanmeg" style="color:#000"><?=$taskinfo['price']*$taskinfo['auction']+$taskinfo['express'];?></span>
                 			</label> 
                 		</div>
                    </div>
                </div>                
                 <!--文本列表-->
             <?php if($is_use_helper):?>
			 <br />
             <br />
             <form class="form-horizontal">
            	<div class="row">
                	<div class="form-group">
					    <div class="col-sm-7">
					      <input id="txtPlatformOrderNumber" type="text" class="form-control" id="inputEmail3" placeholder="提交订单编号">
					    </div>
					    <div class="col-sm-5">
					      <button type="button" class="btn btn-default" onclick="getOrderInfos()">获取订单信息</button>
					    </div>
				  	</div>
            	</div>
            	<div class="row" id="show_api_info" style="display: none;">
            		<br />
            		<p>
            			<strong>订单编号：</strong><span id="api_ordersn"></span>
            		</p>
            		<p>
            			<strong>店铺名称：</strong><span id="api_shopname"></span>
            		</p>
                	<p>
                		<strong>实付金额：</strong><span id="api_payment"></span>(差额：<span id="balance"></span>元)
                	</p>
                	<p>
                		<strong>创建时间：</strong><span id="api_createtime"></span>
                	</p>
                	<p>
                		<strong>支付时间：</strong><span id="api_paytime"></span>
                	</p>
                	<div class="col-sm-8 col-xs-8 t_left tdoa">
                       <div class="form-group">
							<select class="form-control" id="selPayMethod"  onchange="ShowChange()"> 
						 	    <option value="0">请选择支付方式</option>
                                <option value="zhifubao">支付宝</option>
                                <option value="bank">银行卡</option>
                                <option value="xinyongka">信用卡</option>
                                <option value="huabei">花呗支付</option>
 							</select>
  						</div>
                   </div>
            	</div>
        	 </form>
        	 <?php else:?>
        	 	<div class="row toa">
                	<div class="col-sm-4 col-xs-4 t_right ">
                    	<label style="margin-top:10% ;line-height: 10%;">订单编号:</label>
               		</div>
                	<div class="col-sm-8 col-xs-8 t_left ">
                          <input type="text" name="sPlatformOrderNumber" class="form-control step_four" id="txtPlatformOrderNumber"  maxlength="20">
               		</div>
            	</div>
            	<!--文本列表：end-->
                <div class="row toa" >
                    <div class="col-sm-4 col-xs-4 t_right tdoa">
                        <label style="margin-top:10% ;line-height: 10%;">任务金额:</label>
                    </div>
                    <div class="col-sm-8 col-xs-8 t_left tdoa">
                          <input type="text"  class="form-control"  disabled = "disabled" value="<?=$taskinfo['price']*$taskinfo['auction']+$taskinfo['express'];?>">                         	
               		</div>
                </div>
                <!--文本列表-->
            	<div class="row toa">
                	<div class="col-sm-4 col-xs-4 t_right ">
                    	<label style="margin-top:10% ;line-height: 10%;">付款金额:</label>
               		 </div>
                	<div class="col-sm-8 col-xs-8 t_left ">
                          <input type="text" class="form-control step_four" id="txtPayPrice" name="PayPrice" placeholder="请输入付款金额" onkeyup=" clearNoNum(event, this,'<?=$taskinfo['price']*$taskinfo['auction']+$taskinfo['express'];?>') " onblur="checkNum(this)" >
               		 </div>
            	</div>
            	<!--文本列表：end-->
                <div class="row tdoa">
                    <div class="col-sm-4 col-xs-4 t_right ">
                        <label>差额:</label>
                    </div>
                    <div class="col-sm-8 col-xs-8 t_left ">
                        <label ><span id="sDifferencePrice">0</span></label>
                    </div>
                    
                </div>
                <div class="row ">
                    <div class="col-sm-4 col-xs-4 t_right tdoa">
                        <label>支付方式:</label>
                    </div>
                    <div class="col-sm-8 col-xs-8 t_left tdoa">
                       <div class="form-group">
    							<select class="form-control" id="selPayMethod"  onchange="ShowChange()"> 
     							 	    <option value="0">请选择支付方式</option>
                                        <option value="zhifubao">支付宝</option>
                                        <option value="bank">银行卡</option>
                                        <option value="xinyongka">信用卡</option>
                                        <option value="huabei">花呗支付</option>
     							 </select>
  						</div>
                    </div>
                </div>
    	 	 <?php endif;?>  				
            </div>
            <!--文笔：end-->
        </div>
        </div>
        <div class="col-sm-2 col-xs-0"></div>
    </div>
    <!--列表加图:end-->
    <?php if (!$is_use_helper):?>
    	<!--上传图片-->
	    <div class="row toa">
	        <div class="col-sm-2 col-xs-0"></div>
	        <div class="col-sm-8 col-xs-12">
	        <div class="col-sm-12 col-xs-12 kung kunr">
	            上传订单图：
	            <div class="row toa">
	                <div class="col-sm-4 col-xs-4">
	                    <div style="width: 80px;height: 80px;border: 1px dashed goldenrod;">
	                        <input type="file" id="pic2" name="pic2" style="width: 79px;height: 79px; position: absolute;opacity:0;" onchange="ShowTu('#pic2','#lang2','#typ2','#pon2','#son2','#stu2','<?php echo SITE_URL.'task/TasktestOne01';?>','<?php echo SITE_URL ?>')"/>
	                        <img  class="img-responsive img-rounded" id="lang2" style="height: 80px;"/>
	                    </div>
	                    <input type="hidden" name="img1" role="myupload-picture-input" value="" id="stu2">
	                </div>
	                <div id="showUpImg2" class="col-sm-4 col-xs-4" style="height: 100px;">
	                    <div class="row">类型：<span id="typ2"></span></div>
	                    <div class="row"> 进度：<span id="pon2" ></span></div>
	                    <div class="row">结果：<span id="son2"></span></div>
	                </div>
	                <div class="col-sm-4 col-xs-4">
	                	<div style="width: 80px;height: 80px;border: 1px dashed goldenrod;"  >
	                        <img style="height: 80px;width: 80px;object-fit: cover;" id="liulantu01" />
	                   </div>
	                </div>
	            </div>
	        </div>
	        </div>
	        <div class="col-sm-2 col-xs-0"></div>
	    </div>
	    <!--上传图片：end-->
	<?php endif;?>
    <!--top提示-->
    <div class="row tdoa" style="margin-bottom: 20px;">
        <div class="col-sm-2 col-xs-0"></div>
        <div class="col-sm-8 col-xs-12">
        <div class="col-sm-12 col-xs-12 kun kuny kunr alert-warning">
            <div class="row yan " style="border-radius: 10px 10px 0px 0;"><h4 style="text-align: center;" >温馨提示</h4></div>
            <div class="row">
                <p style="padding: 3%;">若支付金额与担保金额的<span class="red">差额>50元</span>，在平台将<span class="red">无法提交订单</span>。遇到这种情况时，请勿在淘宝进行下单操作。</p>
                
            </div>
        </div>
        </div>
        <div class="col-sm-2 col-xs-0"></div>
    </div>
    <!--top提示：end-->
    <!--第四步：end-->
    <!--提交表单-->
    <div class="row tdoa">
    	  <div class="col-sm-2 col-xs-0"></div>
    	  <div class="col-sm-8 col-xs-12 ">
    	  	    <div class="row">
    	  	    	 <div class="row text-center">
    	  	    	 	 <div class="col-sm-12 col-xs-12 toa">
    	  	    	 	 		<button type="button" class="btn btn-info" onclick="SubmitAudit('<?php echo SITE_URL.'task/Orderall';?>')" id="jindu" >提交</button>
    	  	    	 	 </div>
    	  	         </div>
    	       </div>
          </div>
    	  <div class="col-sm-2 col-xs-0"></div>
    </div>
    <!--提交表单-->
    </div>
</div>
<!--图片上传js-->
<script type="text/javascript">
	/*
	 * 信息弹窗
	 */
	function m_alter($message, callback)
	{
		layer.confirm($message, {title: '', btn: ['我知道了'], icon: 7});
		return false;
	}
	/*
	 * 获取订单信息
	 */
	function getOrderInfos()
	{
		if(CheckOrderNumber())
		{
			$load = layer.msg('正在获取订单信息...', {
						icon: 16,
						shade: 0.01,
						time: 0,
					});
			var $post = {
				'ordersn': $("#txtPlatformOrderNumber").val(),
				'shopid': <?=$taskinfo['sid']?>,
				'proid': <?=$taskinfo['proid']?>,
			};
			$.post('/task/getOrderInfos', $post, function(datas){
				if (datas.status)
				{
					var $merchant_price = <?=$taskinfo['price'] * $taskinfo['auction'] + $taskinfo['express'];?>;  //商家设置的金额
					$payment = datas.data.payment;
					$ordersn = datas.data.tidStr;
					console.log(datas);
					$('span#api_ordersn').html($ordersn);
					$('span#api_shopname').html(datas.data.title);
					$('span#api_payment').html($payment);
					$('span#api_createtime').html(datas.data.created);
					$('span#api_paytime').html(datas.data.payTime);
					$('span#balance').html(datas.data.payment - parseInt($merchant_price));
					$('#show_api_info').slideDown(1000);
					layer.close($load);
				}
				else
				{
					$('#show_api_info').slideUp(1000);
					$payment = null;
					m_alter(datas.message);
				}
			}, 'JSON');
		}
	}
    //测试浏览图
    var intlet="<?=$taskinfo['intlet']?>";
    var terminal="<?=$rukou['terminal']?>";
    var tasktype="<?=$taskinfo['tasktype']?>";
    var ty_url="<?=S_IMAGES;?>";    
    Browsediagram(tasktype,intlet,'#liulantu',ty_url);
    Browsediagram01(tasktype,intlet,'#liulantu01',ty_url);

  
  function SubmitAudit(ur){
  	 $use_helper = '<?=$is_use_helper;?>';
  	 if(!window.$payment && $use_helper != '0')
  	 {
  	 	layer.alert("请正确填入订单编号，并提交以获取订单信息",{icon: 7});
  	 	return false;
  	 }
  	 var shopname= $("#shopname").html();
  	 var tasktwoimg =$("#stu1").val();
  	 var orderimg = $("#stu2").val();
  	 var txtPayPrice = $use_helper != '0' ? $payment : $("#txtPayPrice").val();
  	 var orderNumber = $use_helper != '0' ? $ordersn : $("#txtPlatformOrderNumber").val();
  	 var len=$("input[type=checkbox]:checked").length;
     var len01=$("input[type=checkbox]").length;
  	 var xia=$("#selPayMethod").val();
     var taskid = $("#taskid").val();
  	 if(CheckOrderNumber()){

  	 }else{
  	 	return false;
  	 }
  	 if(shopname == "" || shopname==null || shopname == "??" ){
  	 	layer.alert("请验证店铺名或商品ID！",{icon: 7});
  	 	return false;
  	 }
  	 <?php if ($taskinfo['intlet']!=6){?>
  	 if(tasktwoimg == "" || tasktwoimg == null){
  	 	layer.alert("请上传第二步的截图！",{icon: 7});
  	 	return false;
  	 }
  	 <?php } ?>
  	 if (!$use_helper)
  	 {
  	 	if(orderimg == "" || orderimg == null){
	  	 	layer.alert("请上传第四步的截图！",{icon: 7});
	  	 	return false;
	  	 }
	  	 if(txtPayPrice == "" || txtPayPrice == null){
	  	 	layer.alert("请输入付款金额！123",{icon: 7});
	  	 	return false;
	  	 }
	  	 if (parseFloat($("#txtPayPrice").val()) <= 0) {
	            layer.alert("付款金额必须大于0！",{icon: 7});
	            return false;
	    } 
  	 }
    if(len == len01){
           if(xia != 0 ){
       		}else{
             layer.alert("请选择支付方式！",{icon: 7});
             return false;
        	}
     }else{
     	layer.alert("请勾选未够选项！",{icon: 7});
        return;
    }
   $arr = {"shopname":shopname,"tasktwoimg":tasktwoimg,"orderimg":orderimg,"txtPayPrice":txtPayPrice,"orderNumber":orderNumber,"xia":xia,"taskid":taskid};
   var index = layer.load(2, {time: 0});
   $.ajax({
   	type:"post",
   	url:ur,
   	async:true, 
   	dataType: "json",
   	data:$arr,
   	success: function (data){
   		layer.close(index);
        if(data.err_code == 1){
				layer.msg(data.msg,{icon: 7,time:1300},function(){  	    
						localStorage.clear();
		            	<?php if($shebei=='PC'){?>
		            	var indexall = parent.layer.getFrameIndex(window.name); 
						        parent.location.reload();
								parent.layer.close(indexall); 
		            	<?php }?>           		
		            	<?php if($shebei=='TX'){?>
		            	      　window.location.href="<?php echo $this->createUrl('/mobile/task/taskmanage');?>";
		            	<?php } ?>
		        });
        }else if(data.err_code == 2){
        		layer.alert(data.msg,{icon: 7});
        }else if(data.err_code == 3){
		        layer.msg(data.msg,{icon: 6,time:1300},function(){
		        	    localStorage.clear();
		            	<?php if($shebei=='PC'){?>
		            	var indexall = parent.layer.getFrameIndex(window.name); 
						        parent.location.reload();
								parent.layer.close(indexall); 
		            	<?php }?>           		
		            	<?php if($shebei=='TX'){?>
		            	      　window.location.href="<?php echo $this->createUrl('/mobile/task/taskmanage');?>";
		            	<?php } ?>
		        });
        }
   	},error: function (data) {
        layer.alert('系统异常，请确认任务是否提交成功，如若本金未提现，我们将于次日凌晨为您补正，请耐心等待。',{icon: 6});
//      var indexall = parent.layer.getFrameIndex(window.name); 
//      parent.location.reload();
//		parent.layer.close(indexall); 
    }
   });
  }
 
</script>
</body>
</html>