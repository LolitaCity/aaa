<?php


class SiteController extends Controller {
	/**
	 * Declares class-based actions.
	 */
	public $layout = '//layouts/public_header';
	public function actions() {
		return array (
				
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page' => array (
						'class' => 'CViewAction' 
				) 
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */

	/**
     * 刷手首页 优化
     */
    public function actionIndex() {
        $uid = Yii::app ()->user->getId ();
        //用于首页内容加载和判定用户是否登陆
        if ($uid) {
            // 读取未完成的评价任务
            //$tecriterria = new CDbCriteria ();
            //$tecriterria->addCondition ( 'doid=' . $uid . ' AND doing=0' );
            //$countte = Taskevaluate::model ()->count ( $tecriterria );
            // 总共赚取得佣金
            // $countprice = 0;
            // $sql="SELECT userid,increase,id FROM ".Yii::app()->db->tablePrefix."_cashlog WHERE (type='任务佣金' OR type='评价任务佣金' OR type='推广返现') AND userid=".Yii::app()->user->getId();
            //$sql = "SELECT SUM(increase) as increase  FROM " . Yii::app ()->db->tablePrefix . "_cashlog WHERE (type='任务佣金' OR type='评价任务佣金' OR type='推广返现') AND userid=" . $uid;
            //$countprice = Yii::app ()->db->createCommand ( $sql )->queryScalar ();
            //客服qq
            //$kefu = System::model ()->find ( "varname='buyerQQkefu'" );
            //$sql = "SELECT  SUM(increase) FROM zxjy_cashlog WHERE userid='{$uid}' ;";
            //$usermoney = Yii::app ()->db->createCommand ( $sql )->queryScalar ();
            //if ($usermoney == false)
            //	$usermoney = 0;
            //$sql = "UPDATE zxjy_user SET Money ={$usermoney} WHERE id='{$uid}'";
            //$rr = Yii::app ()->db->createCommand ( $sql )->execute ();
            /*
             * foreach ($res as $v){
             * $m=substr($v['increase'],1);
             * $countprice+=$m;
             * };
             */
            //缓存60s
			$mintime =Toole::getMillisecond();
        if($mintime-$_SESSION['mintim']>500){
            $_SESSION['mintim'] = $mintime;
        }else{
            header("content-type:text/html;charset=utf-8");
            $arr ['err_code'] = 4;
            $arr ['msg'] = '系统发现你频繁访问页面，属于恶意访问页面，如果继续恶意访问账号将会冻结或无法接单！';
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
            exit();
        }
            if(Yii::app()->redis->get($uid.'_countte')){
                $evaluatecount = Yii::app()->redis->get($uid.'_countte');
                $eschedual = Yii::app()->redis->get($uid.'_keschedual');
                $customer = Yii::app()->redis->get($uid.'_countprice');
                $moneyall = Yii::app()->redis->get($uid.'_usermoney');
            }else{
                // 读取未完成的评价任务 优化
                $sql = "select COUNT(doid)  from zxjy_taskevaluate where doid=$uid and doing = 0;";
                $countte = Yii::app()->db->createCommand($sql)->queryScalar();
                Yii::app()->redis->set($uid.'_countte',$countte,60);
                $evaluatecount = Yii::app()->redis->get($uid.'_countte');
                // 总共赚取得佣金
                $sql = "SELECT SUM(increase) as increase  FROM  zxjy_cashlog WHERE (type='任务佣金' OR type='评价任务佣金' OR type='推广返现' OR type ='任务推广佣金' OR type='评价佣金') AND userid=" . $uid;
                $countprice = Yii::app ()->db->createCommand ( $sql )->queryScalar ();
                if(empty($countprice)){
                    $countprice = 0;
                    Yii::app()->redis->set($uid.'_countprice',$countprice,60);
                }else{
                    Yii::app()->redis->set($uid.'_countprice',$countprice,60);
                }
                $customer = Yii::app()->redis->get($uid.'_countprice');
                //客服工单
                $sql = "SELECT COUNT(ut.id) FROM zxjy_schedual AS s LEFT JOIN zxjy_usertask AS ut ON s.usertaskid=ut.id   WHERE s.status >3 and s.buyerid=" . $uid;
                $keschedual = Yii::app ()->db->createCommand ( $sql )->queryScalar ();
                Yii::app()->redis->set($uid.'_keschedual',$keschedual,60);
                $eschedual = Yii::app()->redis->get($uid.'_keschedual');
                //账户存款
                $sql = "SELECT  SUM(increase) FROM zxjy_cashlog WHERE userid='{$uid}' ;";
                $usermoney = Yii::app ()->db->createCommand ( $sql )->queryScalar ();
                if ($usermoney == false){
                    $usermoney = 0;
                    Yii::app()->redis->set($uid.'_usermoney',$usermoney,60);
                }else{
                    Yii::app()->redis->set($uid.'_usermoney',$usermoney,60);
                    $sql = "UPDATE zxjy_user SET Money ={$usermoney} WHERE id='{$uid}'";
                    $rr = Yii::app ()->db->createCommand ( $sql )->execute ();
                }
                $moneyall = Yii::app()->redis->get($uid.'_usermoney');
            }
            //客服qq
            if(Yii::app()->redis->get('kefu')){
                $kefu = Yii::app()->redis->get('kefu');
            }else{
                $sql = 'select `value` from zxjy_system where varname=\'buyerQQkefu\'';
                $qq =  Yii::app ()->db->createCommand ( $sql )->queryScalar ();
                Yii::app()->redis->set('kefu',$qq,3600);
                $kefu = Yii::app()->redis->get('kefu');
            }

            $sql = "SELECT utask.id,utask.taskid,utask.commission,t.remark,s.shopname,t.tasktype
                    FROM zxjy_usertask as utask 
                    LEFT JOIN zxjy_task AS t ON utask.taskid=t.id 
                    LEFT JOIN zxjy_taskmodel AS tm ON tm.pid = t.mark 
                    LEFT JOIN zxjy_shop AS s ON s.sid=utask.shopid  
                    WHERE   utask.userid={$uid} and utask.`status` = 0 ";
            $list = Yii::app ()->db->createCommand ( $sql )->queryRow();
            if($list['id'] == 0)
            {
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
            //判定银行卡
			//密令码
            $ra = Toole::setGuid();
            $string = MD5($uid.$ra);
            $guid = $string;
            Yii::app()->redis->set('uid'.$uid,$guid, 30 * 60);
            $this->render ( PLATFORM != 'esx' ? 'index' : 'index_' . PLATFORM, array (
                'evaluatecount' => $evaluatecount,
                'customer' => $customer,
                'kefu' => $kefu,
                'moneyall' => $moneyall,
                'eschedual' =>$eschedual,
                'list'=>$list,
				'guid' =>$guid,
                'has_pre' => Yii::app() -> db -> createCommand($sql) -> queryScalar(),
            ));


        } else {
            $this->redirect ( $this->createUrl ( 'passport/login' ) );
        }
    }
    /*
	 * 判定是否绑银行卡
	 *
	 */
    public function actionBindingbankcard(){
        $uid = Yii::app ()->user->getId ();
        $arr = array();
        $sql = "SELECT COUNT(id) from zxjy_banklist WHERE userid=".$uid;
        $list = Yii::app ()->db->createCommand ( $sql )->queryRow();
        $arr['msg'] = $list['COUNT(id)'];
        echo json_encode($arr);
    }

    public function actionBinding()
    {
        $this->layout = false;
        $arr['msg'] = "未绑定银行卡";
        $this->render ( 'index_test', array (
            'mag' => $arr,
        ) );
    }
	/*
	 * 队列总数大于100，任务总数小于30则返回
	 *
	 */
	public function actionQueueNum() { 
		$kkL = count(Yii::app ()->redis->keys ( 'L_*' ) ) ;
		$arr = array ( 'quenum' => $kkL );
		$i = date('i' , time() ) * 1 ;
		if($i<=3){  //每小时的前3分钟处理
			//$this->delOverTask (); // 先删除过期任务
		}
		echo json_encode ( $arr );
		exit ();
	}


	// 接任务开始
	public function actionAcceptTask() {
		$res['queueCount']=0;$res['taskAcceptRes']='FAILED';$res['msg']='平台比较繁忙，请稍后再试！'; 
		echo json_encode($res);exit;
		$arr = array ();
		$kk = 0;
		$lenth = 0;
		$tbprefix = Yii::app ()->db->tablePrefix;
		// 判断刷客的账户以及任务状态是否正常
		$userinfo = User::model ()->findByPk ( Yii::app ()->user->getId () );
		$sql = "SELECT `value`,`varname` FROM " . $tbprefix . "_system where varname='taskScore' OR varname='monthAccount' OR varname='buyerSet'";
		$system = Yii::app ()->db->createCommand ( $sql )->queryAll ();
		$buyer = Blindwangwang::model ()->find ( 'userid=' . Yii::app ()->user->getId () );
		$allsystem = array ();
		// print_r($_POST);exit;
		foreach ( $system as $k => $v ) {
			if ($v ['varname'] == 'buyerSet') {
				$v ['value'] = unserialize ( $v ['value'] );
			}
			$allsystem [$v ['varname']] = $v ['value'];
		}
		$beginToday = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
		$endToday = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) + 1, date ( 'Y' ) ) - 1;
		// 月结日时间戳start<end
		$mothday = $this->getlastMonthDays ( time (), $allsystem ['monthAccount'] );
		$weekday = $this->getWeekRange ();
		// 判断用户月结日内是否超出单量 1天3单 7天15单 30天60单
		$daycount = $this->gettaskcount ( $beginToday, $endToday );
		$weekcount = $this->gettaskcount ( $weekday ['start'], $weekday ['end'] );
		$monthcount = $this->gettaskcount ( $mothday ['start'], $mothday ['end'] );
		$overtime = time () - 3600;
		// 判断是否还有正在进行的任务
		$uID = Yii::app ()->user->getId ();
		$usertask = Usertask::model ()->find ( 'userid=' . $userinfo ['id'] . ' and addtime>' . $overtime . ' and status=0' );

		if ($userinfo->Status) {
			$arr ['err_code'] = 1;
			$arr ['msg'] = '账户已被冻结，无法接单!';
		} elseif ($buyer->statue == 0) {
			$arr ['err_code'] = 3;
			$arr ['msg'] = '您的淘宝账户未审核，请联系管理人员！';
		} elseif ($buyer->statue == 4) {
			$arr ['err_code'] = 8;
			$arr ['msg'] = '您的淘宝账户审核未通过，请到会员中心--买号管理重新提交资料！';
		} elseif ($userinfo->Score < $allsystem ['taskScore']) {
			$arr ['err_code'] = 4;
			$arr ['msg'] = '您的信用积分太低，不能接任务，请到：会员中心-》信用积分  赚取积分！';
		} elseif (@$usertask->userid) {
			$arr ['err_code'] = 2;
			$arr ['msg'] = '亲，不要吃着碗里的看着锅里的，请先把已经接手的任务完成再来领取新任务。';
		} elseif ($monthcount >= $allsystem ['buyerSet'] ['month']) {
			$arr ['err_code'] = 5;
			$arr ['msg'] = '每月最多接手' . $allsystem ['buyerSet'] ['month'] . '单，请下个月再来!';
		} elseif ($weekcount >= $allsystem ['buyerSet'] ['week']) {
			$arr ['err_code'] = 6;
			$arr ['msg'] = '本周最多接手' . $allsystem ['buyerSet'] ['week'] . '个任务,请下周再来!';
		}  else {

			if ($_POST ['FineTaskClassType'] == '销量任务') {
				$tbarr = array (
						'platformtype' => $_POST ['PlatformTypes'],
						'tasktype' => $_POST ['TaskType'],
						'price' => $_POST ['TaskPriceEnd'],
						'tasktypelen' => $_POST ['TaskTypelen']
				);
				Yii::app ()->session ['w' . Yii::app ()->user->getId ()] = $tbarr;
			}
			$isFG = 'False';
			if ($_POST ['FineTaskClassType'] == '复购任务') {
				$isFG = 'True';
				$fgarr = array (
						'platformtype' => $_POST ['PlatformTypes'],
						'fgtasktype' => $_POST ['FGTaskType'],
						'fgprice' => $_POST ['FGTaskPriceEnd'],
						'tasktypelen' => $_POST ['FGTaskTypelen']
				);
				Yii::app ()->session ['w' . Yii::app ()->user->getId ()] = $fgarr;
			}
		}
		$this->render ( 'index', array (
				'length' => 1,
				'acceptarr' => $arr,
				'isFG' => $isFG
		) );
	}
	 // 接任务开始 优化
    public function actionAcceptTask01() {
		
		
        $arr = array ();
        $kk = 0;
        $lenth = 0;
        $tbprefix = Yii::app ()->db->tablePrefix;
        // 判断刷客的账户以及任务状态是否正常
        //$userinfo = User::model ()->findByPk ( Yii::app ()->user->getId () );
        $uID = Yii::app ()->user->getId ();
		$mintime =Toole::getMillisecond();
        if($mintime-$_SESSION['mintim']>500){
            $_SESSION['mintim'] = $mintime;
        }else{
            $arr ['err_code'] = 4;
            $arr ['msg'] = '系统发现你频繁访问页面，属于恶意访问页面，如果继续恶意访问账号将会冻结或无法接单！';
            $all = array(
                'length' => 1,
                'acceptarr' => $arr,
                'isFG' => $isFG
            );
            echo json_encode($all);
            exit();
        }
        $sql = "select `Status`,`Score` from zxjy_user where id=".$uID;
        $userinfo = Yii::app ()->db->createCommand ( $sql )->queryRow();
        //系统刷单限制
        $sql = "SELECT `value`,`varname` FROM " . $tbprefix . "_system where varname='taskScore' OR varname='monthAccount' OR varname='buyerSet'";
        $system = Yii::app ()->db->createCommand ( $sql )->queryAll ();
        //系统刷单限制条件 改成数组
        $allsystem = array ();
        foreach ( $system as $k => $v ) {
            if ($v ['varname'] == 'buyerSet') {
                //接手单量限制 反序列化
                $v ['value'] = unserialize ( $v ['value'] );
            }
            $allsystem [$v ['varname']] = $v ['value'];
        }
        //刷手买号
        $buyer = Blindwangwang::model ()->find ( 'userid=' . Yii::app ()->user->getId () );
        // print_r($_POST);exit;
        //获取今日开始时间戳和结束时间戳
        $beginToday = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
        $endToday = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) + 1, date ( 'Y' ) ) - 1;
        // 月结日时间戳start<end
        $mothday = $this->getlastMonthDays ( time (), $allsystem ['monthAccount'] );
        //周
        $weekday = $this->getWeekRange ();
        // 判断用户月结日内是否超出单量 1天3单 7天15单 30天60单
        $daycount = $this->gettaskcount ( $beginToday, $endToday );//当天
        $weekcount = $this->gettaskcount ( $weekday ['start'], $weekday ['end'] );//当周
        $monthcount = $this->gettaskcount ( $mothday ['start'], $mothday ['end'] );//当月
        //一个小时之前
        $overtime = time () - 3600;
        // 判断是否还有正在进行的任务
        $usertask = Usertask::model ()->find ( 'userid=' .$uID . ' and addtime>' . $overtime . ' and status=0' );
		 if($_POST){
            $this->Statisticaltimes($uID,$_POST['terminal']);
        }else{
            $arr ['err_code'] = 4;
            $arr ['msg'] = '页面';
            $all = array(
                'length' => 1,
                'acceptarr' => $arr,
                'isFG' => $isFG
            );
            echo json_encode($all);
            exit();
        }
        //账户是否冻结 都是根据系统的值来判定的
        if ($userinfo['Status']==1) {
            $arr ['err_code'] = 1;
            $arr ['msg'] = '账户已被冻结，无法接单!';
        } elseif ($buyer->statue == 0) {
            $arr ['err_code'] = 3;
            $arr ['msg'] = '您的淘宝账户未审核，请联系管理人员！';
        } elseif ($buyer->statue == 4) {
            $arr ['err_code'] = 8;
            $arr ['msg'] = '您的淘宝账户审核未通过，请到会员中心--买号管理重新提交资料！';
		} elseif ($buyer->statue == 2) {
            $arr ['err_code'] = 8;
            $arr ['msg'] = '买号被冻结原因:'.$buyer->msg;
        } elseif ($userinfo['Score'] < $allsystem ['taskScore']) {
            $arr ['err_code'] = 4;
            $arr ['msg'] = '您的信用积分太低，不能接任务，请到：会员中心-》信用积分  赚取积分！';
        } elseif (@$usertask->userid) {
            $arr ['err_code'] = 2;
            $arr ['msg'] = '亲，不要吃着碗里的看着锅里的，请先把已经接手的任务完成再来领取新任务。';
        } elseif ($monthcount >= $allsystem ['buyerSet'] ['month']) {
            $arr ['err_code'] = 5;
            $arr ['msg'] = '每月最多接手' . $allsystem ['buyerSet'] ['month'] . '单，请下个月再来!';
        } elseif ($weekcount >= $allsystem ['buyerSet'] ['week']) {
            $arr ['err_code'] = 6;
            $arr ['msg'] = '本周最多接手' . $allsystem ['buyerSet'] ['week'] . '个任务,请下周再来!';
        } elseif ($daycount >= $allsystem ['buyerSet'] ['day'] + 1) {
            $arr ['err_code'] = 7;
            $arr ['msg'] = '当天最多接手' . $allsystem ['buyerSet'] ['day'] . '个任务,请明天再来!';
            /*
             * 未做：判断当前用户是否有投诉订单，有投诉订单不接任务
             *
             */
        } else {
            // 任务类型判断 默认 isFG为（False ：销量任务 ）（True ：复购任务）
            if ($_POST ['FineTaskClassType'] == '销量任务') {
                $tbarr = array (
                    'platformtype' => $_POST ['PlatformTypes'],
                    'tasktype' => $_POST ['TaskType'],
                    'price' => $_POST ['TaskPriceEnd'],
                    'tasktypelen' => $_POST ['TaskTypelen']
                );
                $arr ['err_code'] = 9;
                $arr ['msg'] = '正在接销量任务';
                Yii::app ()->session ['w' . Yii::app ()->user->getId ()] = $tbarr;
            }
            $isFG = 'False';
            if ($_POST ['FineTaskClassType'] == '复购任务') {
                $isFG = 'True';
                $fgarr = array (
                    'platformtype' => $_POST ['PlatformTypes'],
                    'fgtasktype' => $_POST ['FGTaskType'],
                    'fgprice' => $_POST ['FGTaskPriceEnd'],
                    'tasktypelen' => $_POST ['FGTaskTypelen']
                );
                $arr ['err_code'] = 9;
                $arr ['msg'] = '正在接复购任务';
                Yii::app ()->session ['w' . Yii::app ()->user->getId ()] = $fgarr;
            }
        }
		$check_black_buyer_sql = 'SELECT COUNT(1) FROM zxjy_blackaccount where blackaccountinfo = "' . $buyer -> wangwang . '" AND status = 1';
        $is_black_buyer = Yii::app ()->db->createCommand ($check_black_buyer_sql)->queryScalar();
        if ($is_black_buyer)
        {
            $sql = 'SELECT COUNT(1) FROM zxjy_usertask as t
                    LEFT JOIN zxjy_bindbuyer as y ON y.id = t.buyerid
                    WHERE TO_DAYS(FROM_UNIXTIME(t.addtime)) = TO_DAYS(NOW()) AND wangwangid = ' . $buyer -> id . '
                    UNION
                    SELECT COUNT(1) FROM zxjy_pretask as pr
                    LEFT JOIN zxjy_bindbuyer as y ON y.id = pr.buyerid
                    WHERE TO_DAYS(FROM_UNIXTIME(pr.addtime)) = TO_DAYS(NOW()) AND wangwangid = ' . $buyer -> id;
            $r = Yii::app ()->db->createCommand ($sql)->queryColumn();
            $is_black_buyer = array_sum(Yii::app ()->db->createCommand ($sql)->queryColumn());
        }
        $sql = 'SELECT COUNT(1) FROM zxjy_usertask as ut
                LEFT JOIN zxjy_task as t on t.id = ut.taskid
                WHERE ut.userid = ' . $uID . ' AND TO_DAYS(FROM_UNIXTIME(ut.addtime)) = TO_DAYS(NOW()) AND tasktype < 4';
        $all = array(
            'length' => 1,
            'acceptarr' => $arr,
            'isFG' => $isFG,
			'is_black_buyer' => $is_black_buyer,
            'qrnumber' => PLATFORM == 'xkq' ? Yii::app() -> db -> createCommand($sql) -> queryScalar() : 0,  //日限制两单只对信客圈生效
        );
        echo json_encode($all);
    }
	
	//记录接单请求经过PHP次数
    public function StatisticalTimes($uid,$type){
        
        $dattime =strtotime(date('Y-m-d',time()));
        $Statistical= Statisticaltimes::model ()->find ( 'userid=' . Yii::app ()->user->getId (),'addtime >'.$dattime );
        if($Statistical){
            switch ($type){
                case 1:
                    $Statistical->pctype =  $Statistical->pctype+1;
                    $Statistical->update();
                    break;
                case 2:
                    $Statistical->phonetype =  $Statistical->phonetype+1;
                    $Statistical->update();
                    break;
            }

        }else{
            switch ($type){
                case 1:
                    $statisticaltimes = new Statisticaltimes();
                    $statisticaltimes->userid = $uid;
                    $statisticaltimes->addtime = time();
                    $statisticaltimes->pctype = 1;
                    $statisticaltimes->phonetype = 0;
                    $statisticaltimes->save();
                    break;
                case 2:
                    $statisticaltimes = new Statisticaltimes();
                    $statisticaltimes->userid = $uid;
                    $statisticaltimes->addtime = time();
                    $statisticaltimes->pctype = 0;
                    $statisticaltimes->phonetype = 1;
                    $statisticaltimes->save();
                    break;
            }
        }

    }
	
	// 取消排队
	public function actionCancelQueue() {
		//$uID = Yii::app ()->user->getId ();
		//$fp = fopen ( BKC_URL."?UnlookID={$uID}", 'r' );
		//fclose ( $fp );
		echo 0;
		exit ();
	}



	// 刷手在线数
	public function actionUserInlines() {
		$kkL = count( Yii::app ()->redis->keys ( 'L_*' ) ) ;
		$_LineUpCount =  Yii::app ()->redis->get( "LineUpCount")   ;
		$dd = date('Y-m-d h:i:sa' , time() ) ;
		echo "{$dd}==刷手在线数(60秒内)==>{$kkL} ,  进行中的处理数==>{$_LineUpCount}  "  ;
	}


	// 接任务结果
	public function actionGetQueAcceptRes() {
		$res['queueCount']=0;$res['taskAcceptRes']='FAILED';$res['msg']='平台比较繁忙，请稍后再试！';  echo json_encode($res);exit;
		/* 开始锁代码块 */
		$t = 'PC' ;
		if( isset($_GET['T']) ) $t=$_GET['T'] ;
		$uID = Yii::app ()->user->getId ();
		if( ! $uID)  {
			exit (   json_encode ( array(queueCount=>1000) ) );
		}

		//判定是否超单
        //系统刷单限制
        $sql = "SELECT `value`,`varname` FROM zxjy_system where varname='taskScore' OR varname='monthAccount' OR varname='buyerSet'";
        $system = Yii::app ()->db->createCommand ( $sql )->queryAll ();
        //系统刷单限制条件 改成数组
        $allsystem = array ();
        foreach ( $system as $k => $v ) {
            if ($v ['varname'] == 'buyerSet') {
                //接手单量限制 反序列化
                $v ['value'] = unserialize ( $v ['value'] );
            }
            $allsystem [$v ['varname']] = $v ['value'];
        }
        //获取今日开始时间戳和结束时间戳
        $beginToday = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
        $endToday = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) + 1, date ( 'Y' ) ) - 1;
        // 月结日时间戳start<end
        $mothday = $this->getlastMonthDays ( time (), $allsystem ['monthAccount'] );
        //周
        $weekday = $this->getWeekRange ();
        // 判断用户月结日内是否超出单量 1天3单 7天15单 30天60单
        $daycount = $this->gettaskcount ( $beginToday, $endToday );//当天
        $weekcount = $this->gettaskcount ( $weekday ['start'], $weekday ['end'] );//当周
        $monthcount = $this->gettaskcount ( $mothday ['start'], $mothday ['end'] );//当月

        if ($monthcount >= $allsystem ['buyerSet'] ['month']) {
            $arr ['err_code'] = 5;
            $arr ['msg'] = '每月最多接手' . $allsystem ['buyerSet'] ['month'] . '单，请下个月再来!';
            $arr ['queueCount'] = 0;
            $arr ['taskAcceptRes'] = 'FAILED';
            echo  json_encode ($arr);
            exit ();
        } elseif ($weekcount >= $allsystem ['buyerSet'] ['week']) {
            $arr ['err_code'] = 5;
            $arr ['msg'] = '每月最多接手' . $allsystem ['buyerSet'] ['month'] . '单，请下个月再来!';
            $arr ['queueCount'] = 0;
            $arr ['taskAcceptRes'] = 'FAILED';
            echo  json_encode ($arr);
            exit ();
        } elseif ($daycount >= $allsystem ['buyerSet'] ['day']) {
            $arr ['err_code'] = 5;
            $arr ['msg'] = '每月最多接手' . $allsystem ['buyerSet'] ['month'] . '单，请下个月再来!';
            $arr ['queueCount'] = 0;
            $arr ['taskAcceptRes'] = 'FAILED';
            echo  json_encode ($arr);
            exit ();
        }

		Yii::app ()->redis->set( 'L_'.$uID  , 1 , 60 ) ;

		$user_lines =   Yii::app ()->redis->get( "LineUpCount")   ;
		if( $user_lines > 50  ){
			$res['queueCount']=0;$res['taskAcceptRes']='FAILED';$res['msg']='平台比较繁忙，请稍后再试!!!';  echo json_encode($res);exit;
		}

		$current_sure_taskNum = Yii::app ()->redis->get( "current_sure_taskNum"   ) ;
		if( empty($current_sure_taskNum) == false && $current_sure_taskNum == 0    ){
			$res['queueCount']=0;$res['taskAcceptRes']='FAILED';$res['msg']='平台暂无任务，请稍后访问!！';  echo json_encode($res);exit;
		}

		$h = date('H' , time() ) * 1 ;
		$kkL = count( Yii::app ()->redis->keys ( 'L_*' ) ) ;
		$uKey = "uTime_{$uID}" ;
		$uTime =  Yii::app ()->redis->get( $uKey ) ;
//		if( time() -  $uTime  < 15 ||  $h < 21 ) {
//			//Yii::app ()->redis->set( $uKey , time() ) ;
//			exit ( json_encode ( array(queueCount=>$kkL) ) );
//		}
//		Yii::app ()->redis->set( $uKey , time() ) ;
//        if( (time() -  $uTime)  < 60 &&   ($h>8 &&  $h < 21)  ) {
//            //Yii::app ()->redis->set( $uKey , time() ) ;
//            $c = time() -  $uTime;
//            $res ['queueCount'] =$kkL;
//            $res ['msg'] = "l分钟内过于频繁！！！倒计时：".$c;
//            echo json_encode ( $res );
//            exit ();
//        }
            Yii::app ()->redis->set( $uKey , time() ) ;

		$tbprefix = Yii::app ()->db->tablePrefix;

        $h = date('H' , time() ) * 1 ;
        $kkL = count( Yii::app ()->redis->keys ( 'L_*' ) ) ;
        $uKey = "uTime_{$uID}" ;
        $uTime =  Yii::app ()->redis->get( $uKey ) ;


		// 开始查找任务
		$where = '';
		$proidarr = array ();
		$markarr = array ();
		// $upprice=$post['price']?$post['price']:$score;
		
		if (isset ( $post ['fgtasktype'] ) && ! empty ( $post ['fgprice'] )) {
			$upprice = $post ['fgprice'];
		} elseif (isset ( $post ['fgtasktype'] ) && empty ( $post ['fgprice'] )) {
			$upprice = 5000;
		} else {
			$upprice = $post ['price'] ? $post ['price'] : 500;
		}
		// 判断是无线端还是app
		if (isset ( $_SERVER ['HTTP_X_WAP_PROFILE'] )) {
			$where .= ' AND t.intlet IN(1,3,4,6) ';
		} else {
			if ($post ['tasktypelen'] == 1 && $post ['tasktype'] == 'PC') {
				$where .= ' AND t.intlet IN(2,5) ';
			} elseif ($post ['tasktypelen'] == 1 && $post ['tasktype'] == '无线端') {
				$where .= ' AND t.intlet IN(1,3,4,6) ';
			}
		}
		// 查找任务表，得到有记录的产品id和商家id
		$intimeshop = 30 * 24 * 60 * 60;
		$intimepro = 50 * 24 * 60 * 60;
		// 查找用户是否隐藏或者退出任务
		$startdate = strtotime ( date ( 'Y-m-d' ) );
		//$unaceept = Unaceept::model ()->find( "userid='{Yii::app ()->user->getId ()}' AND addtime>" .$startdate );
        $sql = "SELECT * FROM `zxjy_unaceept` where addtime >'{$startdate}' and userid =".Yii::app ()->user->getId ();
        $unaceept =Yii::app ()->db->createCommand ( $sql )->queryRow();
		$shopidstr = '';
		$productidstr = '';
		if ($unaceept) {
			if ($unaceept['shopids'])
				$shopidstr = $unaceept['shopids'];
				if ($unaceept->proids)
					$productidstr = $unaceept['proids'];
					if ($post ['fgtasktype']) {
						$where .= $this->getFgProAndShop ( $intimepro, 'proid', $productidstr );
						$where .= $this->getFgProAndShop ( $intimeshop, 'shopid', $shopidstr );
					} else {
						$where .= $this->getProAndShop ( $intimeshop, 'shopid', $shopidstr );
						$where .= $this->getProAndShop ( $intimepro, 'proid', $productidstr );
					}
		}

		// 查找商家是否隐藏任务
		// $usershop = User::model ()->findAll ( 'Opend=1 AND (ShowStatus=1 OR Status=1)' );
		$hideshop = ' SELECT id FROM zxjy_user  WHERE Opend=1 AND (ShowStatus=1 OR Status=1 OR Money < 1020 ) ';
		/*
		 * foreach ( $usershop as $value ) {
		 * $hideshop .= $value->id . ',';
		 * }
		 * $hideshop = substr ( $hideshop, 0, - 1 );
		 */
		$whereshop = '';
		if ($hideshop) {
			$whereshop .= ' AND t.userid NOT IN(' . $hideshop . ') ';
		}
		$end5959 = strtotime ( @date ( 'Y-m-d' ) ) + 3600 * 24 - 1;
		// 查找产品状态显示正常的任务、proid不重复的,有数量的任务、当前时间+1小时小于任务结束时间的，以及当前时间大于开始时间的,
		// 判断是销量任务还是复购任务
		// 		if (isset ( $post ['fgtasktype'] ) && ! empty ( $post ['fgtasktype'] )) {
		// 			$sql = "SELECT DISTINCT t.proid,t.mark,s.sid,tt.start,tt.end,tt.takenumber,tt.number  FROM " . $tbprefix . '_task AS t LEFT JOIN ' . $tbprefix . '_tasktime As tt ON t.mark=tt.pid ' . " LEFT JOIN " . $tbprefix . "_shop AS s ON s.sid=t.shopid " . ' WHERE t.status=0 AND t.tasktype=3 AND t.number>(t.qrnumber+t.del) ' . "$whereshop  AND '$startime'<tt.`end` AND '" . time () . "'>tt.`start` " . $where . "  AND ( (tt.end<$end5959 AND " . time () . ">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )" . '   ORDER BY t.top DESC LIMIT 0,50';
		// 		} else {
		// 			$sql = "SELECT DISTINCT t.proid,t.mark,s.sid,tt.start,tt.end,tt.takenumber,tt.number  FROM " . $tbprefix . '_task AS t LEFT JOIN ' . $tbprefix . '_tasktime As tt ON t.mark=tt.pid ' . " LEFT JOIN " . $tbprefix . "_shop AS s ON s.sid=t.shopid " . ' WHERE t.status=0  AND t.tasktype=1 AND t.number>(t.qrnumber+t.del) ' . "$whereshop  AND '$startime'<tt.`end` AND '" . time () . "'>tt.`start` " . $where . "  AND ( (tt.end<$end5959 AND " . time () . ">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )" . '   ORDER BY t.top DESC LIMIT 0,50';
		// 		}
		$tasktype = (isset ( $post ['fgtasktype'] ) && ! empty ( $post ['fgtasktype'] ))?3:1 ;
		$now_time = time () ;

		$sql = @"
SELECT  t.* ,  tm.id  as taskmodelid , tt.id as tasktimeid , tm.express , tm.price * tm.auction as price
FROM zxjy_task    AS   t
LEFT JOIN zxjy_tasktime As tt ON t.mark=tt.pid
LEFT JOIN zxjy_taskmodel AS tm ON t.mark=tm.pid
WHERE t.status=0  AND t.tasktype={$tasktype} AND t.number>(t.qrnumber+t.del)    
AND t.userid NOT IN( SELECT id FROM zxjy_user  WHERE Opend=1 AND (ShowStatus=1 OR Status=1  OR Money  < 1020 ) )  
AND UNIX_TIMESTAMP(NOW()) <tt.`end` AND UNIX_TIMESTAMP(NOW()) >tt.`start` 
AND UNIX_TIMESTAMP(NOW()) - ((tt.`end`-tt.`start`)/tt.number* t.qrnumber + tt.`start`)  > 0 
LIMIT 0 , 200  ; "  ;
		/* 
		 * //晚上9后不进行平均分配时间进行派单
		 * */
		
		if($h >= 21 ){
			$sql = @"
SELECT t.* ,  tm.id  as taskmodelid , tt.id as tasktimeid , tm.express , tm.price * tm.auction as price
FROM zxjy_task    AS   t
LEFT JOIN zxjy_tasktime As tt ON t.mark=tt.pid
LEFT JOIN zxjy_taskmodel AS tm ON t.mark=tm.pid
WHERE t.status=0  AND t.tasktype='1' AND t.number>(t.qrnumber+t.del)    
AND t.userid NOT IN( SELECT id FROM zxjy_user  WHERE Opend=1 AND (ShowStatus=1 OR Status=1  OR Money  < 1020 ) )  
AND UNIX_TIMESTAMP(NOW()) <tt.`end` AND UNIX_TIMESTAMP(NOW()) >tt.`start` ; "  ;
		}
		
		/*
		 $sql = "SELECT t.* ,  tm.id  as taskmodelid , tt.id as tasktimeid , tm.express
		 FROM zxjy_task AS t
		 LEFT JOIN zxjy_tasktime As tt ON t.mark=tt.pid
		 LEFT JOIN zxjy_taskmodel AS tm ON t.mark=tm.pid
		 WHERE t.status=0  AND t.tasktype='1' AND t.number>(t.qrnumber+t.del)    AND t.userid NOT IN( SELECT id FROM zxjy_user  WHERE Opend=1 AND (ShowStatus=1 OR Status=1) )    " ;
		 */
		$all = Yii::app ()->db->createCommand ( $sql )->queryAll ();
		if (empty ( $all ) ) {

			Yii::app ()->redis->set( $uKey  , time() + 60 * 5   ) ; //表示：5分钟内请求不做任何查询，直接返回
			$res ['queueCount'] = 0;
			$res ['taskAcceptRes'] = 'FAILED';
			$res ['msg'] = '平台暂无任务可接，请稍后再试！';
			echo json_encode ( $res );
			exit ();
		}
		Yii::app ()->redis->set( "current_sure_taskNum"    , count($all) ,  60 ) ;

		$taskIndex = array_rand ($all , 1);
		$task = $all[$taskIndex] ;
		if( isset($task)== false){
            $res ['queueCount'] =$kkL;
            $res ['msg'] = "taskIndex不知道：".$taskIndex;
           echo  json_encode ($res);
           exit ();
		}
		$task ['taskid'] = $task['id'] ;
		
		/*
		 foreach ( $all as $k => $v ) {
		 $proidarr [] = $v ['proid'];
		 $markarr [$v ['proid']] = $v ['mark'];
		 }
		 // 得到产品id,查询当前的商家是否符合条件,1.获得买号的年龄，区域，性别进行判断
		 $proidstr = implode ( ',', $proidarr );
		 $buyer = Bindbuyer::model ()->find ( "userid='{Yii::app ()->user->getId ()}'" );
		 $sex = $buyer->sex == 0 ? 'man' : 'woman';
		 $markstr = '';
		 $whereprostr = '';
		 if ($proidstr) {
		 $whereprostr = "id IN($proidstr) AND ";
		 }
		 */
		/* 2.查找符合条件的产品
		 $sql = "SELECT `id`,`sex`,`age` FROM " . $tbprefix . "_product WHERE $whereprostr  region Like '%" . $buyer->region . "%'";
		 $allist = Yii::app ()->db->createCommand ( $sql )->queryAll ();
		 foreach ( $allist as $k => $v ) {
		 $sexqujian = unserialize ( $v ['sex'] );
		 $agequjian = unserialize ( $v ['age'] );
		 if ($sexqujian [$sex] > 40) {
		 $markstr .= "'" . $markarr [$v ['id']] . "',";
		 } elseif ($agequjian [$buyer->age] > 30) {
		 $markstr .= "'" . $markarr [$v ['id']] . "',";
		 }
		 }
		 
		 $markstr = substr ( $markstr, 0, - 1 );
		 // $instr = $markstr ? " tm.pid IN($markstr) AND " : '';
		 */
		$instr = '';
		/*
		 // 3.通过符合条件的产品查找任务表，关联类型表 随机查找1条
		 if ($post ['fgtasktype']) {
		 $sql = "SELECT tm.id AS taskmodelid,t.id AS taskid,t.top,t.proid,t.userid as merchantid,t.shopid,tm.price,tm.commission,tm.express, tt.id AS tasktimeid,tt.number FROM " . $tbprefix . "_task AS t " . " LEFT JOIN " . $tbprefix . '_taskmodel AS tm ON tm.pid=t.mark LEFT JOIN ' . $tbprefix . '_tasktime AS tt ON t.mark=tt.pid WHERE ' . $instr . "  t.tasktype=3 AND tm.price<=$upprice " . $where . " AND $startime<tt.`end` AND '" . time () . "'>tt.`start` " . " AND ( (tt.end<$end5959 AND " . time () . ">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )" . " AND t.number>(t.qrnumber+t.del)  AND tm.number>(tm.takenumber+t.del)   ORDER BY RAND() LIMIT 1";
		 } else {
		 $sql = "SELECT tm.id AS taskmodelid,t.id AS taskid,t.top,t.proid,t.userid as merchantid,t.shopid,tm.price,tm.commission,tm.express, tt.id AS tasktimeid,tt.number FROM " . $tbprefix . "_task AS t " . " LEFT JOIN " . $tbprefix . '_taskmodel AS tm ON tm.pid=t.mark LEFT JOIN ' . $tbprefix . '_tasktime AS tt ON t.mark=tt.pid WHERE ' . $instr . " t.tasktype=1 AND tm.price<=$upprice " . $where . " AND $startime<tt.`end` AND '" . time () . "'>tt.`start` " . " AND ( (tt.end<$end5959 AND " . time () . ">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )" . " AND t.number>(t.qrnumber+t.del)  AND tm.number>(tm.takenumber+t.del)   ORDER BY RAND() LIMIT 1";
		 }
		 $task = Yii::app ()->db->createCommand ( $sql )->queryRow ();
		 */
		
		
		// 查找usertask表看是否有真超单的记录
		// $issame = 1;
		$samesql = "SELECT COUNT(taskid) as docount FROM " . $tbprefix . "_usertask WHERE taskid=$task[taskid]";
		$countdotask = Yii::app ()->db->createCommand ( $samesql )->queryRow ();
		$issame = $task ['number'] - $countdotask ['docount'];
		
		
		//$ckShopBuyed =1 ;
		// $root=dirname(dirname(dirname(__FILE__)));
		if ($issame > 0 && ! empty ( $task ['taskmodelid'] )
				&& ! empty ( $task ['taskid'] ) && ! empty ( $task ['tasktimeid'] )
				&& $task ['tasktimeid'] != ''  && $task ['tasktimeid'] != ' ' && $task ['taskid'] != '' && $task ['taskid'] != ' '
				&& $task ['taskmodelid'] != ' ' && $task ['taskmodelid'] != '') {
					// $this->log($root.'\data\1.txt',json_encode($task));
					
					$userid = Yii::app ()->user->getId ();
					if( isset($userid) == false ){
                        $res ['queueCount'] =$kkL;
                        $res ['msg'] = "超单：".$userid;
                        echo  json_encode ($res);
                        exit();
					}
					$tasksn = $this->build_task_no ();
					$addtime = time ();
					$buyerid = $buyer->id;
					$goodsprice = $task ['price'] + $task ['express'];
					$commission = $this->getTaskCommission ( $goodsprice );
					$taskID = $task ['taskid'];

					Yii::app ()->redis->set( $uKey  , time() + 60 * 60  , $T_Repire ) ; //设置更长的时间让访用户在该请求未返回前，忽略之后追加的请求
					
					// 插入刷手任务
					$fp = fopen (BKC_URL."?ActionTag=AddUserTask&T={$t}&TaskID={$taskID}&UserID={$userid}&TaskSN={$tasksn}&Commission={$commission}", 'r' );
					$strJson = '';
					while ( ! feof ( $fp ) ) {
						$line = fgets ( $fp, 1024 ); // 每读取一行
						$strJson = $strJson . $line;
					}
					fclose ( $fp );
					Yii::app ()->redis->set( $uKey  , time()  ) ;  //该请求返回后，设置为正常时间
					if (empty ( $strJson ) == false) {
						$jsonObject = json_decode ( $strJson );
						if ($jsonObject->IsOK == true) {
							Yii::app ()->redis->set( $uKey  , time() + 60 * 5   ) ; //表示：成功接到任务，则忽略5分钟内的请求
							$res ['queueCount'] = 0;
							$res ['taskAcceptRes'] = 'SUCCESS';
							echo json_encode ( $res );
							exit ();
						}
						else if( $jsonObject->RType < 0  ){
							Yii::app ()->redis->set( $uKey  , time() + 60 ) ;
							exit (   json_encode ( array(queueCount=>0 , taskAcceptRes=>'FAILED' ,  msg=>$jsonObject->Description ) ) );
						}
					}
					Yii::app ()->redis->set( $uKey  , time()    ) ;
                      $res ['queueCount'] =$kkL;
                      $res ['msg'] = "尚未找到任务：".$userid;
                      echo  json_encode ($res);
                      exit ();
					
				} else {
					Yii::app ()->redis->set( $uKey  , time() + 60 * 3   ) ; //表示：10分钟内请求不做任何查询，直接返回
					$res ['queueCount'] = 0;
					$res ['taskAcceptRes'] = 'FAILED';
					$res ['msg'] = '平台暂无任务可接，请稍后再试！';
					echo json_encode ( $res );
					exit ();
				}
				
				echo json_encode ( $res );
				exit ();
	}

	function unsetredis($queue) {
	}
	function log($file, $txt) {
		$fp = fopen ( $file, 'ab+' );
		fwrite ( $fp, '-----------' . @date ( 'Y-m-d H:i:s' ) . '-----------------' );
		fwrite ( $fp, $txt );
		fwrite ( $fp, "\r\n\r\n\r\n" );
		fclose ( $fp );
	}
	// 找到任务佣金梯度
	function getTaskCommission($goodsprice = 0) {
		$commission_buyer = System::model ()->findByAttributes ( array (
				"varname" => "commission_buyer" 
		) );
		$buyercommission = 0;
		$arr = explode ( '|', $commission_buyer->value );
		$pricearr = array ();
		foreach ( $arr as $k => $val ) {
			$price = trim ( substr ( $val, 0, strpos ( $val, '=' ) ) );
			$commission = trim ( substr ( $val, strpos ( $val, '=' ) + 1 ) );
			$pricearr [$commission] = $price;
		}
		$commission = 0;
		arsort ( $pricearr );
		foreach ( $pricearr as $key => $val ) {
			if ($goodsprice <= $val) {
				$commission = $key;
			}
		}
		$max = max ( $pricearr );
		$kk = array_search ( $max, $pricearr );
		if ($goodsprice >= $max) {
			$commission = $kk;
		}
		return $commission;
	}
	/* 查找在范围内的商家和商品 */
	function getProAndShop($intime, $filed, $other = '') {
		$tbprefix = Yii::app ()->db->tablePrefix;
		$where = '';
		$str = '';
		$sql = "SELECT " . $filed . " FROM " . $tbprefix . "_usertask WHERE userid=" . Yii::app ()->user->getId () . " AND " . time () . "<(addtime+$intime)";
		
		$all = Yii::app ()->db->createCommand ( $sql )->queryAll ();
		foreach ( $all as $v ) {
			$str .= $v [$filed] . ',';
		}
		$str = substr ( $str, 0, - 1 );
		if (! empty ( $str ) && ! empty ( $other )) {
			$where .= " AND t." . $filed . " NOT IN(" . $str . ',' . $other . ") ";
		}
		if (! empty ( $str ) && empty ( $other )) {
			$where .= " AND t." . $filed . " NOT IN(" . $str . ") ";
		}
		if (empty ( $str ) && ! empty ( $other )) {
			$where .= " AND t." . $filed . " NOT IN(" . $other . ") ";
		}
		return $where;
	}
	function getFgProAndShop($intime, $filed, $other = '') {
		$tbprefix = Yii::app ()->db->tablePrefix;
		$where = '';
		$str = '';
		$otherarr = array ();
		$sql = "SELECT " . $filed . " FROM " . $tbprefix . "_usertask WHERE userid=" . Yii::app ()->user->getId () . " AND " . time () . ">(addtime+$intime)";
		if (! empty ( $other )) {
			$otherarr = explode ( ',', $other );
		}
		$all = Yii::app ()->db->createCommand ( $sql )->queryAll ();
		foreach ( $all as $v ) {
			if (! in_array ( $v [$filed], $otherarr )) {
				$str .= $v [$filed] . ',';
			}
		}
		$str = substr ( $str, 0, - 1 );
		if (! empty ( $str )) {
			$where .= " AND t." . $filed . " IN(" . $str . ") ";
		} else {
			$where .= " AND t." . $filed . " IN(0) ";
		}
		return $where;
	}
    /* 清除任务01 */
    public function actionQueuedl() {
        $arr= array();
        $i = date('i' , time() ) * 1 ;
        $arr['msg'] = "清除过期任务";
        if($i<=3){  //每小时的前3分钟处理
           // $this->delOverTask (); // 先删除过期任务
            $arr['msg'] = "以清除过期任务";
        }
        echo json_encode ( $arr );
        exit ();
    }
  
  /* 清除任务01 */
    public function actionQueuedlall() {
        $arr= array();
        $i = date('i' , time() ) * 1 ;
        $arr['msg'] = "清除过期任务";
        
            $this->delOverTask (); // 先删除过期任务
            $arr['msg'] = "以清除过期任务";
        
        echo json_encode ( $arr );
        exit ();
    }
	/* 清除任务 */
	function delOverTask() {
		$time = strtotime ( @date ( 'Y-m-d H:i:s' ) ) - 3600;
		$usertasks = Usertask::model ()->findAll ( " status=0 AND addtime<$time" );
		foreach ( $usertasks as $val ) {
			if (! empty ( $val->orderimg ) || $val->status > 0 || $val->flag > 2) {
			} else {
				
				$UserTaskID = $val->id;
				$fp = fopen ( BKC_URL."?ActionTag=ClearUserTask&UserTaskID={$UserTaskID}", 'r' );
				$strJson = '';
				while ( ! feof ( $fp ) ) {
					$line = fgets ( $fp, 1024 ); // 每读取一行
					$strJson = $strJson . $line;
				}
				fclose ( $fp );
				if (empty ( $strJson ) == false) {
					$jsonObject = json_decode ( $strJson );
					if ($jsonObject->IsOK == true) {
						$this->add_unnormaltask ( $val->id, $val->userid, $val->merchantid, $val->addtime, $val->updatetime, $val->taskid, $val->shopid, $val->taskmodelid, $val->tasktimeid, $val->status, 'sitecontrller/delovertask' );
					}
				}
				
			}
		}
	}
	/* 获取任务总数 */
	function gettaskcount($start, $end) {
		$tbprefix = Yii::app ()->db->tablePrefix;
		$sql = "SELECT COUNT(id) AS cc FROM " . $tbprefix . "_usertask WHERE userid=" . Yii::app ()->user->getId () . " AND addtime<'$end' AND addtime>'$start'";
		$row = Yii::app ()->db->createCommand ( $sql )->queryRow ();
		return $row ['cc'];
	}
	/* 生成任务编号 */
	function build_task_no() {
		$Sn = 'V' . substr ( time (), - 3 ) . str_pad ( mt_rand ( 1, 99999 ), 5, '0', STR_PAD_LEFT );
		return $Sn;
	}
	// 获取一周的开始和结束
	function getWeekRange() {
		// 将日期转时间戳
		$one = time () - ((date ( 'w' ) == 0 ? 7 : date ( 'w' )) - 1) * 24 * 3600;
		$seven = time () + (7 - (date ( 'w' ) == 0 ? 7 : date ( 'w' ))) * 24 * 3600;
		$date ['start'] = mktime ( 0, 0, 0, date ( 'm', $one ), date ( 'd', $one ), date ( 'Y', $one ) );
		$date ['end'] = mktime ( 0, 0, 0, date ( 'm', $seven ), date ( 'd', $seven ), date ( 'Y', $seven ) );
		return $date;
	}
	// 获取指定上月日期
	function getlastMonthDays($timenow, $day) {
		$d = date ( 'd', $timenow );
		$m = date ( 'm', $timenow );
		$y = date ( 'Y', $timenow );
		if ($d > $day) {
			$date ['start'] = mktime ( 0, 0, 0, date ( 'm', $timenow ), $day, date ( 'Y', $timenow ) );
			if ($m == 12) {
				$date ['end'] = mktime ( 0, 0, 0, 1, $day, $y + 1 );
			} else {
				$date ['end'] = mktime ( 0, 0, 0, date ( 'm', $timenow ) + 1, $day, date ( 'Y', $timenow ) );
			}
		} else {
			$date ['end'] = mktime ( 0, 0, 0, date ( 'm', $timenow ), $day, date ( 'Y', $timenow ) );
			if ($m == 1) {
				$date ['start'] = mktime ( 0, 0, 0, 12, $day, $y - 1 );
			} else {
				$date ['start'] = mktime ( 0, 0, 0, date ( 'm', $timenow ) - 1, $day, date ( 'Y', $timenow ) );
			}
		}
		return $date;
	}
	/*
	 * 会员等级说明
	 */
	public function actionUserLeveldoc() {
		$this->render ( 'userLeveldoc' );
	}
	
	/**
	 * Displays the contact page
	 */
	public function actionContact() {
		$model = new ContactForm ();
		if (isset ( $_POST ['ContactForm'] )) {
			$model->attributes = $_POST ['ContactForm'];
			if ($model->validate ()) {
				$name = '=?UTF-8?B?' . base64_encode ( $model->name ) . '?=';
				$subject = '=?UTF-8?B?' . base64_encode ( $model->subject ) . '?=';
				$headers = "From: $name <{$model->email}>\r\n" . "Reply-To: {$model->email}\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/plain; charset=UTF-8";
				
				mail ( Yii::app ()->params ['adminEmail'], $subject, $model->body, $headers );
				Yii::app ()->user->setFlash ( 'contact', 'Thank you for contacting us. We will respond to you as soon as possible.' );
				$this->refresh ();
			}
		}
		$this->render ( 'contact', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$model = new LoginForm ();
		
		// if it is ajax validation request
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'login-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
		
		// collect user input data
		if (isset ( $_POST ['LoginForm'] )) {
			$model->attributes = $_POST ['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate () && $model->login ())
				$this->redirect ( Yii::app ()->user->returnUrl );
		}
		// display the login form
		$this->render ( 'login', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	// 用户退出
	public function actionLoginout() {
		Yii::app ()->user->logout ( true ); // 当前应用用户退出
		echo $this->redirect ( 'index' );
	}
	/*
	 * 用户发布任务时进行手机短信验证
	 */
	public function actionTaskPublistCode() {
		$_POST ['phone'] = '15150678327';
		if (isset ( $_POST ['phone'] )) {
			$userid = Yii::app ()->user->getId ();
			$suerid = intval ( $userid );
			if ($userid <= 0) {
				echo "非法操作";
				Yii::app ()->end ();
			}
			$currenttime = time ();
			$starttime = date ( "Y-m-d 00:00:00", $currenttime );
			$starttime = strtotime ( $starttime );
			$endtime = date ( "Y-m-d 23:59:59", $currenttime );
			$endtime = strtotime ( $endtime );
			
			$criteria = new CDbCriteria ();
			$criteria->condition = 'userid=' . $userid . ' and time>=' . $starttime . ' and time<=' . $endtime;
			$criteria->order = "id desc";
			$number = Smslist::model ()->count ( $criteria );
			if ($number > 30) {
				echo "每个用户每天最多只能发送30条短信";
				Yii::app ()->end ();
			}
			// 检查时间
			if (isset ( Yii::app ()->session ['currenttimepublish'] )) {
				$lasttime = Yii::app ()->session ['currenttimepublish'];
				if (time () - $lasttime < 180) {
					echo "180秒内只能发送一次";
					Yii::app ()->end ();
				}
			}
			// 检查手机号在数据库中是否存在
			$checkphone = User::model ()->findByAttributes ( array (
					'Phon' => $_POST ['phone'] 
			) );
			if ($checkphone == false) // 手机号不存在
			{
				echo "FAIL";
				Yii::app ()->end ();
			}
			// 生成验证码
			$randStr = str_shuffle ( '1234567890' ); // 短信验证码由数字组成
			$code = substr ( $randStr, 0, 6 );
			
			$content = $this->newSms ( $_POST ['phone'], '【优美】您的短信验证码为' . $code . '，若非本人操作，请忽略！' );
			
			if ($content == '000') {
				$num = System::model ()->findByAttributes ( array (
						"varname" => "taskUpSmsMoney" 
				) );
				// 插入短信发送记录
				$record = new Smslist ();
				$record->userid = $userid; // 用户id
				$record->type = 1; // 购买米粒类型
				$record->phone = $_POST ['phone']; // 购买米粒数量
				$record->time = time (); // 操作时间
				$record->save (); //
				                  
				// 每发一条短信，扣一条短信的钱
				$record = new Recordlist ();
				$record->userid = $userid; // 用户id
				$record->catalog = 13; // 13代表短信费
				$record->number = $num; // 费用
				$record->time = time (); // 操作时间
				$record->save (); // 保存流水
				                  
				// 对用户进行减钱操作
				$userinfo = User::model ()->findByPk ( $userid );
				$userinfo->Money = $userinfo->Money - $num; // 在原有余额基本上减去购买米粒使用掉的金额
				$userinfo->save ();
				// 状态为0，说明短信发送成功
				Yii::app ()->session ['codepublish'] = $code; // session存储code用于检验
				Yii::app ()->session ['phonepublish'] = $_POST ['phone']; // session存储手机号码用于检验
				Yii::app ()->session ['currenttimepublish'] = time (); // session存储手机号码用于检验
				echo "SUCCESS";
			} else {
				// 状态非0，说明失败
				echo "FAIL";
			}
		}
	}
	public function actionSms() {
		if (isset ( $_POST ['phone'] ) && isset ( $_POST ['phoneCode'] )) {
			// 检查时间
			if (isset ( Yii::app ()->session ['currenttime'] )) {
				$lasttime = Yii::app ()->session ['currenttime'];
				if (time () - $lasttime < 300) {
					echo "300秒内只能发送一次";
					Yii::app ()->end ();
				}
			}
			// 检查手机号在数据库中是否存在
			$checkphone = User::model ()->findByAttributes ( array (
					'Phon' => $_POST ['phone'] 
			) );
			if ($checkphone == false) // 手机号不存在
			{
				echo "FAIL";
				Yii::app ()->end ();
			}
			// 生成验证码
			$randStr = str_shuffle ( '1234567890' ); // 短信验证码由数字组成
			$code = substr ( $randStr, 0, 6 );
			
			$content = $this->newSms ( $_POST ['phone'], '【优美】您的短信验证码为' . $code . '，若非本人操作，请忽略！' );
			
			if ($content == '000') {
				// 状态为0，说明短信发送成功
				Yii::app ()->session ['code'] = $code; // session存储code用于检验
				Yii::app ()->session ['phone'] = $_POST ['phone']; // session存储手机号码用于检验
				Yii::app ()->session ['currenttime'] = time (); // session存储手机号码用于检验
				echo "SUCCESS";
			} else {
				// 状态非0，说明失败
				echo "FAIL";
			}
		}
	}
	public function NewSms($Mobile, $Content) {
		$url = "http://service.winic.org:8009/sys_port/gateway/index.asp";
		$data = "id=%s&pwd=%s&to=%s&content=%s&otime=";
		$id = iconv ( "UTF-8", "GB2312", 'lixuexinhouqiu' );
		$pwd = 'a123456';
		$to = $Mobile;
		$content = iconv ( "UTF-8", "GB2312", $Content );
		$rdata = sprintf ( $data, $id, $pwd, $to, $content );
		
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $rdata );
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		$result = curl_exec ( $ch );
		curl_close ( $ch );
		$result = substr ( $result, 0, 3 );
		return $result;
		/*
		 * if ($result == '000')
		 * {
		 * return "短信发送成功";
		 * }
		 * else if ($result == '-01')
		 * {
		 * return "短信余额不足";
		 * }
		 * else if ($result == '-02')
		 * {
		 * return "用户ID错误";
		 * }
		 * else if ($result == '-03')
		 * {
		 * return "密码错误";
		 * }
		 * else
		 * {
		 * return "未知错误";
		 * }
		 */
	}
}