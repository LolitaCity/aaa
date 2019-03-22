<?php
class OtherController extends Controller
{
public  $layout=false;
public function init()
{
    parent::init();
    $userid=Yii::app()->user->getId();
    if (empty($userid)){
         $this->redirect($this->createUrl('user/login'));exit;
    }
}
public function actions()
{
    return array(
        // captcha action renders the CAPTCHA image displayed on the contact page
        'captcha'=>array(
            'class'=>'CCaptchaAction',
            'backColor'=>0xFFFFFF,
            'width'=>80,    //默认120
            'height'=>35,    //默认50
            'padding'=>2,    //文字周边填充大小

            'foreColor'=>0x2040A0,     //字体颜色
            'minLength'=>4,      //设置最短为6位
            'maxLength'=>4,       //设置最长为7位,生成的code在6-7直接rand了
            'transparent'=>true,      //显示为透明,默认中可以看到为false
            'offset'=>-2,        //设置字符偏移量
        )
    );
}
public function actionIndexWinopen(){
    $content_url=$this->createUrl('other/openNews',array('gid'=>198));
    $this->render('custom',array('barname'=>'首页弹窗公告','url'=>$content_url));
}
public  function  actionOpenNews(){
    //首页弹窗显示
    if ($_GET['gid']){
        $article=Article::model()->find('goods_id='.$_GET['gid']);
    }

    $this->render('openNews',array('content'=>@$article->goods_desc));
}
//弹出框后隐藏
public function actionIndexOk(){
    Yii::app()->session['closeNews']='1';echo Yii::app()->session['closeNews'];exit;
}
//修改手機號
public function actionEditPhoneNum(){
    $siteLogin=new SiteLoginForm;
    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
    if (isset($_POST['newPhone'])){
        //验证安全码是否一致
        $result=array();
//   [Yii.CCaptchaAction.381b57ad.other.captcha] => giwi
        $captcha_key='Yii.CCaptchaAction.'.Yii::app()->getId().'.other.captcha';
        $verify=$_SESSION[$captcha_key];
        if($verify!=$_POST['code']){
            $result['err_code']=3;$result['msg']='验证码不正确';
            echo json_encode($result);exit;
        }
        if(md5($_POST['safecode'])!=$userinfo->SafePwd){
            $result['err_code']=2;$result['msg']='安全码输入错误';
            echo json_encode($result);exit;
        }
        $userinfo->Phon=$_POST['newPhone'];
        if($userinfo->save()){
            $result['err_code']=1;$result['msg']='修改成功';
            echo json_encode($result);exit;
        }
    }
    $this->render('editPhoneNum',array('sitelogin'=>$siteLogin,'userInfo'=>$userinfo));
}
//修改密码
public function actionEditPassword(){
    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
    if (isset($_POST['newPwd'])){
        //验证安全码是否一致
        $result=array();
        if(md5($_POST['safePwd'])!=$userinfo->SafePwd){
            $result['err_code']=2;$result['msg']='安全码输入错误';
            echo json_encode($result);exit;
        }
        $userinfo->PassWord=md5($_POST['newPwd']);
        if($userinfo->save()){
            $result['err_code']=1;$result['msg']='修改成功';
            echo json_encode($result);exit;
        }
    }
    $this->render('editPassword',array('userInfo'=>$userinfo));
}
//修改安全码
public function actionEditSafepwd(){
    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
    if (isset($_POST['safepwd'])){
        //验证安全码是否一致
        $result=array();
        if(md5($_POST['pwd'])!=$userinfo->PassWord){
            $result['err_code']=2;$result['msg']='登录密码错误';
            echo json_encode($result);exit;
        }
        $userinfo->SafePwd=md5($_POST['safepwd']);
        if($userinfo->save()){
            $result['err_code']=1;$result['msg']='修改成功';
            echo json_encode($result);exit;
        }
    }
    $this->render('editPassword',array('userInfo'=>$userinfo));
}
//修改QQ
public function actionEditQQ(){
    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
    if (isset($_POST['qq'])){
        //验证安全码是否一致
        $result=array();
        if(md5($_POST['safePwd'])!=$userinfo->SafePwd){
            $result['err_code']=2;$result['msg']='安全码错误';
            echo json_encode($result);exit;
        }
        $userinfo->QQToken=$_POST['qq'];
        if($userinfo->save()){
            $result['err_code']=1;$result['msg']='修改成功';
            echo json_encode($result);exit;
        }
    }
    $this->render('editPassword',array('userInfo'=>$userinfo));
}
//修改微信号
public function actionEditWxchat(){
    if ($_POST){
        $user=User::model()->findByPk(Yii::app()->user->getId());
        if ($user->SafePwd!=md5($_POST['safePwd'])){
            $res['err_code']=1;$res['msg']='身份验证错误!';
            echo json_encode($res);exit;
        }
        $user->wechat=$_POST['newWeChat'];
        if ($user->save()){
            $res['err_code']=0;$res['msg']='修改成功!';
            echo json_encode($res);exit;
        }else{
            $res['err_code']=2;$res['msg']='修改失败!';
            echo json_encode($res);exit;
        }
    }
}
//买号管理
public function actionBuyerList(){
    $prefix=Yii::app()->getDb()->tablePrefix;
    $sql="SELECT w.userid,w.id,w.statue,w.wangwang,w.platform,w.msg,b.* from ".$prefix."_blindwangwang AS w LEFT JOIN ".$prefix."_bindbuyer AS b ON w.id=b.wangwangid WHERE w.userid=".Yii::app()->user->getId();
    $result=Yii::app()->db->createCommand($sql)->queryRow();
    $result['account_info']=unserialize($result['account_info']);
    $levelarr=$this->taobaoLevel();
    foreach ($levelarr as $v){
        if($result['account_info']['xy_val']>=$v[0] && $result['account_info']['xy_val']<=$v[1]){
            $result['level']=$v[2];
        }
    }
    //单量控制
    $buyerSet=System::model()->findByAttributes(array("varname"=>"buyerSet"));
    $buyerSet=unserialize($buyerSet->value);
    //判断当前的接手今天接了多少单  从后台控制的单量-当前接手的单量  此处没做
    $daycount=$buyerSet['day'];
    $this->layout='public_header';
    $this->render('buyerList',array('list'=>$result,'daycount'=>$daycount));
}
//显示买号详情
public function actionShowBuyerDetail(){
    $id=$_GET['id'];
    if($id){
        $prefix=Yii::app()->getDb()->tablePrefix;
        $sql="SELECT w.userid,w.statue,w.wangwang,w.platform,b.* from ".$prefix."_blindwangwang AS w LEFT JOIN ".$prefix."_bindbuyer AS b ON w.id=b.wangwangid WHERE b.id=".$id;
        $result=Yii::app()->db->createCommand($sql)->queryRow();
        $result['account_info']=unserialize($result['account_info']);
        $levelarr=$this->taobaoLevel();
        foreach ($levelarr as $v){
            if($result['account_info']['xy_val']>=$v[0] && $result['account_info']['xy_val']<=$v[1]){
                $result['level']=$v[2];
            }
        }
        //单量控制
        $buyerSet=System::model()->findByAttributes(array("varname"=>"buyerSet"));
        $buyerSet=unserialize($buyerSet->value);
        $article=Article::model()->find('goods_id=202');
        //判断当前的接手今天接了多少单  从后台控制的单量-当前接手的单量  此处没做
        $this->render('buyerDetail',array('list'=>$result,'buyerSet'=>$buyerSet,'article'=>$article));
    }else{
        echo '参数错误！';
    }

}
//平台公告
public function actionContentIndex(){
    $cat_id=@$_GET['cat_id']?@$_GET['cat_id']:39;
    $criteria = new CDbCriteria;
    $criteria->order ="sort_order asc,goods_id desc";
    $criteria->addCondition('is_delete=0 and cat_id='.$cat_id);//查询没有放入回首点的商品

    $proreg = Article::model()->findAll($criteria);//查询销售填写记录
    //分页结束
     $this->layout="public_header";
    $this->render('contentIndex',array(
        'list' => $proreg,
        'cat_id'=>$cat_id,
    ));

}
public function actionNewsInfo(){
    if($_GET['id']){
        $info=Article::model()->findByPk($_GET['id']);
    }
    $this->layout="public_header";
    $this->render('newsInfo',array('info'=>@$info));
}
//信用积分
public function actionAuxiliaryInfo(){
    $this->layout='public_header';
    $addscore=Addscore::model()->find('userid='.Yii::app()->user->getId());
    if ($addscore){
        $addscore->secondCard=unserialize($addscore->secondCard);
        $addscore->taobaoinfo=unserialize($addscore->taobaoinfo);
        $addscore->zhimainfo=unserialize($addscore->zhimainfo);
        $addscore->lifephoto=unserialize($addscore->lifephoto);
        $addscore->qqinfo=unserialize($addscore->qqinfo);
        $addscore->urgentinfo=unserialize($addscore->urgentinfo);
    }


    $this->render('auxiliaryInfo',array('addscore'=>$addscore));
}
//第二证件照片
public function actionSecondCard(){
    $addscore=Addscore::model()->find('userid='.Yii::app()->user->getId());
    $seconcard=array();
    if (@$_POST['img1']){
        $arr=array('status'=>'未审核','img1'=>$_POST['img1'],'img2'=>$_POST['img2'],'msg'=>'');
        if (!$addscore){
             $addscore=new Addscore;
        }
        $addscore->userid=Yii::app()->user->getId();
        $addscore->secondCard=serialize($arr);
        if ($addscore->save()){
            echo '<script>parent.location.reload();</script>';exit;
        }
    }
    if (@$addscore->secondCard){
        $seconcard=unserialize($addscore->secondCard);
    }

    $this->render('secondCard',array('seconcard'=>$seconcard));
}
//淘宝账户认证
public function actionAlipayCheck(){
    $addscore=Addscore::model()->find('userid='.Yii::app()->user->getId());
    $taobaoinfo=array();
    if (@$_POST['TaoBaoName']){
        $arr=array('status'=>'未审核','taobaoname'=>$_POST['TaoBaoName'],'alipaytel'=>$_POST['AlipayTel'],'img1'=>$_POST['img1'],'msg'=>'');
        if (!$addscore){
             $addscore=new Addscore;
        }
        $addscore->userid=Yii::app()->user->getId();
        $addscore->taobaoinfo=serialize($arr);
        if ($addscore->save()){
            echo '<script>parent.location.reload();</script>';exit;
        }
    }
    if (@$addscore->taobaoinfo){
        $taobaoinfo=unserialize($addscore->taobaoinfo);
    }
    $this->render('alipayCheck',array('taobaoinfo'=>$taobaoinfo));
}
//芝麻信用认证
public function actionZhimaCredit(){
    $addscore=Addscore::model()->find('userid='.Yii::app()->user->getId());
    $zhimainfo=array();
    if (@$_POST['AlipayRealName']){
        $arr=array('status'=>'未审核','alipayrealname'=>$_POST['AlipayRealName'],'sesamecredit'=>$_POST['SesameCredit'],'img1'=>$_POST['img1'],'msg'=>'');
        if (!$addscore){
             $addscore=new Addscore;
        }
        $addscore->userid=Yii::app()->user->getId();
        $addscore->zhimainfo=serialize($arr);
        if ($addscore->save()){
            echo '<script>parent.location.reload();</script>';exit;
        }
    }
    if (@$addscore->zhimainfo){
        $zhimainfo=unserialize($addscore->zhimainfo);
    }
    $this->render('zhimaCredit',array('zhimainfo'=>$zhimainfo));
}
//生活照认证
public function actionLifePhoto(){
    $addscore=Addscore::model()->find('userid='.Yii::app()->user->getId());
    $lifephoto=array();
    if (@$_POST['img1']){
        $arr=array('status'=>'未审核','img1'=>$_POST['img1'],'msg'=>'');
        if (!$addscore){
             $addscore=new Addscore;
        }
        $addscore->userid=Yii::app()->user->getId();
        $addscore->lifephoto=serialize($arr);
        if ($addscore->save()){
            echo '<script>parent.location.reload();</script>';exit;
        }
    }
    if (@$addscore->lifephoto){
        $lifephoto=unserialize($addscore->lifephoto);
    }
    $this->render('lifePhoto',array('lifephoto'=>$lifephoto));
}
//qq认证
public function actionQqCheck(){
    $addscore=Addscore::model()->find('userid='.Yii::app()->user->getId());
    $qqinfo=array();
    if (@$_POST['QQAge']){
        $arr=array('status'=>'未审核','qqage'=>$_POST['QQAge'],'img1'=>$_POST['img1'],'msg'=>'');
        if (!$addscore){
            $addscore=new Addscore;
        }
        $addscore->userid=Yii::app()->user->getId();
        $addscore->qqinfo=serialize($arr);
        if ($addscore->save()){
            echo '<script>parent.location.reload();</script>';exit;
        }
    }
    if (@$addscore->qqinfo){
        $qqinfo=unserialize($addscore->qqinfo);
    }
    $this->render('qqcheck',array('qqinfo'=>$qqinfo));
}
//紧急联系人认证
public function actionUrgentCheck(){
    $addscore=Addscore::model()->find('userid='.Yii::app()->user->getId());
    $urgentinfo=array();
    if (@$_POST['UrgentName']){
        $arr=array('status'=>'未审核','urgentname'=>$_POST['UrgentName'],'tel'=>$_POST['Tel'],'relationship'=>$_POST['Relationship'],'msg'=>'');
        if (!$addscore){
            $addscore=new Addscore;
        }
        $addscore->userid=Yii::app()->user->getId();
        $addscore->urgentinfo=serialize($arr);
        if ($addscore->save()){
            echo '<script>parent.location.reload();</script>';exit;
        }
    }
    if (@$addscore->urgentinfo){
        $urgentinfo=unserialize($addscore->urgentinfo);
    }
    $this->render('urgentCheck',array('urgentinfo'=>$urgentinfo));
}
//信用积分记录
public function actionScoreLog()
{

    $criteria = new CDbCriteria;
    $criteria->order = "add_time desc";
    $where='';
    $strdate=array();
    if (!empty($_POST)){
        //Array ( [BeginDate] => 2017-11-06 14:39 [EndDate] => 2017-11-07 00:00 )
        if (!empty($_POST['BeginDate']) && empty($_POST['EndDate'])){
            $where.=' AND add_time>'.strtotime($_POST['BeginDate']);
        }elseif (!empty($_POST['EndDate']) && empty($_POST['BeginDate'])){
            $where.=' AND add_time<'.strtotime($_POST['EndDate']);
        }elseif (!empty($_POST['EndDate']) && !empty($_POST['BeginDate'])){
            $where.=' AND add_time>'.strtotime($_POST['BeginDate']).' AND add_time<'.strtotime($_POST['EndDate']);
        }
        $strdate=array('BeginDate'=>$_POST['BeginDate'],'EndDate'=>$_POST['EndDate']);
    }
    $criteria->addCondition('userid='.Yii::app()->user->getId().$where);

    $total=Scorelog::model()->count($criteria);
    $pages=new CPagination($total);
    $pages->pageSize=10;
    $pages->applyLimit($criteria);

    $loglist = Scorelog::model()->findAll($criteria);
    $this->render('scoreLog',array('loglist'=>$loglist,'strdate'=>$strdate,'pages'=>$pages));
}



}




















?>