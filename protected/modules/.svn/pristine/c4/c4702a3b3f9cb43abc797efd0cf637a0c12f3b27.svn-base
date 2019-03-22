<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link href="<?=M_CSS_URL;?>common2.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>css.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>weui.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>CustomCss.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>open.win.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>open.win.js" type="text/javascript"></script>
	
    <script src="<?=M_JS_URL;?>TouchSlide.1.1.js" type="text/javascript"></script>
    <link href="<?=M_CSS_URL;?>pagination.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>style.css" rel="stylesheet" type="text/css">
    <link href="<?=M_CSS_URL;?>style(1).css" rel="stylesheet" type="text/css">
    <script language="javascript">
        $(function () {
            $("#tabBox2 li").click(function () {
                var type = $(this).attr("name");
                  location.href = "/mobile/task/evaltasklist/type/" + type+'.html';
            });
            var type = '<?=@$_GET['type']?>';
            $("#tabBox2 li").each(function (e, item) {
                if ($(item).attr("name") == type) {
                    $("#tabBox2 li").removeClass("on");
                    $(item).addClass("on");
                }
            });
        })
    </script>
    <style type="text/css">
        .cncont h3
        {
            font-size: 12px;
            margin-top: 1%;
            border-top: 1px dashed #ccc;
            color: #737373;
        }
    </style>


</head>
<body>
    <div class="cm" style="padding-bottom: 50px;" id="bigbox" title="评价任务">
         <?php $this->renderPartial("/public/header");?>

        <!--待评价-->
        <div class="Coupon" id="tabBox1">
            <div id="tabBox2" class="cntab hd">
                <ul>
                    
                    <li name="0" class="on">待评价</li>
                    <li name="1">待审核</li>
                    <li name="2">评价完成</li>
                    <!--<li name="4">审核通过</li>-->
                </ul>
            </div>
            <div id="changebox">
                <div class="cncontbox bd" id="tabBox1-bd">
   <!-- 待评价 -->
                        <div class="con">
                            <ul class="cncont cncont_2">
                                    
									<?php foreach ($evallist as $val):?>
									<li>
                                        <h5 class="hxt">
                                        </h5>
                                    </li>
                                    <li>
                                        <h2> <?php
                                        switch ($val['doing']){
                                            case 0:echo '待评价';break;
                                            case 1;echo '待审核';break;
                                            case 2;echo '评价完成';break;
                                            case 3;echo '已拒绝评价';break;
                                        }
                                        ?></h2>
                                        <dl>
										<?php
											$usertask=Usertask::model()->findByPk($val['usertaskid']);
											$product=Product::model()->findByPk($usertask->proid);
										?>
                                                <a href="<?=$this->createUrl('task/evaltasktest',array('usertaskid'=>$val['usertaskid']));?>">
                                                    <dt>
                                                        <img width="106px" height="107px" src="<?=@$product->commodity_image;?>"></dt>
                                                    <dd>
                                                        购物平台：<b>淘宝</b></dd>
                                                    <dd>
                                                        订单编号：<?=$val['ordersn']?></dd>
                                                    <dd>
                                                        店铺名称：<?=$this->substr_cut($val['shopname'])?></dd>
                                                    <dd>
                                                        任务类型：<?=($val['status']==1?'晒图好评':'文字好评');?></dd>
                                                </a>
                                        </dl>
                                        <h3>
                                                <span>佣金：￥<b><?=$val['iscommission']?></b> 元</span>
                                        </h3>
                                    </li>
									<?php endforeach;?>
                            </ul>
                        </div>
                </div>
            </div>
        </div>
		            <div class="yyzx_1">
                <?php
                $this->widget('CLinkPager', array(
                    'selectedPageCssClass'=>'active',
                    'pages' => $pages,
                    'lastPageLabel' => '最后一页',
                    'firstPageLabel' => '第一页',
                    'header' => false,
                    'nextPageLabel' => "下一页",
                    'prevPageLabel' => "上一页",
					'maxButtonCount'=>5,
                ));
                ?>
            </div>
		
        <!--待评价-->
    </div>
   <?php $this->renderPartial("/public/footer");?>  

</body></html>