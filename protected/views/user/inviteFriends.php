<!--会员中心-->
<style>
    .intbox{overflow: hidden;width: 100%;margin: 20px 0}
    .intbox dt,.intbox dd{float: left;margin-right: 10px;line-height: 30px;}
    .intbox dd input{border: solid #ddd 1px;height: 30px;padding-left: 10px;}
    .intbox botton{background: #bb0a0a;padding: 8px;color: #fff;cursor: pointer}
</style>
<link type="text/css" rel="stylesheet" href="<?php echo S_CSS;?>laydate.css">
<div class="sj-zjgl">
    <div class="sk_notice">
        <div class="notice fl w100">
            <h3>
                邀请好友说明</h3>
            <div class="ul_scroll hauto">
                <ul>
                  <li class="w100">1.推广方式--复制下方推广链接发送给好友</li>
                  <li class="w100">2.邀请好友--好友点开链接注册</li>
                  <li class="w100">3.获得返利--注册成功的好友完成任务后，您将获得推广费，推广费将发送至余额!</li>
                  <li class="w100">4.被推荐人在进行任务过程中出现了退款，差评等恶意违规行为，推荐人需<span style="color: red;">承担50%赔偿责任</span>!</li>
                </ul>
            </div>
        </div>
    </div>
    <?php
    echo $this->renderPartial('/user/usercenterTopNav');
    $userInfo=User::model()->findByPk(Yii::app()->user->getId());
    ?>
    <div class="zjgl-right">
        <div class="sk-hygl">
            <dl class="intbox">
                <dt>请输入被邀请者手机号：</dt>
                <dd><input type="text" maxlength="11" onblur="value=value.replace(/[^0-9]/g,'')" onkeyup="value=value.replace(/[^0-9]/g,'')" onpaste="value=value.replace(/[^0-9]/g,'')" value="" name="invitphon" id="invitphon"/></dd>
                <dd><botton type="botton" id="createInviteUrl">生成邀请链接</botton></dd>
            </dl>
            <div class="bddf mt20">
                <table id="urlbox" style="display: none">

                </table>
            </div>
 <script>
     $('#createInviteUrl').click(function () {
         var phon=$.trim($('#invitphon').val());
         msg='';
         if (phon.length !=11) {
             msg="手机号只能输入11位纯数字";
         }else if (!(/^1[3|4|6|5|7|8|9]\d{9}$/.test(phon))) {
             msg="手机号格式不正确";
         }
         if(msg != ''){
             $.openAlter(msg,'提示',{width:250,height:250})
         }else {
             $.post('<?=$this->createUrl('user/qrcode')?>', {phon: phon}, function (data) {
                 $('#urlbox').show();
                 $('#urlbox').html(data)
             }, 'html')
         }
     })
 </script>
            <ul style="margin-top: 20px">
                <li class="hygl-mh">
                    <p class="hygl-mh_1" style="font-size: 16px;">
                        我推荐的好友</p>
                    <!--<p id="pAddJDBuyNo">
                        <input onclick="AddJDBuyNo()" class="input-butto100-xls" type="button" value="绑定新买号"></p>-->
                </li>
            </ul>
            <div class="zjgl-right_2">
                <table>
                    <tbody><tr>
                        <th width="200">
                            用户名称
                        </th>
                        <th width="200">
                            买号名称
                        </th>
                        <th width="200">
                            买号等级
                        </th>
                        <th width="200">
                            已做任务数量
                        </th>
                    </tr>
                    <script type="text/javascript">
                        $("#pAddBuyNo").hide();
                    </script>
<?php foreach ($allfrends as $val):?>
    <?php $xy=unserialize($val['account_info']);
    $levelarr=$this->taobaoLevel();
    foreach ($levelarr as $v){
        if($xy['xy_val']>=$v[0] && $xy['xy_val']<=$v[1]){
            $level=$v[2];
        }
    }
    ?>
                        <tr>
                            <td><?=$val['username'];?></td>
                            <td><?=$val['wangwang']?></td>
                            <td><img src="<?=S_IMAGES.$level;?>.gif" title="买号的信誉值为<?=$xy['xy_val']?>"></td>
                            <td>
                                <label><?=$val['usertaskCount']?></label>
                            </td>

                        </tr>
<?php endforeach;?>
                    </tbody></table>
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
                ));
                ?>
            </div>

        </div>

    </div>
</div>
























