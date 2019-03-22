        <style>
        *{ margin:0; padding:0;}
        li{ list-style: none;}
        a{ text-decoration: none;}
        .dtrwLis{
        	width:1030px;
        	margin: 0 auto;
        	margin-top: 8px;
        }
        .dtrwLis >li{
        	padding-left: 22px;
        	width:1006px;
        	padding-top: 15px;
        	padding-bottom: 15px;
        	min-height: 105px;
        	margin-bottom: 10px;
        	border: 1px dashed #99c1f5;
        	border-radius: 5px;
        	background: #fff;
        }
        li.dtrwLisOn{
            box-shadow:0 0 3px 3px #adcffb;
        }
        .rebh{
        	font-size: 12px;
        	color: #57a0ff;
        }
        .rebh font{ padding-left:10px;}
        .allRw_pro{
        	margin-top: 13px;
        	height:70px;
        }
        .allRw_proImg{
        	display: block;
        	float: left;
        	width:71px;
        	height: 71px;
        }
        .allRw_pros{
        	float: left;
        	margin-left:25px;
        	width:685px;
        	height:54px;
        	padding-top:12px;
        	border-right: 1px dashed #99c1f5;
        
        }
        .allRw_prosLis{
        	width:100%;
        	height:30px;
        }
        .allRw_pro1{
        	float: left;
        	width:auto;
        	font-size: 12px;
        	color: #555;
            margin-right:15px;
        }
        .allRw_pro1 span{
        	font-size: 16px;
        	color: #fc3e19;
        }
        .othallRw_pro{
        	float: left;
        }
        .othallRw_pro >li{
        	float: left;
        	margin-right:32px;
        	font-size: 12px;
        	color: #555;
        }
        .othallRw_pro >li>span{
        	font-size: 16px;
        	color: #fc3e19;
        }
        .allRw_proLink{
        	margin-top:12px;
        }
        .allRw_proLink>a{
        	margin-right: 3px;
        	width:36px;
        	height: 20px;
        	border: 1px solid #57a0ff;
        	border-radius: 3px;
        	text-align: center;
        	line-height: 22px;
        	font-size: 12px;
        	color: #666;
            padding:2px 4px;
            font-weight: bold;
        }
        .allRw_proLink>a:hover{ color:#57a0ff;}
        .qcrw{
        	position: relative;
        	top:4px;
        	display: block;
        	float: left;
        	width:80px;
        	height: 30px;
        	border: 1px solid #57a0ff;
        	border-radius: 5px;
        	text-align: center;
        	line-height: 30px;
        	font-size: 14px;
        	color: #57a0ff;
            margin-left:20px;
        }
        .qcrw:hover{
            color: #fff;
            background:#57a0ff;
        }
        .rwPage{
        	width:1030px;
        	margin: 0 auto;
        	margin-top:50px;
        }
        .rwPageLis{
        	float: left;
        }
        .rwPageLis >li{
        	float: left;
        	width:40px;
        	height: 28px;
        	margin-right: 6px;
        }
        .rwPageLis >li>a{
        	display: block;
        	width:100%;
        	line-height: 30px;
        	text-align: center;
        	font-size: 12px;
        	color: #666;
        	background: #fff;
        	border: 1px dashed #99c1f5;
        }
        .rwPageLis >li>a.pageCli{
        	color: #fff;
        	background: #57a0ff;
        }
        .rwPageLis >li.rwPage_prev{
        	float: left;
        	margin-right:16px;
        }
        .rwPageLis >li.rwPage_prev>a{
        	display: block;
        	width:50px;
        	line-height: 30px;
        	text-align: center;
        	font-size: 12px;
        	color: #666;
        	background: #fff;
        	border: 1px dashed #99c1f5;
        }
        .rwPageLis >li.rwPage_next>a{
        	display: block;
        	width:50px;
        	line-height: 30px;
        	text-align: center;
        	font-size: 12px;
        	color: #666;
        	background: #fff;
        	border: 1px dashed #99c1f5;
        }
        .rwPageIntrd{
        	float: left;
        	margin-left:23px;
        	position: relative;
        	top:12px;
        	font-size: 14px;
        	color: #333333;
        }
        .rwPageIntrd >span{
        	color: #ff7900;
        }
        </style>
        <?php
        $task=Task::model()->findByPk($item->taskid);
        $taskmodel=Taskmodel::model()->findByPk($item->taskmodelid);
        $tasktime=Tasktime::model()->findByPk($item->tasktimeid);
        $product=Product::model()->findByPk($item->proid);
        $rukou=$this->liuliangrukou($task->intlet);
        $taskeval=Taskevaluate::model()->find('usertaskid='.$item->id);
        ?>
        <ul class="dtrwLis" style="font-size: 12px; margin-top:20px;">
            <li class="taskItem">
                <div class="rebh">
                    <font>任务编号</font>：<span><?php echo $item->tasksn;?>(<?=$rukou['intletarr'][$task->intlet]?>)</span>
                </div>
                <div class="allRw_pro">
                    <img src="<?php echo VERSION2;?>img/p1.jpg" alt="" title="" class="allRw_proImg" />
                    <div class="allRw_pros">
                        <div class="allRw_prosLis">
                            <div class="allRw_pro_intr clearfix">
                                <ul class="othallRw_pro clearfix">
                                    <li >任务说明：<span><?=$task->remark;?></span>
                                    </li>
                                    <li >商品名称：<span><?=$product->commodity_title;?></span>
                                    </li>
                                    <li>
                                        任务金额： <span><?php echo $taskmodel->price+$taskmodel->express;?></span>元(包含运费)
                                    </li>
                                    <li >
                                    商品佣金： <span><?php echo $taskmodel->commission;?></span>元
                                    </li>
                                    <li >
                                    买手的佣金： <span><?php echo $item->commission;?></span>元
                                    </li>
                                </ul>
                            </div><br />
                        </div>
                    </div>

                    <a class="qcrw"><?php
                        switch ($item->status){
                            case 0:echo '正在进行';break;
                            case 1:echo '待发货';break;
                            case 2:echo '确认收货';break;
                            case 3:echo '商家确认';break;
                            case 4:echo '完成订单';break;
                            case 5:echo '待评价';break;
                            case 6:echo '已评价';break;
                            case 7:echo '已完成';break;
                        }
                        ?></a>
                </div>
                <div class="clear"></div><br />
                <?php
                        $buyerinfo=Blindwangwang::model()->find('userid='.$item->userid);
                        $usermsg=User::model()->findByPk($item->merchantid);
                        $shopinfo=Shop::model()->findByPk($item->shopid);
                ?>
                <div class="takerInfo"><!--taskFunMan start-->
                    <?php if($usermsg){ ?>
					<span>商家信息：</span><?php echo $usermsg->Username;?>　<img src="<?php echo VERSION2?>img/wang.jpg" width="20" style="position: relative; top:5px;" />&nbsp;掌柜号：
                        <?php echo $shopinfo->shopname;?>　
                    <?php } else{ ?>
					<span>商家信息不存在或已被删除：</span>
					<?php } ?>
					<span style="color: red;"><?php
                        if($item->ordersn)
                            echo "订单编号：".$item->ordersn."<font style='color:#000'>(购买的订单编号)</font>";
                    ?></span>
                    <?php
                        if($buyerinfo->wangwang){
                    ?>
                    　<strong style="font-weight: bold; color:#000;">　【买号】</strong><span style="color: red; padding:0;"><?php echo $buyerinfo->wangwang;?></span>
                    <?php }?>

                </div><!--taskFunMan end-->

                <div class="introduce" style="line-height: 22px; margin-top:5px;"><!--introduce start-->
                    <?php
                        if($taskeval->content){
                    ?>
                    <p style="color: red; font-size:12px;">规定好评内容：<?php echo $taskeval->content;?></p>
                    <?php
                        }
                    ?>

                </div><!--introduce end-->
            </li>
        </ul>
        <?php
            $signKey="sywnew!@#$%20161612!#@$!@#$!@%!@";//签名key
        ?>
        <div class="detail">

            <div class="detailItem">
                【任务发布时间】：<font><?php echo date('Y-m-d H:i:s',$task->addtime);?></font>
            </div>
            <div class="detailItem">
                【接手任务时间】：<font><?php echo $item->addtime?date('Y-m-d H:i:s',$item->addtime):'暂无'?></font>
            </div>
            <div class="detailItem">
                【任务开始时间】：<font><?php echo $tasktime->start?date('Y-m-d H:i:s',$tasktime->start):'暂无'?></font>
            </div>

        </div>
        <style>
            .detail{ width: 1000px; margin: 0 auto; font-size:12px; line-height:25px;}
            .detail font{ color:red;}
            .layui-anim{ position: relative; top: 100px;}
        </style>
        <!--layer插件-->
        <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
        <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
        <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
        <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
        <script>
            $(function(){
                //商家查看接手上传截图
                $("a.bueryImg").click(function(){
                    var imgUrl=$(this).attr("alt");
                    if($(this).attr("alt")!="" && !$(this).attr("lang"))
                    {
                        if(imgUrl!="")
                        {
                            layer.open({
                                type: 1,
                                title: false,
                                closeBtn: 1,
                                area: ['1000px','50%'],
                                shadeClose: true,
                                content: '<div style="text-align:center;"><img src="'+imgUrl+'" style="max-width:100%;"></div>'
                            });
                        }
                        else
                        {
                            layer.confirm('任务还没有完成，暂无截图', {
                        		btn: ['知道了'] //按钮
                        	});
                        }
                    }
                    
                    if($(this).attr("lang")!="" && !$(this).attr("alt"))//货比与浏览店内其他商品
                    {
                        var imgUrl=$(this).attr("lang");//图片路径连接符
                        var imgSrc="";
                        var urlArr=imgUrl.split("|");
                        if(urlArr[0]!="" && urlArr.length>0)
                        {
                            imgSrc+='<div style="text-align:center;"><img src="'+urlArr[0]+'" style="max-width:100%;"></div>';
                        }
                        
                        if(urlArr[1]!="" && urlArr.length>1)
                        {
                            imgSrc+='<div style="text-align:center;"><img src="'+urlArr[1]+'" style="max-width:100%;"></div>';
                        }
                        
                        if(urlArr[2]!="" && urlArr.length>2)
                        {
                            imgSrc+='<div style="text-align:center;"><img src="'+urlArr[2]+'" style="max-width:100%;"></div>';
                        }
                        if(imgSrc!="")
                        {
                            layer.open({
                                type: 1,
                                title: false,
                                closeBtn: 1,
                                area: ['1000px','50%'],
                                shadeClose: true,
                                content: ''+imgSrc+''
                            });
                        }
                        else
                        {
                            layer.confirm('任务还没有完成，暂无截图', {
                        		btn: ['知道了'] //按钮
                        	});
                        }
                    }
                });
            })
        </script>