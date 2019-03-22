<?php
class TaskController extends Controller {
	public $layout = 'public_header';
	public function init() {
		parent::init ();
		$userid = Yii::app ()->user->getId ();
		if (empty ( $userid )) {
			$this->redirect ( $this->createUrl ( 'user/login' ) );
			exit ();
		}
	}
	public function actions() {
		return array (
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha' => array (
						'class' => 'CCaptchaAction',
						'backColor' => 0xFFFFFF,
						'width' => 80, // 默认120
						'height' => 35, // 默认50
						'padding' => 2, // 文字周边填充大小
						
						'foreColor' => 0x2040A0, // 字体颜色
						'minLength' => 4, // 设置最短为6位
						'maxLength' => 4, // 设置最长为7位,生成的code在6-7直接rand了
						'transparent' => true, // 显示为透明,默认中可以看到为false
						'offset' => - 2  // 设置字符偏移量
				) 
		);
	}
	// 任务管理
	public function actionTaskManage() {
		//$this->setFreeTask ();
		$tbprefix = Yii::app ()->db->tablePrefix;
		$timen30 = time () - (3 * 24 * 3600);
		$where = '';
		if ($_GET ['status'] > - 1 && $_GET ['status'] != 'null') {
			$where .= ' AND utask.status=' . $_GET ['status'];
		}
		if (! empty ( $_GET ['txtSearch'] )) {
			
			if ($_GET ['selSearch'] == 'shopname') {
				$where .= " AND s.shopname LIKE'%$_GET[txtSearch]%' ";
			} else {
				$where .= " AND utask." . $_GET ['selSearch'] . "='$_GET[txtSearch]' ";
			}
		}
		if (! empty ( $_GET ['beginDate'] ) && ! empty ( $_GET ['endDate'] )) {
			$where .= " AND utask.addtime>'" . $_GET ['beginDate'] . "' AND utask.addtime<'" . $_GET ['endDate'] . "' ";
		}
		if (! empty ( $_GET ['beginDate'] ) && empty ( $_GET ['endDate'] )) {
			$where .= " AND utask.addtime>'" . $_GET ['beginDate'] . "' ";
		}
		if (empty ( $_GET ['beginDate'] ) && ! empty ( $_GET ['endDate'] )) {
			$where .= " AND utask.addtime<'" . $_GET ['endDate'] . "' ";
		}
		$tbname = Blindwangwang::model ()->find ( 'userid=' . Yii::app ()->user->getId () );
		$sql = 'SELECT utask.*,t.remark,tm.price,tm.express,tm.auction,t.intlet,s.shopname FROM ' . $tbprefix . '_usertask AS utask LEFT JOIN ' . $tbprefix . '_task AS t ON utask.taskid=t.id' . ' LEFT JOIN ' . $tbprefix . '_taskmodel AS tm ON utask.taskmodelid=tm.id LEFT JOIN ' . $tbprefix . '_shop AS s ON s.sid=utask.shopid WHERE utask.addtime>' . $timen30 . ' AND utask.userid=' . Yii::app ()->user->getId () . $where . ' and (t.tasktype = 1 OR t.tasktype = 3) ORDER BY utask.addtime DESC';
		
		// 分页
		$creteria = new CDbCriteria ();
		$list = Yii::app ()->db->createCommand ( $sql )->queryAll ();
		$pages = new CPagination ( count ( $list ) );
		$pages->pageSize = 10;
		$pages->applyLimit ( $creteria );
		
		$list = Yii::app ()->db->createCommand ( $sql . " LIMIT :offset,:limit" );
		$list->bindValue ( ':offset', $pages->currentPage * $pages->pageSize );
		$list->bindValue ( ':limit', $pages->pageSize );
		$task = $list->queryAll ();
		
		$this->render ( 'taskManage', array (
				'tbname' => $tbname->wangwang,
				'task' => $task,
				'pages' => $pages 
		) );
	}
	// 任务管理 （预订单/预约单）
    public function actionTaskManageOne(){

        $tbprefix = Yii::app ()->db->tablePrefix;
        $timen30 = time () - (3 * 24 * 3600);
        $where = '';
        if ($_GET ['status'] > - 1 && $_GET ['status'] != 'null') {
            $where .= ' AND utask.status=' . $_GET ['status'];
        }
        if (! empty ( $_GET ['txtSearch'] )) {

            if ($_GET ['selSearch'] == 'shopname') {
                $where .= " AND s.shopname LIKE'%$_GET[txtSearch]%' ";
            } else {
                $where .= " AND utask." . $_GET ['selSearch'] . "='$_GET[txtSearch]' ";
            }
        }
        if (! empty ( $_GET ['beginDate'] ) && ! empty ( $_GET ['endDate'] )) {
            $where .= " AND utask.addtime>'" . $_GET ['beginDate'] . "' AND utask.addtime<'" . $_GET ['endDate'] . "' ";
        }
        if (! empty ( $_GET ['beginDate'] ) && empty ( $_GET ['endDate'] )) {
            $where .= " AND utask.addtime>'" . $_GET ['beginDate'] . "' ";
        }
        if (empty ( $_GET ['beginDate'] ) && ! empty ( $_GET ['endDate'] )) {
            $where .= " AND utask.addtime<'" . $_GET ['endDate'] . "' ";
        }
        $tbname = Blindwangwang::model ()->find ( 'userid=' . Yii::app ()->user->getId () );
        $sql = 'SELECT utask.*,t.remark,tm.price,tm.express,tm.auction,t.intlet,s.shopname,t.tasktype,tt.beginPay,tt.EndPay
                FROM ' . $tbprefix . '_pretask AS utask 
                LEFT JOIN ' . $tbprefix . '_task AS t ON utask.taskid=t.id' . ' 
                LEFT JOIN ' . $tbprefix . '_taskmodel AS tm ON utask.taskmodelid=tm.id 
                LEFT JOIN ' . $tbprefix . '_tasktime AS tt ON t.mark=tt.pid 
                LEFT JOIN ' . $tbprefix . '_shop AS s ON s.sid=utask.shopid 
                WHERE utask.addtime>' . $timen30 . ' AND utask.userid=' . Yii::app ()->user->getId () . $where . ' ORDER BY utask.addtime DESC';

        // 分页
        $creteria = new CDbCriteria ();
        $list = Yii::app ()->db->createCommand ( $sql )->queryAll ();
        $pages = new CPagination ( count ( $list ) );
        $pages->pageSize = 10;
        $pages->applyLimit ( $creteria );

        $list = Yii::app ()->db->createCommand ( $sql . " LIMIT :offset,:limit" );
        $list->bindValue ( ':offset', $pages->currentPage * $pages->pageSize );
        $list->bindValue ( ':limit', $pages->pageSize );
        $task = $list->queryAll ();

        $this->render ( 'TaskManageOne', array (
            'tbname' => $tbname->wangwang,
            'task' => $task,
            'pages' => $pages
        ) );
    }
	// 任务开始1
	public function actionTaskOne() { //
		$tbprefix = Yii::app ()->db->tablePrefix;
//		设置时间 一个小时任务过期
		$setfreetime = 1200;
		$where = '';
		//设置锁定任务
		$time10 = 10;
        //超时判断时间
        $chaotime = 0;
        $arr= array();
		if (! empty ( $_GET ['taskid'] )) {
			// 设置浏览时间为10秒
			$cookies = Yii::app ()->request->getCookies ();
			if (empty ( $cookies ['readtime' . $_GET ['taskid']]->value )) {
				$cookie = new CHttpCookie ( 'readtime' . $_GET ['taskid'], time () + 11 );
				$cookie->expire = time () + 60 * 60; // 有限期30分钟
				Yii::app ()->request->cookies ['readtime' . $_GET ['taskid']] = $cookie; // 写入
			} else {
				$time10 = $cookies ['readtime' . $_GET ['taskid']]->value - time ();
			}
			
			$usertask = Usertask::model ()->findByPk ( $_GET ['taskid'] );
			//根据任务进度状态 添加搜索条件
			if ($usertask->flag == 0) {
				$where = ' AND utask.flag=0 ';
				$overtime = time () - 20 * 60; // defalt
                $chaotime = ($usertask->addtime+20*60) - time();
                if($chaotime<0){
                    $this->layout = false;
                    $arr['msg'] = "任务超过锁定时间！！！！";
                    $this->render ( 'tasktest', array (
                        'mag' => $arr,
                    ) );
                    exit();
                }
			} elseif ($usertask->flag == 1) {
				$overtime = time () - 30 * 60;
				$where = ' AND utask.flag=1 ';
                if($chaotime<0){
                    $this->layout = false;
                    $arr['msg'] = "任务到了释放时间！！！！";
                    $this->render ( 'tasktest', array (
                        'mag' => $arr,
                    ) );
                    exit();
                }
			} elseif ($usertask->flag == 2) {
				$overtime = time () - 60 * 60;
				$where = ' AND utask.flag=2 ';
				$setfreetime = ($usertask->addtime + 60 * 60) - time ();
                if($setfreetime<0){
                    $this->layout = false;
                    $arr['msg'] = "任务超过了完成时间！！！！";
                    $this->render ( 'tasktest', array (
                        'mag' => $arr,
                    ) );
                    exit();
                }
			}
			//$sql = 'SELECT utask.*,t.remark,t.intlet FROM ' . $tbprefix . '_usertask AS utask LEFT JOIN ' . $tbprefix . '_task AS t ON utask.taskid=t.id' . ' WHERE utask.id=' . $_GET ['taskid'] . " $where AND  utask.addtime>'$overtime'";
            $sql = 'SELECT utask.*,t.remark,t.intlet FROM ' . $tbprefix . '_usertask AS utask LEFT JOIN ' . $tbprefix . '_task AS t ON utask.taskid=t.id' . ' WHERE utask.id=' . $_GET ['taskid'] . " $where";
			$task = Yii::app ()->db->createCommand ( $sql )->queryRow ();
			/*
			 * if (empty($task)){
			 * $this->delCurtask($_GET['taskid'],$overtime);
			 * $this->redirect($this->createUrl('task/taskmanage'));
			 * }else
			 */
			if ($usertask->flag == 0) {
				$usertask->flag = 1;
				$usertask->save ();
			} elseif ($usertask->flag == 1) {
				$setfreetime = ($usertask->addtime + 30 * 60) - time ();
			}
		}
		$this->layout = false;
		if (@$_GET ['taskid']) {
			$this->render ( 'taskOne', array (
					'taskinfo' => $task,
					'setfreetime' => $setfreetime,
					'time10' => $time10 
			) );
		} else {
			$this->redirect ( $this->createUrl ( 'task/tasktwo', array (
					'taskid' => $_POST ['taskid'] 
			) ) );
		}
	}
	// 任务开始2
	public function actiontaskTwo() {
		$tbprefix = Yii::app ()->db->tablePrefix;
		$msg = '';
		$setfreetime = 0;
        //超时判断时间
        $arr= array();
		if (! empty ( $_GET ['taskid'] )) {
			$taskid = $_GET ['taskid'];
			$where = '';
			$usertask = Usertask::model ()->findByPk ( $_GET ['taskid'] );
			if ($usertask->flag == 1) {
				$overtime = time () - 30 * 60;
				$where = ' AND utask.flag=1 ';
			} elseif ($usertask->flag == 2) {
				$overtime = time () - 60 * 60;
				$where = ' AND utask.flag=2 ';
				$setfreetime = ($usertask->addtime + 60 * 60) - time ();
                $setfreetime = ($usertask->addtime + 60 * 60) - time ();
			}
			$sql = 'SELECT utask.*,tm.price AS modelprice,tm.express,tm.modelname,tm.auction,t.remark,t.intlet,t.tasktype,t.keyword,t.order,t.price,t.sendaddress,t.proid,t.other,s.shopname,p.commodity_image FROM ' . $tbprefix . '_usertask AS utask LEFT JOIN ' . $tbprefix . '_task AS t ON utask.taskid=t.id LEFT JOIN ' . $tbprefix . '_shop AS s ON t.shopid=s.sid LEFT JOIN ' . $tbprefix . '_product AS p ON p.id=t.proid LEFT JOIN  ' . $tbprefix . '_taskmodel as tm ON tm.id=utask.taskmodelid WHERE utask.id=' . $taskid . " AND utask.addtime>'$overtime' $where";
			$task = Yii::app ()->db->createCommand ( $sql )->queryRow ();
			// 扫码
			if ($task ['intlet'] == 6) {
				$product = Product::model ()->findByPk ( $task ['proid'] );
				$task ['qrcode'] = $product->qrcode;
			}
			/*
			 * if (empty($task)){
			 * $this->delCurtask($_GET['taskid'],$overtime);
			 * $this->redirect($this->createUrl('task/taskmanage'));exit;
			 * }
			 */
			if ($task ['flag'] == 2) {
				$setfreetime = ($task ['addtime'] + 60 * 60) - time ();
			} elseif ($task ['flag'] == 1) {
				$setfreetime = ($task ['addtime'] + 30 * 60) - time ();
			}
		}
		if (@$_POST ['usertaskid']) {
			// 提交数据
			$usertask = Usertask::model ()->findByPk ( $_POST ['usertaskid'] );
			if ($_POST ['intlet'] != 6) {
				$usertask->tasktwoimg = $_POST ['tasktwoimg'];
			}
			$usertask->flag = 2;
			$usertask->save ();
		}
		$this->layout = false;
		$this->render ( 'taskTwo', array (
				'taskinfo' => @$task,
				'msg' => $msg,
				'setfreetime' => $setfreetime 
		) );
	}
	
	// 3333
	public function actionTaskThree() {
		$usertask = '';
		if (@$_GET ['usertaskid']) {
			$overtime = time () - 60 * 60;
			// $usertask=Usertask::model()->find('id='.$_GET['usertaskid']." AND flag=2");
			$usertask = Usertask::model ()->find ( 'id=' . $_GET ['usertaskid'] );
            if($usertask->flag < 2 ){
                if ($_GET ['usertaskid']) {
                    // 提交数据
                    $usertask->flag = 2;
                    $usertask->save ();
                }
            }
			/*
			 * if ($usertask->addtime<$overtime){
			 * $this->delCurtask($_GET['usertaskid'],$overtime);
			 * $this->redirect($this->createUrl('task/taskmanage'));exit;
			 * }
			 */
			$cookie = Yii::app ()->request->getCookies ();
			
			if (empty ( $cookie ['stoptime' . $_GET ['usertaskid']]->value )) {
				$time = time () + 5 * 60;
				$cookie = new CHttpCookie ( 'stoptime' . $_GET ['usertaskid'], $time );
				$cookie->expire = $time + 1800;
				Yii::app ()->request->cookies ['stoptime' . $_GET ['usertaskid']] = $cookie;
				$stoptime = date ( 'Y/m/d H:i:s', $time );
				$stopmin = $time - time ();
			} else {
				$stoptime = date ( 'Y/m/d H:i:s', @$cookie ['stoptime']->value );
				$stopmin = @$cookie ['stoptime' . $_GET ['usertaskid']]->value - time ();
			}
			
			$sql = "SELECT remark FROM " . Yii::app ()->db->tablePrefix . "_task WHERE id=" . $usertask->taskid;
			$row = Yii::app ()->db->createCommand ( $sql )->queryRow ();
			$remark = $row ['remark'];
			$setfreetime = ($usertask ['addtime'] + 60 * 60) - time ();
			$product = Product::model ()->findByPk ( $usertask->proid );
		}
		if (@$_POST) {
			$this->redirect ( $this->createUrl ( 'task/taskfour', array (
					'usertaskid' => $_POST ['usertaskid'] 
			) ) );
		}
		$this->layout = false;
		$this->render ( 'taskThree', array (
				'usertaskid' => $_GET ['usertaskid'],
				'usertask' => $usertask,
				'stoptime' => $stoptime,
				'stopmin' => $stopmin,
				'setfreetime' => $setfreetime,
				'buytype' => $product,
				'remark' => $remark 
		) );
	}
	// 444
	public function actionTaskFour() {
		$tbprefix = Yii::app ()->db->tablePrefix;
		$overtime = time () - 60 * 60;
		$taskinfo = array ();
        //超时判断时间
        $chaotime = 0;
        $arr= array();
        $usertask = Usertask::model ()->findByPk ( $_GET ['usertaskid'] );
        $chaotime = ($usertask->addtime+60*60) - time();
        if($chaotime<0){
            $this->layout = false;
            $arr['msg'] = "任务超过了完成时间！！！！";
            $this->render ( 'tasktest', array (
                'mag' => $arr,
            ) );
            exit();
        }
		if (! empty ( $_GET ['usertaskid'] )) {
			$sql = "SELECT ut.*,s.shopname,t.intlet,tm.price,tm.express,tm.auction,tm.modelname,p.commodity_image as image FROM " . $tbprefix . "_usertask AS ut LEFT JOIN " . $tbprefix . "_shop AS s " . ' ON ut.shopid=s.sid LEFT JOIN ' . $tbprefix . '_taskmodel as tm ON ut.taskmodelid=tm.id LEFT JOIN ' . $tbprefix . '_product AS p ON p.shopid=ut.shopid ' . ' LEFT JOIN  ' . $tbprefix . '_task as t ON t.id=ut.taskid WHERE ut.id= ' . $_GET ['usertaskid'] . " AND ut.flag=2 AND ut.addtime>'$overtime'";
			$taskinfo = Yii::app ()->db->createCommand ( $sql )->queryRow ();
			$taskinfo ['price'] = $taskinfo ['price'] + $taskinfo ['express'];
			/*
			 * if (empty($taskinfo)){
			 * $this->delCurtask($_GET['usertaskid'],$overtime);
			 * $this->redirect($this->createUrl('task/taskmanage'));exit;
			 * }
			 */
			$setfreetime = ($taskinfo ['addtime'] + 60 * 60) - time ();
		}
		if (@$_POST ['TaskID']) {
			
			$sql = "SELECT COUNT(1) FROM zxjy_usertask WHERE ordersn ='{$_POST[ordernum]}'";
			$ordersnCount = Yii::app ()->db->createCommand ( $sql )->queryScalar ();
			if ($ordersnCount > 0) {
				echo "<script>alert('该订单交易编号已提交过任务，不可重复使用订单交易编号');location.reload();</script>";
				exit ();
			}  

			$sql = "UPDATE " . Yii::app ()->db->tablePrefix . "_usertask SET `ordersn`='$_POST[ordernum]',`orderimg`='$_POST[orderimg]'
,`orderprice`='$_POST[PayPrice]',`paytype`='$_POST[PayMethod]'," . "updatetime=" . time () . ",`flag`=3,status=4 WHERE id=$_POST[TaskID]";
			$res = Yii::app ()->db->createCommand ( $sql )->execute ();
			/*
			 * $usertask=Usertask::model()->findByPk($_POST['TaskID']);
			 * $usertask->ordersn=trim($_POST['ordernum']);
			 * $usertask->orderimg=$_POST['orderimg'];
			 * $usertask->orderprice=$_POST['PayPrice'];
			 * $usertask->paytype=$_POST['PayMethod'];
			 * $usertask->updatetime=time();
			 * $usertask->flag=3;
			 * $usertask->status=1;
			 */
			if ($res > 0) {
				//对任务佣金的处理，在另一个进程中进行处理
				$uID = Yii::app ()->user->getId ();
				$fp = fopen ( BKC_URL."?ActionTag=SendMoney&UserTaskID={$_GET ['usertaskid']}", 'r' );
				$strJson = '';
				while ( ! feof ( $fp ) ) {
					$line = fgets ( $fp, 1024 ); // 每读取一行
					$strJson = $strJson . $line;
				}
				
				$clientMsg = "提交任务出现错误，操作终止，请与客服联系并提交您的相关任务信息";
				fclose ( $fp );
				if (empty ( $strJson ) == false) {
					$jsonObject = json_decode ( $strJson );
					if ($jsonObject) {
						if ($jsonObject->IsOK== true) {
							$clientMsg = '已成功提交，任务完成！【提醒：请到本金提现申请提现,否则商家无法返还本金】';
						} else {
							$clientMsg = "操作终止，提交过程错误：{$jsonObject->Description}  ";
						}
					}
				}
				echo '<html>';
				echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>';
				echo "<script>alert('{$clientMsg}');window.location.href ='" . $this->createUrl ( 'finance/selleroutcash' ) . "';</script>";
				exit ();
				echo '</html>';
			}
		}
		$this->layout = false;
		$this->render ( 'taskFour', array (
				'taskinfo' => $taskinfo,
				'setfreetime' => $setfreetime,
                'usertaskid'=>$_GET ['usertaskid']
		) );
	}
	
	// 退出任务
	public function actionTaskExit() {
		$count = 10;
		$stardate = strtotime ( date ( 'Y-m-d' ) );
        $uid = Yii::app ()->user->getId ();
		$unaceept = Unaceept::model ()->find ( 'userid=' . Yii::app ()->user->getId () . ' AND addtime>' . $stardate );
		if ($unaceept){
            $count = $unaceept->num;
        }
        if($_POST['taskid']){
            $sql = "SELECT id,taskid FROM zxjy_usertask WHERE  userid={$uid} and `taskid` =".$_POST['taskid'];
            $taskuser = Yii::app ()->db->createCommand ( $sql )->queryRow();
            if($taskuser){}else{
                echo "<script>alert('任务不存在，请稍刷新！');parent.location.reload();</script>";
                exit ();
            }
        }
		if (! empty ( $_POST ['taskid'] ) && $count > 0) {
			$Usertask = Usertask::model ()->find ( 'taskid=' . $_POST ['taskid'] . ' AND userid=' . Yii::app ()->user->getId () );
			// 统计退出次数Array ( [taskid] => 72 [reasonType] => 1 [Remark] => [notaceeptshop] => on )
			if (! empty ( $unaceept )) {
				if ($_POST ['notaceeptshop'] == 'True') {
					if (! empty ( $unaceept->shopids )) {
						$unaceept->shopids = $unaceept->shopids . ',' . $Usertask->shopid;
					} else {
						$unaceept->shopids = $Usertask->shopid;
					}
				}
                //拼接记录不接的商品
				if ($_POST ['reasonType'] == 'False') {
					if (! empty ( $unaceept->proids )) {
						$unaceept->proids = $unaceept->proids . ',' . $Usertask->proid;
					} else {
						$unaceept->proids = $Usertask->proid;
					}
				}
				$unaceept->num = $unaceept->num - 1;
			} else {
				$unaceept = new Unaceept ();
				$unaceept->userid = Yii::app ()->user->getId ();
				$unaceept->addtime = time ();
				$unaceept->num = 9;
				if ($_POST ['notaceeptshop'] == 'True') {
					$unaceept->shopids = $Usertask->shopid;
				}
				if ($_POST ['reasonType'] == 0) {
					$unaceept->proids = $Usertask->proid;
				}
			}
			//$unaceept->save ();

            $ck = $this->updateTaskNum ( $Usertask->taskid, $Usertask->tasktimeid, $Usertask->taskmodelid, $Usertask->id );
            if($ck) {
                $unaceept->save();
                if (! empty ( $_POST ['Remark'] )) {
                    $userlog = new Userlog ();
                    $userlog->userid = Yii::app ()->user->getId ();
                    $userlog->logtype = '退出任务';
                    $userlog->content = $_POST ['Remark'];
                    $userlog->addtime = time ();
                    $userlog->save ();
                }
                $this->add_unnormaltask ( $_POST ['taskid'], Yii::app ()->user->getId (), $Usertask->merchantid, $Usertask->addtime, $Usertask->updatetime, $Usertask->taskid, $Usertask->shopid, $Usertask->taskmodelid, $Usertask->tasktimeid, $Usertask->status, 'tasdcontrller/TaskExit' );
                echo "<script>alert('退出任务成功。');parent.location.reload();</script>";
                exit ();
            }else{
                echo "<script>alert('退出任务失败，请稍后再试！');parent.location.reload();</script>";
                exit ();
            }
		} elseif (! empty ( $_POST ['taskid'] ) && $count == 0) {
			echo "<script>alert('今日退出任务总数已经超出限额，不能再退出任务总数了');parent.location.reload();</script>";
			exit ();
		}
		$this->layout = false;
		$this->render ( 'taskExit', array (
				'taskid' => @$_GET ['taskid'],
				'count' => $count 
		) );
	}
	// 评价任务
	public function actionEvalTask() {
		$tbprefix = Yii::app ()->db->tablePrefix;
		$info = array ();
		if ($_GET ['usertaskid']) {
			$sql = "SELECT ut.tasksn,ut.id AS usertaskid,ut.ordersn,s.shopname,p.commodity_title,tv.*  FROM " . $tbprefix . "_usertask AS ut LEFT JOIN " . $tbprefix . "_shop AS s ON s.sid=ut.shopid LEFT JOIN " . $tbprefix . "_taskevaluate AS tv ON tv.usertaskid=ut.id LEFT JOIN " . $tbprefix . "_product AS p ON " . "p.id=ut.proid WHERE ut.id=" . $_GET ['usertaskid'];
			$info = Yii::app ()->db->createCommand ( $sql )->queryRow ();
			$info ['imgcontent'] = unserialize ( $info ['imgcontent'] );
		}
		if (! empty ( $_POST )) {
			$sql = "UPDATE " . $tbprefix . "_taskevaluate SET doing=1,postimg='$_POST[img1]' WHERE id=$_POST[taskevalid]";
			$res = Yii::app ()->db->createCommand ( $sql )->query ();
			$usertask = Usertask::model ()->findByPk ( $_POST ['usertaskid'] );
			$usertask->status = 6;
			if ($res) {
				$usertask->save ();
				$this->redirect ( $this->createUrl ( 'task/evaltasklist' ) );
			}
		}
		$this->layout = false;

		$this->render ( 'evalTask', array (
				'info' => $info
		) );
	}


    // 评价任务(xin)
    public function actionEvalTasktest() {
        $tbprefix = Yii::app ()->db->tablePrefix;
        $info = array ();
        if ($_GET ['usertaskid']) {
            $sql = "SELECT ut.tasksn,ut.id AS usertaskid,ut.ordersn,s.shopname,p.commodity_title,tv.*  FROM " . $tbprefix . "_usertask AS ut LEFT JOIN " . $tbprefix . "_shop AS s ON s.sid=ut.shopid LEFT JOIN " . $tbprefix . "_taskevaluate AS tv ON tv.usertaskid=ut.id LEFT JOIN " . $tbprefix . "_product AS p ON " . "p.id=ut.proid WHERE ut.id=" . $_GET ['usertaskid'];
            $info = Yii::app ()->db->createCommand ( $sql )->queryRow ();
            $info ['imgcontent'] = unserialize ( $info ['imgcontent'] );
        }
        if (! empty ( $_POST )) {
            //评价佣金即使返现
            $uID = Yii::app ()->user->getId () ;
            $mark = 'outeval_' . $uID;
            $redis = Yii::app() -> redis;
            if (!empty($_POST))
            {
                if (time() - $redis -> get($mark) < 1* 20)  //请求间隔小于10分钟直接返回
                {
                    echo "<script>alert('请求间隔小于20秒');</script>";
                    $this->redirect ( $this->createUrl ( 'task/evaltasklist' ) );
                    exit ();
                }
                $redis -> set($mark, time());
            }
            $taskevalid= $_POST[taskevalid];
            $url = BKC_URL."?ActionTag=User_TaskEvaluate_OK&TaskEvaluateID={$taskevalid}";
            $rr =Toole::curl_get($url);
            $jsonObject = json_decode ( $rr );

            if($jsonObject->IsOK == true){
                $sql = "UPDATE " . $tbprefix . "_taskevaluate SET doing=2,postimg='$_POST[img1]' WHERE id=$_POST[taskevalid]";
                $res =  Yii::app ()->db->createCommand ( $sql )->execute ();
                $usertask = Usertask::model ()->findByPk ( $_POST ['usertaskid'] );
                $usertask->status = 7;
                if ($res) {
                    $usertask->save ();
                    $this->redirect ( $this->createUrl ( 'task/evaltasklist' ) );
                    exit ();
                }else{
                }
            }
        }
        $this->layout = false;

        $this->render ( 'evalTask', array (
            'info' => $info
        ) );
    }

	// 评价任务列表
	public function actionEvalTaskList() {
		$tbprefix = Yii::app ()->db->tablePrefix;
		$search = array ();
		$where = ' AND te.doing=0 ';
		if (is_numeric ( $_GET ['type'] )) {
			if (! empty ( $_GET ['type'] )) {
				$where = ' AND te.doing=' . $_GET ['type'] . ' ';
			}
		}
		$list = array ();
		$sql = "SELECT te.*,ut.ordersn,ut.tasksn,ut.expressnum,ut.updatetime,w.wangwang,s.shopname FROM " . $tbprefix . "_taskevaluate AS te LEFT JOIN " . $tbprefix . "_usertask AS ut ON te.usertaskid=ut.id LEFT JOIN " . $tbprefix . "_blindwangwang AS w ON w.userid=te.doid LEFT JOIN " . $tbprefix . "_shop " . " AS s ON s.sid=ut.shopid WHERE te.doid=" . Yii::app ()->user->getId () . $where." order by te.addtime desc ";
		// 分页
		$creteria = new CDbCriteria ();
		$list = Yii::app ()->db->createCommand ( $sql )->queryAll ();
		$pages = new CPagination ( count ( $list ) );
		$pages->pageSize = 10;
		$pages->applyLimit ( $creteria );
		
		$list = Yii::app ()->db->createCommand ( $sql . " LIMIT :offset,:limit" );
		$list->bindValue ( ':offset', $pages->currentPage * $pages->pageSize );
		$list->bindValue ( ':limit', $pages->pageSize );
		$list = $list->queryAll ();
		
		$this->render ( 'evalTaskList', array (
				'evallist' => $list,
				'search' => $search,
				'pages' => $pages 
		) );
	}
	// 淘宝问大家
	public function actionTbAsk() {
		$this->render ( 'tbAsk' );
	}
	// 认证店铺名shopconfirm
	public function actionShopConfirm() {
		$tbprefix = Yii::app ()->db->tablePrefix;
		if ($_POST ['val']) {
			$usertask = Usertask::model ()->findByPk ( $_POST ['taskid'] );
			switch ($_POST ['type']) {
				case in_array ( $_POST ['type'], array (
						1,
						3,
						4,
						6 
				) ) :
					$sql = "SELECT shopname FROM " . $tbprefix . "_shop  WHERE sid=" . $usertask->shopid . " AND (shopname='$_POST[val]' OR shopname=' $_POST[val]' OR shopname='$_POST[val] ')";
					break;
				case in_array ( $_POST ['type'], array (
						2,
						5 
				) ) :
					$sql = "SELECT commodity_id FROM " . $tbprefix . "_product WHERE id=" . $usertask->proid . " AND commodity_id='$_POST[val]'";
			}
			$row = Yii::app ()->db->createCommand ( $sql )->queryRow ();
			if ($row) {
				
				$cookies = Yii::app ()->request->getCookies ();
				$comfirmcookie = $cookies ['comfirmcookie' . $_POST ['taskid']]->value;
				// 生成coockie
				if (empty ( $comfirmcookie )) {
					$cookie = new CHttpCookie ( 'comfirmcookie' . $_POST ['taskid'], 1 );
					$cookie->expire = time () + 3600; // 有限期60分钟
					Yii::app ()->request->cookies ['comfirmcookie' . $_POST ['taskid']] = $cookie; // 写入
				}
				$res ['err_code'] = 0;
				$res ['msg'] = '验证通过';
				$res ['shopname'] = $row ['shopname'];
			} else {
				$res ['err_code'] = 1;
				$res ['msg'] = '验证不通过！';
			}
			echo json_encode ( $res );
			exit ();
		}
	}
	// 确认收货
	public function actionComfirmTask() {
		if (! empty ( $_GET ['usertaskid'] )) {
			$usertask = Usertask::model ()->findByPk ( $_GET ['usertaskid'] );
		}
		if (! empty ( $_POST ['taskid'] )) {
			$usertask = Usertask::model ()->findByPk ( $_POST ['taskid'] );
			/*
			 * $time3=$usertask->updatetime+3*24*3600;
			 * if (time()<$time3){
			 * echo "<script>alert('当前订单未满3天，请淘宝确认收货之后再来平台确认收货');self.parent.$.closeWin()</script>";exit;
			 * }
			 */
			$usertask->status = 3;
			if ($usertask->save ()) {
				echo "<script>parent.location.reload()</script>";
				exit ();
			}
		}
		$this->layout = false;
		$this->render ( 'comfirmTask', array (
				'usertask' => @$usertask 
		) );
	}
	// 一键确认收货
	public function actionComfirmAllTask() {
		// $time3=time()-3*24*3600;
		// $usertask=Usertask::model()->findAll('userid='.Yii::app()->user->getId().' AND status=2 AND updatetime<'.$time3);
		$usertask = Usertask::model ()->findAll ( 'userid=' . Yii::app ()->user->getId () . ' AND status=2 ' );
		$arr = array ();
		foreach ( $usertask as $v ) {
			$arr [] = $v->id;
		}
		if (empty ( $arr )) {
			$this->redirect_message ( '亲，没有确认收货的订单哦！', 'failed', 2, $this->createUrl ( 'task/taskmanage' ) );
			exit ();
		} else {
			$count = Usertask::model ()->updateByPk ( $arr, array (
					'status' => '3' 
			), 'status=2' );
			if ($count > 0) {
				$this->redirect_message ( '一键收货成功', 'success', 1, $this->createUrl ( 'task/taskmanage' ) );
				exit ();
			} else {
				$this->redirect_message ( '操作失败', 'failed', 2, $this->createUrl ( 'task/taskmanage' ) );
				exit ();
			}
		}
	}
	// 放弃评价任务
	public function actionSetfreeEvalTask() {
		if (! empty ( $_GET ['taskevalid'] )) {
			$sql = 'SELECT * FROM ' . Yii::app ()->db->tablePrefix . '_taskevaluate WHERE usertaskid=' . $_GET ['taskevalid'];
			$row = Yii::app ()->db->createCommand ( $sql )->queryRow ();
			$usertask = Usertask::model ()->findByPk ( $row ['usertaskid'] );
			$user = User::model ()->findByPk ( $row ['sellerid'] );
			$sql = 'UPDATE ' . Yii::app ()->db->tablePrefix . '_taskevaluate SET doing=3 WHERE usertaskid=' . $_GET ['taskevalid'];
			Yii::app ()->db->createCommand ( $sql )->query ();
			$cashlog = new Cashlog ();
			$cashlog->type = '返还评价佣金';
			$cashlog->remoney = $user->Money;
			$cashlog->increase = '+' . $row ['iscommission'];
			$cashlog->beizhu = '刷手放弃评价任务返还佣金';
			$cashlog->addtime = time ();
			$cashlog->userid = $row ['sellerid'];
			$cashlog->usertaskid = $row ['usertaskid'];
			$cashlog->proid = $usertask->proid;
			$cashlog->shopid = $usertask->shopid;
			$user->Money = $user->Money + $row ['iscommission'];
			$user->save ();
			if ($cashlog->save ()) {
				$this->redirect_message ( '操作成功', 'success', 1, $this->createUrl ( 'task/taskmanage' ) );
				exit ();
			} else {
				$this->redirect_message ( '操作失败', 'failed', 1, $this->createUrl ( 'task/taskmanage' ) );
				exit ();
			}
		}
	}
	
	// 释放任务
	function setFreeTask() {
		$tbprefix = Yii::app ()->db->tablePrefix;
		$uid = Yii::app ()->user->getId ();
		$overtiem = time () - 5 * 60; // defalt
		$overtiemtwo = time () - 30 * 60; // two
		$overtiemthree = time () - 60 * 60; // three
		                             // $sql="SELECT * FROM ".$tbprefix."_usertask WHERE userid=$uid AND status=0 AND ((flag=0 AND addtime<$overtiem ) OR (flag=1 AND addtime<$overtiemtwo ) ".
		                             // " OR (flag=2 AND addtime<$overtiemthree ))";
		$sql = "SELECT * FROM " . $tbprefix . "_usertask WHERE userid=$uid  AND status=0 AND addtime<$overtiemthree ";
		// echo $sql;exit;
		$all = Yii::app ()->db->createCommand ( $sql )->queryAll ();
		foreach ( $all as $val ) {
			$task = Task::model ()->findByPk ( $val ['taskid'] );
			$usertask = Usertask::model ()->findByPk ( $val ['id'] );
			$taskmodel = Taskmodel::model ()->findByPk ( $val ['taskmodelid'] );
			$task->qrnumber = $task->qrnumber - 1;
			if (! empty ( $val ['tasktimeid'] )) {
				$tasktime = Tasktime::model ()->findByPk ( $val ['tasktimeid'] );
				$tasktime->takenumber = $tasktime->takenumber - 1;
				$tasktime->save ();
			}
			
			$taskmodel->takenumber = $taskmodel->takenumber - 1;
			
			// 生成商家资金日志文件
			$cashLog = new Cashlog ();
			$cashLog->type = '返还佣金';
			$us = User::model ()->findByPk ( $task->userid );
			$cashLog->remoney = $us->Money + ($taskmodel->commission + $task->top);
			$us->Money = $us->Money + ($taskmodel->commission + $task->top);
			$cashLog->increase = '+' . ($taskmodel->commission + $task->top);
			$cashLog->beizhu = '刷手放弃任务返还佣金13';
			$this->add_unnormaltask ( $val ['id'], $val ['userid'], $val ['merchantid'], $val ['addtime'], $val ['updatetime'], $val ['taskid'], $val ['shopid'], $val ['taskmodelid'], $val ['tasktimeid'], $val ['status'], 'taskcontrller/setFreeTask' );
			$cashLog->addtime = time ();
			$cashLog->userid = $task->userid;
			$cashLog->usertaskid = $usertask->id;
			$cashLog->proid = $task->proid;
			$cashLog->shopid = $task->shopid;
			$cashLog->save ();
			$us->save ();
			
			$task->save ();
			$taskmodel->save ();
			$usertask->delete ();
		}
	}
	// 删除任务
	function delCurtask($taskid, $overtime) {
		// $usertask=Usertask::model()->find('id='.$taskid .' AND addtime>'.$overtime);
		$usertask = Usertask::model ()->find ( 'id=' . $taskid );
		if (! empty ( $usertask )) {
			$task = Task::model ()->findByPk ( $usertask->taskid );
			$taskmodel = Taskmodel::model ()->findByPk ( $usertask->taskmodelid );
			
			$task->qrnumber = $task->qrnumber - 1;
			$taskmodel->takenumber = $taskmodel->takenumber - 1;
			if (! empty ( $usertask->tasktimeid )) {
				$tasktime = Tasktime::model ()->findByPk ( $usertask->tasktimeid );
				$tasktime->takenumber = $tasktime->takenumber - 1;
				$tasktime->save ();
			}
			
			// 生成商家资金日志文件
			$cashLog = new Cashlog ();
			$cashLog->type = '返还佣金';
			$us = User::model ()->findByPk ( $task->userid );
			$cashLog->remoney = $us->Money + ($taskmodel->commission + $task->top);
			$us->Money = $us->Money + ($taskmodel->commission + $task->top);
			$cashLog->increase = '+' . ($taskmodel->commission + $task->top);
			$cashLog->beizhu = '刷手放弃任务返还佣金22';
			$cashLog->addtime = time ();
			$cashLog->userid = $task->userid;
			$cashLog->usertaskid = $usertask->id;
			$cashLog->proid = $task->proid;
			$cashLog->shopid = $task->shopid;
			$cashLog->save ();
			$us->save ();
			$this->add_unnormaltask ( $usertask->id, $usertask->userid, $usertask->merchantid, $usertask->addtime, $usertask->updatetime, $usertask->taskid, $usertask->shopid, $usertask->taskmodelid, $usertask->tasktimeid, $usertask->status, 'tasdcontrller/delCurtask' );
			$task->save ();
			
			$taskmodel->save ();
			$usertask->delete ();
		}
	}
	// 删除任务
    function updateTaskNum($taskid, $tasktimeid, $taskmodelid, $usertaskid) {

        $url = BKC_URL."?ActionTag=ClearUserTask&UserTaskID={$usertaskid}";
        $rr =Toole::curl_get($url);

        $jsonObject = json_decode ( $rr );
        if($rr){
            return ($jsonObject->IsOK == true) ;;
        }else{
            return false ;
        }
        return false ;
    }

//	function updateTaskNum($taskid, $tasktimeid, $taskmodelid, $usertaskid) {
//		$task = Task::model ()->findByPk ( $taskid );
//		$task->qrnumber = $task->qrnumber - 1;
//		$tasktime = Tasktime::model ()->findByPk ( $tasktimeid );
//		if ($tasktime->takenumber > 0) {
//			$tasktime->takenumber = $tasktime->takenumber - 1;
//			$tasktime->save ();
//		}
//		$taskmodel = Taskmodel::model ()->findByPk ( $taskmodelid );
//		$taskmodel->takenumber = $taskmodel->takenumber - 1;
//
//		// 生成商家资金日志文件
//		$cashLog = new Cashlog ();
//		$cashLog->type = '返还佣金';
//		$us = User::model ()->findByPk ( $task->userid );
//		$cashLog->remoney = $us->Money + ($taskmodel->commission + $task->top);
//		$us->Money = $us->Money + ($taskmodel->commission + $task->top);
//		$cashLog->increase = '+' . ($taskmodel->commission + $task->top);
//		$cashLog->beizhu = '刷手放弃任务返还佣金23';
//		$cashLog->addtime = time ();
//		$cashLog->userid = $task->userid;
//		$cashLog->usertaskid = $usertaskid;
//		$cashLog->proid = $task->proid;
//		$cashLog->shopid = $task->shopid;
//		$cashLog->save ();
//		$us->save ();
//
//		$task->save ();
//
//		$taskmodel->save ();
//	}
	// 用户名处理
	function substr_cut($user_name) {
		// 获取字符串长度
		$strlen = mb_strlen ( $user_name, 'utf-8' );
		// 如果字符创长度小于2，不做任何处理
		if ($strlen < 2) {
			return $user_name;
		} else {
			// mb_substr — 获取字符串的部分
			$firstStr = mb_substr ( $user_name, 0, 1, 'utf-8' );
			$lastStr = mb_substr ( $user_name, - 1, 1, 'utf-8' );
			// str_repeat — 重复一个字符串
			return $strlen == 2 ? $firstStr . str_repeat ( '*', mb_strlen ( $user_name, 'utf-8' ) - 1 ) : $firstStr . str_repeat ( "*", $strlen - 2 ) . $lastStr;
		}
	}
}

?>