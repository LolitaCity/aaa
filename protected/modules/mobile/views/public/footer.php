<?php $sql="SELECT * FROM ".Yii::app()->db->tablePrefix."_buyer_question ORDER BY `order`";
      $list=Yii::app()->db->createCommand($sql)->queryAll();
	  
?>

<div class="app_q1 center_ctl">
    <!--常见问题-->
    <!-- <span class="right">常见问题</span> -->
    <div class="menu_question">
        <!--滚动条-->
        <div class="menu1_question">
            <div class="menu2_question">
			<?php foreach ($list as $k=>$v):?>
                <div class="tree">
                    <div class="tree_box">
                        <h3 class="png_<?php echo $v['order'];?>">
                            <em></em><?php echo $v['question_type'];?></h3>
                        <ul class="tree_one">
						<?php $question=json_decode(urldecode($v['question_content']));foreach ($question as $k=>$v):?>
                        
                            <li>
                                <h4 style="word-wrap: break-word">
                                    <b>问:</b><span><?php echo $v->title;?></span></h4>
                                <div class="tree_two">
                                    <b>答:</b> <em></em>
                                    <p style="word-wrap: break-word">
                                        <?php echo nl2br($v->answer) ;?>
                                    </p>
                                </div>
                            </li>
							<?php endforeach;?>
                        </ul>
                    </div>
                </div>
			<?php endforeach;?>	
				
            </div>
        </div>
        <!--滚动条-->
    </div>
    <!--常见问题-->
    
    <div class="w-nav" style="width: 100%; position: fixed; left: 0; bottom: 0; z-index: 9999">
        <div class="w-sj-nav">
            <ul id="ownUI">
                <li style="width: 25%">
                    <a id="first" href="<?=$this->createUrl('default/index');?>" >首页</a>
                </li> 

                <li style="width: 25%" id="dd">                
                	  <ul  id="yy" style="width: 100%;position: relative;bottom:0px;">
                	  	  <li id="ll" style="width: 100%"><a href="#" >接手管理 </a></li>
		                		<li style="width: 100%"> <a id="kk" href="<?=$this->createUrl('task/taskmanage');?>" >销量任务 </a></li>
		                		<li style="width: 100%"><a href="<?=$this->createUrl('task/taskmanageOne');?>" >预定/预约 </a></li>
                	  </ul>
                </li>
                <li style="width: 25%;">
                    <a id="third" href="<?=$this->createUrl('finance/takeoutcash');?>">平台提现 </a>
                </li>
                <li style="width: 25%"> 
                	  <a  id="fourth" href="<?=$this->createUrl('finance/selleroutcash');?>">本金提现</a> 
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    	$("#dd").click(function(){
    		  $("#ll").remove();
    			$("#kk").css("background","#ce0a0a");
    			$("#yy").css("bottom","40px");
    			 console.log("sdas")
    	});
</script>