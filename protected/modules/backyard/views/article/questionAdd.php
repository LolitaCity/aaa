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

<body>
<!-- start: Header -->
<?php $this->renderPartial("/baseLayout/header");?>
<!-- end: Header -->
<style>.input250{width: 250px}</style>
<div class="container-fluid content">

    <div class="row">

        <!-- start: Main Menu -->
        <?php $this->renderPartial("/baseLayout/mainmenu");?>
        <!-- end: Main Menu -->

        <!-- start: Content -->
        <div class="main">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> 添加文档</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
                        <li><i class="fa fa-laptop"></i>文档管理系统</li>
                    </ol>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>
                        接手问答-文档修改</span>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="clear"></div>
                    <div class="theBody"><!--theBody start-->
                        <div class="filledForm" style="margin-top: 10px;"><!--filledForm start-->
                            <form method="post" action="<?php echo $this->createUrl('article/questionadd');?>" class="addAdmin">
                                <table border="0" cellspacing="0" cellpadding="0" style="width:800px; height:auto; color:#666; line-height:40px; font-size:12px;">
                                    <tbody><tr>
                                        <td width="100">问答分类:</td>
                                        <td width="255"><input type="text" value="<?php echo @$detail['question_type'];?>" name="typename" class="inputxt" datatype="s1-100" nullmsg="请输入栏目名称！" errormsg="至少1个字符！"></td>
                                        <td width="561"></td>
                                    </tr>

                                    <tr class="addrow">
                                        <td >问题:</td>
                                        <td ><input type="text" style="height: 30px;line-height: 30px" placeholder="请输入问题名称" name="question[0]" class="input250" value="" /></td>
                                        <td ><textarea style="line-height: 20px" rows="4" cols="80" placeholder="请输入问题答案" name="content[0]"></textarea>
                                            <a style="display: inline-block;margin-left:10px;cursor: pointer" id="addline">添加+</a></td>
                                    </tr>
                                    <?php if (@$detail['question_content']){
                                        foreach (@$detail['question_content'] as $k=>$v){
                                        ?>
                                        <tr class="chidrow"><td >问题<?php echo $k+1;?>:</td>
                                        <td ><input type="text" style="height: 30px;line-height: 30px" placeholder="请输入问题名称" name="question[<?php echo $k+1;?>]" class="input250" value="<?php echo $v->title;?>" /></td>
                                                <td ><textarea style="line-height: 20px" rows="4" cols="80" placeholder="请输入问题答案" name="content[<?php echo $k+1;?>]"><?php echo $v->answer;?></textarea>
                                                    <a style="display: inline-block;margin-left:10px;cursor: pointer" onclick="delrow(this)">删除-</a>
                                                    </td></tr>

                                        <?php }}?>
                                    <tr>
                                        <td >是否展示:</td>
                                        <td >
                                            <label><input type="radio" value="1" <?php if (@$detail['statue']==1 || empty($detail))echo 'checked';?>  name="statue" class="inputxt" >显示</label>
                                            <label><input type="radio" value="0" <?php if (@$detail['statue']==0 && !empty($detail))echo 'checked';?>  name="statue" class="inputxt" >不显示</label>
                                        </td>
                                        <td ></td>
                                    </tr>
                                    <tr>
                                        <td >排序:</td>
                                        <td >
                                            <input type="text" placeholder="请填写数字" value="<?php echo @$detail['order'];?>"   name="order" class="inputxt" >数字越小越靠前(1-6)

                                        </td>
                                        <td ></td>
                                    </tr>

                                    <tr>
                                        <td><div align="center"></div></td>
                                        <td><input type="submit" value="确认提交" class="btn btn-sm btn-success" border="0"/></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    </tbody></table>
                                <?php if (@$detail){?><input type="hidden" name="qid" value="<?php echo @$detail['id'];?>"/><?php }?>
                            </form>
                        </div>
                    </div><!--theBody end-->
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <!-- end: Content -->
<script>
    $('#addline').click(function () {
        var k=$('.chidrow').length;
        var key=k+1;
        var str='<tr class="chidrow"><td >问题'+key+':</td>' +
            '<td ><input style="height: 30px;line-height: 30px" placeholder="请输入问题名称" name="question['+key+']" class="" value="" /></td>' +
            '<td ><textarea style="line-height: 20px" rows="4" cols="80" placeholder="请输入问题答案" name="content['+key+']"></textarea>' +
            '<a style="display: inline-block;margin-left:10px;cursor: pointer" onclick="delrow(this)">删除-</a>' +
            '</td></tr>';
        if(k==0){
            $(this).parents('tr').after(str)
        }else {
            $('.chidrow').eq(k-1).after(str)
        }

    })
    function delrow(o) {
        $(o).parents('tr').remove();
    }
</script>


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





</body>
</html>