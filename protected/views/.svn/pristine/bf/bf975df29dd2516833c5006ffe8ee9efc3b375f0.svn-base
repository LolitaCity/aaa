<!DOCTYPE html>
<html>
<head>
    <title>任务</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?=S_CSS;?>bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=S_CSS;?>udp.css"/>
    <!-- jQuery (Bootstrap 的 JavaScript 插件需要引入 jQuery) -->
    <script src="<?=S_JS;?>jquery.js"></script>
    <script src="<?=S_JS;?>bootstrap.min.js"></script>
    <script src="<?=S_JS;?>udp_vincent_pre.js?ver=2.0"></script>
    <script type="text/javascript" src="<?php echo S_JS;?>layer/layer.js"></script>
</head>
<script type="text/javascript">
    $(document).ready(function (){
        panding(<?=$taskinfo['intlet']?>);
    })
    
    function Timesb(minute, second) 
    {
    	if(window.stay_countdown)
		{
			clearTimeout(stay_countdown);
		}
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
            localStorage.setItem('hasStay' + $task_tag, 1)
//          localStorage.hasStay = 1;  //已经停留6分钟
            $("#browse_finished_btn").show();
            $("#disan").remove();
        }
        else {
            $("#lblMinute").text(minute);
            $("#lblSecond").text(second);
            stay_countdown = setTimeout("Timesb('" + minute + "','" + second + "')", 1000);
        }
    }
    
    /*
     * 浏览完毕
     */
    function browse_finish($pre_id)
    {
    	var $post = {
    		'img_search': $('#stu1').val(),
    		'img_browse': $('#stu3').val(),
    		'pretask_id': $pre_id,
    	};
    	$load = layer.msg('提交数据中...', {
					icon: 16,
					shade: 0.01,
					time: 0,
				});
    	getTime(function(datas){
    		if(datas.num > 0)  //尚未走完停留时间
    		{
    			m_alter('请等待主产品停留时间倒计时');
    			return false;
    		}
    		else
    		{
    			if($('.step_four:checked').length != $('.step_four').length)
				{
					m_alter('请勾选对应按钮');
					return false;
				}
				if(!window.localStorage.getItem('imgUrl#lang3' + $task_tag))
				{
					m_alter('请上传浏览截图');
					return false;
				}
				if ($post.img_search == '')
				{
					m_alter('请重新上传搜索截图');
					return false;
				}
				if ($post.img_browse == '')
				{
					m_alter('请重新上传浏览截图');
					return false;
				}
				$.post('/task/SubmitBrowse', $post, function(datas){
					layer.close($load);
					if (datas.status)
					{
						clear_localStorage($task_tag);  //清除该任务的本地存储
						layer.confirm(datas.message, {title: '', btn: ['我知道了'], closeBtn: 0}, function(index){
							<?php if($shebei=='PC'){?>
			            		parent.window.location.href="<?php echo $this->createUrl('site/index');?>";
			            	<?php }?>           		
			            	<?php if($shebei=='TX'){?>
			            	      　window.location.href="<?php echo $this->createUrl('/mobile/task/taskmanage');?>";
			            	<?php } ?>
						});
					}
					else
					{
						layer.msg(datas.message, {anim: 6, icon: 5, time: 1600});
					}
				}, 'JSON');
    	}
    	});
   }

	//用于预览图
    //任务类型
	var type="<?=$taskinfo['intlet']?>";
    var type1="<?=$rukou['terminal']?>";
    //任务类型主
    var type2="<?=$taskinfo['tasktype']?>";
    var ty_url="<?=S_IMAGES;?>";         
    var second =<?php echo $setfreetime;?>;
    var secondke =<?php echo $ketiam;?>;

    function FouX()
    {
    	$('input.task_request').each(function(){
    		if (!$(this).is(':checked'))
    		{
    			alert('请勾选您已模拟的任务过程');
    			return false;
    		}
    	});
		$("#dishi").css("display","block");
    	if (localStorage.getItem('hasStay' + $task_tag))
    	{
    		localStorage.setItem('has_check' + $task_tag, 1);
    		$("#dishi").css("display","block");
    	}
    	else
    	{
    		alert('时间未到，请耐心等待主产品停留时间');
    		return false;
    	}
    }
    
    function getTime(callback) 
	{
        $.ajax({
            type: "POST",
            data: {"id":<?=$taskinfo['id']?>},
            url: '<?php echo SITE_URL.'task/Tasksuo01';?>',
            dataType:'json',
            success:function(data) {
                callback(data);
            },error:function(data){

            }
        });
    }
    
    

</script>
<input type="hidden" value="<?php echo $taskinfo['userid'] . '_pre_' . $taskinfo['id']; ?>" id="task_tag">
<p class="navbar navbar-default navbar-fixed-top text-center" style="min-height: 1px!important; padding: 0.2em;">
    任务过期时间还有:<span class="jishi" ></span>
</p>
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
            	
            <?php }?>
            		
            <?php if($shebei=='TX'){?>
            	     <a href="<?php echo $this->createUrl('/mobile/task/taskmanage');?>" id="imgeColse" > <h4 style="color: #fff;">X</h4>
			         </a>
			       
            <?php } ?>
        </div>
        
    </div>
    <!--第头部标题:end-->
    <!--top 标题栏-->

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
            <div class="row text-center">
                <strong class="text-danger">该任务为预约任务！即今日浏览，明日下单</strong>
            </div>
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
    				<div class="col-sm-6 col-xs-8">
               		 <div class="row ">
               		 	<div id="" style="background: url(<?=S_IMAGES;?>mopan2.png);background-repeat:no-repeat; background-size:100% 100%;-moz-background-size:100% 100%;">
               		 		<img src="<?=$this -> getProductImg($taskinfo);?>" class="img-responsive img-rounded kuny"  style= "opacity:0.7;"/>
                  		  	<!--<img src="<?php $through_train_img = 'through_train_' . $taskinfo['car_img']; echo $taskinfo['car_img'] == 0 ? $taskinfo['commodity_image'] : $taskinfo[$through_train_img];?>" class="img-responsive img-rounded kuny"  style= "opacity:0.7;"/>-->
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
                    <div class="col-sm-5 col-xs-5 t_left tdoa">
<!--                        <label>(记得快点找呀！！)</label>-->
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
                                    <button type="button" class="btn btn-info" onclick="Confirm('<?=$taskinfo['taskid']?>','<?=$taskinfo['intlet']?>','<?php echo $this->createUrl('task/tasktestOne02');?>')">验证</button>
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
                        <img  class="img-responsive img-rounded" id="lang1" style="height: 80px;"/>
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
                        <img class="img-responsive img-rounded" style="height: 80px;" id="litu" />
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
                            <h4 style="color: #000;text-align: center;">请完成以下操作，在完成后勾选对应按钮，<strong class="text-danger">
                            	务必<?php
                            		switch($taskinfo['how_browse'])
                        			{
                        				case 1:
                        					$how_browse = '将商品加入购物车，并加购四款同类产品，上传“购物车”截图';
                        					$how_search = '从购物车直接进入';
                        					break;
                        				case 2: 
                        					$how_browse = '收藏该商品，并收藏五款同类产品，上传“收藏夹”截图';
                        					$how_search = '从收藏夹直接进入';
                        					break;
                        				case 3: 
                        					$how_browse = '货比三家，上传“足迹”截图';
                        					$how_search = '从足迹直接进入';
                        					break;
                        			}
                        			echo $how_browse;	
                        		?>
							</strong></h4>
                        </div>
                    </div>
                    <?php if ($taskinfo['bookmark']>=50){?>
                        <!--控件文本-->
                        <div class="row toa">
                            <div class="col-sm-12 col-xs-12 t_red">
                                <div class="checkbox"> <label><input type="checkbox" value="" class="task_request step_four" name="has_collect_shop">收藏店铺</label> </div>
                            </div>
                        </div>
                        <!--控件文本：end-->
                    <?php } if ($taskinfo['talk']>=50){?>
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
                    $max=0;
                    $xhome=unserialize($taskinfo['x_home']);
                    if($xhome && count($xhome)>0 && $xhome['not']<40){
                        array_shift($xhome);
                        $max=array_search(max($xhome),$xhome);
                    }
                    if ($xhome && count($xhome) > 0 && $xhome[$max]>30){
                        $num=substr($max,-1);
                        ?>
                        <!--控件文本-->
                        <div class="row tdoa">
                            <div class="col-sm-12 col-xs-12 t_red">
                                <div class="checkbox">
                                    <label>
                                        <input class="step_four" type="checkbox" id="checkbox5" name="has_browse"  value="货比<?=@$num;?>家" >浏览<?=@$num;?>家同类店铺的一款同类商品
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--控件文本：end-->
                    <?php } ?>
                    <?php
                    $maxsame=0;
                    $deep=unserialize($taskinfo['deep']);
                    if ($deep && $deep['net']<40){
                        array_shift($deep);
                        $max2=array_search(max($deep),$deep);
                    }
                    if ($deep && $deep[$max]>30){
                        $numdeep=substr($max2,-1);
                        ?>
                        <!--控件文本-->
                        <div class="row toa">
                            <div class="col-sm-12 col-xs-12 t_red">
                                <div class="checkbox">
                                    <label>
                                        <input class="step_four" type="checkbox" id="checkbox4" name="has_browse"  value="浏览店内<?=@$numdeep;?>款其他商品" > 浏览店内<?=@$numdeep;?>款其他商品
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!--控件文本：end-->
                    <?php }?>
                    <!--控件文本内容-->
                    <div class="row toa">
                    	&nbsp;&nbsp;&nbsp;&nbsp;任务说明：<?=$taskinfo['remark'] ? $taskinfo['remark'] : '无'?>
                        <!--<div class="col-sm-5 col-xs-5 t_right">
                            <label style="margin-top:10% ;">任务说明:</label>
                        </div>
                        <div class="col-sm-5 col-xs-5 t_left">
                            <?php if ($taskinfo['remark']):?>
                            	<?=$taskinfo['remark']?>
                                <textarea name="" rows="" cols=""  class="form-control" ><?=$taskinfo['remark']?></textarea>
                            <?php else:?>
                            	无
                                <textarea name="" rows="" cols=""  class="form-control" >无</textarea>
                            <?php endif;?>
                        </div>-->
                    </div>
					
					<div class="row text-center">
						<h5 >----------上传对应截图----------</h5>
						<br />
						<div class="col-sm-2"></div>
						<div class="col-sm-10">
							<div class="col-sm-3 col-xs-3 ">
			                    <div style="width: 80px;height: 80px;border: 1px dashed goldenrod;">
			                        <input type="file" id="pic3" name="pic1" style="width: 79px;height: 79px; position: absolute;opacity:0;" onchange="ShowTu('#pic3','#lang3','#typ3','#pon3','#son3','#stu3','<?php echo SITE_URL.'task/TasktestOne01';?>','<?php echo SITE_URL ?>')">
			                        <img class="img-responsive img-rounded" id="lang3" style="height: 80px;" src="">
			                    </div>
			                    <input type="hidden" name="tasktwoimg" role="myupload-picture-input" value="" id="stu3">
			                </div>
			                <div id="showUpImg3" class="col-sm-6 col-xs-6 style="height: 100px;">
			                    <div class="row">类型：<span id="typ3"></span></div>
			                    <div class="row"> 进度：<span id="pon3" ></span></div>
			                    <div class="row">结果：<span id="son3"></span></div>
			                </div>
			                <div class="col-sm-3 col-xs-3">
			                	<div style="width: 80px;height: 80px;border: 1px dashed goldenrod; margin-right: 0px!important;"  >
			                        <img onclick="Kai('/source/images/how_browse_<?=$taskinfo['how_browse']?>.jpg')" class="img-responsive img-rounded" style="height: 80px;" src="/source/images/how_browse_<?=$taskinfo['how_browse']?>.jpg" />
			                   </div>
			                </div>
		                </div>
					</div>

                    <div class="row toa t_cen">
                        <button id="disan" type="button" class="btn btn-info" disabled="disabled" style="display: none">主产品要停留:<span id="lblMinute">0</span>分<span id="lblSecond">0</span>秒</button>
                        <button id="browse_finished_btn" type="button" class="btn btn-info"  onclick="browse_finish(<?=$taskinfo['id']?>)" style="display: none">浏  览  完  毕</button>
                    </div>
                    <!--控件文本内容：end-->
                </div>
            </div>
            <div class="col-sm-2 col-xs-0"></div>
       </div>
        <!--列表:end-->
        <!--第三步：end-->
    </div>

</div>
<!--图片上传js-->
<script type="text/javascript">
	//任务时间计算
    var min2 =parseInt(second/60);
    var s2 =parseInt(second%60);
   Timesa(min2,s2);
    var min1 =parseInt(secondke/60);
    var s1 =parseInt(secondke%60);
   Timesake(min1,s1);
   litutu(type,type1,type2,ty_url,'#litu');

    // var min =parseInt(420/60);
    // var s =parseInt(420%60);
    // Timesb(min, s);

  function SubmitAudit(ur){
  	 var shopname= $("#shopname").html();
  	 var tasktwoimg =$("#stu1").val();
  	 var orderimg = $("#stu2").val();
  	 var txtPayPrice = $("#txtPayPrice").val();
  	 var orderNumber = $("#txtPlatformOrderNumber").val();
  	 alert("你输入的订单号为："+orderNumber);
  	 var len=$("input[type=checkbox]:checked").length;
     var len01=$("input[type=checkbox]").length;
  	 var xia=$("#selPayMethod").val();
     var taskid = $("#taskid").val();
  	 if(CheckOrderNumber()){

  	 }else{
  	 	return false;
  	 }
  	 if(shopname == "" || shopname==null || shopname == "??" ){
  	 	alert("请验证店铺名或商品ID");
  	 	return false;
  	 }
  	 <?php if ($taskinfo['intlet']!=6){?>
  	 if(tasktwoimg == "" || tasktwoimg == null){
  	 	alert("请上传第二步的截图");
  	 	return false;
  	 }
  	 <?php } ?>
  	 if(orderimg == "" || orderimg == null){
  	 	alert("请上传第四步的截图");
  	 	return false;
  	 }
  	 if(txtPayPrice == "" || txtPayPrice == null){
  	 	alert("请输入付款金额");
  	 	return false;
  	 }
  	 if (parseFloat($("#txtPayPrice").val()) <= 0) {
            alert("付款金额必须大于0");
            return false;
    }   
    if(len == len01){
           if(xia != 0 ){
       		}else{
               alert("请选择支付方式！");
             return false;
        	}
     }else{
            alert("请勾选未够选项！");
            return;
    }
    Kaiti();
	var formData = new FormData();
        formData.append("shopname" , shopname);
        formData.append("tasktwoimg" , tasktwoimg);
        formData.append("orderimg" , orderimg);
        formData.append("txtPayPrice" , txtPayPrice);
        formData.append("orderNumber" , orderNumber);
        formData.append("xia" , xia);
        formData.append("taskid" , taskid);
        
        $.ajax({
        type: "POST",
        url: ur,
        data: formData ,
        processData : false,
        contentType : false ,
        xhr: function(){
            var xhr = $.ajaxSettings.xhr();
            if(onprogress && xhr.upload) {
                xhr.upload.addEventListener("progress" , onprogresso, false);
                return xhr;
            }
        },success: function(data) {          
        	 var obj = JSON.parse(data);
            // alert("状态码:"+obj.status);
            if(obj.err_code==3){
            	Guan();
            	layer.msg(obj.msg, {
            	icon: 16,
           		 time:2000,
            	shade: 0.01
        		});
        		clear_localStorage($task_tag);
        		//localStorage.clear();
            	<?php if($shebei=='PC'){?>
            	parent.window.location.href="<?php echo $this->createUrl('site/index');?>";
            	var index = parent.layer.getFrameIndex(window.name);  
                parent.layer.close(index); 
            	<?php }?>           		
            	<?php if($shebei=='TX'){?>
            	      　window.location.href="<?php echo $this->createUrl('/mobile/task/taskmanage');?>";
            	<?php } ?>
            }else if(obj.err_code==1 || obj.err_code==4){
            	clear_localStorage($task_tag);
				//localStorage.clear();
            	Guan();
                alert(obj.msg);
            	<?php if($shebei=='PC'){?>
            	parent.window.location.href="<?php echo $this->createUrl('site/index');?>";
            	var index = parent.layer.getFrameIndex(window.name);  
                parent.layer.close(index); 
            	<?php }?>           		
            	<?php if($shebei=='TX'){?>
            	      　window.location.href="<?php echo $this->createUrl('/mobile/task/taskmanage');?>";
            	<?php } ?>
            }else{
            	Guan();
            	alert(obj.msg);
            }
            
        },
        error:function(xhr){ //上传失败
        	 var obj = JSON.parse(data);
            alert("提交失败"+obj.msg);
            $("#jindu").html("提交失败" );
        }
    });
  }
 
  function onprogresso(evt){
    var loaded = evt.loaded;     //已经上传大小情况
    var tot = evt.total;      //附件总大小
    var per = Math.floor(100*loaded/tot);  //已经上传的百分比
    //$("#jindu").html( per +"%" );   
    $("#tijiaodu").css( {'width':per +"%"} );
}
</script>
</body>
</html>