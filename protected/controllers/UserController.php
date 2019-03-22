<?php
/*
    用户中心
*/
class UserController extends Controller
{
    
    /*public function init()  
    {     
        //parent::init();     
        Yii::app()->clientScript->registerCssFile(WEB_SITE_CSS_URL.'user.css'); 
        Yii::app()->clientScript->registerCssFile(SBT_CSS_URL.'css.css'); 
        
    }*/
    public $layout=	'//layouts/public_header';
	public function filters()
    {
        return array(
            'accessControl',
        );
    }
    
    public function accessRules()
    {
        return array(
				array('allow',  // 允许所有用户访问 'login' 动作.
					'actions'=>array('error'),
					'users'=>array('*'),
				),
				array('allow', // 允许认证用户访问所有动作
					'users'=>array('@'),
				),
				array('deny',  // 拒绝所有的用户。
					'users'=>array('*'),
				),
			);
    }
    public function actionShuju()
		    {

						$sql = "SELECT tc.id FROM zxjy_transfercash as tc
                LEFT JOIN zxjy_usertask as ut on ut.id = tc.usertaskid
                LEFT JOIN zxjy_user as u on u.id = ut.userid
                LEFT JOIN zxjy_banklist as bl on bl.id = tc.bankid
                LEFT JOIN zxjy_blindwangwang as bw on bw.userid = u.id
                WHERE ut.addtime > 1535731200 and   tc.addtime > 1541952000 and ut.addtime <1541001600  ORDER BY tc.id desc";
                $Count = Yii::app ()->db->createCommand ( $sql )->queryAll ();
                foreach ($Count as $k=>$v){
                    $arr.= $v['id'].",";
                }
                echo($arr);
		    }
    /*
        会员中心-威客实名认证
    */
    public function actionAuthPerson()
    {
        //淘内幕实名认证
        if(isset($_POST['taoneimo']) && $_POST['taoneimo']=="DOIT")
        {
            $authcheck=Authperson::model()->findByAttributes(array('uid'=>Yii::app()->user->getId()));
            if($authcheck)//已经提交过
            {
                echo "EXIST";
            }else
            {
                $authinfo=new Authperson;
                $authinfo->uid=Yii::app()->user->getId();
                $authinfo->time=time();
                if($authinfo->save())
                {
                    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
                    $userinfo->AuthPersonStep1=1;//资料已经提交
                    $userinfo->save();
                    echo "SUCCESS";
                }
                else
                {
                    echo "FAIL";
                }
            }
            Yii::app()->end();
        }
        //判断是否认证通过
        $auperson=Authperson::model()->find('uid='.Yii::app()->user->getId());

        //威客实名认证
        if(isset($_POST['username']))
        {
            $authcheck=Authperson::model()->findByAttributes(array('uid'=>Yii::app()->user->getId()));
            if($authcheck)//已经提交过
            {
				$sql = "select idcardnumber from zxjy_authperson where idcardnumber = '{$_POST['idcardnumber']}'";
                $idcardnumber =  Yii::app ()->db->createCommand ( $sql )->queryScalar ();
                if($idcardnumber){
                    if($authcheck->idcardnumber == $_POST['idcardnumber']){

                    }else{
                        echo "FAILNUMBER";
                        exit();
                    }
                }else{

                }
                $authcheck->uid=Yii::app()->user->getId();
                $authcheck->username=$_POST['username'];
                $authcheck->idcardnumber=$_POST['idcardnumber'];
                $authcheck->zfbaccount=$_POST['zfbaccount'];
                $authcheck->qq=$_POST['qq'];
                if($_POST['province']==$_POST['city'])
                    $authcheck->address=$_POST['province'].$_POST['town'].$_POST['street'];
                else
                    $authcheck->address=$_POST['province'].$_POST['city'].$_POST['town'].$_POST['street'];
                $authcheck->telephone=$_POST['telephone'];
                $authcheck->zmidcard = strpos($_POST['zmidcard'], WEB_URL) === false ? WEB_URL.$_POST['zmidcard'] : $_POST['zmidcard'];
                $authcheck->handwithidcard = strpos($_POST['handwithidcard'], WEB_URL) === false ? WEB_URL.$_POST['handwithidcard'] : $_POST['handwithidcard'];
                $authcheck->lifephoto = strpos($_POST['lifephoto'], WEB_URL) === false ? WEB_URL.$_POST['lifephoto'] : $_POST['lifephoto'];
                $authcheck->time=time();
                $authcheck -> status = 0;
                if($authcheck->save())
                {
                    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
                    $userinfo->AuthPersonStep1=1;//资料已经提交
                    $userinfo->TrueName=$_POST['username'];//资料已经提交
                    $userinfo->save();
                    echo "SUCCESS";
                }
                else
                    echo "FAIL";
            }else{
				$sql = "select idcardnumber from zxjy_authperson where idcardnumber = '{$_POST['idcardnumber']}'";
                $idcardnumber =  Yii::app ()->db->createCommand ( $sql )->queryScalar ();
                if($idcardnumber){
                    echo "FAILNUMBER";
                    exit();
                }else{

                }
                $authinfo=new Authperson;
                $authinfo->uid=Yii::app()->user->getId();
                $authinfo->username=$_POST['username'];
                $authinfo->idcardnumber=$_POST['idcardnumber'];               
                $authinfo->zfbaccount=$_POST['zfbaccount'];
                $authinfo->qq=$_POST['qq'];
                if($_POST['province']==$_POST['city'])
                    $authinfo->address=$_POST['province'].$_POST['town'].$_POST['street'];
                else
                    $authinfo->address=$_POST['province'].$_POST['city'].$_POST['town'].$_POST['street'];
                $authinfo->telephone=$_POST['telephone'];
                $authinfo->zmidcard=WEB_URL.$_POST['zmidcard'];
                $authinfo->handwithidcard=WEB_URL.$_POST['handwithidcard'];
                $authinfo->lifephoto=WEB_URL.$_POST['lifephoto'];
                $authinfo->time=time();
                if($authinfo->save())
                {
                    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
                    $userinfo->AuthPersonStep1=1;//资料已经提交
                    $userinfo->TrueName=$_POST['username'];//资料已经提交
                    $userinfo->save();
                    echo "SUCCESS";
                }
                else
                    echo "FAIL";
            }
            Yii::app()->end();
        }else{
		$this->layout=false;
		$this->render('authPerson',array('authdesc'=>$auperson));};
    }

    /*
        会员中心-绑定掌柜号认证
    */
    public function actionAuthStore()
    {
        if(isset($_POST['platform']))
        {
            $wangwangcheck=Blindwangwang::model()->findByAttributes(array('wangwang'=>$_POST['wangwang']));
            if($wangwangcheck)//该掌柜号已经被绑定过
            {
                echo "EXIST";
            }else
            {
                $wangwang=new Blindwangwang;
                $wangwang->userid=Yii::app()->user->getId();
                $wangwang->wangwang=trim($_POST['wangwang']);
                $wangwang->catalog=2;
                $wangwang->blindtime=time();
                $wangwang->platform=$_POST['platform'];
                $wangwang->ip=$_POST['authStoreIP'];
                $wangwang->authStoreIP=$_POST['authStoreIP'];
                $wangwang->authStoreQQ=$_POST['authStoreQQ'];
                $wangwang->authStorePhone=$_POST['telephone'];

                $randStr = str_shuffle('1234567890');//由数字组成
                $wangwang->authStoreCode=substr($randStr,0,6);

                $wangwang->authStoreStep1=1;//基本资料已提交

                $wangwang->authStoreStatus=0;
                if($wangwang->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            Yii::app()->end();
        }
        $this->render('authStore');
    }

    /*
        验证商品链接地址
    */
    public function actionAuthStoreUrl()
    {
        if(isset($_POST['authStoreUrl']) && isset($_POST['id']))
        {
            $wangwanginfo=Blindwangwang::model()->findByPk($_POST['id']);

            $pageinfo=file_get_contents($_POST['authStoreUrl']);

            //验证商品链接中是否有验证码
            $checkauthStoreCode=strpos($pageinfo,iconv("utf-8","gb2312",$wangwanginfo->authStoreCode));

            //验证商品链接中的掌柜号是否正确
            $checkwangwang=strpos($pageinfo,iconv("utf-8","gb2312",$wangwanginfo->wangwang));

            /*$wangwanginfo->authStoreUrl=$_POST['authStoreUrl'];
            $wangwanginfo->authStoreStep2=1;*/
            if($checkauthStoreCode==false && $checkwangwang==true)
                echo "authStoreCodeNO";
            else if($checkwangwang==false && $checkauthStoreCode==true)
                echo "wangwangNO";
            else if($checkauthStoreCode==false && $checkwangwang==false)
                echo "bothNO";
            else
            {
                $wangwanginfo->authStoreUrl=$_POST['authStoreUrl'];
                $wangwanginfo->authStoreStep2=1;
                $wangwanginfo->authStoreStatus=1;//审核通过
                $wangwanginfo->authStorepasstime=time();
                $wangwanginfo->save();
                echo "SUCCESS";
            }
        }else
        {
            echo "FAIL";
        }
    }
/*
 * 推广好友
 */
public function actionInviteFriends(){
    $db=Yii::app()->db->tablePrefix;
    $sql='SELECT ispromoter FROM '.$db.'_user WHERE id='.Yii::app()->user->getId();
    $row=Yii::app()->db->createCommand($sql)->queryRow();
    $allfrends=array();
    if ($row['ispromoter']==0){
        $this->redirect_message('您暂无此权限！','failed',2,$this->createUrl('user/index'));
    }else{
    	
        $sql="SELECT count(1) FROM ".$db."_user AS u LEFT JOIN ".$db."_blindwangwang AS w ".
            " ON u.id=w.userid LEFT JOIN ".$db."_bindbuyer AS b ON b.userid=u.id WHERE u.IdNumber =".Yii::app()->user->getId();
        //$all=Yii::app()->db->createCommand($sql)->queryAll();
        
    	$uid = Yii::app()->user->getId() ;
    	
    	$sql2 =@"
SELECT  A.* , IFNULL(B.usertaskCount,0) as  usertaskCount  FROM  ( 
SELECT u.username,u.id AS userid,w.wangwang,b.account_info 
FROM zxjy_user AS u 
LEFT JOIN zxjy_blindwangwang AS w  ON u.id=w.userid 
LEFT JOIN zxjy_bindbuyer AS b ON b.userid=u.id 
WHERE u.IdNumber ='{$uid}' ) A
LEFT JOIN  ( SELECT userid , COUNT(1) as  usertaskCount FROM  zxjy_usertask WHERE   flag=3  GROUP BY  userid  ) B ON B.userid = A.userid
ORDER BY A.userid  DESC " ;
    	
        $criteria=new CDbCriteria();
        $allCount=Yii::app()->db->createCommand($sql)->queryScalar();
        $pages=new CPagination($allCount);
        $pages->pageSize=15;
        $pages->applyLimit($criteria);
        $all=Yii::app()->db->createCommand( $sql2 .' LIMIT :offset,:limit');
        $all->bindValue(':offset',$pages->currentPage*$pages->pageSize);
        $all->bindValue(':limit',$pages->pageSize);
        $all=$all->queryAll();

        /*
        foreach ($all as $k=>$val){
            $usertask=Usertask::model()->findAll('userid='.$val['userid'].' AND flag=3');
            $all[$k]['usertaskCount']=count($usertask);
        }*/
        
        $allfrends=$all;
    }
    $this->render('inviteFriends',array('allfrends'=>$allfrends,'pages'=>$pages));
}
public function actionQrcode(){
    //Yii::$enableIncludePath = false;
    //Yii::import ('application.extensions.phpqrcode.phpqrcode', 1 );
    if ($_POST['phon']){
        $phon=md5($_POST['phon']);
        $url=   WEB_URL . $this->createUrl('passport/regist',array('userid'=>Yii::app()->user->getId(),'ppp'=>$phon));
        //$qrcode=QRcode::png($url,false,'QR_ECLEVEL_L',6,1);
        $html='<tr><td >推广链接:</td><td id="promoteurl">'.$url.'</td></tr>';
              //'<tr><td >推广二维码:</td><td id="promotecode">'.$qrcode.'</td></tr>';
        echo $html;exit;
    }


}


    /*
        用户中心-用户推广赚钱
    */
    public function actionUserSpread()
    {
        $criteria = new CDbCriteria;
        $criteria->order ="id desc";
        $criteria->addCondition('IdNumber='.Yii::app()->user->getId());//查询我发起的投诉
    
        //分页开始
        $total = User::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proInfo = User::model()->findAll($criteria);
        //分页结束
        $this->render('userSpread',array(
            'proInfo' =>$proInfo,
            'pages' => $pages,
            'total'=>$total
        ));
    }
    
    /*
        用户中心-生成用户推广的专属链接
    */
    public function actionuserSpreadLink()
    {
        $this->renderPartial('userSpreadLink');
    }
    
    public function actionGetTitle()
    {
        
        if(isset($_POST['url']) && $_POST['url']!="")
        {
            $url=$_POST['url'];
            if(@preg_match('/(<div class="tb-detail-hd">)(.*)(<\/div>)/is',file_get_contents($url), $matches) && strpos($url,"detail.tmall.com")){
                $arrNew=explode("</h1>",$matches[0]);
                $promotionlisttitle=strip_tags($arrNew[0]);
            } 
            else if(@preg_match('/(<h3 class="tb-main-title">)(.*)(<\/h3>)/is',file_get_contents($url), $matches) && strpos($url,"item.taobao.com"))
            {
                $protitle=strip_tags($matches[0]);
            }
            else   
            {
                $protitle=0;
            }
            
            echo iconv("gbk//TRANSLIT","UTF-8",trim($protitle));
        }
    }
    
    /*
        用户中心-手机号码绑定激活
    */
    public function actionUserPhonActive()
    {
        if(isset($_POST['phone']) && isset($_POST['phoneCode']))
        {
            if($_POST['phoneCode']==Yii::app()->session['code'])
            {
                if($_POST['phone']==Yii::app()->session['phone'])
                {
                    unset(Yii::app()->session['code']);//清除验证码
                    unset(Yii::app()->session['phone']);//清除手机号
                    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
                    $userinfo->Phon=$_POST['phone'];//重新配置用户的手机号码
                    $userinfo->PhonActive=1;//改变用户手机激活的状态
                    $userinfo->save();
                    echo "SUCCESS";
                }
                else
                {
                    echo "PHONEFAIL";
                }
            }else
            {
                echo "CODEFAIL";//验证码不正确
            }
        }
        else
            $this->render('userPhonActive');
    }
    
    /*
        用户中心-检查安全码是否正确
    */
    public function actionCheckSafePwd()
    {
        if(isset($_POST['safePwd']) && $_POST['safePwd']!="")
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            if($userinfo->SafePwd==md5($_POST['safePwd']))
                echo "SUCCESS";
            else
                echo "FAIL";
        }else
            echo "FAIL";
    }
    
    /*
        用户中心-修改安全操作码
    */
    public function actionUserSafePwdFirstSet()
    {
        $userInfo=User::model()->findByPk(Yii::app()->user->getId());
        if(isset($_POST['setSafePwd']) && $_POST['setSafePwd']=="Done" && isset($_POST['safePwd']))
        { 
            if($userInfo->SafePwd=="")//没有设置过安全码
            {
                $userInfo->SafePwd=md5($_POST['safePwd']);
                if($userInfo->save())
                {
                    $this->redirect(array('user/index'));
                }
                else
                {
                    $this->redirect_message('安全码设置失败，请联系客服人员！','success',10,$this->createUrl('site/index'));
                }
            }else
            {
                $this->redirect_message('您已经设置过安全码！','success',10,$this->createUrl('site/index'));
            }
        }
        else{
            if($userInfo->SafePwd=="")//没有设置过安全码
                $this->render('userSafePwdFirstSet');
            else
                $this->redirect_message('您已经设置过安全码！','success',10,$this->createUrl('user/index'));
        }
    }
    
    /*
        用户中心-修改绑定手机号码
    */
    public function actionUserChangPhone()
    {
        if(isset($_POST['phone']) && $_POST['phone']!="")//修改手机号码
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            $userinfo->Phon=$_POST['phone'];//修改为新的手机号码
            if($userinfo->save())
                echo "SUCCESS";
            else
                echo "FAIL";
        }
        else
            $this->renderPartial('userChangPhone');
    }
    
    /*
        用户中心-投诉中心-发起的投诉
    */
    public function actionUserTsCenter()
    {
        $criteria = new CDbCriteria;
        $criteria->order ="time desc";
        $criteria->addCondition('douid='.Yii::app()->user->getId());//查询我发起的投诉
    
        //分页开始
        $total = Complianlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Complianlist::model()->findAll($criteria);
        //分页结束
        
        $this->render('userTsCenter',array(
            'proInfo' => $proreg,
            'pages' => $pages,
            'total'=>$total
        ));
    }
    
    /*
        用户中心-投诉中心-收到的投诉
    */
    public function actionUserTsCenterGet()
    {
        $criteria = new CDbCriteria;
        $criteria->order ="time desc";
        $criteria->addCondition('uid='.Yii::app()->user->getId());//查询我发起的投诉
    
        //分页开始
        $total = Complianlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Complianlist::model()->findAll($criteria);
        //分页结束
        
        $this->render('userTsCenterGet',array(
            'proInfo' => $proreg,
            'pages' => $pages,
            'total'=>$total
        ));
    }
    /*
        用户中心-添加卡号
    */
    public function actionGetPhoneCode()
    {
        $this->renderPartial('getPhoneCode');
    }
    /*
        用户中心-添加卡号
    */
    public function actionUserAddBank()
    {
        $this->renderPartial('userAddBank');
    }
    /*
        用户中心-修改卡号
    */
    public function actionUserEditBank()
    {
		if(isset($_GET['bankid'])){
			$bankInfo=Banklist::model()->findByPk(intval($_GET['bankid']));
			if($bankInfo){
				$this->renderPartial('userEditBank',array(
                   'bankInfo' => $bankInfo
               ));
			}else{
				$this->renderPartial('userEditBank');
			}
            
		}
		
    }
    /*
        用户中心-确认添加银行卡
    */
    public function actionUserAddBankCertain()
    {
        if(isset($_POST['truename']) && $_POST['truename']!="" && isset($_POST['bankAccount']) && $_POST['bankAccount']!="")
        {
            $checkBank=Banklist::model()->findByAttributes(array('bankAccount'=>$_POST['bankAccount']));
            if($checkBank)//银行卡已存在
            {
                echo "BANKACCOUNTEXIT";
            }else//不存在则进行添加
            {
                $bankInfo=new Banklist();
                $bankInfo->userid=Yii::app()->user->getId();//用户id
                $bankInfo->truename=$_POST['truename'];//真实姓名
                $bankInfo->phone=$_POST['Phon'];//添加银行卡时绑定的手机号码
                $bankInfo->bankCatalog=$_POST['bankCatalog'];//银行卡的类型即银行名称
                $bankInfo->bankAccount=$_POST['bankAccount'];//银行卡号
                $bankInfo->time=time();//添加银行卡时间
                if($bankInfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
        }
        else
            echo "FAIL";
    }
	/*
        用户中心-修改银行卡
    */
    public function actionUserEditBankCertain()
    {
        if(isset($_POST['truename']) && $_POST['truename']!="" && isset($_POST['bankAccount']) && $_POST['bankAccount']!="" && isset($_POST['id']) && $_POST['id']>0)
        {
			$bankInfo=Banklist::model()->findByAttributes(array('id'=>intval($_POST['id']),'userid'=>Yii::app()->user->getId()));
			if($bankInfo){
				$bankInfo->truename=$_POST['truename'];//真实姓名
                $bankInfo->phone=$_POST['Phon'];//添加银行卡时绑定的手机号码
                $bankInfo->bankCatalog=$_POST['bankCatalog'];//银行卡的类型即银行名称
                $bankInfo->bankAccount=$_POST['bankAccount'];//银行卡号
                $bankInfo->time=time();//添加银行卡时间
				if($bankInfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
			}else{
				echo '银行卡不存在';
			}
        }
        else
            echo "FAIL";
    }
           
	/*
        用户中心-删除银行卡
    */
    public function actionUserDelBank()
    {
        if(isset($_POST['bankid']))
        {
            $checkBank=Banklist::model()->findByAttributes(array('id'=>$_POST['bankid'],'userid'=>Yii::app()->user->getId()));
            if($checkBank)//银行卡已存在
            {
                if($checkBank->delete())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }else//不存在则进行添加
            {
                echo '银行卡不存在';
            }
        }
        else
            echo "FAIL";
    }
	
    /*
        用户中心-用户中心首页-总览  优化
    */
    public function actionIndex()
    {
        //搜出 用户所有信息

        $uID = Yii::app()->user->getId();
        if(Yii::app()->redis->get($uID.'_usermoney')){
            $userInfoR = Yii::app()->redis->get($uID.'_userInfo');
            $countpriceR = Yii::app()->redis->get($uID.'_countprice');
            $countR = Yii::app()->redis->get($uID.'_count');
            $usermoneyR = Yii::app()->redis->get($uID.'_usermoney');
        }else{
            $userInfo = User::model()->findByPk(Yii::app()->user->getId());
            $sql = "SELECT Username,QQToken,Phon,SafePwd,wechat from zxjy_user where id =".$uID;
            $userInfo = Yii::app()->db->createCommand($sql)->queryRow();
            Yii::app()->redis->set($uID.'_userInfo',$userInfo,60);
            $userInfoR = Yii::app()->redis->get($uID.'_userInfo');
            //总共赚取得佣金
            $countprice = 0;
            $sql = "SELECT SUM(increase) FROM zxjy_cashlog WHERE (type='任务佣金' OR type='评价任务佣金' OR type='推广返现') AND userid=" . $uID;
            $res = Yii::app()->db->createCommand($sql)->queryRow();
//            foreach ($res as $v) {
//                $m = substr($v['increase'], 1);
//                // 累计赚取金币
//                $countprice += $m;
//            };
            Yii::app()->redis->set($uID.'_countprice',$res['SUM(increase)'],60);
            $countpriceR = Yii::app()->redis->get($uID.'_countprice');
//            //系统限制
//            $sql = "SELECT `value`,`varname` FROM zxjy_system where varname='taskScore' OR varname='monthAccount' OR varname='buyerSet'";
//            $system = Yii::app()->db->createCommand($sql)->queryAll();
//            $allsystem = array();
//            foreach ($system as $k => $v) {
//                if ($v['varname'] == 'buyerSet') {
//                    $v['value'] = unserialize($v['value']);
//                }
//                $allsystem[$v['varname']] = $v['value'];
//
//            }
//            $beginToday = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
//            $endToday = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')) - 1;
//            //月结日时间戳start<end
//            $mothday = $this->getlastMonthDays(time(), $allsystem['monthAccount']);
//            $weekday = $this->getWeekRange();
//            $daycount = $this->gettaskcount($beginToday, $endToday);
//            $weekcount = $this->gettaskcount($weekday['start'], $weekday['end']);
//            $monthcount = $this->gettaskcount($mothday['start'], $mothday['end']);
//            //淘宝接手机会
//            $count = 0;
//            if ($monthcount >= $allsystem['buyerSet']['month'] || $weekcount >= $allsystem['buyerSet']['week'] || $daycount >= $allsystem['buyerSet']['day']) {
//                $count = 0;
//                Yii::app()->redis->set($uID.'_count',$count,60);
//                $countR = Yii::app()->redis->get($uID.'_count');
//            } else {
//                $usertask=Usertask::model()->findAll('userid='.Yii::app()->user->getId()." AND addtime<$endToday AND addtime>$beginToday");
//                $count=$allsystem['buyerSet']['day']-count($usertask);
//                Yii::app()->redis->set($uID.'_count',$count,60);
//                $countR = Yii::app()->redis->get($uID.'_count');
//            }
            // 单量控制
            $buyerSet = System::model ()->findByAttributes ( array ( "varname" => "buyerSet"  ) );
            //反序列化
            $buyerSet = unserialize ( $buyerSet->value );
            // 判断当前的接手今天接了多少单 从后台控制的单量-当前接手的单量   显示可接手数量
            $uID = Yii::app ()->user->getId () ;
            $sql = @"SELECT COUNT(1) FROM zxjy_usertask WHERE userid='{$uid}' AND  addtime > UNIX_TIMESTAMP( DATE_FORMAT( NOW() , '%Y-%m-%d 00:00:01') ) AND  addtime < UNIX_TIMESTAMP( DATE_FORMAT( NOW() , '%Y-%m-%d 23:59:59') ) ; " ;
            $cc = Yii::app ()->db->createCommand ( $sql )->queryScalar();
            $daycount = $buyerSet ['day'] - $cc ;
            Yii::app()->redis->set($uid."_count",$daycount,60);
            $countR =  Yii::app()->redis->get($uid."_count");
            //账户金币
            $sql = "SELECT  SUM(increase) FROM zxjy_cashlog WHERE userid='{$uID}' ;" ;
            $usermoney= Yii::app ()->db->createCommand ( $sql )->queryScalar ();
            if($usermoney == false) $usermoney =0 ;
            Yii::app()->redis->set($uID.'_usermoney',$usermoney,1);
            $usermoneyR = Yii::app()->redis->get($uID.'_usermoney');
        }

        $this->render('index',array('userInfo'=>$userInfoR,'countprice'=>$countpriceR,'count'=>$countR,'usermoney'=>$usermoneyR));
    }
    
    
    /*
        用户中心-新手考试
    */
    public function actionUserExam()
    {
        //提交试卷
        if(isset($_POST['qeustion']) && isset($_POST['answer']))
        {
            $total=count($_POST['qeustion']);//题目总数
            $answerCount=0;//计算答对数量
            foreach($_POST['answer'] as $k=>$v)
            {
                $exam=Exam::model()->find(array(
                    'condition'=>'id='.$v.' and answer=1'
                ));
                if($exam)
                    $answerCount++;
            }
            
            //如果答对数量超过80%则通过考试
            if($answerCount/$total>0.8 || $answerCount/$total==0.8)
            {
                $userInfo=User::model()->findByPk(Yii::app()->user->getId());
                $userInfo->ExamPass=1;//考试通过，改变考试状态
                $scorelog=new Scorelog();
                $scorelog->userid=Yii::app()->user->getId();
                $scorelog->original_score=$userInfo->Score;
                $scorelog->score_info='+50';
                $scorelog->score_now=$userInfo->Score+50;
                $scorelog->description='通过考试，+50信用积分';
                $scorelog->add_time=time();
                $userInfo->Score=$userInfo->Score+50;//考试通过，改变考试状态
                $scorelog->save();
                $userInfo->save();
                echo "SUCCESS";
            }
            else
            {
                echo "FAIL";
            }
            Yii::app()->end();
        }
        
        $this->render('userExam');
    }
    
    /*
        用户中心-淘宝大厅-已接任务
    */
    public function actionTaobaoInTask()
    {
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]);
            else
                $criteria->condition='status=-1';//给出不存在的条件
            $criteria->order ="time desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoInTask',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //我接手的任务
	    $criteria = new CDbCriteria;
        $criteria->condition='taskerid='.Yii::app()->user->getId().' and status<>6 and complian_status<>3 and taskCompleteStatus<>1';//不查询已完成的任务
        $criteria->order ="status asc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoInTask',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    

    /*
        已接任务-全部任务
    */
    public function actionTaobaoInTaskAllList()
    {
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]);
            else
                $criteria->condition='status=-1';//给出不存在的条件
            $criteria->order ="taskcompleteTime desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoInTaskAllList',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //我接手的任务
	    $criteria = new CDbCriteria;
        $criteria->condition='taskerid='.Yii::app()->user->getId();//不查询已完成的任务
        $criteria->order ="taskcompleteTime desc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoInTaskAllList',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    

    /*
        用户中心-淘宝大厅-淘宝绑定买号
    */
    public function actionTaobaoBindBuyer()
    {
        if(isset($_POST['account_name']))
		{ $result=array();
			$_POST['account_name']=trim($_POST['account_name']);
			$ww=Blindwangwang::model()->find("(wangwang='$_POST[account_name]' OR wangwang=' $_POST[account_name]' OR wangwang='$_POST[account_name] ') AND statue = 1");
			if(!empty($ww)){
				$result['err_code']=4;$result['msg']="该买号已经存在！";echo json_encode($result);exit;
			}
            if (empty($_POST['wid'])){
                $checkBlindwangwang=Blindwangwang::model()->find(array(
                    'condition'=>"userid=".Yii::app()->user->getId()
                ));
                if(count($checkBlindwangwang)>0)//买号已存在
                {
                    $result['err_code']=1;$result['msg']="每个用户只能绑定一个账号，不要太贪心哦！";echo json_encode($result);exit;
                }
            }
        $bindbuyer=Bindbuyer::model()->find('userid='.Yii::app()->user->getId());
 
        if (empty($bindbuyer)) { 
            $blindwangwang = new Blindwangwang;
            $bindbuyer=new Bindbuyer;
            $bindbuyer->addtime=time();
            $blindwangwang->blindtime=time();//绑定时间
        }else{ 
            $blindwangwang=Blindwangwang::model()->find('userid='.Yii::app()->user->getId());
			if(empty($blindwangwang)){
				$blindwangwang=new Blindwangwang;
				$blindwangwang->blindtime=time();
			}else{
				$blindwangwang->updatetime=time();//绑定时间blindtime
			}           
			
        }
        PLATFORM == 'xkq'?$dbname='aaa':$dbname='aaa_xkq';
		$sql = 'SELECT COUNT(1)  FROM  '. $dbname .'.zxjy_blindwangwang WHERE wangwang = "' . $_POST['account_name'] . '"';
        if (Yii::app() -> db -> createCommand($sql) -> queryScalar())
        {
            $blindwangwang -> is_esx = 1;
        }
        $blindwangwang->userid=Yii::app()->user->getId();//用户id
        $blindwangwang->wangwang=$_POST['account_name'];//淘宝买家帐号
        $blindwangwang->wangwanginfo=$_POST['xy_val'];//淘宝帐号等级信息
        $blindwangwang->taotaorz=1;//是否通过淘宝实名认证
        $blindwangwang->statue=0;//是否通过淘宝实名认证
        $blindwangwang->ip=XUtils::getClientIP();//操作ip
        $blindwangwang->platform=$_POST['platform'];
        $account_info=array('xy_val'=>$_POST['xy_val'],'xy_img'=>WEB_URL.$_POST['xy_img'],'tqz_val'=>$_POST['tqz_val'],'tqz_img'=>WEB_URL.$_POST['tqz_img']);
        $account_info=serialize($account_info);
        $keysa = "save_".$uid;
			  if (Yii::app()->redis->get($keysa))  //请求间隔小于1分钟直接返回
				{
						$result['err_code']=2;$result['msg']="请勿频繁操作!";echo json_encode($result);exit;
				}
				Yii::app()->redis->set($keysa,1,30);
        if($blindwangwang->save()){
            $wangwangid = $blindwangwang->attributes['id'];
            $bindbuyer->userid=Yii::app()->user->getId();
            $bindbuyer->wangwangid=$wangwangid;
            $bindbuyer->account_info=$account_info;
            $bindbuyer->wkqimg=WEB_URL.$_POST['wkqimg'];
            // $bindbuyer->huabeiimg=WEB_URL.$_POST['huabeiimg'];
            //$bindbuyer->zfbidentityimg=WEB_URL.$_POST['zfbidentityimg'];
            //$bindbuyer->zfbbaseimg=WEB_URL.$_POST['zfbbaseimg'];
            $bindbuyer->sex=$_POST['sex'];
            $bindbuyer->age=$_POST['age'];
            $bindbuyer->region=$_POST['region'];
            $bindbuyer->save();
            $result['err_code']=0;$result['msg']="提交成功，请等待管理员审核";echo json_encode($result);exit;
        }
        else{
            $result['err_code']=2;$result['msg']="提交失败";echo json_encode($result);exit;}
        }
        $buyer=array();
        if ($_GET['wid']){
            $buyer=Bindbuyer::model()->findByPk($_GET['wid']);
        }
        $this->render('taobaoBindBuyer',array('buyer'=>$buyer));
    }

    public function actionUploadQRCode()
    {
        if (!empty($_FILES))
        {
            $code_url = unserialize($this -> uploadFile($_FILES['file']))[0];
            $sql = 'UPDATE zxjy_user set weChat_QRCode = "' . $code_url . '" WHERE id = ' . $this -> uid;
            $this -> db -> createCommand($sql) -> query() !== false ? Toole::show(1, '二维码上传成功') : Toole::show(0, '二维码上传失败，请稍后再试');
        }
        else
            Toole::show(0, '获取文件信息失败，请重新上传');
    }
    /**
     * 上传文件
     * @param $file  文件信息
     * @param int $size_limit  //大小限制，默认2M
     * @param array $type_limit  类型限制，数组格式
     * @return array  //返回序列化后的文件存储路径
     */
    public  function uploadFile($file, $size_limit = 2048000, $type_limit = ['image/gif', 'image/jpeg', 'image/png', 'image/jpg'])
    {
        $dirname = '/data';
        $ym = @date("Ym");
        $save_path2 = 'myUpload'.$dirname.'/'.$ym . "/";
        if (!file_exists($save_path2)) {
            mkdir($save_path2);
        }
        $pic_path = "myUpload".$dirname."/".$ym."/";
        $n = $m = 0;
        $arr = [];
        if (in_array($file['type'], $type_limit))  //文件格式正确
        {
            if ($file['size'] < $size_limit)
            {
                if (is_uploaded_file ($file['tmp_name']))
                {
                    $savename = md5(uniqid(microtime(true),true)) . '.png';
                    if (move_uploaded_file ($file['tmp_name'], $pic_path . $savename))
                    {
                        $arr [$m ++] = SITE_URL . $pic_path . $savename;
                    }
                    else
                        Toole::show(0, '存储文件失败，请稍后再试');
                }
            }
            else
                Toole::show(0, '上传的文件超出限制大小, 单张图片文件大小不大于2M');
        }
        else
            Toole::show(0, '请上传文件格式为' . implode('/', $type_limit) . '的图片。否则无法保存！');
        return empty($arr) ? Toole::show(0, '图片上传失败，请稍后再试') : serialize($arr);  //返回序列化后的存储路径
    }

    
    /*
        用户中心-淘宝大厅-删除买号
    */
    public function actionTaobaoBindBuyerDel()
    {
        if(isset($_GET['id']))
        {
            $blindInfo=Blindwangwang::model()->findByAttributes(array(
                'userid'=>Yii::app()->user->getId(),
                'id'=>$_GET['id']
            ));
            if($blindInfo)//检查要删除的买号是否属于当前登录用户
            {
                $blindInfo->delete();
                $this->redirect(array('user/taobaoBindBuyer'));
            }
            else
            {
                $this->redirect_message('您无权删除','success',3,$this->createUrl('user/taobaoBindBuyer'));
            }
        }
        else
            $this->redirect_message('您无权删除','success',3,$this->createUrl('user/taobaoBindBuyer'));
    }
    
     /*
        用户中心-淘宝大厅-修改买号信息
    */
    public function actionTaobaoBindBuyerChangeInfo()
    {
        if(isset($_POST['id']) || isset($_POST['value']) || isset($_POST['action']))
        {
            $blindInfo=Blindwangwang::model()->findByPk($_POST['id']);
            if($_POST['action']=="realnameOn")//修改淘宝实名认证信息
            {
                $blindInfo->taotaorz=$_POST['value'];
            }
            
            if($_POST['action']=="changeStatusOn")//修改是否启用买号
            {
                $statue=$_POST['value']==1?0:1;
                $blindInfo->statue=$statue;
            }
            
            if($_POST['action']=="taobaoScoreOn")//修改淘宝信誉
            {
                $blindInfo->wangwanginfo=$_POST['value'];
            }
            if($blindInfo->save())
                echo 1;
            else
                echo 0;
        }
    }
    
    
    
    /*
        用户中心-淘宝大厅-淘宝绑定掌柜
    */
    public function actionTaobaoBindSeller()
    {
        if(isset($_POST['bdmh']))
        {   
            $checkBlindwangwang=Blindwangwang::model()->find(array(
                'condition'=>"wangwang='".$_POST['bdmh']."' and statue <>3"
            ));
            
            
            if(count($checkBlindwangwang)>0)//买号已存在
            {
                $warning="该买号已经被绑定过";
            }
            else
            {
                $checkBlindwangwang=Blindwangwang::model()->find(array(
                    'condition'=>"wangwang='".$_POST['bdmh']."' and userid=".Yii::app()->user->getId().' and statue=3'
                ));
                if(count($checkBlindwangwang)>0)//如果该用户绑定号已经存在，只是被系统取消了，也就是statue状态为3的情况下
                {
                    $checkBlindwangwang->statue=1;
                    if($checkBlindwangwang->save())
                    {
                        $this->redirect('blindBuyCount');
                    }
                    Yii::app()->end();
                }
                
                
                $blindwangwang=new Blindwangwang;
                $blindwangwang->userid=Yii::app()->user->getId();//用户id
                $blindwangwang->wangwang=$_POST['bdmh'];//淘宝掌柜帐号
                $blindwangwang->catalog=2;//帐号类型为2即掌柜帐号
                $blindwangwang->ip=XUtils::getClientIP();//操作ip
                $blindwangwang->blindtime=time();//绑定时间
                $blindwangwang->platform=$_POST['platform'];//掌柜号所属平台
                
                if($blindwangwang->save())
                    $warning="恭喜您，买号绑定成功！";
                else
                    $warning="买号绑定失败";
            }
            $criteria = new CDbCriteria;
            $criteria->order ="blindtime desc";
            $criteria->addCondition('userid='.Yii::app()->user->getId().' and catalog=2');//查询绑定的买号
        
            //分页开始
            $total = Blindwangwang::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=5;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Blindwangwang::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoBindSeller',array(
                "warning"=>$warning,
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        $criteria = new CDbCriteria;
        $criteria->order ="blindtime desc";
        $criteria->addCondition('userid='.Yii::app()->user->getId().' and catalog=2');//查询绑定的掌柜号
    
        //分页开始
        $total = Blindwangwang::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=5;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Blindwangwang::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoBindSeller',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }

    /*
        用户中心-删除任务模板
    */
    public function actionDeltemplete()
    {
        if(isset($_GET['temid']) && $_GET['temid'])
        {
            $teminfo=Companytasklist::model()->findByPk($_GET['temid']);
            $teminfo->isTpl=0;//不保存为模板
            $teminfo->tplTo="0*#";//改为默认值
            $teminfo->save();
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }
    
    
    /*
        用户中心-维护资料密码
    */
    public function actionUserAccountCenter()
    {
        if(isset($_POST['headImg']))
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            $userinfo->MyPhoto=$_POST['headImg'];//头像
            //$userinfo->QQToken=$_POST['qq'];//QQ号码
			//$userinfo->Email=$_POST['email'];//Email
            $userinfo->TrueName=$_POST['truename'];//真实姓名
            $userinfo->Sex=$_POST['sex'];//性别
            $userinfo->PlaceOtherLogin=$_POST['PlaceOtherLogin'];//异地登录
            if($userinfo->save())
                echo "SUCCESS";
            else
                echo "FAIL";
            Yii::app()->end();
        }
        else
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            $this->render('userAccountCenter',array(
                'userinfo'=>$userinfo
            ));
        }
    }
    
    /*
        用户中心-修改密码
    */
    public function actionChangPassword()
    {
        if(isset($_POST['newpassword']) && $_POST['newpassword']!="")
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            $userinfo->PassWord=md5($_POST['newpassword']);//修改密码
            if($userinfo->save())
                echo "SUCCESS";
            else
                echo "FAIL";
        }
        else
            echo "FAIL";
        
    }
    
    
     /*
        用户中心-修改安全操作码
    */
    public function actionChangSafepwd()
    {
        if(isset($_POST['newSafepwd']) && $_POST['newSafepwd']!="")
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            $userinfo->SafePwd=md5($_POST['newSafepwd']);//修改安全操作码
            if($userinfo->save())
                echo "SUCCESS";
            else
                echo "FAIL";
        }
        else
            echo "FAIL";
        
    }
    
    /*
        用户找回安全操作码
    */
    public function actionUsergetBackSafePwd()
    {
        $this->renderPartial('usergetBackSafePwd');
    }
    

    /*
        用户中心-推广奖励明细
    */
    public function actionUserSpreadDetail()
    {
        //查询用户推广奖励记录
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and catalog=18';
        $criteria->order ="id desc";
    
        //分页开始
        $total = Recordlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Recordlist::model()->findAll($criteria);
        //分页结束
        $this->render('userSpreadDetail',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }

    /*
        用户中心-明细-提现明细
    */
    public function actionUserPayDetailTX()
    {
        //查询用户提现记录
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and catalog=8';
        $criteria->order ="id desc";
    
        //分页开始
        $total = Recordlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Recordlist::model()->findAll($criteria);
        //分页结束
        
        $this->render('userPayDetailTX',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    

    /*
        用户中心-申请提现
    */
    public function actionUserCashToBank()
    {
        if(isset($_POST['txMoneyNum']) && $_POST['txMoneyNum']!="" && isset($_POST['bankid']) && $_POST['bankid']!="")
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            if($_POST['txMoneyNum']<$userinfo->Money)//提现金额正常
            {
                //添加流水
                $record=new Recordlist();
                $record->userid=Yii::app()->user->getId();//用户id
                $record->catalog=8;//提现类型
                $record->number=$_POST['txMoneyNum'];//提现的金额
                $record->time=time();//操作时间
                $record->bankid=$_POST['bankid'];//银行卡id
                $record->txStatus=1;//提现申请中
                $record->save();//保存流水
                
                $userinfo->Money=$userinfo->Money-$_POST['txMoneyNum'];//余额等于原有金额减去提现金额
                if($userinfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            else//提现金额大于余额
                echo "MONEYTOOMATCH";
        }
        else
            $this->render('userCashToBank');
    }
    
    /*
        用户中心-用户提现列表
    */
    public function actionUserTxList()
    {
        //查询用户提现记录
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and catalog=8';
        $criteria->order ="id desc";
    
        //分页开始
        $total = Recordlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Recordlist::model()->findAll($criteria);
        //分页结束
        
        $this->render('userTxList',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }


     /*
        绑定认证掌柜号-删除掌柜号
    */
    public function actionDeleteWangwang()
    {
        if(isset($_GET['id']))
        {
            $wangwang=Blindwangwang::model()->findByPk($_GET['id']);
            $wangwang->delete();
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }
    function gettaskcount($start,$end){
        $tbprefix=Yii::app()->db->tablePrefix;
        $sql="SELECT COUNT(id) AS cc FROM ".$tbprefix."_usertask WHERE userid=".Yii::app()->user->getId()." AND addtime<'$end' AND addtime>'$start'";
        $row=Yii::app()->db->createCommand($sql)->queryRow();
        return $row['cc'];
    }
    //获取指定上月日期
    function getlastMonthDays($timenow,$day){
        $d=date('d',$timenow);$m=date('m',$timenow);$y=date('Y',$timenow);
        if ($d>$day){
            $date['start']=mktime(0,0,0,date('m',$timenow),$day,date('Y',$timenow));
            if ($m==12){
                $date['end']=mktime(0,0,0,1,$day,$y+1);
            }else{
                $date['end']=mktime(0,0,0,date('m',$timenow)+1,$day,date('Y',$timenow));
            }
        }else{
            $date['end']=mktime(0,0,0,date('m',$timenow),$day,date('Y',$timenow));
            if ($m==1){
                $date['start']=mktime(0,0,0,12,$day,$y-1);
            }else{
                $date['start']=mktime(0,0,0,date('m',$timenow)-1,$day,date('Y',$timenow));
            }
        }
        return $date;
    }
    //获取一周的开始和结束
    function getWeekRange(){
        // 将日期转时间戳
        $one=time()-((date('w')==0?7:date('w'))-1)*24*3600;
        $seven=time()+(7-(date('w')==0?7:date('w')))*24*3600;
        $date['start']=mktime(0,0,0,date('m',$one),date('d',$one),date('Y',$one));
        $date['end']=mktime(0,0,0,date('m',$seven),date('d',$seven),date('Y',$seven));
        return $date;
    }
}