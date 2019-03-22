
<!-- 内容-->
<div class="sj-zjgl">
    <?php
    echo $this->renderPartial('/user/usercenterTopNav');
    $userInfo=User::model()->findByPk(Yii::app()->user->getId());
    ?>
    <div class="zjgl-right">
        <div class="sk-hygl">
            <h2 class="fprw-pt">
            </h2>
            <div class="sk1_news">
                <div class="news1_ul">
                    <ul>
                        <li id="liOne" <?php if (@$_GET['cat_id']==39 || empty($_GET['cat_id'])):?> class="cur"<?php endif;?>><a href="<?php echo $this->createUrl('other/contentindex',array('cat_id'=>39));?>">
                                违规说明</a></li>
                        <li id="liTwo"<?php if (@$_GET['cat_id']==41 ):?> class="cur"<?php endif;?>><a href="<?php echo $this->createUrl('other/contentindex',array('cat_id'=>41));?>">
                                系统公告</a></li>
                    </ul>
                </div>
                <div class="news1_list">
                    <ul class="news1_title">
                        <li class="w_530">
                            <h3>
                                标题</h3>
                        </li>
                        <li class="w_143 title_li2 tc">时间</li>
                        <li class="w_143 title_li3 tr">来自</li>
                    </ul>
                    <?php
                    foreach($list as $v){
                    ?>
                    <ul class="news2_list_ul">
                        <li class="w_530"><a href="<?php echo $this->createUrl('other/newsinfo',array('id'=>$v->goods_id));?>">
                                <span style="font-weight: bold;"><?php echo $v->goods_name;?></span>
                            </a></li>
                        <li class="w_143 tc"><?php echo date('Y-m-d H:i:s',$v->add_time);?></li>
                        <li class="w_143 tr">系统</li>
                    </ul>
                    <?php }?>

                </div>
                <div class="yyzx_1"><!--分页开始-->
                    <?php
                    $this->widget('CLinkPager', array(
                        'selectedPageCssClass'=>'active',
                        'pages' => $pages,
                        'lastPageLabel' => '最后一页',
                        'firstPageLabel' => '第一页',
                        'header' => false,
                        'nextPageLabel' => "下一页",
                        'prevPageLabel' => "上一页",
                    ));
                    ?>
                </div><!--分页结束-->


            </div>

        </div>
    </div>
</div>
<!-- 内容-->
























