
        <link href="<?php echo S_CSS;?>user_center.css" rel="stylesheet" type="text/css"/>
        <!--新手考试-->
        <div class="content bgf5 mt30">
            <ul class="d_zhannei clearfix">
            	<li class="d_znli" >初级试题</li>
            </ul>
            <div id="tab1" titlename="初级试题" class="d_biaoti clearfix show" >
                <div class="setInside mt20"><!--setInside start-->
                    <?php
                        $count=1;
                        $question=Exam::model()->findAll(array(
                            'condition'=>'is_question=1 AND type=1',
                            'order'=>'id asc'
                        ));
                        foreach($question as $item){
                            $answer=Exam::model()->findAll(array(
                                'condition'=>'q_id='.$item->id
                            ));
                    ?>
                    <div class="examItem"><!--examItem start-->
                        <div class="examQ">第<?php echo $count?>题：<?php echo $item->text;?></div>
                        <div class="examA">
                            <?php
                                foreach($answer as $k=>$v){
                            ?>
                            <input type="radio" <?php echo $k==0?'checked="checked"':'';?> name="exam#<?php echo $item->id;?>" value="<?php echo $v->id;?>" lang="<?php echo $item->id;?>"/>&nbsp;
                                <?php 
                                    echo $v->text;
                                ?>
                            <br />
                            <?php }?>
                        </div>
                    </div><!--examItem end-->
                    <?php
                            $count++;
                        }
                    ?>
                    <button class="sendMyExam" onclick="showtab(this,'1')">
                        <span class="btn" id="next">下一步</span></button>
                </div><!--setInside end-->
            </div>
            <div id="tab2" titlename="高级试题" class="d_biaoti clearfix hide" >
                <div class="setInside mt20"><!--setInside start-->
                    <?php
                        $count=1;
                        $question=Exam::model()->findAll(array(
                            'condition'=>'is_question=1 AND type=2',
                            'order'=>'id asc'
                        ));
                        foreach($question as $item){
                            $answer=Exam::model()->findAll(array(
                                'condition'=>'q_id='.$item->id
                            ));
                    ?>
                    <div class="examItem"><!--examItem start-->
                        <div class="examQ">第<?php echo $count?>题：<?php echo $item->text;?></div>
                        <div class="examA">
                            <?php
                                foreach($answer as $k=>$v){
                            ?>
                            <input type="radio" <?php echo $k==0?'checked="checked"':'';?> name="exam#<?php echo $item->id;?>" value="<?php echo $v->id;?>" lang="<?php echo $item->id;?>"/>&nbsp;
                                <?php
                                    echo $v->text;
                                ?>
                            <br />
                            <?php }?>
                        </div>
                    </div><!--examItem end-->
                    <?php
                            $count++;
                        }
                    ?>
                    <button class="sendMyExam"><span class="btn " id="prev " onclick="showtab(this,0)">上一步</span>
                        <span class="btn" id="next" onclick="showtab(this,1)">下一步</span></button>
                </div><!--setInside end-->
            </div>
            <div id="tab3" titlename="终极试题" class="d_biaoti clearfix hide" >
                <div class="setInside mt20"><!--setInside start-->
                    <?php
                        $count=1;
                        $question=Exam::model()->findAll(array(
                            'condition'=>'is_question=1 AND type=3',
                            'order'=>'id asc'
                        ));
                        foreach($question as $item){
                            $answer=Exam::model()->findAll(array(
                                'condition'=>'q_id='.$item->id
                            ));
                    ?>
                    <div class="examItem"><!--examItem start-->
                        <div class="examQ">第<?php echo $count?>题：<?php echo $item->text;?></div>
                        <div class="examA">
                            <?php
                                foreach($answer as $k=>$v){
                            ?>
                            <input type="radio" <?php echo $k==0?'checked="checked"':'';?> name="exam#<?php echo $item->id;?>" value="<?php echo $v->id;?>" lang="<?php echo $item->id;?>"/>&nbsp;
                                <?php
                                    echo $v->text;
                                ?>
                            <br />
                            <?php }?>
                        </div>
                    </div><!--examItem end-->
                    <?php
                            $count++;
                        }
                    ?>
                    <button  class="sendMyExam"><span class="btn " id="prev " onclick="showtab(this,'0')">上一步</span><span class="btn " id="send">提交答卷</span></button>
                </div><!--setInside end-->
            </div>
            <div class="clear"></div>
        </div>
        <!--新手考试-->
 <!--layer插件-->

<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
<script>
    function showtab(o,n) {
        var tabid=$(o).parents('.d_biaoti').attr('id');
        var id=tabid.substr(-1,1);
        var stabid='';
        stabid=n==1?'tab'+(parseInt(id)+1):'tab'+(parseInt(id)-1);
        $('#'+tabid).removeClass('show');
        $('#'+tabid).addClass('hide');
        $('.d_znli').text( $('#'+stabid).attr('titlename'))
        $('#'+stabid).removeClass('hide');
        $('#'+stabid).addClass('show');
    }
    $(function(){
        $("#send").click(function(){
            //询问框
        	layer.confirm('您确认提交您的试卷吗？', {
        		btn: ['确认提交','再检查一下'] //按钮
        	},function(){
        	   
               var res="";
               var Qarr = [];//题目数组
               var Aarr = [];//答案数组
               var key=0;
               $("input:radio:checked").each(function(){

                    Qarr[key]=$(this).attr("lang");
                    Aarr[key]=$(this).val();//答案存入数组
                    key=key+1;
               });
               
        	   //提交试卷
        	   $.ajax({
        			type:"POST",
        			url:"<?php echo $this->createUrl('user/userExam');?>",
        			data:{"qeustion":Qarr,'answer':Aarr},
        			success:function(msg)
        			{
                        if(msg=='SUCCESS')//通过考试
                        {
                            //询问框
                        	layer.confirm('恭喜您通过新手考试', {
                        		btn: ['知道了'] //按钮
                        	},function(){
                        	   window.location.href='<?php echo $this->createUrl('other/auxiliaryinfo');?>';
                        	});
                        }else//考试失败
                        {
                            layer.confirm('<span style="color:red;">很遗憾，考试未通过</span>', {
                        		btn: ['重新考试','以后再说'] //按钮
                        	},function(){
                        	   location.reload();//刷新当前页面
                        	},function(){
                        	   window.location.href='<?php echo $this->createUrl('user/index');?>';
                        	});
                        }
        			}
        		});
        	});
        });
    })
</script>