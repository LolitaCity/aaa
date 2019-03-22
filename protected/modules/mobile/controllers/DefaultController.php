<?php
class DefaultController extends Controller
{
    public $layout=false;
    public function init(){
        $userid=Yii::app()->user->getId();
       if(empty($userid)){
           $this->redirect($this->createUrl('user/login'));exit;
       }
    }
    /*后台首页*/
    public function actionIndex()
    {
        $uid = Yii::app()->user->getId();
        $rditime1 = 60;
		$mintime =Toole::getMillisecond();
        if($mintime-$_SESSION['mintim']>500){
            $_SESSION['mintim'] = $mintime;
        }else{
            header("content-type:text/html;charset=utf-8");
            $arr ['err_code'] = 4;
            $arr ['msg'] = '系统发现你频繁访问页面，属于恶意访问页面，如果继续恶意访问账号将会冻结或无法接单！';
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
			
			 $_SESSION['mintim'] = $mintime;
            exit();
        }
        if(Yii::app()->redis->get($uid.'_system_webtitle')){
            $webtitleR =Yii::app()->redis->get($uid.'_system_webtitle');
            $authpersonR =Yii::app()->redis->get($uid.'_system_authperson');
            $taskScoreR =Yii::app()->redis->get($uid.'_system_taskScore');
            $authperson2R =Yii::app()->redis->get($uid.'_authperson2');
            $blindwangwangR =Yii::app()->redis->get($uid.'_blindwangwang');
        }else{
            //系统标题
            $sql = "SELECT `value`,`varname` FROM zxjy_system where varname='webtitle' OR varname='authperson' OR varname='taskScore'";
            $systems = Yii::app()->db->createCommand($sql)->queryAll();
            $system = array();
            foreach ($systems as $k => $v) {
                $system[$v['varname']] = $v['value'];
                Yii::app()->redis->set($uid.'_system_'.$v['varname'],$v['value'],$rditime1);
            }
            $webtitleR =Yii::app()->redis->get($uid.'_system_webtitle');
            $authpersonR =Yii::app()->redis->get($uid.'_system_authperson');
            $taskScoreR =Yii::app()->redis->get($uid.'_system_taskScore');

            //是否实名
            $sql = "SELECT * FROM zxjy_authperson where uid =".$uid;
            $authperson2 = Yii::app()->db->createCommand($sql)->queryRow();
            Yii::app()->redis->set($uid.'_authperson2',$authperson2['status'],$rditime1);
            $authperson2R =Yii::app()->redis->get($uid.'_authperson2');
            //是否绑定买号
            $sql = "SELECT * FROM zxjy_blindwangwang where userid =".$uid;
            $blindwangwang = Yii::app()->db->createCommand($sql)->queryRow();
            if(empty($blindwangwang)){
                Yii::app()->redis->set($uid.'_blindwangwang',1,$rditime1);
            }else{
                Yii::app()->redis->set($uid.'_blindwangwang',2,$rditime1);
            }
            $blindwangwangR =Yii::app()->redis->get($uid.'_blindwangwang');
            }
        //用户信息
        $sql = "select * from zxjy_user where id =".$uid;
        $userinfo = Yii::app()->db->createCommand($sql)->queryRow();
        //判断是否实名
        if($userinfo['AuthPerson'] == 0 && $authpersonR == 1){
            $auth_statue = 0;
         }else{
            $auth_statue = 1;
         }
         $rditime = 60;
        if(Yii::app()->redis->get($uid.'_usermoney')){
            $evaluatecount = Yii::app()->redis->get($uid.'_countte');
            $moneyall = Yii::app()->redis->get($uid.'_usermoney');
        }else{
            //账户存款
            $sql = "SELECT  SUM(increase) FROM zxjy_cashlog WHERE userid='{$uid}' ;";
            $usermoney = Yii::app ()->db->createCommand ( $sql )->queryScalar ();
            if ($usermoney == false){
                $usermoney = 0;
                Yii::app()->redis->set($uid.'_usermoney',$usermoney,$rditime);
            }else{
                Yii::app()->redis->set($uid.'_usermoney',$usermoney,$rditime);
                $sql = "UPDATE zxjy_user SET Money ={$usermoney} WHERE id='{$uid}'";
                $rr = Yii::app ()->db->createCommand ( $sql )->execute ();
            }
            $moneyall = Yii::app()->redis->get($uid.'_usermoney');

            //当前评价任务
            $sql = "select COUNT(doid)  from zxjy_taskevaluate where doid=$uid and doing = 0;";
            $countte = Yii::app()->db->createCommand($sql)->queryScalar();
            Yii::app()->redis->set($uid.'_countte',$countte,$rditime);
            $evaluatecount = Yii::app()->redis->get($uid.'_countte');
        }

        $sql = "SELECT utask.id,utask.taskid,utask.commission,t.remark,s.shopname,t.tasktype
                    FROM zxjy_usertask as utask 
                    LEFT JOIN zxjy_task AS t ON utask.taskid=t.id 
                    LEFT JOIN zxjy_taskmodel AS tm ON tm.pid = t.mark 
                    LEFT JOIN zxjy_shop AS s ON s.sid=utask.shopid  
                    WHERE   utask.userid={$uid} and utask.`status` = 0 ";
        $list = Yii::app ()->db->createCommand ( $sql )->queryRow();
        if($list['id'] == 0){
            $sql = "SELECT utask.id,utask.taskid,utask.commission,t.remark,s.shopname,t.tasktype
                    FROM zxjy_pretask as utask 
                    LEFT JOIN zxjy_task AS t ON utask.taskid=t.id 
                    LEFT JOIN zxjy_taskmodel AS tm ON tm.pid = t.mark 
                    LEFT JOIN zxjy_shop AS s ON s.sid=utask.shopid  
                    WHERE   utask.userid={$uid} and utask.`status` = 0 ";
            $list = Yii::app ()->db->createCommand ( $sql )->queryRow();
        }
        $sql = 'SELECT COUNT(1) FROM zxjy_pretask as p
                    LEFT JOIN zxjy_tasktime as tt on tt.id = p.tasktimeid
                    WHERE TO_DAYS(FROM_UNIXTIME(beginPay)) = TO_DAYS(NOW()) AND status <> 2 AND status != 4 AND p.userid = ' . $uid;
        $list['shopname'] = Toole::Substr_Cut($list['shopname']);
		 //密令码
            $ra = Toole::setGuid();
            $string = MD5($uid.$ra);
            $guid = $string;
            Yii::app()->redis->set('uid'.$uid,$guid, 30 * 60);
    	$this->render('index',array(
    	    'countte'=>$evaluatecount,
            'webtitle' =>$webtitleR,
            'auth_statue' =>$auth_statue,
            'taskScore' =>$taskScoreR,
            'userinfo' => $userinfo,
            'authperson2' =>$authperson2R,
            'blindwangwang' =>$blindwangwangR,
            'moneyall' =>$moneyall,
			'guid' =>$guid,
            'list'=>$list,
            'has_pre' => Yii::app() -> db -> createCommand($sql) -> queryScalar(),
        ));

    }
    
    //报错页面
    public function actionError()
    {
		
        $this->renderPartial('error');
    }
    /*
 * 队列总数大于100，任务总数小于30则返回
 *
 * */
    public function actionQueueNum(){
    	
    	$kkL = count(Yii::app ()->redis->keys ( 'L_*' ) ) ;
    	$arr = array ( 'quenum' => $kkL );
    	
    	$i = date('i' , time() ) * 1 ;
    	if($i<=3){  //每小时的前3分钟处理
    		//$this->delOverTask (); // 先删除过期任务
    	}
    	echo json_encode ( $arr );
    	exit ();
    }
    //接任务开始
    public function actionAcceptTask(){
        $arr=array();$kk=0;$lenth=0;$tbprefix=Yii::app()->db->tablePrefix;
        //判断刷客的账户以及任务状态是否正常
        $userinfo=User::model()->findByPk(Yii::app()->user->getId());
        $sql="SELECT `value`,`varname` FROM ".$tbprefix."_system where varname='taskScore' OR varname='monthAccount' OR varname='buyerSet'";
        $system=Yii::app()->db->createCommand($sql)->queryAll();
        $buyer=Blindwangwang::model()->find('userid='.Yii::app()->user->getId());
        $allsystem=array();
        // print_r($_POST);exit;
        foreach ($system as $k=>$v){
            if ($v['varname']=='buyerSet'){$v['value']=unserialize($v['value']);}
            $allsystem[$v['varname']]=$v['value'];

        }
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        //月结日时间戳start<end
        $mothday=$this->getlastMonthDays(time(),$allsystem['monthAccount']);$weekday=$this->getWeekRange();
        //判断用户月结日内是否超出单量 1天3单  7天15单  30天60单
        $daycount=$this->gettaskcount($beginToday,$endToday);
        $weekcount=$this->gettaskcount($weekday['start'],$weekday['end']);
        $monthcount=$this->gettaskcount($mothday['start'],$mothday['end']);
        $overtime=time()-3600;
        //判断是否还有正在进行的任务
        $usertask=Usertask::model()->find('userid='.Yii::app()->user->getId().' and addtime>'.$overtime.' and status=0');
        if ($userinfo->Status){
            $arr['err_code']=1;$arr['msg']='账户已被冻结，无法接单!';
        }elseif ($buyer->statue==0){
            $arr['err_code']=3;$arr['msg']='您的淘宝账户未审核，请联系管理人员！';
        }elseif ($buyer->statue==4){
            $arr['err_code']=8;$arr['msg']='您的淘宝账户审核未通过，请到会员中心--买号管理重新提交资料！';
        }elseif ($buyer->statue == 2) {
            $arr ['err_code'] = 8;
            $arr ['msg'] = '买号被冻结原因:'.$buyer->msg;
        }elseif($userinfo->Score < $allsystem['taskScore']) {
            $arr['err_code'] = 4;
            $arr['msg'] = '您的信用积分太低，不能接任务，请到：会员中心-》信用积分  赚取积分！';
        }elseif (@$usertask->userid) {
            $arr['err_code'] = 2;
            $arr['msg'] = '亲，不要吃着碗里的看着锅里的，请先把已经接手的任务完成再来领取新任务。';
        }elseif($monthcount>=$allsystem['buyerSet']['month']) {
            $arr['err_code'] = 5;
            $arr['msg'] = '每月最多接手'.$allsystem['buyerSet']['month'].'单，请下个月再来!';
        }elseif ($weekcount>=$allsystem['buyerSet']['week']) {
            $arr['err_code'] = 6;
            $arr['msg'] = '本周最多接手'.$allsystem['buyerSet']['week'].'个任务,请下周再来!';
        }elseif ($daycount>=$allsystem['buyerSet']['day'] + 1) {
            $arr['err_code'] = 7;
            $arr['msg'] = '当天最多接手'.$allsystem['buyerSet']['day'].'个任务,请明天再来!';
            /*
             * 未做：判断当前用户是否有投诉订单，有投诉订单不接任务
             *
             * */
        }else{
             
            if ($_POST['FineTaskClassType']=='销量任务'){
                $tbarr=array('tasktype'=>1,'price'=>$_POST['TaskPriceEnd']);
                Yii::app()->session['w'.Yii::app()->user->getId()]=$tbarr;
            }
            $isFG='0';
            if ($_POST['FineTaskClassType']=='复购任务'){
                $isFG='1';
                $fgarr=array('fgtasktype'=>1,'price'=>$_POST['TaskPriceEnd']);
                Yii::app()->session['w'.Yii::app()->user->getId()]=$fgarr;
            }

        }
        

        $this->render('index',array(
        		'length'=>1,
        		'acceptarr'=>$arr,
        		'isFG'=>$isFG));
    }
    //接任务结果(无用)
    public function actionGetQueAcceptRes(){
    	
    	// $res['queueCount']=0;$res['taskAcceptRes']='FAILED';$res['msg']='平台暂无任务可接，请稍后再试！'; echo json_encode($res);exit;
    		
    	/* 开始锁代码块*/
		$uID = Yii::app()->user->getId() ;
		$fp = fopen(BKC_URL."?TaskID=A001&T=WX&UserID={$uID}", 'r');
		$strJson = '';
		while ( ! feof ( $fp ) ) {
			$line = fgets ( $fp, 1024 ); // 每读取一行
			$strJson = $strJson . $line;
		}
		fclose($fp);
		if (empty ( $strJson ) == false) {
			$jsonObject = json_decode ( $strJson );
			if($jsonObject->IsOK==false){
				$res['queueCount']= $jsonObject->RType ;
				$res['taskAcceptRes']='FAILED';
				$res['msg']= $jsonObject->Description; 
				echo json_encode($res);exit;
			}
		}
    	 
    	
    	$markstr=substr($markstr,0,-1);
    	$instr=$markstr?" tm.pid IN($markstr) AND ":'';
    	
    	
    	
        //获得队伍总数
        $post=Yii::app()->session['w'.Yii::app()->user->getId()];
        $queueall=Yii::app()->redis->lrange('userque',0,99);
        $fgqueueall=Yii::app()->redis->lrange('fguserque',0,99);
        $res=array();
        //判断传递过来的参数是复购还是销量任务
        if(isset($post['fgtasktype'])){
            $queueCount=Yii::app()->redis->llen('fguserque');
            //如果用户在销量任务里排队就清除那个用户队列
            foreach ($queueall as $kq=>$vq){
                $quid=substr($vq,0,strpos($vq,','));
                if ($quid==Yii::app()->user->getId()){
                    Yii::app()->redis->lrem('userque',$vq,$kq);
                }
            }
        }else{
            $queueCount=Yii::app()->redis->llen('userque');
            //如果用户在复购队列里就清除那个用户的队列
            foreach ($fgqueueall as $kfq=>$vfq){
                $qfuid=substr($vfq,0,strpos($vfq,','));
                if ($qfuid==Yii::app()->user->getId()){
                    Yii::app()->redis->lrem('userque',$vfq,$kfq);
                }
            }
        }
        //队伍总数大于100的返回
        //if ($queueCount>99){  $res['queueCount']=200; }
        
        
        //取出1-10的队列，看里面的排队时间有没有超过5分钟，超过就清队列，同时允许20个人进入队列领取任务
        $que20=Yii::app()->redis->lrange('userque',0,19);
        foreach ($que20 as $key=>$val){
            $outtime=substr($val,strpos($val,',')+1);
            if ((time()-$outtime)>180){
                Yii::app()->redis->lrem('userque',$val,$key);
            }
        }
        //取出1-20的复购队列，看里面的排队时间有没有超过2分钟，超过就清队列，同时允许20个人进入队列领取任务,复购任务队列
        $fgque20=Yii::app()->redis->lrange('fguserque',0,19);
        foreach ($fgque20 as $fgkey=>$fgval){
            $outtime=substr($fgval,strpos($fgval,',')+1);
            if ((time()-$outtime)>120){
                Yii::app()->redis->lrem('fguserque',$fgval,$fgkey);
            }
        }

        if(isset($post['fgtasktype'])){
            $queue10=Yii::app()->redis->lrange('fguserque',0,19);//获取20条数据
        }else{
            $queue10=Yii::app()->redis->lrange('userque',0,19);//获取20条数据
        }
        $userstr=array();

        foreach ($queue10 as $k=>$v){
            $userstr[]=substr($v,0,strpos($v,','));
        }
		
		$userstr=array_unique($userstr);
			
        if (in_array(Yii::app()->user->getId(),$userstr)){
            //先删除过期任务
            //$this->delOverTask();
            //$userinfo=User::model()->findByPk(Yii::app()->user->getId());
            //$score=$userinfo->Score;
            $tbprefix=Yii::app()->db->tablePrefix;
            //开始查找任务

            $where='';$proidarr=array();
            $markarr=array();
            //$upprice=$post['price']?$post['price']:$score;

            if(isset($post['fgtasktype']) && !empty($post['fgprice'])){
                $upprice=$post['fgprice'];
            }elseif(isset($post['fgtasktype'])&&empty($post['fgprice'])){
                $upprice=5000;
            }else{
                $upprice=$post['price']?$post['price']:500;
            }

            //只搜无线端任务
            $where.= ' AND t.intlet IN(1,3,4,6) ';
            $startime=time();
            //查找任务表，得到有记录的产品id和商家id
            $intimeshop=30*24*60*60;$intimepro=50*24*60*60;
            //查找用户是否隐藏或者退出任务
            $startdate=strtotime(date('Y-m-d'));
            $unaceept=Unaceept::model()->find('userid='.Yii::app()->user->getId().' AND addtime>'.$startdate);
            $shopidstr='';$productidstr='';
            if ($unaceept->shopids)$shopidstr=$unaceept->shopids;
            if ($unaceept->proids)$productidstr=$unaceept->proids;
            if($post['fgtasktype']){
                $where.=$this->getFgProAndShop($intimepro,'proid',$productidstr);
                $where.=$this->getFgProAndShop($intimeshop,'shopid',$shopidstr);
            }else{
                $where.=$this->getProAndShop($intimeshop,'shopid',$shopidstr);
                $where.=$this->getProAndShop($intimepro,'proid',$productidstr);
            }


            //查找商家是否隐藏任务
            $usershop=User::model()->findAll('Opend=1 AND (ShowStatus=1 OR Status=1)');
            $hideshop='';
            foreach ($usershop as $value){
                $hideshop.=$value->id.',';
            }
            $hideshop=substr($hideshop,0,-1);$whereshop='';
            if ($hideshop){
                $whereshop.=' AND s.userid NOT IN('.$hideshop.') ';
            }
            $end5959=strtotime(@date('Y-m-d'))+3600*24-1;
            //查找产品状态显示正常的任务、proid不重复的,有数量的任务、当前时间+1小时小于任务结束时间的，以及当前时间大于开始时间的,
			//判断是销量任务还是复购任务
            if(isset($post['fgtasktype'])&&!empty($post['fgtasktype'])){
                $sql="SELECT DISTINCT t.proid,t.mark,s.sid,tt.start,tt.end,tt.takenumber,tt.number  FROM ".$tbprefix.'_task AS t LEFT JOIN '.$tbprefix.'_tasktime As tt ON t.mark=tt.pid '.
                    " LEFT JOIN ".$tbprefix."_shop AS s ON s.sid=t.shopid ".' WHERE t.status=0 AND t.tasktype=3 AND t.number>(t.qrnumber+t.del) '.
                    "$whereshop  AND '$startime'<tt.`end` AND '".time()."'>tt.`start` " .$where.
                    "  AND ( (tt.end<$end5959 AND ".time().">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )".
                    '   ORDER BY t.top DESC LIMIT 0,50';
            }else{
                $sql="SELECT DISTINCT t.proid,t.mark,s.sid,tt.start,tt.end,tt.takenumber,tt.number  FROM ".$tbprefix.'_task AS t LEFT JOIN '.$tbprefix.'_tasktime As tt ON t.mark=tt.pid '.
                    " LEFT JOIN ".$tbprefix."_shop AS s ON s.sid=t.shopid ".' WHERE t.status=0  AND t.tasktype=1 AND t.number>(t.qrnumber+t.del) '.
                    "$whereshop  AND '$startime'<tt.`end` AND '".time()."'>tt.`start` " .$where.
                    "  AND ( (tt.end<$end5959 AND ".time().">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )".
                    '   ORDER BY t.top DESC LIMIT 0,50';
            }
            $all=Yii::app()->db->createCommand($sql)->queryAll();

            if (empty($all)){
                $res['queueCount']=0;
                $res['taskAcceptRes']='FAILED';
                $res['msg']='平台暂无任务可接，请稍后再试！';
                $this->unsetredis($queue10);
                echo json_encode($res);exit;
            }

            
            
            
            foreach ($all as $k =>$v) {
                $proidarr[]=$v['proid'];
                $markarr[$v['proid']]=$v['mark'];
            }
            //得到产品id,查询当前的商家是否符合条件,1.获得买号的年龄，区域，性别进行判断
            $proidstr=implode(',',$proidarr);
            $buyer=Bindbuyer::model()->find('userid='.Yii::app()->user->getId());
            $sex=$buyer->sex==0?'man':'woman';$markstr='';$whereprostr='';
            if($proidstr){
                $whereprostr="id IN($proidstr) AND ";
            }
            
            /*2.查找符合条件的产品
            $sql="SELECT `id`,`sex`,`age` FROM ".$tbprefix."_product WHERE $whereprostr  region Like '%".$buyer->region."%'";
            $allist=Yii::app()->db->createCommand($sql)->queryAll();
            foreach ($allist as $k=>$v){
                $sexqujian=unserialize($v['sex']);
                $agequjian=unserialize($v['age']);
                if ($sexqujian[$sex]>40 ){
                    $markstr.="'".$markarr[$v['id']]."',";
                }elseif ($agequjian[$buyer->age]>30){
                    $markstr.="'".$markarr[$v['id']]."',";
                }
            }*/
            
            
            

            //3.通过符合条件的产品查找任务表，关联类型表 随机查找1条
            if($post['fgtasktype']) {
                $sql = "SELECT tm.id AS taskmodelid,t.id AS taskid,t.top,t.proid,t.userid as merchantid,t.shopid,tm.price,tm.commission,tm.express, tt.id AS tasktimeid,tt.number FROM " . $tbprefix . "_task AS t " .
                    " LEFT JOIN " . $tbprefix . '_taskmodel AS tm ON tm.pid=t.mark LEFT JOIN ' . $tbprefix . '_tasktime AS tt ON t.mark=tt.pid WHERE ' . $instr . "  t.tasktype=3 AND tm.price<=$upprice " . $where .
                    " AND $startime<tt.`end` AND '" . time() . "'>tt.`start` " .
                    " AND ( (tt.end<$end5959 AND " . time() . ">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )" .
                    " AND t.number>(t.qrnumber+t.del)  AND tm.number>(tm.takenumber+t.del)   ORDER BY RAND() LIMIT 1";
            }else {
                $sql = "SELECT tm.id AS taskmodelid,t.id AS taskid,t.top,t.proid,t.userid as merchantid,t.shopid,tm.price,tm.commission,tm.express, tt.id AS tasktimeid,tt.number FROM " . $tbprefix . "_task AS t " .
                    " LEFT JOIN " . $tbprefix . '_taskmodel AS tm ON tm.pid=t.mark LEFT JOIN ' . $tbprefix . '_tasktime AS tt ON t.mark=tt.pid WHERE ' . $instr . " t.tasktype=1 AND tm.price<=$upprice " . $where .
                    " AND $startime<tt.`end` AND '" . time() . "'>tt.`start` " .
                    " AND ( (tt.end<$end5959 AND " . time() . ">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )" .
                    " AND t.number>(t.qrnumber+t.del)  AND tm.number>(tm.takenumber+t.del)   ORDER BY RAND() LIMIT 1";
            }
            $task=Yii::app()->db->createCommand($sql)->queryRow();
            //查找usertask表看是否有记录防止重复添加
            //$issame=1;
            $ckShopBuyed = false;
            if($task['taskid']){
                $samesql="SELECT COUNT(1) as docount FROM ".$tbprefix."_usertask WHERE taskid={$task['taskid']}";
                $countdotask=Yii::app()->db->createCommand($samesql)->queryRow();
                $issame=$task['number']-$countdotask['docount'];
                //检查是否30天内重复接到同一商家的任务
                $uID = Yii::app ()->user->getId ();
                $shopID = $task ['shopid'];
                $sql2 = "SELECT COUNT(1) FROM zxjy_usertask   WHERE addtime > UNIX_TIMESTAMP ( DATE_ADD(NOW() ,INTERVAL -30 DAY) ) AND shopid='{$shopID}' AND userid='{$uID}' ";
                $cc = Yii::app ()->db->createCommand ( $sql2 )->queryScalar ();
                $ckShopBuyed = ($cc == 0);
            }
            
            
            
            $taskID = $task ['taskid'] ;
            if ($ckShopBuyed == true && $issame>0 && ! empty($task['taskmodelid']) && !empty($task['taskid']) && !empty($task['tasktimeid']) 
            		&&  $task['tasktimeid']!=''&& $task['tasktimeid']!=' '&&  $task['taskid']!=''&& $task['taskid']!=' '
            		&& $task['taskmodelid']!=' '&&  $task['taskmodelid']!=''){
                //$this->log($root.'\data\1.txt',json_encode($task));

                $userid=Yii::app()->user->getId();
                $tasksn=$this->build_task_no();
                $addtime=time();
                $buyerid=$buyer->id;
                $goodsprice=$task['price']+$task['express'];
                $commission=$this->getTaskCommission($goodsprice);
                
                $taskID = $task ['taskid'] ;
                //插入刷手任务
                $sql="INSERT INTO ".$tbprefix."_usertask  (`tasksn`,`userid`,`shopid`,`taskid`,`addtime`,`buyerid`,`merchantid`,`tasktimeid`,`taskmodelid`,`commission`,`proid`)".
                    " VALUES('$tasksn','$userid','$task[shopid]','$task[taskid]','$addtime','$buyerid','$task[merchantid]','$task[tasktimeid]','$task[taskmodelid]','$commission','$task[proid]')";
                $addres = Yii::app ()->db->createCommand ( $sql )->execute ();
                $insertid = Yii::app ()->db->getLastInsertID ();
                $this->unsetredis ( $queue10 );
                
                if($addres) {
                	$sql2 = "SELECT COUNT(1) FROM   zxjy_usertask  WHERE taskid='{$taskID}'" ;
                	$cc = Yii::app ()->db->createCommand ( $sql2 )->queryScalar();
                	if( $cc  > $task ['number'] ){
                		$sql2 = "DELETE FROM zxjy_usertask WHERE id='{$insertid}';" ;
                		Yii::app ()->db->createCommand ( $sql2 )->execute();
                		$addres = false ;
                		
                		$cTime = date ( 'Y-m-d H:i:s' );
                		$FF = fopen ( getcwd () . "\\tmp\\lockfile.txt" , "a+" );
                		fwrite ( $FF, "WX===>{$cTime} , TaskID=>{$taskID} , DELETE->{$insertid} \r\n" );
                		fclose ( $FF );
                	}
                }
                
                
                if ($addres){
                    //$this->log($root.'\data\1.txt',$addres.'aaa'.$insertid.'userid:'.Yii::app()->user->getId());
                    //更改任务表数量
                    $dbtask=Task::model()->findByPk($task['taskid']);
                    $dbtaskmodel=Taskmodel::model()->findByPk($task['taskmodelid']);
                    $dbtasktime=Tasktime::model()->findByPk($task['tasktimeid']);
                    $dbtask->qrnumber=$dbtask->qrnumber+1;
                    $dbtaskmodel->takenumber=$dbtaskmodel->takenumber+1;
                    $dbtasktime->takenumber=$dbtasktime->takenumber+1;
                    //扣除商家佣金
                    $us=User::model()->findByPk($task['merchantid']);

                    //生成日志文件
                    $cashLog=new Cashlog;
                    $cashLog->type='任务佣金';
                    $cashLog->remoney=$us->Money-($task['commission']+$task['top']);
                    $us->Money=$us->Money-($task['commission']+$task['top']);
                    $cashLog->increase='-'.($task['commission']+$task['top']);
                    $cashLog->beizhu='刷手接任务扣除佣金';
                    $cashLog->addtime=time();
                    $cashLog->userid=$task['merchantid'];
                    $cashLog->usertaskid=$insertid;
                    $cashLog->proid=$task['proid'];
                    $cashLog->shopid=$task['shopid'];
                    $cashLog->save();
                    $us->save();

                    $dbtask->save();
                    $dbtaskmodel->save();
                    $dbtasktime->save();
                    $res['queueCount']=0;
                    $res['taskAcceptRes']='SUCCESS';
                }
                //找到任务后，加入用户任务表
            }else{
                $res['queueCount']=0;$res['taskAcceptRes']='FAILED';$res['msg']='平台暂无任务可接，请稍后再试！';
                $this->unsetredis($queue10); echo json_encode($res);exit;
            }

        }else{
            $curuser='';
            foreach ($queueall as $val){
                $curuid=substr($val,0,strpos($val,','));
                if ($curuid==Yii::app()->user->getId()){
                    $curuser=$val;
                }
            }
            if (empty($curuser)){
                $res['queueCount']=0;$res['taskAcceptRes']='FAILED';$res['msg']='平台暂无任务可接，请稍后再试！';
            }else{
                $quebefore=array_search($curuser,$queueall);//当前用户之前的总人数
                $res['queueCount']=$quebefore+1;
            }

        }
        
        echo json_encode($res);exit;

    }


    //停止接单
    public function actionCancelQueue(){
        $this->redirect($this->createUrl('default/index'));
    }
    //队列过大时弹出消息
    public function actionOpenConfirm(){
        $this->render('openconfirm');
    }
    
    //用户退出
    public function actionLoginout(){
        Yii::app()->user->logout(false); //当前应用用户退出
        $this->redirect(array('user/login'));
    }
    function unsetredis($queue){
    }
    
    
    function log($file,$txt)
    {
        $fp =  fopen($file,'ab+');
        fwrite($fp,'-----------'.@date('Y-m-d H:i:s').'-----------------');
        fwrite($fp,$txt);
        fwrite($fp,"\r\n\r\n\r\n");
        fclose($fp);
    }
    //找到任务佣金梯度
    function getTaskCommission($goodsprice=0){
        $commission_buyer=System::model()->findByAttributes(array("varname"=>"commission_buyer"));
        $buyercommission=0;
        $arr=explode('|',$commission_buyer->value);
        $pricearr=array();
        foreach ($arr as $k=>$val){
            $price=trim(substr($val,0,strpos($val,'=')));
            $commission=trim(substr($val,strpos($val,'=')+1));
            $pricearr[$commission]=$price;
        }
        $commission=0;
        arsort($pricearr);
        foreach ($pricearr as $key=>$val){
            if ($goodsprice<=$val){
                $commission=$key;
            }
        }
        $max=max($pricearr);
        $kk=array_search($max,$pricearr);
        if ($goodsprice>=$max){
            $commission=$kk;
        }
        return $commission;
    }
    /*查找在范围内的商家和商品*/
    function getProAndShop($intime,$filed,$other=''){
        $tbprefix=Yii::app()->db->tablePrefix;$where='';
        $str='';
        $sql="SELECT ".$filed." FROM ".$tbprefix."_usertask WHERE userid=".Yii::app()->user->getId()." AND ".time()."<(addtime+$intime)";

        $all=Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($all as $v){
            $str.=$v[$filed].',';
        }
        $str=substr($str,0,-1);
        if (!empty($str) && !empty($other)){
            $where.=" AND t.".$filed." NOT IN(".$str.','.$other.") ";
        }
        if (!empty($str) && empty($other)){
            $where.=" AND t.".$filed." NOT IN(".$str.") ";
        }
        if (empty($str) && !empty($other)){
            $where.=" AND t.".$filed." NOT IN(".$other.") ";
        }
        return $where;
    }
    function getFgProAndShop($intime,$filed,$other=''){
        $tbprefix=Yii::app()->db->tablePrefix;$where='';
        $str='';$otherarr=array();
        $sql="SELECT ".$filed." FROM ".$tbprefix."_usertask WHERE userid=".Yii::app()->user->getId()." AND ".time().">(addtime+$intime)";
        if(!empty($other)){$otherarr=explode(',',$other);}
        $all=Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($all as $v){
            if(!in_array($v[$filed],$otherarr)){
                $str.=$v[$filed].',';
            }

        }
        $str=substr($str,0,-1);
        if (!empty($str)){
            $where.=" AND t.".$filed." IN(".$str.") ";
        }else{
            $where.=" AND t.".$filed." IN(0) ";
        }
        return $where;
    }
    /*清除任务*/
    function delOverTask(){
        $time=strtotime(@date('Y-m-d H:i:s'))-3600;
        $usertasks=Usertask::model()->findAll(" status=0 AND addtime<$time AND userid=".Yii::app()->user->getId());

        foreach ($usertasks as $val){
            if(!empty($val->orderimg) || $val->status>0 || $val->flag>2){

            }else{
                $task=Task::model()->find('id='.$val->taskid);
                $task->qrnumber=$task->qrnumber-1;
                $taskmodel=Taskmodel::model()->find('id='.$val->taskmodelid);
                $taskmodel->takenumber=$taskmodel->takenumber-1;
                $tasktime=Tasktime::model()->find('id='.$val->tasktimeid);
                $tasktime->takenumber=$tasktime->takenumber-1;

                //生成商家资金日志文件
                $cashLog=new Cashlog;
                $cashLog->type='返还佣金';
                $us=User::model()->findByPk($val->merchantid);
                $cashLog->remoney=$us->Money+($taskmodel->commission+$task->top);
                $us->Money=$us->Money+($taskmodel->commission+$task->top);
                $cashLog->increase='+'.($taskmodel->commission+$task->top);
                $cashLog->beizhu='刷手放弃任务返还佣金21';
                $cashLog->addtime=time();
                $cashLog->userid=$val->merchantid;
                $cashLog->usertaskid=$val->id;
                $cashLog->proid=$val->proid;
                $cashLog->shopid=$val->shopid;
                $cashLog->save();$us->save();
                $this->add_unnormaltask($val->id,$val->userid,$val->merchantid,$val->addtime,$val->updatetime,$val->taskid,$val->shopid,$val->taskmodelid,$val->tasktimeid,$val->status,'sitecontrller/delovertask');


                $task->save();
                $taskmodel->save();$tasktime->save();
                $ut=Usertask::model()->find('id='.$val->id);
                $ut->delete();
            }
        }
    }
    /*获取任务总数*/
    function gettaskcount($start,$end){
        $tbprefix=Yii::app()->db->tablePrefix;
        $sql="SELECT COUNT(id) AS cc FROM ".$tbprefix."_usertask WHERE userid=".Yii::app()->user->getId()." AND addtime<'$end' AND addtime>'$start'";
        $row=Yii::app()->db->createCommand($sql)->queryRow();
        return $row['cc'];
    }
    /*生成任务编号*/
    function build_task_no(){
        $Sn = 'V' .substr(time(),-3) . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        return  $Sn;
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
}