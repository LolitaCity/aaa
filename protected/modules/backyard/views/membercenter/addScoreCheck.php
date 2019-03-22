<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>数据分析中心</title>
		<!-- Fav and touch icons -->
		<link rel="shortcut icon" href="<?php echo ASSET_URL;?>ico/favicon.ico" type="image/x-icon" />

	    <!-- Css files -->
	    <link href="<?php echo ASSET_URL;?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>css/jquery.mmenu.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>css/climacons-font.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/xcharts/css/xcharts.min.css" rel=" stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/fullcalendar/css/fullcalendar.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/morris/css/morris.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/jquery-ui/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/jvectormap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
	    <link href="<?php echo ASSET_URL;?>css/style.min.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>css/add-ons.min.css" rel="stylesheet">

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
</head>
    <style>
        .showbox{position: absolute;width: 350px;left: -100px;top:20px;background: #fff;border-radius: 5px;border: solid 1px #ddd;z-index: 111;display: none}
        .showbox ul{padding:10px 0 10px 40px}
        .showbox li{overflow: hidden;width: 100%;padding: 2px 0;text-align: left;list-style: none;}
        .showbox li .imgbox{float: left;margin-right:20px;width: 120px;position: relative;}
        .showbox li .blackbg{position: absolute;font-size:14px;left: 0;top:0;background: rgba(0,0,0,0.5);color: #fff;width: 100%;height: 90px;z-index: 1;line-height: 90px;text-align: center}
        .showbox .btn{margin-right: 10px!important;}
        .ybtn{background:green;color: #fff}
    </style>
<body>
	<!-- start: Header -->
	<?php $this->renderPartial("/baseLayout/header");?>
	<!-- end: Header -->

	<div class="container-fluid content">

		<div class="row">

			<!-- start: Main Menu -->
			<?php $this->renderPartial("/baseLayout/mainmenu");?>
			<!-- end: Main Menu -->

		<!-- start: Content -->
		<div class="main">
            <div class="row">
            	<div class="col-lg-12">
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 用户信用加分项审核(每项审核通过将加30积分)</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>会员管理中心</li>
            		</ol>
            	</div>
            </div>
            <form method="post" action="<?php echo $this->createUrl("membercenter/addscorecheck")?>">
                <input type="text" name="keyword" placeholder="请输入用户手机号" style="text-indent: 5px; color: #666; font-size:14px; width:260px;" />　<button type="submit" class="btn btn-sm btn-success" border="0" id="reg_submit"><i class="fa fa-dot-circle-o"></i>&nbsp;搜索</button>
            </form>
            <br />
            <div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>审核列表</span>
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>会员名</th>
                                <th><div align="center">第二证件照</div></th>
                                <th><div align="center">支付宝绑定手机号</div></th>
                                <th><div align="center">芝麻信用分</div></th>
                                <th><div align="center">上传生活照</div></th>
                                <th><div align="center">QQ资料</div></th>
                                <th><div align="center">紧急联系人信息</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($proInfo as $item){
                                    $usermsg=User::model()->findByPk($item->userid);
                            ?>
                            <tr style="color:#666;">
                                <td><?php echo @$usermsg->Username;?></td>
                                <td><div align="center" style="position: relative">
                                        <a style="cursor: pointer;" onclick="$(this).next().next().show()">查看</a>
                                        <?php if (!empty($item->secondCard)){$secondcard=unserialize($item->secondCard);?>
                                        <?php if ($secondcard['status']=='已通过'):?>
                                        <font color="green">已通过</font>
                                         <?php else:?>
                                         <font color="red"><?=$secondcard['status']?></font>
                                        <?php endif;?>
                                        <div class="showbox"><form method="post" action="<?php echo $this->createUrl('membercenter/addscorecheck')?>">
                                                <input type="hidden" name="asid" value="<?=$item->id;?>"/>
                                                <input type="hidden" name="filedname" value="secondCard"/>
                                                <input type="hidden" name="userid" value="<?=$item->userid;?>"/>
                                            <ul>
                                                <li >
                                                    <p class="imgbox"><img width="120" height="90" src="<?=$secondcard['img1'];?>"/><a target="_blank" href="<?=$secondcard['img1'];?>" class="blackbg">点击查看大图</a></p>
                                                    <p class="imgbox"><img width="120" height="90" src="<?=$secondcard['img2'];?>"/><a target="_blank" href="<?=$secondcard['img2'];?>" class="blackbg">点击查看大图</a></p> </li>
                                                <li >
                                                    <textarea name="msg" rows="3" cols="40" placeholder="不通过请输入原因,请控制在20字以内"><?=$secondcard['msg'];?></textarea>
                                                </li>
                                                <li >
                                                    <?php if ($secondcard['status']!='已通过'):?>
                                                    <input type="submit" value="通过" name="pass" class="btn ybtn"/>
                                                    <input type="button" value="不通过" onclick="checkmsg(this)" name="unpass" class="btn nbtn"/>
                                                    <?php endif;?>
                                                    <input type="button" class="btn nbtn" onclick="$(this).parents('.showbox').hide()" value="取消">
                                                </li>
                                            </ul>
                                            </form></div>
                                    <?php }?>
                                    </div></td>
                                <td><div align="center" style="position: relative">
                                        <a style="cursor: pointer;" onclick="$(this).next().next().show()">查看</a>
                                        <?php if (!empty($item->taobaoinfo)){$taobaoinfo=unserialize($item->taobaoinfo);?>
                                            <?php if ($taobaoinfo['status']=='已通过'):?>
                                                <font color="green">已通过</font>
                                            <?php else:?>
                                                <font color="red"><?=$taobaoinfo['status']?></font>
                                            <?php endif;?>
                                            <div class="showbox"><form method="post" action="<?php echo $this->createUrl('membercenter/addscorecheck')?>">
                                                    <input type="hidden" name="asid" value="<?=$item->id;?>"/>
                                                    <input type="hidden" name="filedname" value="taobaoinfo"/>
                                                    <input type="hidden" name="userid" value="<?=$item->userid;?>"/>
                                                    <ul>
                                                        <li >
                                                            <p class="imgbox"><img width="120" height="90" src="<?=$taobaoinfo['img1'];?>"/>
                                                                <a target="_blank" href="<?=$taobaoinfo['img1'];?>" class="blackbg">点击查看大图</a></p>

                                                        <li >
                                                            <p>淘宝账户：<?=$taobaoinfo['taobaoname'];?></p>
                                                        </li>
                                                        <li >
                                                            <p>绑定手机：<?=$taobaoinfo['alipaytel'];?></p>
                                                        </li>
                                                        <li >
                                                            <textarea name="msg" rows="3" cols="40" placeholder="不通过请输入原因,请控制在20字以内"><?=$taobaoinfo['msg'];?></textarea>
                                                        </li>
                                                        <li >
                                                            <?php if ($taobaoinfo['status']!='已通过'):?>
                                                                <input type="submit" value="通过" name="pass" class="btn ybtn"/>
                                                                <input type="button" value="不通过" onclick="checkmsg(this)" name="unpass" class="btn nbtn"/>
                                                            <?php endif;?>
                                                            <input type="button" class="btn nbtn" onclick="$(this).parents('.showbox').hide()" value="取消">
                                                        </li>
                                                    </ul>
                                                </form></div>
                                        <?php }?>
                                    </div></td>
                                <td><div align="center" style="position: relative">
                                        <a style="cursor: pointer;" onclick="$(this).next().next().show()">查看</a>
                                        <?php if (!empty($item->zhimainfo)){$zhimainfo=unserialize($item->zhimainfo);?>
                                            <?php if ($zhimainfo['status']=='已通过'):?>
                                                <font color="green">已通过</font>
                                            <?php else:?>
                                                <font color="red"><?=$zhimainfo['status']?></font>
                                            <?php endif;?>
                                            <div class="showbox"><form method="post" action="<?php echo $this->createUrl('membercenter/addscorecheck')?>">
                                                    <input type="hidden" name="asid" value="<?=$item->id;?>"/>
                                                    <input type="hidden" name="filedname" value="zhimainfo"/>
                                                    <input type="hidden" name="userid" value="<?=$item->userid;?>"/>
                                                    <ul>
                                                        <li >
                                                            <p class="imgbox"><img width="120" height="90" src="<?=$zhimainfo['img1'];?>"/>
                                                                <a target="_blank" href="<?=$zhimainfo['img1'];?>" class="blackbg">点击查看大图</a></p>

                                                        <li >
                                                            <p>支付宝实名姓名：<?=$zhimainfo['alipayrealname'];?></p>
                                                        </li>
                                                        <li >
                                                            <p>芝麻信用分：<?=$zhimainfo['sesamecredit'];?></p>
                                                        </li>
                                                        <li >
                                                            <textarea name="msg"  rows="3" cols="40" placeholder="不通过请输入原因,请控制在20字以内"><?=$zhimainfo['msg'];?></textarea>
                                                        </li>
                                                        <li >
                                                            <?php if ($zhimainfo['status']!='已通过'):?>
                                                                <input type="submit" value="通过" name="pass" class="btn ybtn"/>
                                                                <input type="button" value="不通过" onclick="checkmsg(this)" name="unpass" class="btn nbtn"/>
                                                            <?php endif;?>
                                                            <input type="button" class="btn nbtn" onclick="$(this).parents('.showbox').hide()" value="取消">
                                                        </li>
                                                    </ul>
                                                </form></div>
                                        <?php }?>
                                    </div></td>
                                <td><div align="center" style="position: relative">
                                        <a style="cursor: pointer;" onclick="$(this).next().next().show()">查看</a>
                                        <?php if (!empty($item->lifephoto)){$lifephoto=unserialize($item->lifephoto);?>
                                            <?php if ($lifephoto['status']=='已通过'):?>
                                                <font color="green">已通过</font>
                                            <?php else:?>
                                                <font color="red"><?=$lifephoto['status']?></font>
                                            <?php endif;?>
                                            <div class="showbox"><form method="post" action="<?php echo $this->createUrl('membercenter/addscorecheck')?>">
                                                    <input type="hidden" name="asid" value="<?=$item->id;?>"/>
                                                    <input type="hidden" name="filedname" value="lifephoto"/>
                                                    <input type="hidden" name="userid" value="<?=$item->userid;?>"/>
                                                    <ul>
                                                        <li >
                                                            <p class="imgbox"><img width="120" height="90" src="<?=$lifephoto['img1'];?>"/>
                                                                <a target="_blank" href="<?=$lifephoto['img1'];?>" class="blackbg">点击查看大图</a></p>
                                                        <li >
                                                            <textarea name="msg"  rows="3" cols="40" placeholder="不通过请输入原因,请控制在20字以内"><?=$zhimainfo['msg'];?></textarea>
                                                        </li>
                                                        <li >
                                                            <?php if ($lifephoto['status']!='已通过'):?>
                                                                <input type="submit" value="通过" name="pass" class="btn ybtn"/>
                                                                <input type="button" value="不通过" onclick="checkmsg(this)" name="unpass" class="btn nbtn"/>
                                                            <?php endif;?>
                                                            <input type="button" class="btn nbtn" onclick="$(this).parents('.showbox').hide()" value="取消">
                                                        </li>
                                                    </ul>
                                                </form></div>
                                        <?php }?>
                                    </div></td>
								<td><div align="center" style="position: relative">
                                        <a style="cursor: pointer;" onclick="$(this).next().next().show()">查看</a>
                                        <?php if (!empty($item->qqinfo)){$qqinfo=unserialize($item->qqinfo);?>
                                            <?php if ($qqinfo['status']=='已通过'):?>
                                                <font color="green">已通过</font>
                                            <?php else:?>
                                                <font color="red"><?=$qqinfo['status']?></font>
                                            <?php endif;?>
                                            <div class="showbox"><form method="post" action="<?php echo $this->createUrl('membercenter/addscorecheck')?>">
                                                    <input type="hidden" name="asid" value="<?=$item->id;?>"/>
                                                    <input type="hidden" name="filedname" value="qqinfo"/>
                                                    <input type="hidden" name="userid" value="<?=$item->userid;?>"/>
                                                    <ul>
                                                        <li >
                                                            <p class="imgbox"><img width="120" height="90" src="<?=$qqinfo['img1'];?>"/>
                                                                <a target="_blank" href="<?=$qqinfo['img1'];?>" class="blackbg">点击查看大图</a></p>
                                                        </li >
                                                        <li >
                                                            <p>Q龄：<?=$qqinfo['qqage'];?></p></li>
                                                        <li >
                                                            <textarea name="msg"  rows="3" cols="40" placeholder="不通过请输入原因,请控制在20字以内"><?=$zhimainfo['msg'];?></textarea>
                                                        </li>
                                                        <li >
                                                            <?php if ($qqinfo['status']!='已通过'):?>
                                                                <input type="submit" value="通过" name="pass" class="btn ybtn"/>
                                                                <input type="button" value="不通过" onclick="checkmsg(this)" name="unpass" class="btn nbtn"/>
                                                            <?php endif;?>
                                                            <input type="button" class="btn nbtn" onclick="$(this).parents('.showbox').hide()" value="取消">
                                                        </li>
                                                    </ul>
                                                </form></div>
                                        <?php }?>
                                    </div></td>
                                <td><div align="center" style="position: relative">
                                        <a style="cursor: pointer;" onclick="$(this).next().next().show()">查看</a>
                                        <?php if (!empty($item->urgentinfo)){$urgentinfo=unserialize($item->urgentinfo);?>
                                            <?php if ($urgentinfo['status']=='已通过'):?>
                                                <font color="green">已通过</font>
                                            <?php else:?>
                                                <font color="red"><?=$urgentinfo['status']?></font>
                                            <?php endif;?>
                                            <div class="showbox"><form method="post" action="<?php echo $this->createUrl('membercenter/addscorecheck')?>">
                                                    <input type="hidden" name="asid" value="<?=$item->id;?>"/>
                                                    <input type="hidden" name="filedname" value="urgentinfo"/>
                                                    <input type="hidden" name="userid" value="<?=$item->userid;?>"/>
                                                    <ul>
                                                        <li >
                                                            <p>紧急联系人姓名：<?=$urgentinfo['urgentname'];?></p></li>
                                                        <li >
                                                        <li >
                                                            <p>紧急联系人电话：<?=$urgentinfo['tel'];?></p></li>
                                                        <li >
                                                        <li >
                                                            <p>与紧急联系人关系：<?=$urgentinfo['relationship'];?></p></li>
                                                        <li >
                                                            <textarea name="msg"  rows="3" cols="40" placeholder="不通过请输入原因,请控制在20字以内"><?=$urgentinfo['msg'];?></textarea>
                                                        </li>
                                                        <li >
                                                            <?php if ($urgentinfo['status']!='已通过'):?>
                                                                <input type="submit" value="通过" name="pass" class="btn ybtn"/>
                                                                <input type="button" value="不通过" onclick="checkmsg(this)" name="unpass" class="btn nbtn"/>
                                                            <?php endif;?>
                                                            <input type="button" class="btn nbtn" onclick="$(this).parents('.showbox').hide()" value="取消">
                                                        </li>
                                                    </ul>
                                                </form></div>
                                        <?php }?>
                                    </div></td>
                             </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                </table>

                <?php
                    if(isset($pages)){
                ?>
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
                </div><!--分页结束-->
                <?php }?>
          </div><!--theBody end-->
            <div class="clear"></div>
		</div>
		<!-- end: Content -->
		<br><br><br>


		<!-- start: usage -->
		<?php $this->renderPartial("/baseLayout/usage");?>
		<!-- end: usage Menu -->

	</div><!--/container-->


	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Warning Title</h4>
				</div>
				<div class="modal-body">
					<p>Here settings can be configured...</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="clearfix"></div>


	<!-- start: JavaScript-->
	<!--[if !IE]>-->

			<script src="<?php echo ASSET_URL;?>js/jquery-2.1.1.min.js"></script>

	<!--<![endif]-->

	<!--[if IE]>

		<script src="<?php echo ASSET_URL;?>js/jquery-1.11.1.min.js"></script>

	<![endif]-->

	<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo ASSET_URL;?>js/jquery-2.1.1.min.js'>"+"<"+"/script>");
		</script>

	<!--<![endif]-->

	<!--[if IE]>

		<script type="text/javascript">
	 	window.jQuery || document.write("<script src='<?php echo ASSET_URL;?>js/jquery-1.11.1.min.js'>"+"<"+"/script>");
		</script>

	<![endif]-->
	<script src="<?php echo ASSET_URL;?>js/jquery-migrate-1.2.1.min.js"></script>
	<script src="<?php echo ASSET_URL;?>js/bootstrap.min.js"></script>


	<!-- page scripts -->
	<script src="<?php echo ASSET_URL;?>plugins/jquery-ui/js/jquery-ui-1.10.4.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/moment/moment.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/fullcalendar/js/fullcalendar.min.js"></script>
	<!--[if lte IE 8]>
		<script language="javascript" type="text/javascript" src="<?php echo ASSET_URL;?>plugins/excanvas/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.stack.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.time.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.spline.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/xcharts/js/xcharts.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/autosize/jquery.autosize.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/placeholder/jquery.placeholder.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/datatables/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/raphael/raphael.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/morris/js/morris.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/jvectormap/js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/jvectormap/js/gdp-data.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/gauge/gauge.min.js"></script>


	<!-- theme scripts -->
	<script src="<?php echo ASSET_URL;?>js/SmoothScroll.js"></script>
	<script src="<?php echo ASSET_URL;?>js/jquery.mmenu.min.js"></script>
	<script src="<?php echo ASSET_URL;?>js/core.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/d3/d3.min.js"></script>

	<!-- inline scripts related to this page -->
	<script src="<?php echo ASSET_URL;?>js/pages/index.js"></script>

	<!-- end: JavaScript-->
	<!--layer插件-->

	<script>
        function checkmsg(o) {
            var msg=$(o).parents('.showbox').find('textarea').val();
            if(msg==null || msg==''){
                alert('请输入不通过原因');
                return false;
            }
                $(o).parents('form').submit();

        }

	</script>

</body>
</html>