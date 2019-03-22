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
	public function actionIndex() {
		if (Yii::app ()->user->getId ()) {
			// 读取未完成的评价任务
			$tecriterria = new CDbCriteria ();
			$tecriterria->addCondition ( 'doid=' . Yii::app ()->user->getId () . ' AND doing=0' );
			$countte = Taskevaluate::model ()->count ( $tecriterria );
			// 总共赚取得佣金
			$countprice = 0;
			
			// $sql="SELECT userid,increase,id FROM ".Yii::app()->db->tablePrefix."_cashlog WHERE (type='任务佣金' OR type='评价任务佣金' OR type='推广返现') AND userid=".Yii::app()->user->getId();
			$sql = "SELECT SUM( ABS(increase)) as increase  FROM " . Yii::app ()->db->tablePrefix . "_cashlog WHERE (type='任务佣金' OR type='评价任务佣金' OR type='推广返现') AND userid=" . Yii::app ()->user->getId ();
			$res = Yii::app ()->db->createCommand ( $sql )->queryScalar ();
			$kefu = System::model ()->find ( "varname='buyerQQkefu'" );
			/*
			 * foreach ($res as $v){
			 * $m=substr($v['increase'],1);
			 * $countprice+=$m;
			 * };
			 */
			$countprice += $res;
			
			$this->render ( 'index', array (
					'evaltaskcount' => $countte,
					'countprice' => $countprice,
					'kefu' => $kefu 
			) );
		} else {
			$this->redirect ( $this->createUrl ( 'passport/login' ) );
		}
	}
	/*
	 * 队列总数大于100，任务总数小于30则返回
	 *
	 */
	public function actionQueueNum() {
		$arr = array ();
		// 1获取当前队列总数,如果等于100就不存队列
		if ($_POST ['tasktype'] == 1) {
			$quenum = Yii::app ()->redis->llen ( 'fguserque' );
			if ($quenum == 100) {
				$arr ['quenum'] = 200;
			}
		} else {
			$quenum = Yii::app ()->redis->llen ( 'userque' );
			if ($quenum >= 100) {
				$arr ['quenum'] = 200;
			}
		}
		echo json_encode ( $arr );
		exit ();
	}
	// 接任务开始
	public function actionAcceptTask() {
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
		} elseif ($daycount >= $allsystem ['buyerSet'] ['day']) {
			$arr ['err_code'] = 7;
			$arr ['msg'] = '当天最多接手' . $allsystem ['buyerSet'] ['day'] . '个任务,请明天再来!';
			/*
			 * 未做：判断当前用户是否有投诉订单，有投诉订单不接任务
			 *
			 */
		} else {
			// 2如果队列有相同的值就不存队列,复购的另存队列
			if ($_POST ['FineTaskClassType'] == '销量任务') {
				$quearr = Yii::app ()->redis->lrange ( 'userque', 0, 99 );
				foreach ( $quearr as $val ) {
					$uid = substr ( $val, 0, strpos ( $val, ',' ) );
					if ($uid == Yii::app ()->user->getId ())
						$kk = 1;
				}
				
				if ($kk == 0) {
					$userstr = Yii::app ()->user->getId () . ',' . $_POST ['outtime'];
					Yii::app ()->redis->rpush ( 'userque', $userstr );
				}
				// 获取当前用户前面的用户
				// Yii::app()->redis->delete('userque');
				$quearr = Yii::app ()->redis->lrange ( 'userque', 0, 99 );
				$curuser = '';
				foreach ( $quearr as $val ) {
					$curuid = substr ( $val, 0, strpos ( $val, ',' ) );
					if ($curuid == Yii::app ()->user->getId ()) {
						$curuser = $val;
					}
				}
			} else {
				$quearr = Yii::app ()->redis->lrange ( 'fguserque', 0, 99 );
				foreach ( $quearr as $val ) {
					$uid = substr ( $val, 0, strpos ( $val, ',' ) );
					if ($uid == Yii::app ()->user->getId ())
						$kk = 1;
				}
				if ($kk == 0) {
					$userstr = Yii::app ()->user->getId () . ',' . $_POST ['outtime'];
					Yii::app ()->redis->rpush ( 'fguserque', $userstr );
				}
				// 获取当前用户前面的用户
				// Yii::app()->redis->delete('userque');
				$quearr = Yii::app ()->redis->lrange ( 'fguserque', 0, 99 );
				$curuser = '';
				foreach ( $quearr as $val ) {
					$curuid = substr ( $val, 0, strpos ( $val, ',' ) );
					if ($curuid == Yii::app ()->user->getId ()) {
						$curuser = $val;
					}
				}
			}
			$key = array_search ( $curuser, $quearr );
			$lenth = $key + 1;
			
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
				'length' => $lenth,
				'acceptarr' => $arr,
				'isFG' => $isFG 
		) );
	}
	// 取消排队
	public function actionCancelQueue() {
		$quearr = Yii::app ()->redis->lrange ( 'userque', 0, 99 );
		$fgquearr = Yii::app ()->redis->lrange ( 'fguserque', 0, 99 );
		
		$key = '';
		$val = '';
		foreach ( $quearr as $k => $v ) {
			$uid = substr ( $v, 0, strpos ( $v, ',' ) );
			if ($uid == Yii::app ()->user->getId ()) {
				$key = $k;
				$val = $v;
			}
		}
		if ($val) {
			Yii::app ()->redis->lrem ( 'userque', $val, $key );
		}
		// 取消复购排队队列
		$key2 = '';
		$val2 = '';
		foreach ( $fgquearr as $kkk => $vvv ) {
			$uid = substr ( $vvv, 0, strpos ( $vvv, ',' ) );
			if ($uid == Yii::app ()->user->getId ()) {
				$key2 = $kkk;
				$val2 = $vvv;
			}
		}
		if ($val2) {
			Yii::app ()->redis->lrem ( 'fguserque', $val2, $key2 );
		}
		
		echo 0;
		exit ();
	}
	// 接任务结果
	public function actionGetQueAcceptRes() {
		
		// $res['queueCount']=0;$res['taskAcceptRes']='FAILED';$res['msg']='平台暂无任务可接，请稍后再试！'; echo json_encode($res);exit;
		
		/* 开始锁代码块*/
		$uID = Yii::app()->user->getId() ;
		$fp = fopen(BKC_URL."?TaskID={$uID}", 'r');
		fclose($fp);
		
		// 获得队伍总数
		$post = Yii::app ()->session ['w' . Yii::app ()->user->getId ()];
		$queueall = Yii::app ()->redis->lrange ( 'userque', 0, 99 );
		$fgqueueall = Yii::app ()->redis->lrange ( 'fguserque', 0, 99 );
		$res = array ();
		// 判断传递过来的参数是复购还是销量任务
		if (isset ( $post ['fgtasktype'] )) {
			$queueCount = Yii::app ()->redis->llen ( 'fguserque' );
			// 如果用户在销量任务里排队就清除那个用户队列
			foreach ( $queueall as $kq => $vq ) {
				$quid = substr ( $vq, 0, strpos ( $vq, ',' ) );
				if ($quid == Yii::app ()->user->getId ()) {
					Yii::app ()->redis->lrem ( 'userque', $vq, $kq );
				}
			}
		} else {
			$queueCount = Yii::app ()->redis->llen ( 'userque' );
			// 如果用户在复购队列里就清除那个用户的队列
			foreach ( $fgqueueall as $kfq => $vfq ) {
				$qfuid = substr ( $vfq, 0, strpos ( $vfq, ',' ) );
				if ($qfuid == Yii::app ()->user->getId ()) {
					Yii::app ()->redis->lrem ( 'userque', $vfq, $kfq );
				}
			}
		}
		// 队伍总数大于100的返回
		//if ($queueCount > 99) { $res ['queueCount'] = 200; }
		
		// 取出1-10的队列，看里面的排队时间有没有超过5分钟，超过就清队列，同时允许20个人进入队列领取任务
		$que20 = Yii::app ()->redis->lrange ( 'userque', 0, 19 );
		foreach ( $que20 as $key => $val ) {
			$outtime = substr ( $val, strpos ( $val, ',' ) + 1 );
			if ((time () - $outtime) > 180) {
				Yii::app ()->redis->lrem ( 'userque', $val, $key );
			}
		}
		// 取出1-20的复购队列，看里面的排队时间有没有超过2分钟，超过就清队列，同时允许20个人进入队列领取任务,复购任务队列
		$fgque20 = Yii::app ()->redis->lrange ( 'fguserque', 0, 19 );
		foreach ( $fgque20 as $fgkey => $fgval ) {
			$outtime = substr ( $fgval, strpos ( $fgval, ',' ) + 1 );
			if ((time () - $outtime) > 120) {
				Yii::app ()->redis->lrem ( 'fguserque', $fgval, $fgkey );
			}
		}
		
		if (isset ( $post ['fgtasktype'] )) {
			$queue10 = Yii::app ()->redis->lrange ( 'fguserque', 0, 19 ); // 获取20条数据
		} else {
			$queue10 = Yii::app ()->redis->lrange ( 'userque', 0, 19 ); // 获取20条数据
		}
		$userstr = array ();
		
		foreach ( $queue10 as $k => $v ) {
			$userstr [] = substr ( $v, 0, strpos ( $v, ',' ) );
		}
		
		$userstr = array_unique ( $userstr );
		
		if (in_array ( Yii::app ()->user->getId (), $userstr )) {
			// 先删除过期任务
			$this->delOverTask ();
			// $userinfo=User::model()->findByPk(Yii::app()->user->getId());
			// $score=$userinfo->Score;
			$tbprefix = Yii::app ()->db->tablePrefix;
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
			
			// $startime=time()+3600;
			$startime = time ();
			// 查找任务表，得到有记录的产品id和商家id
			$intimeshop = 30 * 24 * 60 * 60;
			$intimepro = 50 * 24 * 60 * 60;
			// 查找用户是否隐藏或者退出任务
			$startdate = strtotime ( date ( 'Y-m-d' ) );
			$unaceept = Unaceept::model ()->find ( 'userid=' . Yii::app ()->user->getId () . ' AND addtime>' . $startdate );
			$shopidstr = '';
			$productidstr = '';
			if ($unaceept) {
				if ($unaceept->shopids)
					$shopidstr = $unaceept->shopids;
				if ($unaceept->proids)
					$productidstr = $unaceept->proids;
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
			$hideshop = ' SELECT id FROM zxjy_user  WHERE Opend=1 AND (ShowStatus=1 OR Status=1) ';
			/*
			 * foreach ( $usershop as $value ) {
			 * $hideshop .= $value->id . ',';
			 * }
			 * $hideshop = substr ( $hideshop, 0, - 1 );
			 */
			
			$whereshop = '';
			if ($hideshop) {
				$whereshop .= ' AND s.userid NOT IN(' . $hideshop . ') ';
			}
			$end5959 = strtotime ( @date ( 'Y-m-d' ) ) + 3600 * 24 - 1;
			// 查找产品状态显示正常的任务、proid不重复的,有数量的任务、当前时间+1小时小于任务结束时间的，以及当前时间大于开始时间的,
			// 判断是销量任务还是复购任务
			if (isset ( $post ['fgtasktype'] ) && ! empty ( $post ['fgtasktype'] )) {
				$sql = "SELECT DISTINCT t.proid,t.mark,s.sid,tt.start,tt.end,tt.takenumber,tt.number  FROM " . $tbprefix . '_task AS t LEFT JOIN ' . $tbprefix . '_tasktime As tt ON t.mark=tt.pid ' . " LEFT JOIN " . $tbprefix . "_shop AS s ON s.sid=t.shopid " . ' WHERE t.status=0 AND t.tasktype=3 AND t.number>(t.qrnumber+t.del) ' . "$whereshop  AND '$startime'<tt.`end` AND '" . time () . "'>tt.`start` " . $where . "  AND ( (tt.end<$end5959 AND " . time () . ">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )" . '   ORDER BY t.top DESC LIMIT 0,50';
			} else {
				$sql = "SELECT DISTINCT t.proid,t.mark,s.sid,tt.start,tt.end,tt.takenumber,tt.number  FROM " . $tbprefix . '_task AS t LEFT JOIN ' . $tbprefix . '_tasktime As tt ON t.mark=tt.pid ' . " LEFT JOIN " . $tbprefix . "_shop AS s ON s.sid=t.shopid " . ' WHERE t.status=0  AND t.tasktype=1 AND t.number>(t.qrnumber+t.del) ' . "$whereshop  AND '$startime'<tt.`end` AND '" . time () . "'>tt.`start` " . $where . "  AND ( (tt.end<$end5959 AND " . time () . ">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )" . '   ORDER BY t.top DESC LIMIT 0,50';
			}
			
			$all = Yii::app ()->db->createCommand ( $sql )->queryAll ();
			
			if (empty ( $all )) {
				$res ['queueCount'] = 0;
				$res ['taskAcceptRes'] = 'FAILED';
				$res ['msg'] = '平台暂无任务可接，请稍后再试！';
				$this->unsetredis ( $queue10 );
				
				echo json_encode ( $res );
				exit ();
			}
			
			foreach ( $all as $k => $v ) {
				$proidarr [] = $v ['proid'];
				$markarr [$v ['proid']] = $v ['mark'];
			}
			// 得到产品id,查询当前的商家是否符合条件,1.获得买号的年龄，区域，性别进行判断
			$proidstr = implode ( ',', $proidarr );
			$buyer = Bindbuyer::model ()->find ( 'userid=' . Yii::app ()->user->getId () );
			$sex = $buyer->sex == 0 ? 'man' : 'woman';
			$markstr = '';
			$whereprostr = '';
			if ($proidstr) {
				$whereprostr = "id IN($proidstr) AND ";
			}
			// 2.查找符合条件的产品
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
			$instr = '';
			
			// 3.通过符合条件的产品查找任务表，关联类型表 随机查找1条
			if ($post ['fgtasktype']) {
				$sql = "SELECT tm.id AS taskmodelid,t.id AS taskid,t.top,t.proid,t.userid as merchantid,t.shopid,tm.price,tm.commission,tm.express, tt.id AS tasktimeid,tt.number FROM " . $tbprefix . "_task AS t " . " LEFT JOIN " . $tbprefix . '_taskmodel AS tm ON tm.pid=t.mark LEFT JOIN ' . $tbprefix . '_tasktime AS tt ON t.mark=tt.pid WHERE ' . $instr . "  t.tasktype=3 AND tm.price<=$upprice " . $where . " AND $startime<tt.`end` AND '" . time () . "'>tt.`start` " . " AND ( (tt.end<$end5959 AND " . time () . ">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )" . " AND t.number>(t.qrnumber+t.del)  AND tm.number>(tm.takenumber+t.del)   ORDER BY RAND() LIMIT 1";
			} else {
				$sql = "SELECT tm.id AS taskmodelid,t.id AS taskid,t.top,t.proid,t.userid as merchantid,t.shopid,tm.price,tm.commission,tm.express, tt.id AS tasktimeid,tt.number FROM " . $tbprefix . "_task AS t " . " LEFT JOIN " . $tbprefix . '_taskmodel AS tm ON tm.pid=t.mark LEFT JOIN ' . $tbprefix . '_tasktime AS tt ON t.mark=tt.pid WHERE ' . $instr . " t.tasktype=1 AND tm.price<=$upprice " . $where . " AND $startime<tt.`end` AND '" . time () . "'>tt.`start` " . " AND ( (tt.end<$end5959 AND " . time () . ">(((tt.`end`-tt.`start`)/tt.number)*tt.takenumber+tt.`start`)) OR tt.end=$end5959 )" . " AND t.number>(t.qrnumber+t.del)  AND tm.number>(tm.takenumber+t.del)   ORDER BY RAND() LIMIT 1";
			}
			$task = Yii::app ()->db->createCommand ( $sql )->queryRow ();
			
			// 查找usertask表看是否有记录防止重复添加
			$issame = 1;
			$ckShopBuyed = false;
			if ($task ['taskid']) {
				$samesql = "SELECT COUNT(taskid) as docount FROM " . $tbprefix . "_usertask WHERE taskid=$task[taskid]";
				$countdotask = Yii::app ()->db->createCommand ( $samesql )->queryRow ();
				$issame = $task ['number'] - $countdotask ['docount'];
				// 检查是否30天内重复接到同一商家的任务
				$uID = Yii::app ()->user->getId ();
				$shopID = $task ['shopid'];
				$sql2 = "SELECT COUNT(1) FROM zxjy_usertask   WHERE addtime > UNIX_TIMESTAMP ( DATE_ADD(NOW() ,INTERVAL -30 DAY) ) AND shopid='{$shopID}' AND userid='{$uID}' ";
				$cc = Yii::app ()->db->createCommand ( $sql2 )->queryScalar ();
				$ckShopBuyed = ($cc == 0);
			}
			
			// $root=dirname(dirname(dirname(__FILE__)));
			if ($ckShopBuyed == true && $issame > 0 && ! empty ( $task ['taskmodelid'] ) && ! empty ( $task ['taskid'] ) && ! empty ( $task ['tasktimeid'] ) && $task ['tasktimeid'] != '' && $task ['tasktimeid'] != ' ' && $task ['taskid'] != '' && $task ['taskid'] != ' ' && $task ['taskmodelid'] != ' ' && $task ['taskmodelid'] != '') {
				// $this->log($root.'\data\1.txt',json_encode($task));
				
				$userid = Yii::app ()->user->getId ();
				$tasksn = $this->build_task_no ();
				$addtime = time ();
				$buyerid = $buyer->id;
				$goodsprice = $task ['price'] + $task ['express'];
				$commission = $this->getTaskCommission ( $goodsprice );
				
				
				$taskID = $task ['taskid'] ;
				// 插入刷手任务
				$sql = "INSERT INTO " . $tbprefix . "_usertask  (`tasksn`,`userid`,`shopid`,`taskid`,`addtime`,`buyerid`,`merchantid`,`tasktimeid`,`taskmodelid`,`commission`,`proid`)" . " VALUES('$tasksn','$userid','$task[shopid]','$task[taskid]','$addtime','$buyerid','$task[merchantid]','$task[tasktimeid]','$task[taskmodelid]','$commission','$task[proid]')";
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
						fwrite ( $FF, "PC===>{$cTime} , TaskID=>{$taskID} , DELETE->{$insertid} \r\n" );
						fclose ( $FF );
					}
				}
				
				if ($addres) {
					
					// $this->log($root.'\data\1.txt',$addres.'aaa'.$insertid.'userid:'.Yii::app()->user->getId());
					// 更改任务表数量
					$dbtask = Task::model ()->findByPk ( $task ['taskid'] );
					$dbtaskmodel = Taskmodel::model ()->findByPk ( $task ['taskmodelid'] );
					$dbtasktime = Tasktime::model ()->findByPk ( $task ['tasktimeid'] );
					$dbtask->qrnumber = $dbtask->qrnumber + 1;
					$dbtaskmodel->takenumber = $dbtaskmodel->takenumber + 1;
					$dbtasktime->takenumber = $dbtasktime->takenumber + 1;
					// 扣除商家佣金
					$us = User::model ()->findByPk ( $task ['merchantid'] );
					// 生成日志文件
					$cashLog = new Cashlog ();
					$cashLog->type = '任务佣金';
					$cashLog->remoney = $us->Money - ($task ['commission'] + $task ['top']);
					$us->Money = $us->Money - ($task ['commission'] + $task ['top']);
					$cashLog->increase = '-' . ($task ['commission'] + $task ['top']);
					$cashLog->beizhu = '刷手接任务扣除佣金';
					$cashLog->addtime = time ();
					$cashLog->userid = $task ['merchantid'];
					$cashLog->usertaskid = $insertid;
					$cashLog->proid = $task ['proid'];
					$cashLog->shopid = $task ['shopid'];
					$cashLog->save ();
					$us->save ();
					
					$dbtask->save ();
					$dbtaskmodel->save ();
					$dbtasktime->save ();
					
					$res ['queueCount'] = 0;
					$res ['taskAcceptRes'] = 'SUCCESS';
				}
				
				// 找到任务后，加入用户任务表
			} else {
				
				$res ['queueCount'] = 0;
				$res ['taskAcceptRes'] = 'FAILED';
				$res ['msg'] = '平台暂无任务可接，请稍后再试！';
				$this->unsetredis ( $queue10 );
				
				echo json_encode ( $res );
				exit ();
			}
		} else {
			$curuser = '';
			foreach ( $queueall as $val ) {
				$curuid = substr ( $val, 0, strpos ( $val, ',' ) );
				if ($curuid == Yii::app ()->user->getId ()) {
					$curuser = $val;
				}
			}
			if (empty ( $curuser )) {
				$res ['queueCount'] = 0;
				$res ['taskAcceptRes'] = 'FAILED';
				$res ['msg'] = '平台暂无任务可接，请稍后再试！';
			} else {
				$quebefore = array_search ( $curuser, $queueall ); // 当前用户之前的总人数
				$res ['queueCount'] = $quebefore + 1;
			}
		}
		
		echo json_encode ( $res );
		exit ();
	}
	function unsetredis($queue) {
		foreach ( $queue as $kk => $vv ) {
			$uid = substr ( $vv, 0, strpos ( $vv, ',' ) );
			if ($uid == Yii::app ()->user->getId ()) {
				Yii::app ()->redis->lrem ( 'userque', $vv, $kk );
			}
		}
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
	/* 清除任务 */
	function delOverTask() {
		$time = strtotime ( @date ( 'Y-m-d H:i:s' ) ) - 3600;
		$usertasks = Usertask::model ()->findAll ( " status=0 AND addtime<$time" );
		
		foreach ( $usertasks as $val ) {
			if (! empty ( $val->orderimg ) || $val->status > 0 || $val->flag > 2) {
			} else {
				$task = Task::model ()->find ( 'id=' . $val->taskid );
				$task->qrnumber = $task->qrnumber - 1;
				$taskmodel = Taskmodel::model ()->find ( 'id=' . $val->taskmodelid );
				$taskmodel->takenumber = $taskmodel->takenumber - 1;
				$tasktime = Tasktime::model ()->find ( 'id=' . $val->tasktimeid );
				$tasktime->takenumber = $tasktime->takenumber - 1;
				
				// 生成商家资金日志文件
				$cashLog = new Cashlog ();
				$cashLog->type = '返还佣金';
				$us = User::model ()->findByPk ( $val->merchantid );
				$cashLog->remoney = $us->Money + ($taskmodel->commission + $task->top);
				$us->Money = $us->Money + ($taskmodel->commission + $task->top);
				$cashLog->increase = '+' . ($taskmodel->commission + $task->top);
				$cashLog->beizhu = '刷手放弃任务返还佣金';
				$cashLog->addtime = time ();
				$cashLog->userid = $val->merchantid;
				$cashLog->usertaskid = $val->id;
				$cashLog->proid = $val->proid;
				$cashLog->shopid = $val->shopid;
				$cashLog->save ();
				$us->save ();
				$this->add_unnormaltask ( $val->id, $val->userid, $val->merchantid, $val->addtime, $val->updatetime, $val->taskid, $val->shopid, $val->taskmodelid, $val->tasktimeid, $val->status, 'sitecontrller/delovertask' );
				
				$task->save ();
				$taskmodel->save ();
				$tasktime->save ();
				$ut = Usertask::model ()->find ( 'id=' . $val->id );
				$ut->delete ();
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