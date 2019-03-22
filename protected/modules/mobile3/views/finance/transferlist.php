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
    
    <link href="<?=M_CSS_URL;?>pagination.css" rel="stylesheet" type="text/css">
    <script src="<?=M_JS_URL;?>CustomFunc.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>md5.js" type="text/javascript"></script>
    <script src="<?=M_JS_URL;?>TouchSlide.1.1.js" type="text/javascript"></script>
    <script language="javascript">
        $(function () {
            $("#tabBox2 li").click(function () {
                var type = $(this).attr("name");
                  location.href = "/mobile/finance/transferlist/type/" + type+'.html';
            });
            var type = '<?=@$_GET['type'];?>';
            $("#tabBox2 li").each(function (e, item) {
                if ($(item).attr("name") == type) {
                    $("#tabBox2 li").removeClass("on");
                    $(item).addClass("on");
                }
            });
        })
            function msg() {
            $.openAlter("<div style=\"text-align:left\">亲，平台已收到您的反馈。管理员会火速提醒商家进行转账，请耐心等待。</div>", "提示", null, null, "好的");
        }
    </script>
    <style>
        /*提现列表*/
        .cash_list
        {
            display: inline-block;
            width: 94%;
            padding: 0px 3%;
            border-bottom: 1px solid #ddd;
            height: 40px;
            line-height: 40px;
        }
        .cash_list li
        {
            width: 20%;
            float: left;
            text-align: center;
        }
        .cash_list li.on
        {
            border-bottom: 2px solid #f90;
            color: rgb(255, 153, 0);
        }
        .cash_list li.on a
        {
            color: #f90;
        }
        .cash_list_none
        {
            text-align: center;
            color: red;
            height: 45px;
            line-height: 45px;
        }
        .Coupon
        {
            overflow: hidden;
            min-height: 500px;
            background: #fff;
        }
    </style>
    <style>
        /*买家提现*/
        .hxt_x
        {
            height: 6px;
            background: #f2f2f2;
        }
        .t_red
        {
            color: red;
        }
        .cashb_1
        {
            height: 70px;
            position: relative;
        }
        .cashb_1 span
        {
            margin: 15px 15px 0px 0px;
        }
        .cashb1_span
        {
            width: 40px;
            height: 40px;
            float: left;
        }
        .cashb1_span img
        {
            width: 100%;
            float: left;
        }
        .cashb_1 dl
        {
            width: 50%;
            display: flex;
            justify-content: center;
            flex-direction: column;
            height: 70px;
        }
        .cashb_1 dt
        {
            color: #999;
        }
        .cashb_1 p
        {
            position: absolute;
            right: 0px;
            top: 28px;
            right: 3%;
        }
        .cashb_1 p a
        {
            width: 64px;
            height: 27px;
            line-height: 27px;
            text-align: center;
            float: right;
            background: #f90;
            border-radius: 16px;
            color: #fff;
        }
        .cashb_2
        {
            height: 40px;
        }
        .cashb_2 h3
        {
            height: 40px;
            line-height: 40px;
            float: left;
            width: 80%;
            margin-left: 15px;
        }
        .cashb_2 h3 em
        {
            float: right;
            width: 25px;
            height: 25px;
            margin-top: 8px;
        }
        .cashb_2 h3 em img
        {
            width: 100%;
        }
        .cashb_2 h3 a
        {
            font-family: "宋体";
            font-size: 18px;
            color: #457ee8;
            font-weight: bold;
        }
        .cashb_3
        {
            height: 43px;
            border-bottom: 1px #ddd dashed;
        }
        .cashb_4
        {
            border-bottom: 1px #ddd dashed;
        }
        .cashb_4 h3
        {
            color: #999;
        }
        .cashb4_ul
        {
            margin-top: 10px;
        }
        .cashb4_ul li
        {
            margin-bottom: 8px;
            display: inline-block;
            width: 100%;
        }
        .cashb4_ul dt
        {
            color: #457ee8;
        }
        .cashb4_ul em
        {
            width: 20px;
            margin-top: 5px;
            height: 20px;
            background: #ddd;
            text-align: center;
            line-height: 20px;
            color: #fff;
            float: left;
        }
        .cashb4_ul dl
        {
            float: right;
            width: 90%;
        }
        .cashb4_ul dt
        {
            margin-bottom: 5px;
        }
        .cashb4_ul dd
        {
            line-height: 15px;
        }
        
        
        .cashb_quest
        {
            height: 20px;
        }
        .cashb_quest a
        {
            float: left;
            margin-right: 5px;
        }
        .pad_4_3
        {
            padding: 4% 3%;
        }
        .quest_icon
        {
            border: 1px solid red;
            border-radius: 100%;
            width: 15px;
            height: 15px;
            color: red;
            text-align: center;
            line-height: 15px;
            float: left;
        }
        .quest_icon a
        {
            float: left;
        }
        .tab_list_1
        {
            display: flex;
            flex-direction: row;
            height: 50px;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            word-break: break-all;
        }
        .tab_title
        {
            display: flex;
            flex-direction: row;
            width: 75%;
        }
        .span_icon img
        {
            width: 38px;
            height: 38px;
            margin-right: 10px;
        }
        .tab_title li b
        {
            font-size: 15px;
            font-weight: normal;
        }
        .tab_title li
        {
            color: #222;
        }
        .tab_title h3
        {
            color: #888;
            margin-bottom: 5px;
        }
        .tab_state
        {
            height: 43px;
            font-size: 12px;
            text-align: right;
            width: 27%;
        }
        .tab_state span
        {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            margin-bottom: 12px;
        }
        .tab_state em
        {
            width: 6px;
            height: 6px;
            display: block;
            margin-top: 6px;
            margin-right: 6px;
            border-radius: 100%;
        }
        .bder_f90
        {
            border-radius: 3px;
            border: 1px solid #f90;
            color: #f90;
            padding: 5px;
            font-size: 12px;
        }
        
        .t_33cc00
        {
            color: #33cc00;
        }
        
        .display_bg
        {
            background: #000;
            opacity: .1;
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            display: none;
        }
        .dis_black_tc
        {
            display: none;
            position: absolute;
            z-index: 888;
            background: #fff;
            width: 90%;
            border-radius: 5px;
            left: 5%;
            margin-top: -10px;
            line-height: 25px;
            border: 1px solid #f90;
        }
        .dis_black_tc > em
        {
            background: url(../f90_jt_dowm.png) no-repeat;
            display: block;
            width: 12px;
            height: 7px;
            position: absolute;
            top: -7px;
            left: 85px;
        }
        .cash_all
        {
            border-left: 4px solid #447eea;
        }
        .bgfff
        {
            background: #fff;
        }
        .Withdrawals
        {
            border-top: 1px solid #f0f0f2;
            line-height: 23px;
        }
        .jsgl_pt_1 a
        {
            width: 90px;
            height: 28px;
            line-height: 28px;
            text-align: center;
            background: #fea33a;
            display: block;
            color: #fff;
            border-radius: 15px;
        }
        .Withdrawals_1
        {
            margin-top: 5px;
        }
        
        .hxt
        {
            clear: both;
        }
        .invitingfr ul
        {
            border-bottom: 1px solid #eee;
            height: 36px;
        }
        .invitingfr li
        {
            width: 16.63%;
            float: left;
            text-align: center;
            font-size: 12px;
            height: 35px;
            line-height: 35px;
        }
        .invitingfr li.on
        {
            border-bottom: 2px solid #f90;
            color: #f90;
        }
        #changebox
        {
            clear: both;
        }
        .annh4 a
        {
            border-radius: 5px;
            width: 120px;
            height: 30px;
            line-height: 30px;
            display: block;
            text-align: center;
            margin: 10px 0px;
        }
        #totop
        {
            width: 1.28rem;
            height: 1.267rem;
            background: url(../images/totop.png) no-repeat;
            background-size: 100% 100%;
            display: none;
            position: fixed;
            right: 0.133rem;
            bottom: 1.5rem;
            cursor: pointer;
        }
        
      .not_date{text-align:center;}
        .not_date img{width:35%; margin:10% auto 0;}
    </style>

</head>
<body>
    <div class="cm" style="padding-bottom: 50px;" id="bigbox" title="本金提现">
        <?php $this->renderPartial("/public/header");?>
        
    <!--系统提现管理-->
    <div>
        <h2 class="Return pad_2_3 jsgl_pt_1">
            <a href="<?=$this->createUrl('finance/selleroutcash');?>">返回</a></h2>
        <div class="tixian pad_2_3">
            <p>
                表格只记录近30天的提现订单，完整提现记录请登录电脑端查看。点击提现状态可查看订单的详情。
            </p>
        </div>
        <div class="hxt">
        </div>
    </div>
    
    <!-- 222 -->
    <div class="bgfff Withdrawals_1" id="tabBox1">
        <div id="tabBox2" class="invitingfr hd">
            <ul>
                <li name="all" class="on">全部</li>
                <li name="1">等待转账</li>
                <li name="2">已转账</li>
                <li name="0">未转账</li>
                <li name="3">转账失败</li>
                <li name="4">未到账</li>
            </ul>
        </div>
        <div id="changebox">
		
            <div class="cncontbox bd" id="tabBox1-bd">
                    <div class="con">
                        <div class="With_tab">
                             <?php foreach ($list as $v):?>   
							 <?php
				if ($v['arrivestatus']==0) {
					switch ($v['transferstatus']) {
						case 0:
							$status= '未转账';$imgsn=1;
							break;
						case 1:
							$status= '等待转账';$imgsn=4;
							break;
						case 2:
							$status= '已转账';$imgsn=2;
							break;
						case 3:
							$status= '转账失败';$imgsn=3;
							break;
						case 4:
							$status= '未到账';$imgsn=5;
							break;
					}
				}else{
					$status= '已到账';$imgsn=2;
				}
            ?>
                                <a href="<?=$this->createUrl('finance/lookinfo',array('utaskid'=>$v['utaskid']))?>">
                                    <div class="tab_list_1 pad_4_3">
                                        <div class="tab_title">
                                            <span class="span_icon">
                                                <img src="<?=M_IMG_URL?>icon_z<?=$imgsn?>.png"></span>
                                            <ul>
                                                <li>
                                                   <h3 style="width: 210px;">
                                                        订单编号：<?=$v['osn']?></h3>
                                                </li>
                                                <li>
                                                    <p>
                                                        ￥<b><?=$v['orderprice']?></b> 元</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab_state">
                                            <span class="t_33cc00"><?=$status;?></span>
                                        </div>
                                    </div>
                                </a>
								<?php endforeach;?>
                        </div>
                    </div>
                
            </div>
  

        </div>
    </div>
    <!-- 222 -->
    <!-- 卖家提现须知 -->
    
    <!--系统提现管理-->
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
    </div>
<?php $this->renderPartial("/public/footer");?>	


</body></html>