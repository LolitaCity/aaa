
<!-- 内容-->
<div class="sj-zjgl">
    <?php   echo $this->renderPartial('/finance/leftNav');  ?>
    <form action="<?php echo $this->createUrl('finance/takeoutcash');?>"
		id="fm" method="post">
		<div class="zjgl-right">

			<div class="sk-zjgl">
				<div class="zjgl_lt fl">
					<ul>
                           <?PHP if(empty($outcashfull) || $outcashfull ==""){ ?>
						<li>
							<p style="width: 84px; text-align: right;">金币：</p> <span
							id="spPoint"><?php echo $userinfo->Money;?></span> 金币 <span
							style="color: Red; margin-left: 5px"> <a href="" target="_blank"
								style="color: Red;"><u>其中<?=$danbaojin->value?>金币为账户担保金</u></a></span>
						</li>
						<li>
							<p style="width: 84px; text-align: right;">金币兑换：</p>
							<p>
								<input type="text" name="money" class="input_62"
									id="txtSpendPoint"">
							</p>

						</li>

						<li>
							<p style="width: 84px; text-align: right;">提现方式：</p>
							<p style="margin-right: 155px; float: right">
								<input type="radio" name="tixianfanshi" value="1"
									checked="checked"><label> 银行卡</label>
							</p>

						</li>

						<!--银行卡-->
						<div class="yinhangka" id="yinhangka" style="display: block;">
							<li class="txsq">
								<p style="width: 84px; text-align: right;">选择银行卡：</p>
								<p>
									<select id="selBankList" name="bankname" style="height: 30px">
										<option selected="selected" value="">请选择银行卡号</option>
                                        <?php foreach ($banklist as $value):?>
                                        <option
											value="<?=$value->bankAccount?>"><?=$value->bankName.'  '.$value->bankAccount;?></option>
                                        <?php endforeach;?>
                                    </select>
								</p>
							</li>
						</div>
						<!--银行卡-->
						
						<?PHP if($userinfo->alloutcash == 1){ ?>
						<li>
							<p style="color: red;">
								使用全额提现你的账号将会被冻结将无法进行任务等其他操作
							</p>
						</li>
						<li>
							<p>
								<div style="border-radius:10px;background-color: crimson;width: 60px;height: 25px;color:#fff" onclick="Takeoutcashall()">全额提现</div>
							</p>
						</li>
						<?PHP }else{?>
                        <li>
							<p>
								<input onclick="ExchangeMoney()" class="input-butto62-zhs" type="button" value="确认提现">
							</p>
						</li>
						<?PHP }?>
						<?PHP }else{ ?> 
						<li>
							<p style="color: red;">
								<sqan style="color:red">尊敬的会员，你的全额提现清单：<br>提现到银行卡：<?PHP echo $outcashfull[0]['bankaccount'];?>，<BR>被提现的总金额为：<?PHP echo $outcashfull[0]['money'];?>，<BR>提现进度：<?PHP echo $outcashfull[0]['status'];?>,<BR>提交时间：<?PHP echo  date('Y-m-d',$outcashfull[0]['addtime'])?></sqan>
							</p>
						</li>
						<?PHP }?>
					</ul>
				</div>
				<div class="zjgl_fr_15 fr">
					<div class="sk-hygl_15">
						<h2>提现小贴士</h2>
						<div class="tishi_neir">
							<div id="scroll-1">
								<div id="showContent" style="height: 337px;">
									<iframe
										src="<?php echo $this->createUrl('other/OpenNews',array('gid'=>208))?>"
										style="width: 100%;" frameborder="0" scrolling="no"
										id="iframepage" name="iframepage" height="337"> </iframe>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="menu" style="margin-top: 10px">
				<ul>
					<li id="one2" class="off">银行卡提现明细</li>
				</ul>
			</div>
			<div id="divTwo" style="">
				<div class="zjgl-right_2" style="margin-top: 10px;">
					<table>
						<tbody>
							<tr>
								<th width="196">金额</th>
								<th width="196">银行卡</th>
								<th width="196">申请时间</th>
								<th width="196">提现进度</th>
								<th width="196">确定时间</th>
							</tr>
                        <?php foreach (@$outcashList as $value):?>
                        <tr>
								<td class="cff3430">
                               <?=$value->money?>
                            </td>
								<td>
                            <?=$value->bankaccount?>
                            </td>
								<td>
                                <?=date('Y-m-d',$value->addtime);?>
                            </td>
								<td><span style="color: #888"><?=$value->status;?></span></td>
								<td>

                                <?php if ($value->updatetime){echo date('Y-m-d',$value->updatetime);}?>
                            </td>
							</tr>
<?php endforeach;?>
                        </tbody>
					</table>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- 内容-->
<div class="yyzx_1" style="margin-right: 40%;">
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
    </div>
</div>
<script>
    $(document).ready(function () {
	   
		      <?PHP if(empty($outcashfull) || $outcashfull ==""){ ?>
					<?PHP  if($ree =="有"){?>
							$.openAlter("请输入提现金额", "提示");
								return false;
					<?PHP }else{?>
					        layer.alert('<?PHP echo $ree;?>', {icon: 6});
					        return false;
					<?PHP } ?>	 
					<?PHP }else{?>
					layer.alert('<sqan style="color:red">尊敬的会员，你的全额提现清单：<br>提现到银行卡：<?PHP echo $outcashfull[0]['bankaccount'];?>，<BR>被提现的总金额为：<?PHP echo $outcashfull[0]['money'];?>，<BR>提现进度：<?PHP echo $outcashfull[0]['status'];?>,<BR>提交时间：<?PHP echo  date('Y-m-d',$outcashfull[0]['addtime'])?></sqan>', {icon: 6});
					<?PHP }?>
	 });
    function ExchangeMoney() {
        var MinMoney=parseFloat('<?=$danbaojin->value?>');
        var MostMoney=parseFloat('<?=$systemset->value?>');
        var money = parseFloat($.trim($("#txtSpendPoint").val()));
        var type=$("input:radio[name=tixianfanshi]:checked").val();
        var spMoney=parseFloat('<?=$userinfo->Money;?>'); //可提现金额
        if (money == '') {
            $.openAlter("请输入提现金额", "提示");
            return false;
        }
        else if(money>spMoney){
            $.openAlter("提现金币超出，不能提现", "提示");
            return false;
        }
       
        else if(spMoney<MinMoney){
            $.openAlter("当前金币低于担保金，不能提现", "提示");
            return false;
        }
        else if (type==1&&spMoney <= 0) {
            $.openAlter("请输入正确的金额", "提示");
            return false;
        }
        else if (type==1&&money < MostMoney) {
                $.openAlter("提现金额不能小于平台最低提现额度："+MostMoney, "提示");
                return false;

        }
        else if (type==1&& (spMoney-money)<MinMoney) {
                $.openAlter("保证金不能取出哦~", "提示");
                return false;

        }
        else if (type==1&&($("#selBankList").val() == ''||$("#selBankList").val() == null)) {
            $.openAlter("请选择银行卡", "提示");
            return false;
        }  
		<?PHP foreach ($result as $key=>$val){ ?>
        	   if($("#selBankList").val() == <?PHP echo $val['bankAccount']?>){
        	   	$.openAlter("<?PHP echo $val['bankAccount']?>的银行卡支行不合法", "提示");
            return false;
        	   }
        <?PHP } ?>
    var bankid=$("#selBankList").val();

    $.ajax({
    	  type: 'POST',
    	  url: '<?=$this->createUrl('finance/takeoutcash')?>', async:false ,
    	  data: {money:money,bankaccount:bankid} ,
    	  success: function (data) {
              $.openAlter(data.msg,'提示',{width:250,height:250},function () {
                  window.location.href='<?=$this->createUrl('finance/takeoutcash');?>';
              })
          },
    	  dataType: 'json'
    	});

	
    }

	function Takeoutcashall(){
			
			var type=$("input:radio[name=tixianfanshi]:checked").val();
			if (type==1&&($("#selBankList").val() == ''||$("#selBankList").val() == null)) {
					$.openAlter("请选择银行卡", "提示");
					return false;
			}  
			 
			var bankid=$("#selBankList").val();

			layer.confirm('使用全额提现你的账号将会被冻结将无法进行任务等其他操作,视为你将退出平台！！', {
					btn: ['决定退出平台','未想退出平台'] //按钮
				}, function(){
					
					$.ajax({
							type: 'POST',
							dataType: 'json',
							url: '<?=$this->createUrl('finance/Takeoutcashall')?>',
							async:false ,
							data: {bankaccount:bankid},
							success: function (data) {
								console.log(data);
										layer.msg(data.msg, {icon: 1});
										 window.location.href='<?=$this->createUrl('finance/takeoutcash');?>';
								},error: function (data) {
									  layer.msg('提现不成功', {icon: 1});
								}
						});	
				}, function(){
					layer.msg('加油', {icon: 1});
				});
			
		}
</script>