<?php

class TaskController extends Controller
{
    public $layout = 'public_header';

    public function init()
    {
        parent::init();
        $userid = Yii::app()->user->getId();
        if (empty ($userid)) {
            $this->redirect($this->createUrl('passport/login'));
        }
    }
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                'width' => 80, // 默认120
                'height' => 35, // 默认50
                'padding' => 2, // 文字周边填充大小
                'foreColor' => 0x2040A0, // 字体颜色
                'minLength' => 4, // 设置最短为6位
                'maxLength' => 4, // 设置最长为7位,生成的code在6-7直接rand了
                'transparent' => true, // 显示为透明,默认中可以看到为false
                'offset' => -2
            )  // 设置字符偏移量

        );
    }
    // 任务开始1
//    public function actionTaskOne() {
//        $tbprefix = Yii::app ()->db->tablePrefix;
//        $setfreetime = 1200;
//        $where = '';
//        $time10 = 10;
//        if (! empty ( $_GET ['taskid'] )) {
//            // 设置浏览时间为10秒
//            $cookies = Yii::app ()->request->getCookies ();
//            if (empty ( $cookies ['readtime' . $_GET ['taskid']]->value )) {
//                $cookie = new CHttpCookie ( 'readtime' . $_GET ['taskid'], time () + 11 );
//                $cookie->expire = time () + 60 * 60; // 有限期30分钟
//                Yii::app ()->request->cookies ['readtime' . $_GET ['taskid']] = $cookie; // 写入
//            } else {
//                $time10 = $cookies ['readtime' . $_GET ['taskid']]->value - time ();
//            }
//
//            $usertask = Usertask::model ()->findByPk ( $_GET ['taskid'] );
//            if ($usertask->flag == 0) {
//                $where = ' AND utask.flag=0 ';
//                $overtime = time () - 20 * 60; // defalt
//
//            } elseif ($usertask->flag == 1) {
//                $overtime = time () - 30 * 60;
//                $where = ' AND utask.flag=1 ';
//            } elseif ($usertask->flag == 2) {
//                $overtime = time () - 60 * 60;
//                $where = ' AND utask.flag=2 ';
//                $setfreetime = ($usertask->addtime + 60 * 60) - time ();
//            }
//            $sql = 'SELECT utask.*,t.remark,t.intlet FROM ' . $tbprefix . '_usertask AS utask LEFT JOIN ' . $tbprefix . '_task AS t ON utask.taskid=t.id' . ' WHERE utask.id=' . $_GET ['taskid'] . " $where AND  utask.addtime>'$overtime'";
//            $task = Yii::app ()->db->createCommand ( $sql )->queryRow ();
//            /*
//             * if (empty($task)){
//             * $this->delCurtask($_GET['taskid'],$overtime);
//             * $this->redirect($this->createUrl('task/taskmanage'));
//             * }else
//             */
//            if ($usertask->flag == 0) {
//                $usertask->flag = 1;
//                $usertask->save ();
//            } elseif ($usertask->flag == 1) {
//                $setfreetime = ($usertask->addtime + 30 * 60) - time ();
//            }
//        }
//        $this->layout = false;
//        if (@$_GET ['taskid']) {
//            $this->render ( 'taskOne', array (
//                'taskinfo' => $task,
//                'setfreetime' => $setfreetime,
//                'time10' => $time10
//            ) );
//        } else {
//            $this->redirect ( $this->createUrl ( 'task/tasktwo', array (
//                'taskid' => $_POST ['taskid']
//            ) ) );
//        }
//    }
    // 任务开始2
//    public function actiontaskTwo() {
//        //前端返回的是 usertasid 任务id  上传的图片 value intlet 的值
//        $tbprefix = Yii::app ()->db->tablePrefix;
//        $msg = '';
//        $setfreetime = 0;
//        //超时判断时间
//        $chaotime = 0;
//        $arr= array();
//        if (! empty ( $_GET ['taskid'] )) {
//            $taskid = $_GET ['taskid'];
//            $where = '';
//            $usertask = Usertask::model ()->findByPk ( $_GET ['taskid'] );
//            if ($usertask->flag == 1) {
//                $overtime = time () - 30 * 60;
//                $where = ' AND utask.flag=1 ';
//            } elseif ($usertask->flag == 2) {
//                $overtime = time () - 60 * 60;
//                $where = ' AND utask.flag=2 ';
//                $setfreetime = ($usertask->addtime + 60 * 60) - time ();
//                if($setfreetime<0){
//                    $this->layout = false;
//                    $arr['msg'] = "任务超过了完成时间！！！！";
//                    $this->render ( 'Tasktesttow', array (
//                        'mag' => $arr,
//                    ) );
//                    exit();
//                }
//            }
//            $sql = 'SELECT utask.*,tm.price AS modelprice,tm.express,tm.modelname,tm.auction,t.remark,t.intlet,t.tasktype,t.keyword,t.order,t.price,t.sendaddress,t.proid,t.other,s.shopname,p.commodity_image FROM ' . $tbprefix . '_usertask AS utask LEFT JOIN ' . $tbprefix . '_task AS t ON utask.taskid=t.id LEFT JOIN ' . $tbprefix . '_shop AS s ON t.shopid=s.sid LEFT JOIN ' . $tbprefix . '_product AS p ON p.id=t.proid LEFT JOIN  ' . $tbprefix . '_taskmodel as tm ON tm.id=utask.taskmodelid WHERE utask.id=' . $taskid . " AND utask.addtime>'$overtime' $where";
//            $task = Yii::app ()->db->createCommand ( $sql )->queryRow ();
//            // 扫码
//            if ($task ['intlet'] == 6) {
//                $product = Product::model ()->findByPk ( $task ['proid'] );
//                $task ['qrcode'] = $product->qrcode;
//            }
//            /*
//             * if (empty($task)){
//             * $this->delCurtask($_GET['taskid'],$overtime);
//             * $this->redirect($this->createUrl('task/taskmanage'));exit;
//             * }
//             */
//            if ($task ['flag'] == 2) {
//                $setfreetime = ($task ['addtime'] + 60 * 60) - time ();
//            } elseif ($task ['flag'] == 1) {
//                $setfreetime = ($task ['addtime'] + 30 * 60) - time ();
//            }
//        }
//        if (@$_POST ['usertaskid']) {
//            // 提交数据
//            $usertask = Usertask::model ()->findByPk ( $_POST ['usertaskid'] );
//            //保存上传的 商品截图
//            if ($_POST ['intlet'] != 6) {
//                $usertask->tasktwoimg = $_POST ['tasktwoimg'];
//            }
//            $usertask->flag = 2;
//            $usertask->save ();
//        }
//        $this->layout = false;
//        $this->render ( 'taskTwo', array (
//            'taskinfo' => @$task,
//            'msg' => $msg,
//            'setfreetime' => $setfreetime
//        ) );
//    }
    // 3333
//    public function actionTaskThree() {
//        $usertask = '';
//        if (@$_GET ['usertaskid']) {
//            $overtime = time () - 60 * 60;
//            // $usertask=Usertask::model()->find('id='.$_GET['usertaskid']." AND flag=2");
//            $usertask = Usertask::model ()->find ( 'id=' . $_GET ['usertaskid'] );
//
//            /*
//             * if ($usertask->addtime<$overtime){
//             * $this->delCurtask($_GET['usertaskid'],$overtime);
//             * $this->redirect($this->createUrl('task/taskmanage'));exit;
//             * }
//             */
//            $cookie = Yii::app ()->request->getCookies ();
//
//            if (empty ( $cookie ['stoptime' . $_GET ['usertaskid']]->value )) {
//                $time = time () + 5 * 60;
//                $cookie = new CHttpCookie ( 'stoptime' . $_GET ['usertaskid'], $time );
//                $cookie->expire = $time + 1800;
//                Yii::app ()->request->cookies ['stoptime' . $_GET ['usertaskid']] = $cookie;
//                $stoptime = date ( 'Y/m/d H:i:s', $time );
//                $stopmin = $time - time ();
//            } else {
//                $stoptime = date ( 'Y/m/d H:i:s', @$cookie ['stoptime']->value );
//                $stopmin = @$cookie ['stoptime' . $_GET ['usertaskid']]->value - time ();
//            }
//
//            $sql = "SELECT remark FROM " . Yii::app ()->db->tablePrefix . "_task WHERE id=" . $usertask->taskid;
//            $row = Yii::app ()->db->createCommand ( $sql )->queryRow ();
//            $remark = $row ['remark'];
//            $setfreetime = ($usertask ['addtime'] + 60 * 60) - time ();
//            $product = Product::model ()->findByPk ( $usertask->proid );
//        }
//        if (@$_POST) {
//            $this->redirect ( $this->createUrl ( 'task/taskfour', array (
//                'usertaskid' => $_POST ['usertaskid'] ,
//
//            ) ) );
//        }
//        $this->layout = false;
//        $this->render ( 'taskThree', array (
//            'usertaskid' => $_GET ['usertaskid'],
//            'usertask' => $usertask,
//            'stoptime' => $stoptime,
//            'stopmin' => $stopmin,
//            'setfreetime' => $setfreetime,
//            'buytype' => $product,
//            'remark' => $remark
//        ) );
//    }
    // 444(提交任务，等商家审)
//    public function actionTaskFour() {
//        $tbprefix = Yii::app ()->db->tablePrefix;
//        $overtime = time () - 60 * 60;
//        $taskinfo = array ();
//        if (! empty ( $_GET ['usertaskid'] )) {
//            $sql = "SELECT ut.*,s.shopname,t.intlet,tm.price,tm.express,tm.auction,tm.modelname,p.commodity_image as image FROM " . $tbprefix . "_usertask AS ut LEFT JOIN " . $tbprefix . "_shop AS s " . ' ON ut.shopid=s.sid LEFT JOIN ' . $tbprefix . '_taskmodel as tm ON ut.taskmodelid=tm.id LEFT JOIN ' . $tbprefix . '_product AS p ON p.shopid=ut.shopid ' . ' LEFT JOIN  ' . $tbprefix . '_task as t ON t.id=ut.taskid WHERE ut.id= ' . $_GET ['usertaskid'] . " AND ut.flag=2 AND ut.addtime>'$overtime'";
//            $taskinfo = Yii::app ()->db->createCommand ( $sql )->queryRow ();
//            $taskinfo ['price'] = $taskinfo ['price'] + $taskinfo ['express'];
//            /*
//             * if (empty($taskinfo)){
//             * $this->delCurtask($_GET['usertaskid'],$overtime);
//             * $this->redirect($this->createUrl('task/taskmanage'));exit;
//             * }
//             */
//            $setfreetime = ($taskinfo ['addtime'] + 60 * 60) - time ();
//        }
//        $coo = Yii::app ()->request->getCookies ();
//        if ($coo['comfirmcookie' . $taskinfo ['id']]->value == 1){
//
//        }else{
//            echo "<script>alert('你没有验证店铺名！！');window.history.go(-1);</script>";
//            exit ();
//        }
//
//        if (@$_POST ['TaskID']) {
//            $sql = "SELECT COUNT(1) FROM zxjy_usertask WHERE ordersn ='{$_POST[ordernum]}'";
//            $ordersnCount = Yii::app ()->db->createCommand ( $sql )->queryScalar ();
//            if ($ordersnCount > 0) {
//                echo "<script>alert('该订单交易编号已提交过任务，不可重复使用订单交易编号');window.history.go(-1);</script>";
//                exit ();
//            }
//
//            // $sql = "UPDATE " . Yii::app ()->db->tablePrefix . "_usertask SET `ordersn`='$_POST[ordernum]',`orderimg`='$_POST[orderimg]',`orderprice`='$_POST[PayPrice]',`paytype`='$_POST[PayMethod]'," . "updatetime=" . time () . ",`flag`=3,status=1 WHERE id=$_POST[TaskID]";
//            $sql = "UPDATE " . Yii::app ()->db->tablePrefix . "_usertask SET `ordersn`='$_POST[ordernum]',`orderimg`='$_POST[orderimg]',
//`orderprice`='$_POST[PayPrice]',`paytype`='$_POST[PayMethod]'," . "updatetime=" . time () . ",`flag`=3, status=4 WHERE id=$_POST[TaskID]";
//            $res = Yii::app ()->db->createCommand ( $sql )->execute ();
//            /*
//             * $usertask=Usertask::model()->findByPk($_POST['TaskID']);
//             * $usertask->ordersn=trim($_POST['ordernum']);
//             * $usertask->orderimg=$_POST['orderimg'];
//             * $usertask->orderprice=$_POST['PayPrice'];
//             * $usertask->paytype=$_POST['PayMethod'];
//             * $usertask->updatetime=time();
//             * $usertask->flag=3;
//             * $usertask->status=1;
//             */
//
//            if ($res > 0) {
//                $uID = Yii::app ()->user->getId ();
//                $fp = fopen ( BKC_URL."?ActionTag=SendMoney&UserTaskID={$_GET ['usertaskid']}", 'r' );
//                $strJson = '';
//                while ( ! feof ( $fp ) ) {
//                    $line = fgets ( $fp, 1024 );
//                    $strJson = $strJson . $line;
//                }
//                fclose ( $fp );
//            }
//
//            $clientMsg = "提交任务出现错误，操作终止，请与客服联系并提交您的相关任务信息";
//            if (empty ( $strJson ) == false) {
//                $jsonObject = json_decode ( $strJson );
//                if ($jsonObject) {
//                    if ($jsonObject->IsOK == true) {
//                        $clientMsg = '已成功提交，任务完成！【提醒：请到本金提现申请提现,否则商家无法返还本金】';
//                    } else {
//                        $clientMsg = "操作终止，提交过程错误：{$jsonObject->Description}  ";
//                    }
//                }
//            }
//            // echo "<script>alert('已成功提交，等待商家审核！任务提交后请到本金提现申请提现,否则商家无法返还本金');parent.parent.location.reload();</script>";
//            echo "<script>alert('{$clientMsg}');parent.parent.location.reload();</script>";
//        }
//        $this->layout = false;
//        $this->render ( 'taskFour', array (
//            'taskinfo' => $taskinfo,
//            'setfreetime' => $setfreetime
//        ) );
//    }
    // 任务管理(做任务)
//    public function actionTaskManage() {
//        //$this->setFreeTask ();
//        $tbprefix = Yii::app ()->db->tablePrefix;
//        $timen30 = time () - (30 * 24 * 3600);
//        $where = '';
//        if ($_GET ['status'] > - 1 && $_GET ['status'] != 'null') {
//            $where .= " AND utask.status='{$_GET['status']}'";
//        }
//        if (! empty ( $_GET ['txtSearch'] )) {
//
//            if ($_GET ['selSearch'] == 'shopname') {
//                $where .= " AND s.shopname LIKE'%$_GET[txtSearch]%' ";
//            } else {
//                $where .= " AND utask." . $_GET ['selSearch'] . "='$_GET[txtSearch]' ";
//            }
//        }
//        if (! empty ( $_GET ['beginDate'] ) && ! empty ( $_GET ['endDate'] )) {
//            $where .= " AND utask.addtime>'" . $_GET ['beginDate'] . "' AND utask.addtime<'" . $_GET ['endDate'] . "' ";
//        }
//        if (! empty ( $_GET ['beginDate'] ) && empty ( $_GET ['endDate'] )) {
//            $where .= " AND utask.addtime>'" . $_GET ['beginDate'] . "' ";
//        }
//        if (empty ( $_GET ['beginDate'] ) && ! empty ( $_GET ['endDate'] )) {
//            $where .= " AND utask.addtime<'" . $_GET ['endDate'] . "' ";
//        }
//        $tbname = Blindwangwang::model ()->find ( 'userid=' . Yii::app ()->user->getId () );
//        $sql = 'SELECT utask.*,t.remark,tm.price,tm.express,tm.auction,t.intlet,s.shopname FROM ' . $tbprefix . '_usertask AS utask LEFT JOIN ' . $tbprefix . '_task AS t ON utask.taskid=t.id' . ' LEFT JOIN ' . $tbprefix . '_taskmodel AS tm ON utask.taskmodelid=tm.id LEFT JOIN ' . $tbprefix . '_shop AS s ON s.sid=utask.shopid WHERE utask.addtime>' . $timen30 . ' AND utask.userid=' . Yii::app ()->user->getId () . $where . ' ORDER BY utask.addtime DESC';
//
//        // 分页
//        $creteria = new CDbCriteria ();
//        $list = Yii::app ()->db->createCommand ( $sql )->queryAll ();
//
//        $pages = new CPagination ( count ( $list ) );
//        $pages->pageSize = 10;
//        $pages->applyLimit ( $creteria );
//
//        $list = Yii::app ()->db->createCommand ( $sql . " LIMIT :offset,:limit" );
//        $list->bindValue ( ':offset', $pages->currentPage * $pages->pageSize );
//        $list->bindValue ( ':limit', $pages->pageSize );
//        $task = $list->queryAll ();
//        $overtime = time () - 30* 60;
//        $this->render ( 'taskManage', array (
//            'tbname' => $tbname->wangwang,
//            'overtime' =>$overtime ,
//            'task' => $task,
//            'pages' => $pages
//        ) );
//    }
// 任务管理优化
    public function actionTaskManage01(){
        $this->render('taskManagetset01');
    }

    public function actionTaskManage02()
    {
        //$this->setFreeTask ();
        //header("content-type:text/html;charset=utf-8");
        $uid = Yii::app()->user->getId();
        $where = '';
        $timen30 = time() - (30 * 24 * 3600);
        if (empty ($_POST['txtSearch'])) {
            $where .= 'and  utask.addtime>' . $timen30 . " ";
        }

        if ($_POST['taskStatus'] > -1 && $_POST['taskStatus'] != '0') {

            $taskStatus = $_POST['taskStatus'] - 1;
            $where .= " AND utask.status=" . $taskStatus . " ";
        }
        if (!empty ($_POST['txtSearch'])) {
            if ($_POST['selSearch'] == 'shopname') {
                $where .= " AND s.shopname LIKE'%$_POST[txtSearch]%' ";
            } else {
                $where .= " AND utask." . $_POST['selSearch'] . "='$_POST[txtSearch]' ";
            }
        }
        if (!empty ($_POST['beginDate']) && !empty ($_POST['endDate'])) {
            $where .= " AND utask.addtime>'" . $_POST['beginDate'] . "' AND utask.addtime<'" . $_POST['endDate'] . "' ";
        }
        if (!empty ($_POST['beginDate']) && empty ($_POST['endDate'])) {
            $where .= " AND utask.addtime>'" . $_POST['beginDate'] . "' ";
        }
        if (empty ($_POST['beginDate']) && !empty ($_POST['endDate'])) {
            $where .= " AND utask.addtime<'" . $_POST['endDate'] . "' ";
        }
        $ofo = 6;
        $pages = ($_POST['page'] - 1) * $ofo;
        $pagee = $_POST['page'] * $ofo;
        $sql = 'SELECT count(utask.userid) FROM zxjy_usertask AS utask 
                LEFT JOIN zxjy_task AS t ON utask.taskid=t.id 
                LEFT JOIN zxjy_taskmodel AS tm ON utask.taskmodelid=tm.id 
                LEFT JOIN zxjy_shop AS s ON s.sid=utask.shopid 
                LEFT JOIN zxjy_blindwangwang AS bl ON  utask.userid = bl.userid
                LEFT JOIN zxjy_taskevaluate AS tv ON  utask.id = tv.usertaskid
                WHERE  utask.userid=' . $uid . '  ' . $where . ' ORDER BY utask.addtime and (t.tasktype = 1 OR t.tasktype = 3)  DESC ';
        $count = Yii::app()->db->createCommand($sql)->queryRow();
        //$page = $count['count(userid)']/6;
        $limit = " limit " . $pages . "," . $ofo;
        //$where = " limit 0,6";
        $sql = 'SELECT utask.id,utask.taskid,utask.tasksn,utask.ordersn,utask.orderprice,utask.status,utask.commission,utask.addtime,t.remark,tm.price,tm.express,tm.auction,t.intlet,s.shopname,bl.wangwang,tv.doing  FROM zxjy_usertask AS utask 
                LEFT JOIN zxjy_task AS t ON utask.taskid=t.id 
                LEFT JOIN zxjy_taskmodel AS tm ON utask.taskmodelid=tm.id 
                LEFT JOIN zxjy_shop AS s ON s.sid=utask.shopid 
                LEFT JOIN zxjy_blindwangwang AS bl ON  utask.userid = bl.userid
                LEFT JOIN zxjy_taskevaluate AS tv ON  utask.id = tv.usertaskid
                WHERE  utask.userid=' . $uid . '  ' . $where . ' and (t.tasktype = 1 OR t.tasktype = 3)  ORDER BY utask.addtime DESC ' . $limit;
        // 分页
        $list = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($list as $k => $val) {
            // $list[$k]  $val['shopname']);
            $list[$k]['shopname'] = $this->substr_cut(trim($val['shopname']));
            // var_dump( $list[$k]['shopname']);
        }
        $arr = array(
            'list' => $list,
            'count' => $count['count(utask.userid)'],
            'page' => $_POST['page'],
            'ofo' => $ofo
        );
        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    }

    //任务时间获取(销量任务)
    public function actionTasksuo()
    {
        $arr = array();
        $uid = Yii::app()->user->getId();
        $taskid = $_POST['taskid'];
        $sql = "SELECT addtime FROM zxjy_usertask AS ut WHERE userid ={$uid} and  taskid=" . $_POST['taskid'];
        $taskinfo = Yii::app()->db->createCommand($sql)->queryRow();
        if ($taskinfo) {
            $setfreetime = ($taskinfo['addtime'] + 45 * 60) - time();
            $arr['setfreetime'] = $setfreetime;
            $arr['msg'] = '任务时间setfreetime:' . $setfreetime;
        } else {
            $setfreetime = 0;
            $arr['setfreetime'] = $setfreetime;
            $arr['msg'] = '任务查找不到';
        }
        $sql = "SELECT `value` FROM zxjy_system  WHERE varname = 'waittime'";
        $taskdengdaitime = Yii::app()->db->createCommand($sql)->queryRow();
        $ketiamRof = Yii::app()->redis->get($uid . '_time_' . $taskid);
        if ($ketiamRof) {
            $ketiamR1 = (time() - $ketiamRof);
            $arr['num'] =$taskdengdaitime['value'] * 60 - $ketiamR1;
        } else {
            //设置时间
            $arr['num'] = $taskdengdaitime['value'] * 60;
            Yii::app()->redis->set($uid . '_time_' . $taskid, time(), 66 * 60);
        }
        echo json_encode($arr);
    }


    //获取提交的任务信息(销量任务)
    public function actionTasktestOne()
    {
        $uid = Yii::app()->user->getId();
        if (!empty ($_GET['taskid'])) {
            $shebei = $_GET ['shebei'];
            $taskid = $_GET ['taskid'];
            $sql = "SELECT ut.*, s.sid, s.shopname,t.intlet,tm.price,tm.express,tm.auction,tm.modelname,tm.car_img,
                    p.commodity_image as image,p.qrcode,p.commodity_image,p.c_goods,p.bookmark,p.talk,p.x_home,p.deep,p.commodity_id,p.through_train_1, p.through_train_2, p.through_train_3, p.through_train_4,
                    t.keyword,t.remark,t.tasktype
                    FROM zxjy_usertask AS ut
                    LEFT JOIN  zxjy_task as t ON t.id=ut.taskid
                    LEFT JOIN zxjy_shop AS s  ON t.shopid=s.sid
                    LEFT JOIN zxjy_taskmodel as tm ON tm.pid=t.mark
                    LEFT JOIN zxjy_product AS p ON p.id=t.proid
                     WHERE ut.userid ={$uid} and  ut.taskid=" .$taskid;
            $taskinfo = Yii::app()->db->createCommand($sql)->queryRow();
            if ((($taskinfo['addtime'] + 50 * 60) - time()) < 0) {
                $this->layout = false;
                $ck = $this->updateTaskNum($taskinfo['taskid'], $taskinfo['tasktimeid'], $taskinfo['taskmodelid'], $taskinfo['id']);
                if($ck){
                    $this->add_unnormaltask($taskinfo['id'], $uid, $taskinfo['merchantid'], $taskinfo['addtime'], $taskinfo['updatetime'], $taskinfo['taskid'], $taskinfo['shopid'], $taskinfo['taskmodelid'], $taskinfo['tasktimeid'], $taskinfo['status'], 'tasdcontrller/TaskExit');
                    $arr['msg'] = "任务过期了！！！！";
                    $this->render('Tasktesttow', array(
                        'mag' => $arr,
                        'shebei' => $shebei
                    ));
                    exit();
                }
                $arr['msg'] = "任务过期了！！！！,无法记录";
                $this->render('Tasktesttow', array(
                    'mag' => $arr,
                    'shebei' => $shebei
                ));
                exit();

            }
            if ($taskinfo) {
            } else {
                $this->layout = false;
                $arr['msg'] = "任务过期了！！！！";
                $this->render('Tasktesttow', array(
                    'mag' => $arr,
                    'shebei' => $shebei
                ));
                exit();
            }
            $rukou = $this->liuliangrukou($taskinfo['intlet']);
            $this->layout = false;
            $setfreetime = ($taskinfo['addtime'] + 50 * 60) - time();
            $num = 5;
            $this->render('Tasktestone', array(
                'taskinfo' => $taskinfo,
                'rukou' => $rukou,
                'setfreetime' => $setfreetime,
                'ketiam' => $num,
                'shebei' => $shebei,
                'is_use_helper' => $this -> isUseHelper(),
            ));
        } else {
            $this->layout = false;
            $arr['msg'] = "任务找不到！！！！";
            $this->render('Tasktesttow', array(
                'mag' => $arr,
//                'shebei' =>$shebei
            ));
            exit();
        }
    }

    // 任务提交(销量任务)
    public function actionOrderall()
    {
        $arr = array();
        $shijian01 = 0;
        $uid = Yii::app()->user->getId();
        if ($_POST) {
            $sql = "SELECT ut.*,ut.addtime,ut.flag,tm.price,tm.auction,tm.express,t.intlet, p.commodity_id, t.tasktype
                    FROM zxjy_usertask AS ut  
                    LEFT JOIN zxjy_task as t on ut.taskid = t.id
                    LEFT JOIN zxjy_taskmodel as tm ON ut.taskmodelid=tm.id 
                    LEFT JOIN zxjy_product as p ON p.id=ut.proid
                    WHERE ut.userid ={$uid} and ut.taskid=" . $_POST['taskid'];
            $taskinfo = Yii::app()->db->createCommand($sql)->queryRow();
            if ($taskinfo) {
            } else {
                $arr['err_code'] = 2;
                $arr['msg'] = "任务过期了！！";
                echo json_encode($arr);
                exit();
            }
            if ((($taskinfo['addtime'] + 50 * 60) - time()) < 0) {
                $this->layout = false;
                $arr['err_code'] = 2;
                $ck = $this->updateTaskNum($taskinfo['taskid'], $taskinfo['tasktimeid'], $taskinfo['taskmodelid'], $taskinfo['id']);
                if($ck){
                    $this->add_unnormaltask($taskinfo['id'], $uid, $taskinfo['merchantid'], $taskinfo['addtime'], $taskinfo['updatetime'], $taskinfo['taskid'], $taskinfo['shopid'], $taskinfo['taskmodelid'], $taskinfo['tasktimeid'], $taskinfo['status'], 'tasdcontrller/TaskExit');
                    $arr['msg'] = "任务过期了！！";
                    exit();
                }
                $arr['msg'] = "任务过期了！！！！,无法记录";
                echo json_encode($arr);
                exit();
            }
            if ($taskinfo['flag'] == 3) {
                $arr['err_code'] = 1;
                $arr['msg'] = "任务已完成！！请勿重复提交";
                echo json_encode($arr);
                exit();
            }
            if ($_POST['tasktwoimg']) {
                if (empty($_POST['tasktwoimg'])) {
                    $arr['err_code'] = 2;
                    $arr['msg'] = "请上传搜索图";
                    echo json_encode($arr);
                    exit();
                }
            }
            $cha = abs($_POST['txtPayPrice'] - ($taskinfo['price'] * $taskinfo['auction'] + $taskinfo['express']));
            if ($cha > 50) {
                $arr['err_code'] = 2;
                $arr['msg'] = "差额>50元，在平台将无法提交订单！！".$cha;
                echo json_encode($arr);
                exit();
            }
            $ketiam = Yii::app()->redis->get($uid . '_time_' . $_POST['taskid']);
            if ($ketiam) {
                $shifou = time() - $ketiam;
                if ($shifou >= $shijian01) {
                    //判定订单是否完成
                    if (@$_POST ['taskid']) {
                        $sql = "SELECT COUNT(1) FROM zxjy_usertask WHERE ordersn ='{$_POST[orderNumber]}'";
                        $ordersnCount = Yii::app()->db->createCommand($sql)->queryScalar();
                        if ($ordersnCount > 0) {
                            $arr['err_code'] = 2;
                            $arr['msg'] = "('该订单交易编号已提交过任务，不可重复使用订单交易编号')";
                            echo json_encode($arr);
                            exit ();
                        }
                        $sql = "UPDATE zxjy_usertask SET `ordersn`='$_POST[orderNumber]',`orderimg`='$_POST[orderimg]',`tasktwoimg`='$_POST[tasktwoimg]',
`orderprice`='$_POST[txtPayPrice]',`paytype`='$_POST[xia]'," . "updatetime=" . time() . ",`flag`=3, status=4 WHERE userid = {$uid} and taskid=" . $_POST[taskid];
                        $res = Yii::app()->db->createCommand($sql)->execute();
                        if ($res > 0) {
                            $is_use_helper = $this -> isUseHelper();
                            if ($is_use_helper)  //使用订单小助手，自动处理基础工单，插旗
                            {
                                $taskinfo['ordersn'] = $_POST['orderNumber'];
                                $this -> actionOrderMark($taskinfo['shopid'], $_POST['orderNumber']);
                                $this -> autoDealTrouble($taskinfo);
                            }
                            $capital_limit = $is_use_helper ? '&OrderPrice=' . $_POST['txtPayPrice'] : '';
                            $fp = fopen(BKC_URL . "?ActionTag=SendMoney&UserTaskID={$taskinfo['id']}&" . $capital_limit, 'r');
                            $strJson = '';
                            while (!feof($fp)) {
                                $line = fgets($fp, 1024);
                                $strJson = $strJson . $line;
                            }
                            fclose($fp);
                        }
                    }
                    $arr['err_code'] = 1;
                    $clientMsg = "提交任务出现错误，操作终止，请与客服联系并提交您的相关任务信息";
                    if (empty ($strJson) == false) {
                        $jsonObject = json_decode($strJson);
                        if ($jsonObject) {
                            if ($jsonObject->IsOK == true) {
                                $arr['err_code'] = 3;
                                $clientMsg = '已成功提交，任务完成！【提醒：请到本金提现申请提现,否则商家无法返还本金】';
                                $arr['msg'] = $clientMsg;
                                echo json_encode($arr);
                                exit();
                            } else {
                                $arr['err_code'] = 1;
                                $clientMsg = "操作终止，提交过程错误：{$jsonObject->Description}  ";
                                $arr['msg'] = $clientMsg;
                                echo json_encode($arr);
                                exit();
                            }
                        }
                    }
                    $arr['msg'] = $clientMsg;
                    echo json_encode($arr);
                    exit();
                } else {
                    $arr['err_code'] = 2;
                    $arr['msg'] = "还没到达可提交时间！还有" + ($shijian01 - $shifou) + "秒,才可以提交";
                    echo json_encode($arr);
                    exit();
                }
            } else {
                $arr['err_code'] = 2;
                $arr['msg'] = "还没到达可提交时间！！";
                echo json_encode($arr);
                exit();
            }
        }
        $arr['msg'] = "没东西";
        $arr['err_code'] = 2;
        echo json_encode($arr);
        exit();
    }

    // 店铺名字验证(新的)
    public function actionTasktestOne02()
    {
        $res = array();
        if (isset($_POST ['val'])) {
            $task = task::model()->findByPk($_POST ['taskid']);
            switch ($_POST ['type']) {
                case in_array($_POST ['type'], array(
                    1,
                    3,
                    4,
                    6
                )) :
                    $sql = "SELECT shopname FROM zxjy_shop  WHERE sid=" . $task->shopid . " AND (shopname='$_POST[val]' OR shopname=' $_POST[val]' OR shopname='$_POST[val] ')";
                    break;
                case in_array($_POST ['type'], array(
                    2,
                    5
                )) :
                    $sql = "SELECT commodity_id FROM zxjy_product WHERE id=" . $task->proid . " AND commodity_id='$_POST[val]'";
            }
            $row = Yii::app()->db->createCommand($sql)->queryRow();
            if ($row) {
                $res ['err_code'] = 0;
                $res ['msg'] = '验证通过';
                $res ['val'] = $_POST ['val'];
            } else {
                $res ['err_code'] = 1;
                $res ['msg'] = '验证不通过！';
            }
            echo json_encode($res);
            exit ();
        }
    }

    // 图片上传验证
    public function actionTasktestOne01()
    {
        $a = '{"status":0,"content":"无效文件"}';
        if ($_FILES) {
            $a = Toole::updol($_FILES, $_POST);
            echo $a;
            exit();
        }
        echo json_encode($a);
    }

    public function actionCheckOrderNumber() {
    }

    // 退出任务
    public function actionTaskExit()
    {
        $count = 10;
        $stardate = strtotime(date('Y-m-d'));
        $uid = Yii::app()->user->getId();
        $unaceept = Unaceept::model()->find('userid=' . Yii::app()->user->getId() . ' AND addtime>' . $stardate);
        if ($unaceept) {
            $count = $unaceept->num;
        }
        if ($_GET ['taskid']) {
            $sql = "SELECT id,taskid FROM zxjy_usertask WHERE  userid={$uid} and `taskid` =" . $_GET ['taskid'];
            $taskuser = Yii::app()->db->createCommand($sql)->queryRow();
            if ($taskuser) {
            } else {
                echo "<script>alert('任务不存在，请稍刷新！');parent.location.reload();</script>";
                exit ();
            }
        }
        if (!empty ($_POST ['taskid']) && $count > 0) {
            $Usertask = Usertask::model()->find('taskid=' . $_POST ['taskid'] . ' AND userid=' . Yii::app()->user->getId());
            // 统计退出次数Array ( [taskid] => 72 [reasonType] => 1 [Remark] => [notaceeptshop] => on )
            if (!empty ($unaceept)) {
                //拼接记录不接的店铺
                if ($_POST ['notaceeptshop'] == 'on') {
                    if (!empty ($unaceept->shopids)) {
                        $unaceept->shopids = $unaceept->shopids . ',' . $Usertask->shopid;
                    } else {
                        $unaceept->shopids = $Usertask->shopid;
                    }
                }
                //拼接记录不接的商品
                if ($_POST ['reasonType'] == 0) {
                    if (!empty ($unaceept->proids)) {
                        $unaceept->proids = $unaceept->proids . ',' . $Usertask->proid;
                    } else {
                        $unaceept->proids = $Usertask->proid;
                    }
                }
                $unaceept->num = $unaceept->num - 1;
            } else {
                $unaceept = new Unaceept ();
                $unaceept->userid = Yii::app()->user->getId();
                $unaceept->addtime = time();
                $unaceept->num = 9;
                if ($_POST ['notaceeptshop'] == 'on') {
                    $unaceept->shopids = $Usertask->shopid;
                }
                if ($_POST ['reasonType'] == 0) {
                    $unaceept->proids = $Usertask->proid;
                }
            }
            // 删除任务(2018-3-5)
            $ck = $this->updateTaskNum($Usertask->taskid, $Usertask->tasktimeid, $Usertask->taskmodelid, $Usertask->id);
            if ($ck) {
                $unaceept->save();
                //退任务的备注
                $new_id = $this->add_unnormaltask($_POST ['taskid'], Yii::app()->user->getId(), $Usertask->merchantid, $Usertask->addtime, $Usertask->updatetime, $Usertask->taskid, $Usertask->shopid, $Usertask->taskmodelid, $Usertask->tasktimeid, $Usertask->status, 'tasdcontrller/TaskExit');
                if (!empty ($_POST ['Remark'])) {
                    $userlog = new Userlog ();
                    $userlog->userid = Yii::app()->user->getId();
                    $userlog->logtype = '退出任务';
                    $userlog->content = $_POST ['Remark'];
                    $userlog->addtime = time();
                    $userlog->unnormaltaskid = $new_id;
                    $userlog->save();
                }
                echo "<script>alert('退出任务成功。');parent.location.reload();</script>";
                exit ();
            } else {
                echo "<script>alert('退出任务失败，请稍后再试！');parent.location.reload();</script>";
                exit ();
            }
        } elseif (!empty ($_POST ['taskid']) && $count == 0) {
            echo "<script>alert('今日退出任务总数已经超出限额，不能再退出任务总数了');parent.location.reload();</script>";
            exit ();
        }
        $this->layout = false;
        $this->render('taskExit', array(
            'taskid' => @$_GET ['taskid'],
            'shebei' => @$_GET ['shebei'],
            'count' => $count
        ));
    }

    // 删除任务
    function updateTaskNum($taskid, $tasktimeid, $taskmodelid, $usertaskid)
    {
        //$fp = fopen ( BKC_URL."?ActionTag=ClearUserTask&UserTaskID={$usertaskid}", 'r' );
        //        var_dump($rr);
        //        exit();
        //		$strJson = '';
        //		while ( ! feof ( $fp ) ) {
        //			$line = fgets ( $fp, 1024 ); // 每读取一行
        //			$strJson = $strJson . $line;
        //		}
        //		fclose ( $fp );
        //		if (empty ( $strJson ) == false) {
        //			$jsonObject = json_decode ( $strJson );
        //			return ($jsonObject->IsOK == true) ;
        //		}
        //		return false ;
        $url = BKC_URL . "?ActionTag=ClearUserTask&UserTaskID={$usertaskid}";
        $rr = Toole::curl_get($url);

        $jsonObject = json_decode($rr);
        if ($rr) {
            return ($jsonObject->IsOK == true);;
        } else {
            return false;
        }
        return false;
    }

    // 评价任务
    public function actionEvalTask()
    {
        $tbprefix = Yii::app()->db->tablePrefix;
        $info = array();
        if ($_GET ['usertaskid']) {
            $sql = "SELECT ut.tasksn,ut.id AS usertaskid,ut.ordersn,s.shopname,p.commodity_title,tv.*  FROM " . $tbprefix . "_usertask AS ut LEFT JOIN " . $tbprefix . "_shop AS s ON s.sid=ut.shopid LEFT JOIN " . $tbprefix . "_taskevaluate AS tv ON tv.usertaskid=ut.id LEFT JOIN " . $tbprefix . "_product AS p ON " . "p.id=ut.proid WHERE ut.id=" . $_GET ['usertaskid'];
            $info = Yii::app()->db->createCommand($sql)->queryRow();
            $info ['imgcontent'] = unserialize($info ['imgcontent']);
        }
        if (!empty ($_POST)) {
            //评价佣金即使返现
            $uID = Yii::app()->user->getId();
            $mark = 'outeval_' . $uID;
            $redis = Yii::app()->redis;
            if (!empty($_POST)) {
                if (time() - $redis->get($mark) < 1 * 20)  //请求间隔小于10分钟直接返回
                {
                    echo "<script>alert('请求间隔小于20秒');parent.location.reload();</script>";
                    exit ();
                }
                $redis->set($mark, time());
            }

            $taskevalid = $_POST[taskevalid];
            $url = BKC_URL . "?ActionTag=User_TaskEvaluate_OK&TaskEvaluateID={$taskevalid}";
            $rr = Toole::curl_get($url);
            $jsonObject = json_decode($rr);

            if ($jsonObject->IsOK == true) {
                $sql = "UPDATE " . $tbprefix . "_taskevaluate SET doing=2,postimg='$_POST[img1]' WHERE id=$_POST[taskevalid]";
                $res = Yii::app()->db->createCommand($sql)->query();
                $usertask = Usertask::model()->findByPk($_POST ['usertaskid']);
                $usertask->status = 7;
                if ($res) {
                    $usertask->save();
                    echo "<script>parent.location.reload()</script>";
                    exit ();
                } else {

                }
            }

        }
        $this->layout = false;

        $this->render('evalTask', array(
            'info' => $info
        ));
    }

    // 评价任务列表
    public function actionEvalTaskList()
    {
        $tbprefix = Yii::app()->db->tablePrefix;
        $where = '';
        $search = array();
        if (!empty ($_GET)) {
            if (!empty ($_GET ['txtSearch'])) {
                switch ($_GET ['SelSearch']) {
                    case 'ordersn' :
                        $where .= " AND ut.ordersn LIKE '%$_GET[txtSearch]%' ";
                        break;
                    case 'shopname' :
                        $where .= " AND s.shopname LIKE '%$_GET[txtSearch]%' ";
                        break;
                    default :
                        $where .= " AND ut.tasksn LIKE '%$_GET[txtSearch]%' ";
                        break;
                }
            }
            if (!empty ($_GET ['optionstatus'])) {
                $where .= ' AND te.doing=' . $_GET ['optionstatus'] . ' ';
            }
            $begin = $_GET ['BeginDate'] ? $_GET ['BeginDate'] : '';
            $end = $_GET ['EndDate'] ? $_GET ['EndDate'] : '';
            if (!empty ($begin) && !empty ($end)) {
                $where .= " AND ut.updatetime>'$begin' AND ut.updatetime<'$end' ";
            }
            if (!empty ($begin) && empty ($end)) {
                $where .= " AND ut.updatetime>'$begin' ";
            }
            if (empty ($begin) && !empty ($end)) {
                $where .= "  AND ut.updatetime<'$end' ";
            }
            $search = $_GET;
        }

        $list = array();
        $sql = "SELECT te.*,ut.ordersn,ut.tasksn,ut.expressnum,ut.updatetime,w.wangwang,s.shopname FROM " . $tbprefix . "_taskevaluate AS te LEFT JOIN " . $tbprefix . "_usertask AS ut ON te.usertaskid=ut.id LEFT JOIN " . $tbprefix . "_blindwangwang AS w ON w.userid=te.doid LEFT JOIN " . $tbprefix . "_shop " . " AS s ON s.sid=ut.shopid WHERE te.doid=" . Yii::app()->user->getId() . $where . "  ORDER BY ut.addtime  DESC";
        // 分页
        $creteria = new CDbCriteria ();
        $list = Yii::app()->db->createCommand($sql)->queryAll();
        $pages = new CPagination (count($list));
        $pages->pageSize = 10;
        $pages->applyLimit($creteria);

        $list = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        $list->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $list->bindValue(':limit', $pages->pageSize);
        $list = $list->queryAll();

        $this->render('evalTaskList', array(
            'evallist' => $list,
            'search' => $search,
            'pages' => $pages
        ));
    }

    // 淘宝问大家
    public function actionTbAsk()
    {
        $this->render('tbAsk');
    }

    // 认证店铺名shopconfirm
    public function actionShopConfirm()
    {
        $tbprefix = Yii::app()->db->tablePrefix;
        $res = array();
        if (isset($_POST ['val'])) {
            $usertask = Usertask::model()->findByPk($_POST ['taskid']);
            switch ($_POST ['type']) {
                case in_array($_POST ['type'], array(
                    1,
                    3,
                    4,
                    6
                )) :
                    $sql = "SELECT shopname FROM zxjy_shop  WHERE sid=" . $usertask->shopid . " AND (shopname='$_POST[val]' OR shopname=' $_POST[val]' OR shopname='$_POST[val] ')";
                    break;
                case in_array($_POST ['type'], array(
                    2,
                    5
                )) :
                    $sql = "SELECT commodity_id FROM zxjy_product WHERE id=" . $usertask->proid . " AND commodity_id='$_POST[val]'";
            }
            $row = Yii::app()->db->createCommand($sql)->queryRow();
            if ($row) {
//                $cookies = Yii::app()->request->getCookies();
//                $comfirmcookie = $cookies ['comfirmcookie' . $_POST ['taskid']]->value;
//                // 生成coockie
//                if (empty ($comfirmcookie)) {
//                    $cookie = new CHttpCookie ('comfirmcookie' . $_POST ['taskid'], 1);
//                    $cookie->expire = time() + 3600; // 有限期60分钟
//                    Yii::app()->request->cookies ['comfirmcookie' . $_POST ['taskid']] = $cookie; // 写入
//                }
                $res ['err_code'] = 0;
                $res ['msg'] = '验证通过';
                $res ['val'] = $_POST ['val'];
            } else {
                $res ['err_code'] = 1;
                $res ['msg'] = '验证不通过！';
            }
            echo json_encode($res);
            exit ();
        }
    }

    // 确认收货（获取佣金）
    public function actionComfirmTask()
    {
        if (!empty ($_GET ['usertaskid'])) {
            $usertask = Usertask::model()->findByPk($_GET ['usertaskid']);
        }
        if (!empty ($_POST ['taskid'])) {
            $usertask = Usertask::model()->findByPk($_POST ['taskid']);
            /*
             * $time3=$usertask->updatetime+3*24*3600;
             * if (time()<$time3){
             * echo "<script>alert('当前订单未满3天，请淘宝确认收货之后再来平台确认收货');self.parent.$.closeWin()</script>";exit;
             * }
             */
            $usertask->status = 3;
            if ($usertask->save()) {
                echo "<script>parent.location.reload()</script>";
                exit ();
            }
        }
        $this->layout = false;
        $this->render('comfirmTask', array(
            'usertask' => @$usertask
        ));
    }

    // 一键确认收货
    public function actionComfirmAllTask()
    {
        // $time3=time()-3*24*3600;
        // $usertask=Usertask::model()->findAll('userid='.Yii::app()->user->getId().' AND status=2 AND updatetime<'.$time3);
        $usertask = Usertask::model()->findAll('userid=' . Yii::app()->user->getId() . ' AND status=2 ');
        $arr = array();
        foreach ($usertask as $v) {
            $arr [] = $v->id;
        }
        if (empty ($arr)) {
            $this->redirect_message('亲，没有确认收货的订单哦！', 'failed', 2, $this->createUrl('task/taskmanage'));
            exit ();
        } else {
            $count = Usertask::model()->updateByPk($arr, array(
                'status' => '3'
            ), 'status=2');
            if ($count > 0) {
                $this->redirect_message('一键收货成功', 'success', 1, $this->createUrl('task/taskmanage'));
                exit ();
            } else {
                $this->redirect_message('操作失败', 'failed', 2, $this->createUrl('task/taskmanage'));
                exit ();
            }
        }
    }

    // 放弃评价任务
    public function actionSetfreeEvalTask()
    {
        if (!empty ($_GET ['taskevalid'])) {

            $sql = 'SELECT * FROM ' . Yii::app()->db->tablePrefix . '_taskevaluate WHERE usertaskid=' . $_GET ['taskevalid'];
            $row = Yii::app()->db->createCommand($sql)->queryRow();

            $taskEvaluateID = $row['id'];
            $fp = fopen(BKC_URL . "?ActionTag=Free_TaskEvaluateInfo&TaskEvaluateID={$taskEvaluateID}", 'r');
            $strJson = '';
            while (!feof($fp)) {
                $line = fgets($fp, 1024); // 每读取一行
                $strJson = $strJson . $line;
            }
            fclose($fp);
            if (empty ($strJson) == false) {
                $jsonObject = json_decode($strJson);
                if ($jsonObject->IsOK == true) {
                    $this->redirect_message('操作成功', 'success', 1, $this->createUrl('task/taskmanage01'));
                } else {
                    $this->redirect_message('操作失败:' . $jsonObject->Description, 'failed', 1, $this->createUrl('task/taskmanage01'));
                }
            }


        }
    }

    // 释放任务
    function setFreeTask()
    {
        $tbprefix = Yii::app()->db->tablePrefix;
        $uid = Yii::app()->user->getId();
        $overtiem = time() - 5 * 60; // defalt
        $overtiemtwo = time() - 30 * 60; // two
        $overtiemthree = time() - 60 * 60; // three
        // $sql="SELECT * FROM ".$tbprefix."_usertask WHERE userid=$uid AND status=0 AND ((flag=0 AND addtime<$overtiem ) OR (flag=1 AND addtime<$overtiemtwo ) ".
        // " OR (flag=2 AND addtime<$overtiemthree ))";
        $sql = "SELECT * FROM " . $tbprefix . "_usertask WHERE userid=$uid  AND status=0 AND addtime<$overtiemthree ";
        // echo $sql;exit;
        $all = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($all as $val) {
            $userTaskID = $val ['id'];
            $fp = fopen(BKC_URL . "?ActionTag=ClearUserTask&UserTaskID={$userTaskID}", 'r');
            fclose($fp);
        }
    }

    // 删除任务（废弃）
    function delCurtask($taskid, $overtime)
    {
        // $usertask=Usertask::model()->find('id='.$taskid .' AND addtime>'.$overtime);
        $usertask = Usertask::model()->find('id=' . $taskid);
        if (!empty ($usertask)) {
            $task = Task::model()->findByPk($usertask->taskid);
            $taskmodel = Taskmodel::model()->findByPk($usertask->taskmodelid);

            $task->qrnumber = $task->qrnumber - 1;
            $taskmodel->takenumber = $taskmodel->takenumber - 1;
            if (!empty ($usertask->tasktimeid)) {
                $tasktime = Tasktime::model()->findByPk($usertask->tasktimeid);
                $tasktime->takenumber = $tasktime->takenumber - 1;
                $tasktime->save();
            }
            // 生成商家资金日志文件
            $cashLog = new Cashlog ();
            $cashLog->type = '返还佣金';
            $us = User::model()->findByPk($task->userid);
            $cashLog->remoney = $us->Money + ($taskmodel->commission + $task->top);
            $us->Money = $us->Money + ($taskmodel->commission + $task->top);
            $cashLog->increase = '+' . ($taskmodel->commission + $task->top);
            $cashLog->beizhu = '刷手放弃任务返还佣金3';
            $cashLog->addtime = time();
            $cashLog->userid = $task->userid;
            $cashLog->usertaskid = $usertask->id;
            $cashLog->proid = $task->proid;
            $cashLog->shopid = $task->shopid;
            $cashLog->save();
            $us->save();
            $this->add_unnormaltask($usertask->id, $usertask->userid, $usertask->merchantid, $usertask->addtime, $usertask->updatetime, $usertask->taskid, $usertask->shopid, $usertask->taskmodelid, $usertask->tasktimeid, $usertask->status, 'tasdcontrller/delCurtask');
            $task->save();
            $taskmodel->save();
            $usertask->delete();
        }
    }

    // 用户名处理
    function substr_cut($user_name01)
    {
        $user_name = trim($user_name01);
        // 获取字符串长度
        $strlen = mb_strlen($user_name, 'utf-8');
        // 如果字符创长度小于2，不做任何处理
        if ($strlen < 2) {
            return $user_name;
        } else {
            // mb_substr — 获取字符串的部分
            $firstStr = mb_substr($user_name, 0, 1, 'utf-8');
            $lastStr = mb_substr($user_name, -1, 1, 'utf-8');
            // str_repeat — 重复一个字符串
            return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
        }
    }

    //预订单/预约单列表01
    public function actionShowPretask()
    {
        $this->render('pretask');
    }

    //预订单/预约单列表02
    public function actionReservationList()
    {
        $this->layout = false;  //去除视图的头部
        $uid = Yii::app()->user->getId();
        $page_size = 2;  //每页记录数
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $start = ($page - 1) * $page_size;
        $end = $page * $page_size;
        $condition = ' ';
        $condition .= !empty($_POST['status']) ? ' AND p.status = ' . $_POST['status'] : '';
        $condition .= !empty($_POST['TxtSearch']) ? ' AND ' . $_POST['SelSearch'] . ' like "%' . $_POST['TxtSearch'] . '%"' : '';
        $condition .= !empty($_POST['BeginDate']) ? ' AND p.addtime > ' . strtotime($_POST['BeginDate']) : '';
        $condition .= !empty($_POST['EndDate']) ? ' AND p.addtime < ' . strtotime($_POST['EndDate']) : '';
        $sql = 'SELECT p.*, s.shopname, t.intlet, t.tasktype, t.remark as task_remark, bw.wangwang, tt.beginPay, tt.endPay 
                FROM zxjy_pretask as p
                LEFT JOIN zxjy_task as t on t.id = p.taskid
                LEFT JOIN zxjy_taskmodel as tm on tm.pid = t.mark
                LEFT JOIN zxjy_tasktime as tt on tt.pid = t.mark
                LEFT JOIN zxjy_bindbuyer as bb on bb.id = p.buyerid
                LEFT JOIN zxjy_blindwangwang as bw on bw.id = bb.wangwangid
                LEFT JOIN zxjy_shop as s on s.sid = p.shopid
                WHERE p.userid = ' . $uid . $condition . ' ORDER BY id DESC LIMIT ' . $start . ', ' . $page_size;

        $pagesql = 'SELECT COUNT(1) FROM zxjy_pretask as p
                    LEFT JOIN zxjy_task as t on t.id = p.taskid
                    LEFT JOIN zxjy_shop as s on s.sid = p.shopid
                    WHERE p.userid = ' . $uid . $condition;
        $this->render('reservationList', [
            'list' => Yii::app()->db->createCommand($sql)->queryAll(),
            'count_page' => ceil(Yii::app()->db->createCommand($pagesql)->queryScalar() / $page_size),
            'page' => $page,
            'search' => $_POST,
        ]);
    }

    //提交浏览数据
    public function actionSubmitBrowse()
    {
        $uid = Yii::app() -> user -> getId();
        $db = Yii::app() -> db;
        $validity = 60 * 60;
        if (!empty($_POST['img_search']) && !empty($_POST['img_browse']))  //是否上传所需的截图
        {
            extract($_POST);  //将post提交的数据导入到当前符号表，即可以直接使用键名调用
            $sql = 'SELECT status, addtime FROM zxjy_pretask WHERE id = ' . $pretask_id;
            $pretask_info = $db -> createCommand($sql) -> queryRow();
            if ($pretask_info !== false)
            {
                if (time() - $pretask_info['addtime'] <= $validity)
                {
                    if ($pretask_info['status'] == 0)  //任务状态不为‘进行中’
                    {
                        $sql = 'UPDATE zxjy_pretask SET tasktwoimg = "' . $img_search . '", browseimg = "' . $img_browse . '", updatetime = "' . time() . '", status = 1 WHERE id = ' . $pretask_id;
                        $db -> createCommand($sql) -> execute() ? Toole::show(1, '提交成功，您已成功完成浏览操作，记得明日登陆平台，点击[任务管理--预约/预定任务--开始下单]进行下一步操作。完成付款之后才可获得佣金哦') : Toole::show(0, '任务提交失败，请稍后再试');
                    }
                    else
                        Toole::show(0, '所提交的数据与当前任务状态不匹配，提交失败');
                }
                else
                    Toole::show(0, '由于您未在一个小时内完成浏览操作，该任务已被取消');
            }
            else
                Toole::show(0, '任务已过期，请下次接手后尽快完成提交');
        }
        else
            Toole::show(0, '参数错误，搜索/浏览截图获取失败');
    }

    // 预约单--开始付款
    public function actionDoReservationToPay()
    {
        $uid = Yii::app() -> user -> getId();
        $db = Yii::app() -> db;
        if (isset($_GET['taskid']))
        {
            $pretask_id = $_GET['taskid'];
            $sql = 'SELECT p.*, t.intlet, tt.beginPay, tt.EndPay, tm.how_search, tm.new_keyword, pro.qrcode,pro.commodity_image,pro.c_goods,pro.bookmark,pro.talk,pro.x_home,pro.deep,
                      pro.commodity_id, t.intlet,tm.price,tm.express,tm.auction,tm.modelname, t.remark, s.shopname, s.sid
                    FROM zxjy_pretask as p
                    LEFT JOIN zxjy_task as t ON t.id = p.taskid
                    LEFT JOIN zxjy_taskmodel as tm ON tm.pid = t.mark
                    LEFT JOIN zxjy_tasktime as tt ON tt.pid = t.mark
                    LEFT JOIN zxjy_shop as s ON s.sid = p.shopid
                    LEFT JOIN zxjy_product as pro ON pro.id = p.proid
                    WHERE p.userid = ' . $uid . ' AND p.id = ' . $pretask_id;
            $info = $db -> createCommand($sql) -> queryRow();
            if ($info)  //任务存在
            {
                if ($info['status'] == 1)  //任务状态为已浏览完毕
                {
                    $now = time();
                    if ($now > $info['beginPay'] && $now < $info['EndPay'])  //在规定的支付时间范围内
                    {
                        $this -> layout = false;
                        $rukou = $this -> liuliangrukou($info['intlet']);  //将浏览入口转换成文字描述
                        $this->render('doReservationToPay', [
                            'taskinfo' => $info,
                            'rukou' => $rukou,
                            'setfreetime' => $info['EndPay'] - $now,
                            'ketiam' => 5, //?????
                            'shebei' => $_GET['shebei'],
                            'is_use_helper' => $this -> isUseHelper(),
                        ]);
                    }
                    else
                        exit('当前不在开始下单的时间范围内，请检查是否已过了截至时间，或耐心等待');
                }
                else
                    exit('当前操作与任务状态不匹配，请确认任务是否已浏览完毕且尚未付款');
            }
            else
                exit('未查找到对应任务信息，请确认该任务是否还在有效期内');
        }
        else
            exit('参数错误，获取任务ID失败');
    }

    // 预约单开始浏览
    public function actionDoReservationToBrowse()
    {
        $uid = Yii::app() -> user -> getId();
        $db = Yii::app() -> db;
        $validity = 50 * 60;
        if (isset($_GET['taskid']))
        {
            $pretask_id = $_GET['taskid'];
            $sql = 'SELECT p.*,s.shopname,t.intlet,tm.price,tm.express,tm.auction,tm.modelname,
                    pro.commodity_image as image,pro.qrcode,pro.commodity_image,pro.c_goods,pro.bookmark,pro.talk,pro.x_home,pro.deep,pro.commodity_id,
                    t.keyword,t.remark,t.tasktype, tm.how_browse
                    FROM zxjy_pretask as p
                    LEFT JOIN zxjy_task as t ON t.id = p.taskid
                    LEFT JOIN zxjy_taskmodel as tm ON tm.pid = t.mark
                    LEFT JOIN zxjy_tasktime as tt ON tt.pid = t.mark
                    LEFT JOIN zxjy_shop as s ON s.sid = p.shopid
                    LEFT JOIN zxjy_product as pro ON pro.id = p.proid
                    WHERE p.userid = ' . $uid . ' AND p.id = ' . $pretask_id;
            $info = $db -> createCommand($sql) -> queryRow();
            if ($info)  //任务存在
            {
                if ($info['status'] == 0)  //任务状态为已浏览完毕
                {
                    $now = time();
                    if ($now - $info['addtime'] <= $validity)
                    {
                        $this -> layout = false;
                        $rukou = $this -> liuliangrukou($info['intlet']);  //将浏览入口转换成文字描述
                        $this->render('doReservationToBrowse', [
                            'taskinfo' => $info,
                            'rukou' => $rukou,
                            'setfreetime' => ($info['addtime'] + $validity) - $now,
                            'ketiam' => 5, //?????
                            'shebei' => $_GET['shebei']
                        ]);
                    }
                    else
                    {
                        exit('由于您未在一个小时内完成浏览操作，该任务已被取消');
                    }
                }
                else
                    exit('当前操作与任务状态不匹配，请确认任务是否尚未进行浏览');
            }
            else
                exit('未查找到对应任务信息，请确认该任务是否还在有效期内');
        }
        else
            exit('参数错误，获取任务ID失败');
    }

    //预约单--付款
    public function actionSubmitOldSearch()
    {
        $uid = Yii::app() -> user -> getId();
        $db = Yii::app() -> db;
        if (isset($_POST['pretask_id']) && !in_array('', $_POST, true))
        {
            extract($_POST);
            $sql = 'SELECT p.*, t.intlet, tt.beginPay, tt.EndPay, tm.how_search, tm.new_keyword, pro.commodity_id, pro.qrcode,pro.commodity_image,pro.c_goods,pro.bookmark,pro.talk,pro.x_home,pro.deep,
                      pro.commodity_id, t.intlet,tm.price,tm.express,tm.auction,tm.modelname, t.remark, s.shopname, t.tasktype
                    FROM zxjy_pretask as p
                    LEFT JOIN zxjy_task as t ON t.id = p.taskid
                    LEFT JOIN zxjy_taskmodel as tm ON tm.pid = t.mark
                    LEFT JOIN zxjy_tasktime as tt ON tt.pid = t.mark
                    LEFT JOIN zxjy_shop as s ON s.sid = p.shopid
                    LEFT JOIN zxjy_product as pro ON pro.id = p.proid
                    WHERE p.userid = ' . $uid . ' AND p.id = ' . $pretask_id;
            $info = $db -> createCommand($sql) -> queryRow();
            if ($info)  //任务存在
            {
                if ($info['status'] == 1)  //任务状态为已浏览完毕
                {
                    $now = time();
                    if ($now > $info['beginPay'] && $now < $info['EndPay'])  //在规定的支付时间范围内
                    {
                        $sql = 'SELECT COUNT(1) FROM zxjy_usertask WHERE ordersn = "' . $ordersn . '"';
                        $has_ordersn = $db -> createCommand($sql) -> queryScalar();
                        if ($has_ordersn == 0)
                        {
                            if (abs($pay_price - ($info['price'] * $info['auction'] + $info['express'])) < 50)  //差额小于50
                            {
                                //准备更新pretask的语句
                                $has_new_searchimg = isset($_POST['new_tasktwoimg']) ? ', new_tasktwoimg = "' .  $new_tasktwoimg . '"' : '';
                                $sql = 'UPDATE zxjy_pretask SET status = 2, orderimg = "' . $img_order . '", ordersn = "' . $ordersn . '", orderprice = "' . $pay_price . '", paytype = "' . $paytype . '", updatetime = ' . $now . $has_new_searchimg . ' WHERE id = ' . $pretask_id;
                                if ($db -> createCommand($sql) -> execute() !== false)
                                {
                                    //准备需要插入到usertask表的数据
                                    $sql = 'SELECT * FROM zxjy_pretask WHERE id = ' . $pretask_id;
                                    $pretask_info = $db -> createCommand($sql) -> queryRow();
                                    $diff_arr = [
                                        'browseimg' => '',
                                        'new_tasktwoimg' => '',
                                        'browsetowimg' => '',
                                        'handsel' => '',
                                        'payment' => '',
                                    ];
                                    $other_data = [
                                        'id' => '',
                                        'status' => 4,
                                        'flag' => 2,
                                        'ordersn' => $ordersn,
                                        'orderprice' => $pay_price,
                                        'paytype' => $paytype,
                                        'updatetime' => $now,
                                    ];
                                    $insert = array_merge(array_diff_key($pretask_info, $diff_arr), $other_data);
                                    $sql = 'INSERT into zxjy_usertask (`' . implode('`,`', array_keys($insert)) . '`) VALUES ("' . implode('","', array_values($insert)) . '")';
                                    $back_sql = 'UPDATE zxjy_pretask SET status = 1 WHERE id = ' . $pretask_id;  //插入usertask表失败的时候，回滚任务状态
                                    if (Yii::app() -> db -> createCommand($sql) -> execute() !== false)
                                    {
                                        $sql = 'SELECT id FROM zxjy_usertask WHERE ordersn = "' . $ordersn . '"';
                                        $usertask_id = $db -> createCommand($sql) -> queryScalar();
                                        $is_use_helper = $this -> isUseHelper();
                                        if ($is_use_helper) //使用订单小助手，自动处理基础工单，插旗[放在本佣提现结果外面，防止提现失败导致小助手功能失效]
                                        {
                                            $info = array_merge($info, $other_data);
                                            $info['id'] = $usertask_id;
                                            $this -> actionOrderMark($insert['shopid'], $ordersn);
                                            $this -> autoDealTrouble($info);
                                        }
                                        $capital_limit =  $this -> isUseHelper() ? '&OrderPrice=' . $pay_price : '';
                                        $fp = fopen(BKC_URL . "?ActionTag=SendMoney&UserTaskID=" . $usertask_id . $capital_limit, 'r');
                                        $strJson = '';
                                        while (!feof($fp)) {
                                            $line = fgets($fp, 1024);
                                            $strJson = $strJson . $line;
                                        }
                                        if (empty ($strJson) == false)
                                        {
                                            $jsonObject = json_decode($strJson);
                                            if ($jsonObject -> IsOK)
                                            {
                                                Toole::show(1, '已成功提交，任务完成');
                                            }
                                            else
                                                Toole::show(0, '任务提交成功，但本金到账失败，[error]' . $jsonObject -> Description . '。我们将于明天凌晨为您补正，请耐心等待');
                                        }
                                        else
                                            Toole::show(0, '任务提交成功，但本佣到账失败，我们将于明天凌晨为您补正，请耐心等待');
                                    }
                                    else
                                        $db -> createCommand($back_sql) -> execute() !== false ? Toole::show(0, '插入任务记录失败，请稍后再试') : Toole::show(0, '提交失败，同时数据回滚失败，请联系客服反馈这个情况');
                                }
                                else
                                    Toole::show(0, '更新任务状态失败，请稍后再试');
                            }
                            else
                                Toole::show(0, '差额 > 50元，在平台将无法提交订单');
                        }
                        else
                            Toole::show(0, '订单编号已存在，请仔细检查，重新输入再提交');
                    }
                    else
                        Toole::show(0, '当前不在开始下单的时间范围内，请检查是否已过了截至时间，或耐心等待');
                }
                else
                    Toole::show(0, '当前操作与任务状态不匹配，请确认任务是否已浏览完毕且尚未付款');
            }
            else
                Toole::show(0, '未查找到对应任务信息，请确认该任务是否还在有效期内');
        }
        else
            Toole::show(0, '参数错误，部分参数获取失败或为空，请刷新后再做提交');
    }

    //任务时间获取(预订单/预约单任务)
    public function actionTasksuo01()
    {
        $arr = array();
        $uid = Yii::app()->user->getId();
        $id = $_POST['id'];
        $sql = "SELECT pr.*,t.tasktype FROM zxjy_pretask as pr  
                LEFT JOIN zxjy_task as t on t.id = pr.taskid
                WHERE pr.id =".$id;
        $taskinfo = Yii::app()->db->createCommand($sql)->queryRow();
        if ($taskinfo) {
            $setfreetime = ($taskinfo['addtime'] + 45 * 60) - time();
            $arr['setfreetime'] = $setfreetime;
            $arr['msg'] = '任务时间setfreetime:' . $setfreetime;
        } else {
            $setfreetime = 0;
            $arr['setfreetime'] = $setfreetime;
            $arr['msg'] = '任务查找不到';
        }
        $sql = "SELECT `value` FROM zxjy_system  WHERE varname = 'waittime'";
        $taskdengdaitime = Yii::app()->db->createCommand($sql)->queryRow();

        $ketiamRof = Yii::app()->redis->get($uid . '_time_' . $id);
        if($taskinfo['tasktype'] == 5 && $taskinfo['status'] ==1 ){
            if ($ketiamRof) {
                $ketiamR1 = (time() - $ketiamRof);
                $arr['num'] =5 * 60 - $ketiamR1;
            } else {
                //设置时间
                $arr['num'] = 5 * 60;
                Yii::app()->redis->set($uid . '_time_' . $id, time(), 66 * 60);
            }
        }else{
            if ($ketiamRof) {
                $ketiamR1 = (time() - $ketiamRof);
                $arr['num'] =$taskdengdaitime['value'] * 60 - $ketiamR1;
            } else {
                //设置时间
                $arr['num'] = $taskdengdaitime['value'] * 60;
                Yii::app()->redis->set($uid . '_time_' . $id, time(), 66 * 60);
            }
        }


        echo json_encode($arr);
    }

    //获取提交的任务信息(预订单任务)
    public function actionTaskprelist()
    {
        $uid = Yii::app()->user->getId();
        if (!empty ($_GET['id'])) {
            $shebei = $_GET ['shebei'];
            $id = $_GET ['id'];
            $sql = "SELECT pr.*,s.shopname,t.intlet,tm.price,tm.express,tm.auction,tm.modelname,tm.handsel,tm.Payment,
                    p.commodity_image as image,p.qrcode,p.commodity_image,p.c_goods,p.bookmark,p.talk,p.x_home,p.deep,p.commodity_id,
                    t.keyword,t.remark,t.tasktype,tt.beginPay,tt.EndPay
                    FROM zxjy_pretask AS pr
                    LEFT JOIN  zxjy_task as t ON t.id=pr.taskid
                    LEFT JOIN zxjy_shop AS s  ON t.shopid=s.sid
                    LEFT JOIN zxjy_taskmodel as tm ON tm.pid=t.mark
                    LEFT JOIN zxjy_product AS p ON p.id=t.proid
                    LEFT JOIN zxjy_tasktime as tt ON t.mark=tt.pid
                    WHERE pr.id=" .$id;
            $taskinfo = Yii::app()->db->createCommand($sql)->queryRow();
            if ($taskinfo) {
            } else {
                $this->layout = false;
                $arr['msg'] = "任务过期了！！！！";
                $this->render('Tasktesttow', array(
                    'mag' => $arr,
                    'shebei' => $shebei
                ));
                exit();
            }

            if($taskinfo['tasktype'] == 4){
                switch ($taskinfo['status']){
                    case  0:
                        if ((($taskinfo['addtime'] + 45 * 60) - time()) < 0) {
                            $sql = "UPDATE zxjy_pretask SET status = 4 WHERE id=".$id;
                            $rss = Yii::app()->db->createCommand($sql)->execute();
                            if($rss){
                                $this->layout = false;
                                $arr['msg'] = "任务超过可提交时间！";
                                $this->render('Tasktesttow', array(
                                    'mag' => $arr,
                                    'shebei' => $shebei
                                ));
                                exit();
                            }
                            $this->layout = false;
                            $arr['msg'] = "任务超过可提交时间！,状态未改变！";
                            $this->render('Tasktesttow', array(
                                'mag' => $arr,
                                'shebei' => $shebei
                            ));
                            exit();
                        }
                        $rukou = $this->liuliangrukou($taskinfo['intlet']);
                        $this->layout = false;
                        $setfreetime = ($taskinfo['addtime'] + 45 * 60) - time();
                        $this->render('Tasktestthree', array(
                            'taskinfo' => $taskinfo,
                            'rukou' => $rukou,
                            'setfreetime' => $setfreetime,
                            'shebei' => $shebei
                        ));
                        exit();
                        break;
                    case  1:


                        $rukou = $this->liuliangrukou($taskinfo['intlet']);
                        $this->layout = false;
                        $setfreetime = $taskinfo['EndPay'] - time();
                        $this->render('Tasktestthreeorder', array(
                            'taskinfo' => $taskinfo,
                            'rukou' => $rukou,
                            'setfreetime' => $setfreetime,
                            'shebei' => $shebei
                        ));
                        exit();
                        break;
                    case 4:
                        $this->layout = false;
                        $arr['msg'] = "任务超过可提交时间！";
                        $this->render('Tasktesttow', array(
                            'mag' => $arr,
                            'shebei' => $shebei
                        ));
                        exit();
                        break;
                }
            }
        } else {
            $this->layout = false;
            $arr['msg'] = "任务找不到！！！！";
            $this->render('Tasktesttow', array(
                'mag' => $arr,
            ));
            exit();
        }
    }

    //提交订单(预订单任务)
    public function actionTaskpreorder()
    {
        $arr = array();
        $uid = Yii::app()->user->getId();
        if ($_POST) {
            $id = $_POST['taskid'];
            $sql = "SELECT ut.*,tm.price,tm.auction,tm.express,t.intlet,tm.handsel,tm.Payment,tt.beginPay,tt.EndPay
                    FROM zxjy_pretask AS ut  
                    LEFT JOIN zxjy_task as t on ut.taskid = t.id
                    LEFT JOIN zxjy_taskmodel as tm ON t.mark=tm.pid
                    LEFT JOIN zxjy_tasktime as tt ON t.mark=tt.pid
                    WHERE ut.id =".$id;
            $taskinfo = Yii::app()->db->createCommand($sql)->queryRow();
            if ($taskinfo) {
            } else {
                $arr['err_code'] = 1;
                $arr['msg'] = "任务过期了！！";
                echo json_encode($arr);
                exit();
            }
            switch ($taskinfo['status']){
                case  0:
                    if ((($taskinfo['addtime'] + 45 * 60) - time()) < 0) {
                        $rss = $this->updateTaskpreNum( $id);
                        if($rss){
                            $arr['err_code'] = 1;
                            $arr['msg'] = "任务超过可提交时间！";
                            echo json_encode($arr);
                            exit();
                        }
                        $arr['err_code'] = 1;
                        $arr['msg'] = "任务超过可提交时间！,状态未改变！";
                        echo json_encode($arr);
                        exit();
                    }
                    if ($_POST['tasktwoimg']) {
                        if (empty($_POST['tasktwoimg'])) {
                            $arr['err_code'] = 2;
                            $arr['msg'] = "请上传搜索图";
                            echo json_encode($arr);
                            exit();
                        }
                    }
                    $cha = $_POST['txtPayPrice'] - $taskinfo['handsel'];
                    if ($cha > 50) {
                        $arr['err_code'] = 2;
                        $arr['msg'] = "差额>50元，在平台将无法提交订单！！";
                        echo json_encode($arr);
                        exit();
                    }

                    $sql = "SELECT COUNT(1) FROM zxjy_usertask WHERE ordersn ='{$_POST[orderNumber]}'";
                    $ordersnCount = Yii::app()->db->createCommand($sql)->queryScalar();
                    if ($ordersnCount > 0) {
                        $arr['err_code'] = 2;
                        $arr['msg'] = "('该订单交易编号已提交过任务，不可重复使用订单交易编号')";
                        echo json_encode($arr);
                        exit ();
                    }

                    $sql = "UPDATE zxjy_pretask SET `ordersn`='$_POST[orderNumber]',`browseimg`='$_POST[orderimg]',`tasktwoimg`='$_POST[tasktwoimg]',`handsel`='$_POST[txtPayPrice]',`paytype`='$_POST[xia]'," . "updatetime=" . time() . ", status=1 WHERE id =" . $id;
                    $res = Yii::app()->db->createCommand($sql)->execute();
                    if($res){
                        $arr['err_code'] = 3;
                        $arr['msg'] = "提交成功";
                        echo json_encode($arr);
                        exit();
                    }else{
                        $arr['err_code'] = 1;
                        $arr['msg'] = "提交不成功！";
                        echo json_encode($arr);
                        exit();
                    }
                    break;

                case  1:
                    if($taskinfo['beginPay'] < time() && $taskinfo['EndPay'] >time() ){
                        $cha = $_POST['txtPayPrice'] - ($taskinfo['Payment']+$taskinfo['express']);
                        if ($cha > 50) {
                            $arr['err_code'] = 2;
                            $arr['msg'] = "差额>50元，在平台将无法提交订单！！";
                            echo json_encode($arr);
                            exit();
                        }
                        $sql = "UPDATE zxjy_pretask SET `orderimg`='$_POST[orderimg]',`payment`='$_POST[txtPayPrice]',`paytype`='$_POST[xia]'," . "updatetime=" . time() . ", status=2 WHERE id = " . $id;
                        $res = Yii::app()->db->createCommand($sql)->execute();
                        if($res){
                            $sql = "select * from  zxjy_pretask  WHERE id=" . $id;
                            $pretask = Yii::app()->db->createCommand($sql)->queryRow();
                            //插入usertask
                            $usertask = new Usertask();
                            $usertask->tasksn= $pretask['tasksn'];
                            $usertask->userid= $pretask['userid'];
                            $usertask->shopid= $pretask['shopid'];
                            $usertask->taskid= $pretask['taskid'];
                            $usertask->status= 4 ;
                            $usertask->addtime= $pretask['addtime'];
                            $usertask->updatetime = time();
                            $usertask->buyerid = $pretask['buyerid'];
                            $usertask->tasktimeid= $pretask['tasktimeid'];
                            $usertask->taskmodelid= $pretask['taskmodelid'];
                            $usertask->tasktwoimg= $pretask['tasktwoimg'];
                            $usertask->ordersn= $pretask['ordersn'];
                            $usertask->proid= $pretask['proid'];
                            $usertask->orderimg= $pretask['orderimg'];
                            $usertask->orderprice= $pretask['orderprice'];
                            $usertask->paytype= $pretask['paytype'];
                            $usertask->flag= 3 ;
                            $usertask->commission= $pretask['commission'];
                            $usertask->merchantid= $pretask['merchantid'];
                            $usertask->remark= $pretask['remark'];
                            $usertask->orderimg= $pretask['orderimg'];
                            if( $usertask->save ()){
                                $sql = "select * from  zxjy_usertask  WHERE userid=" .  $pretask['userid']." and taskid = ".$pretask['taskid']  ;
                                $chausertask = Yii::app()->db->createCommand($sql)->queryRow();
                                $fp = fopen(BKC_URL . "?ActionTag=SendMoney&UserTaskID={$chausertask['id']}", 'r');
                                $strJson = '';
                                while (!feof($fp)) {
                                    $line = fgets($fp, 1024);
                                    $strJson = $strJson . $line;
                                }
                                fclose($fp);
                                $arr['err_code'] = 1;
                                $clientMsg = "提交任务出现错误，操作终止，请与客服联系并提交您的相关任务信息";
                                if (empty ($strJson) == false) {
                                    $jsonObject = json_decode($strJson);
                                    if ($jsonObject) {
                                        if ($jsonObject->IsOK == true) {
                                            $arr['err_code'] = 3;
                                            $clientMsg = '已成功提交，任务完成！【提醒：请到本金提现申请提现,否则商家无法返还本金】';
                                            $arr['msg'] = $clientMsg;
                                            echo json_encode($arr);
                                            exit();
                                        } else {
                                            $arr['err_code'] = 1;
                                            $clientMsg = "操作终止，提交过程错误：{$jsonObject->Description}  ";
                                            $arr['msg'] = $clientMsg;
                                            echo json_encode($arr);
                                            exit();
                                        }
                                    }
                                }
                                $arr['msg'] = $clientMsg;
                                echo json_encode($arr);
                                exit();
                            }
                        }else{
                            $arr['err_code'] = 1;
                            $arr['msg'] = "提交不成功！";
                            echo json_encode($arr);
                            exit();
                        }
                    }else if($taskinfo['beginPay'] > time() ){
                        $arr['err_code'] = 1;
                        $arr['msg'] = "还没到尾款支付时间";
                        echo json_encode($arr);
                        exit();
                    }else if($taskinfo['EndPay'] < time() ){
                        $sql = "UPDATE zxjy_pretask SET status = 4 WHERE id =".$id;
                        $rss = Yii::app()->db->createCommand($sql)->execute();
                        if($rss){
                            $arr['err_code'] = 1;
                            $arr['msg'] = "以过尾款支付时间";
                            echo json_encode($arr);
                            exit();
                        }
                        $arr['err_code'] = 1;
                        $arr['msg'] = "以过尾款支付时间";
                        echo json_encode($arr);
                        exit();
                    }
                    break;
            }
        }
        $arr['msg'] = "没东西";
        $arr['err_code'] = 2;
        echo json_encode($arr);
        exit();
    }

    //取消任务（预订单/预约单）
    public function actionTaskpredel(){
        if($_GET){
            $id = $_GET['id'];
            $shebei =$_GET['shebei'];
            $sql = "select * from  zxjy_pretask  WHERE id=" . $id;
            $pretask = Yii::app()->db->createCommand($sql)->queryRow();
            switch ($pretask['status']){
                case  0:
                    $ck = $this->updateTaskpreNum( $id);
                    if ($ck) {
                        //退任务的备注
                        if (!empty ($_POST ['Remark'])) {
                            $userlog = new Userlog ();
                            $userlog->userid = Yii::app()->user->getId();
                            $userlog->logtype = '预_退出任务';
                            $userlog->content = $_POST ['Remark'];
                            $userlog->addtime = time();
                            $userlog->taskid = $id;
                            $userlog->save();
                        }
                        $this->add_unnormaltask($id, Yii::app()->user->getId(), $pretask['merchantid'], $pretask['addtime'], $pretask['updatetime'], $pretask['taskid'], $pretask['shopid'], $pretask['taskmodelid'], $pretask['tasktimeid'], $pretask['status'], 'tasdcontrller/TaskExit');
                        //$this->add_unnormaltask($id ['taskid'], Yii::app()->user->getId(), $pretask['merchantid'], $pretask['addtime'], $pretask['updatetime'], $pretask['taskid'], $pretask['shopid'], $pretask['taskmodelid'], $pretask['tasktimeid'], $pretask['status'], 'tasdcontrller/TaskExit');
                        echo "<script>alert('退出任务成功。');parent.location.reload();</script>";
                        exit ();
                    } else {
                        echo "<script>alert('退出任务失败，请稍后再试！');parent.location.reload();</script>";
                        exit ();
                    }

                    break;
                case  1:
//                    $sql = "UPDATE zxjy_pretask SET status = 4 WHERE id=".$id;
//                    $rss = Yii::app()->db->createCommand($sql)->execute();
//                    if($rss){
                        $this->layout = false;
                        $arr['msg'] = "任务取消失败";
                        $this->render('Tasktesttow', array(
                            'mag' => $arr,
                            'shebei' => $shebei
                        ));
                        exit();
//                    }
                    break;
                case  4:
                        $this->layout = false;
                        $arr['msg'] = "任务已被取消";
                        $this->render('Tasktesttow', array(
                            'mag' => $arr,
                            'shebei' => $shebei
                        ));
                        exit();
                    break;
            }
            $this->layout = false;
            $arr['msg'] = "任务取消不成功";
            $this->render('Tasktesttow', array(
                'mag' => $arr,
                'shebei' => $shebei
            ));
            exit();

        }

    }

    // 删除任务（预订单/预约单）
    function updateTaskpreNum( $preid)
    {
        //$fp = fopen ( BKC_URL."?ActionTag=ClearUserTask&UserTaskID={$usertaskid}", 'r' );
        //        var_dump($rr);
        //        exit();
        //		$strJson = '';
        //		while ( ! feof ( $fp ) ) {
        //			$line = fgets ( $fp, 1024 ); // 每读取一行
        //			$strJson = $strJson . $line;
        //		}
        //		fclose ( $fp );
        //		if (empty ( $strJson ) == false) {
        //			$jsonObject = json_decode ( $strJson );
        //			return ($jsonObject->IsOK == true) ;
        //		}
        //		return false ;
        $url = BKC_URL . "?ActionTag=ClearPretask&PTaskID={$preid}";
        $rr = Toole::curl_get($url);

        $jsonObject = json_decode($rr);
        if ($rr) {
            return ($jsonObject->IsOK == true);;
        } else {
            return false;
        }
        return false;
    }

    /**
     *  请求服务接口，获取信息
     * @param $shopid  本地店铺ID，用以获取商家在淘宝后台的信息
     * @param $curl_args  请求参数
     * @param $top_api  淘宝开放平台对应的API名称
     */
    public function curlApi($seller_userid, $curl_args, $top_api = 'TradeFullinfoGet')
    {
        $return_data = [];
        $api_url = 'http://tongbu.et22.com/api/' . $top_api . '/' . $seller_userid . '?Pid=8015&Key=xiaozhushou&' . $curl_args;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $return_data['tmpInfo'] = json_decode(curl_exec($curl)); // 执行操作
        $return_data['curl_error'] = curl_error($curl);
        curl_close($curl); // 关闭CURL会话
        return $return_data;
    }


    /**
     *  控制台请求操作
     * @param $action_tag  接口标志
     * @param $post_data 请求参数
     * @return mixed
     */
    public function consoleCurlHandle($action_tag, $post_data)
    {
        $curl_url = BKC_URL . "?ActionTag=" . $action_tag;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $curl_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "qianyunlai.com's CURL Example beta");
        $rs_data = curl_exec($ch);
        curl_close($ch);
        return $rs_data;
    }

    /*
     * 通过服务接口获取订单信息
     */
    public function actionGetOrderInfos()
    {
        if (isset($_POST['shopid']) && isset($_POST['ordersn']) && isset($_POST['proid']))
        {
            $sql = 'SELECT seller_userid FROM zxjy_shop WHERE sid = ' . $_POST['shopid'] . ' AND api_expiration_time > UNIX_TIMESTAMP(NOW())';
            $seller_userid = $this -> db -> createCommand($sql) -> queryScalar();
            if (!empty($seller_userid))
            {
                $curl_args = 'tid=' . $_POST['ordersn'] . '&fields=payment,title,created,pay_time,tid,buyer_nick,credit_card_fee,status,orders,num_iid';
                $curl_exe = $this -> curlApi($seller_userid, $curl_args);
                extract($curl_exe);
                if (!$curl_error)  //curl无错误
                {
                    if (isset($tmpInfo -> IsError))  //有效请求
                    {
                        if (!$tmpInfo -> IsError)
                        {
                            if (in_array($tmpInfo -> Trade -> Status, ['WAIT_SELLER_SEND_GOODS', 'WAIT_BUYER_CONFIRM_GOODS', 'TRADE_BUYER_SIGNED', 'TRADE_FINISHED', 'PAID_FORBID_CONSIGN']))  //判断订单状态
                            {
                                $o = $tmpInfo -> Trade -> PayTime;
                                $t = date('Y-m-d', strtotime($tmpInfo -> Trade -> PayTime));
                                if (date('Y-m-d', strtotime($tmpInfo -> Trade -> PayTime)) == date('Y-m-d'))  //当天付款订单
                                {
                                    $sql = 'SELECT commodity_id FROM zxjy_product WHERE TO_DAYS(FROM_UNIXTIME(addtime)) > TO_DAYS("2018-07-17") AND  id = ' . $_POST['proid'];
                                    $this_pro_is_new = $this -> db -> createCommand($sql) -> queryScalar();  //买错商品只对7-17号之后添加的商品有效
                                    if (empty($this_pro_is_new) || $tmpInfo -> Trade -> Orders[0] -> NumIid == $this_pro_is_new)  //买错商品
                                    {
                                        Yii::app() -> redis -> set('order_info_' . $_POST['ordersn'], serialize($tmpInfo -> Trade), 0);
                                        Toole::show(1, '', $tmpInfo -> Trade);
                                    }
                                    else
                                        Toole::show(0, '订单商品[ID:' . $tmpInfo -> Trade -> Orders[0] -> NumIid . ']与商家指定[ID: ' . $this_pro_is_new . ']的不一致，无法获取信息');
                                }
                                else
                                    Toole::show(0, '订单状态无效，付款时间与任务时间不匹配');
                            }
                            else
                                Toole::show(0, '订单状态无效，尚未付款或者交易关闭');
                        }
                        else
                            Toole::show(0, '请求失败，[error]' . $tmpInfo -> ErrCode . ': ' . $tmpInfo -> ErrMsg . ', ' . $tmpInfo -> SubErrMsg);
                    }
                    else
                        Toole::show(0,  $tmpInfo -> Message);
                }
                else
                    Toole::show(0, $curl_error);
            }
            else
                Toole::show(0, '无法获取订单信息，请联系客服');
        }
        else
            Toole::show(0, '参数错误');
    }

    /**
     *  对一笔交易添加备注，即在淘宝后台对订单进行插旗标记
     * @param $shopid  本地店铺ID
     * @param $ordersn 对应的订单编号
     */
    public  function actionOrderMark($shopid, $ordersn)
    {
        $sql = 'SELECT seller_userid, is_mark, mark_val, mark_comment FROM zxjy_shop WHERE sid = ' . $shopid . ' AND api_expiration_time > UNIX_TIMESTAMP(NOW())';
        $shop_infos = $this -> db -> createCommand($sql) -> queryRow();
        if (!empty($shop_infos) && $shop_infos['is_mark'])  //商家服务接口尚未过期，且设置了插旗
        {
            $curl_args = 'tid=' . $ordersn . '&memo=' . urlencode($shop_infos['mark_comment']) . '&flag=' . $shop_infos['mark_val'] . '&fields=tid';
            $curl_exe = $this -> curlApi($shop_infos['seller_userid'], $curl_args, 'TradeMemoAdd');
            extract($curl_exe);
            if (!$curl_error)  //curl无错误
            {
                if (isset($tmpInfo -> IsError))  //有效请求
                {
                    if ($tmpInfo -> IsError)
                    {
                        $this -> actionMarkErrorHandle($ordersn, $tmpInfo -> ErrMsg . ': ' . $tmpInfo -> SubErrMsg);
                    }
                }
                else
                    $this -> actionMarkErrorHandle($ordersn, $tmpInfo -> Message);
            }
            else
                $this -> actionMarkErrorHandle($ordersn, $curl_error);
        }
    }

    /*
     * 插旗失败的处理
     */
    public function actionMarkErrorHandle($ordersn, $curl_err)
    {
        $sql = 'UPDATE zxjy_usertask SET mark_lose = 1 WHERE ordersn = "' . $ordersn . '"';
        $tag_res = $this -> db -> createCommand($sql) -> execute() ? '成功' : '失败';
        file_put_contents('./helper_error/mark_error_log.txt', date('Y-m-d H:i:s') . '：订单[' . $ordersn . ']插旗失败(' . $curl_err . ')， 并且标志' . $tag_res . "\r\n", FILE_APPEND);
    }

    public function actionTest()
    {
        file_put_contents('./helper_error/mark_error_log.txt', '123' . "\r\n", FILE_APPEND);
    }

    /**
     * 自动处理常见的客服问题
     * @param $ordersn  订单编号
     * @param $order_price  商家设置价格
     */
    public function autoDealTrouble($task_infos)
    {
        $uid = Yii::app() -> user -> getId();
        $order_infos = unserialize(Yii::app() -> redis -> get('order_info_' . $task_infos['ordersn']));  //获取到订单信息的redis缓存
        $error_path = './helper_error/autoDealTrouble_error_log.txt';  //记录错误信息的日志文件路径
        if ($order_infos)
        {
            $sql = 'SELECT wangwang FROM zxjy_blindwangwang WHERE userid = ' . $uid;
            $wangwang = $this -> db -> createCommand($sql) -> queryScalar();
            if ($order_infos -> BuyerNick != trim($wangwang))  //使用的买号跟平台上绑定的不一致，扣返任务佣金
            {
                $dispose_tag = $this -> deductAndReturn($task_infos, $task_infos['commission'], '用错买号，扣返佣金[' . $order_infos -> BuyerNick . ']', TRUE, 20, [1, 12], true);
                if ($dispose_tag !== true)
                {
                    file_put_contents($error_path, '订单[' . $task_infos['ordersn'] . ']自动处理[用错买号]工单失败，处理标志为： ' . $dispose_tag . "\r\n", FILE_APPEND);
                }
            }
            if (!empty($order_infos -> CreditCardFee))  //信用卡付款，扣返成交金额的1%
            {
                $dispose_tag = $this -> deductAndReturn($task_infos, $order_infos -> Payment * 0.01, '信用卡付款，扣返成交金额1%', TRUE, 0, [3, 26]);
                if ($dispose_tag !== true)
                {
                    file_put_contents($error_path, '订单[' . $task_infos['ordersn'] . ']自动处理[信用卡付款]工单失败，处理标志为： ' . $dispose_tag . "\r\n", FILE_APPEND);
                }
            }
//            $sql = 'SELECT COUNT(1) FROM zxjy_product WHERE TO_DAYS(FROM_UNIXTIME(addtime)) > TO_DAYS("2018-07-17") AND  id = ' . $task_infos['proid'];
//            $this_pro_is_new = $this -> db -> createCommand($sql) -> queryScalar();  //买错商品只对7-17号之后添加的商品有效
//            if ($this_pro_is_new && $order_infos -> Orders[0] -> NumIid != $task_infos['commodity_id'])  //买错商品
//            {
//                $dispose_tag = $this -> deductAndReturn($task_infos, $task_infos['commission'], '买错商品，扣返佣金[' . $order_infos -> Orders[0] -> NumIid . ' | ' . $task_infos['commodity_id'] . ']', TRUE, 10, [4, 33]);
//                if ($dispose_tag !== true)
//                {
//                    file_put_contents($error_path, '订单[' . $task_infos['ordersn'] . ']自动处理[买错商品]工单失败，处理标志为： ' . $dispose_tag . "\r\n", FILE_APPEND);
//                }
//            }
            Yii::app() -> redis -> del('order_info_' . $task_infos['ordersn']);  //清除订单缓存
        }
        else
            file_put_contents($error_path, '订单[' . $task_infos['ordersn'] . ']自动处理工单失败，没有对应的Redis缓存信息' . "\r\n", FILE_APPEND);
    }

    /**
     *  扣返, 生成工单
     * @param $task_infos  任务信息
     * @param $penaltymoney  扣除刷手多少钱
     * @param $cash_remark  流水备注
     * @param $need_create_schedual  是否需要生成工单记录，默认不需要
     * @param $penaltyscore  扣除刷手多少积分
     * @param $schedual_type  工单类型  [父类， 子类]
     * @param $all_return  是否全返佣金，默认不全返
     * @param $fromUser  扣除对象， 默认刷手
     * @param $toUser  返还对象，默认商家
     * @param $seriousness  严重性，默认轻度
     */
    public function deductAndReturn($task_infos, $penaltymoney, $cash_remark, $need_create_schedual = true, $penaltyscore = 0, $schedual_type = [], $all_return = false, $fromUser = 'userid', $toUser = 'merchantid', $seriousness = 0)
    {
        //初始化工单内容
        $insert = [
            'usertaskid' => $task_infos['id'],
            'typeid' => $schedual_type [0],
            'questionid' => $schedual_type [1],
            'merchantid' => $task_infos['merchantid'],
            'buyerid' => $task_infos['userid'],
            'tasksn' => $task_infos['tasksn'],
            'ordersn' => $task_infos['ordersn'],
            'addtime' => time(),
            'mark' => time () . $this -> generate_password (),
        ];
        //执行扣返操作
        $post_data = json_encode([
            'FromUserID' => $task_infos [$fromUser],
            "ToUserID" => $task_infos [$toUser],
            'Money' => $penaltymoney,
            'Remark' => $cash_remark,
            'UserTaskID' => $task_infos['id'],
        ]);
        $rs_data = $this -> consoleCurlHandle('UserTransAccounts_Display', $post_data);
        $rs_json = json_decode($rs_data);
        if ($rs_json && $rs_json -> IsOK)  //扣返成功，将工单置为处理完成
        {
            if ($all_return)
            {
                $gradient = $task_infos['tasktype'] == 1 ? [
                    7 => 15,
                    8 => 16,
                    11 => 20,
                    12 => 22,
                    13 => 24
                ] : [
                    8 => 17,
                    9 => 18,
                    12 => 22,
                    13 => 24,
                    14 => 29,
                ];
                $return_data = json_encode([
                    'UserID' => $task_infos [$toUser],
                    "Money" => $gradient[$penaltymoney] - $penaltymoney,
                    "PaySN" => $task_infos['ordersn'],
                    "PayProvider" => '手动充值',
                    "Remark" => $cash_remark . '[佣金全返]',
                    "optUserID" => -1,
                ]);
                $this -> consoleCurlHandle('User_Recharge', $return_data);
            }
            $dispose_tag = 'CASH_HANDEL_SUCCESS';  //处理标志
            $insert = array_merge($insert, [
                'status' => 3,
                'updatetime' => time(),
                'penaltymoney' => $penaltymoney,
                'penaltyscore' => $penaltyscore,
                'seriousness' => $seriousness,
                'winid' => $task_infos[$toUser],
            ]);
        }
        else
            $dispose_tag = 'CASH_HANDEL_FAIL';  //流水操作失败, 无需生成工单
        if ($need_create_schedual)
        {
            $res = $this -> db -> createCommand() -> insert('zxjy_schedual', $insert);
            $dispose_tag .=  $res ? '' : '_CREATE_SCHEDUAL_FAIL';
            //扣除积分
            if ($penaltyscore > 0)
            {
                $sql = 'SELECT Score FROM zxjy_user WHERE id = ' . $task_infos['userid'];
                $original_score = $this -> db -> createCommand($sql) -> queryScalar();
                $scorlog = [
                    'userid' => $task_infos['userid'],
                    'original_score' => $original_score,
                    'score_info' => '-' . $penaltyscore,
                    'score_now' => $original_score - $penaltyscore,
                    'description' => '"工单处罚扣除积分"',
                    'add_time' => time(),
                ];
                $res = $res && $this -> db -> createCommand() -> insert('zxjy_scorelog', $scorlog);
                $dispose_tag .=  $res ? '' : '_CREATE_SCORLOG_FAIL';
                $sql = 'UPDATE zxjy_user SET Score = "' . $scorlog['score_now'] . '" WHERE id = ' . $task_infos['userid'];
                $res = $res && $this -> db -> createCommand($sql) -> execute() !== false;  //更新任务用户表complaint字段
                $dispose_tag .= $res ? '' : '_UPDATE_USER_SCORE_FAIL';
            }
        }
        return in_array($dispose_tag, ['CASH_HANDEL_SUCCESS']) ? true : $dispose_tag;
    }

    /*
     * 工单生成标志
     */
    function generate_password($length = 6)
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_[]{}<>~+=/?|';
        $password = '';
        for($i = 0; $i < $length; $i ++)
        {
            $password .= $chars [mt_rand ( 0, strlen ( $chars ) - 1 )];
        }
        return $password;
    }

    /*
     * 判断是否使用小助手
     */
    function  isUseHelper()
    {
        if (!Yii::app() -> redis -> get('is_use_helper'))
        {
            $sql = 'SELECT value from zxjy_system WHERE id = 104';
            Yii::app() -> redis -> set('is_use_helper', Yii::app() ->db -> createCommand($sql) -> queryScalar(), 0);
        }
        return Yii::app() -> redis -> get('is_use_helper');
    }

    /*
     *  收藏等百分比实现
     */
    function getHandlePercent_collect($percent, $cache_name)
    {
        if (!Yii::app() -> redis -> get($cache_name))
        {
            Yii::app() -> redis -> set($cache_name, mt_rand(1, 100) <= $percent, 60 * 60);
        }
        return Yii::app() -> redis -> get($cache_name);
    }

    function getHandlePercent($percent_arr, $cache_name)
    {
        if (!Yii::app() -> redis -> get($cache_name))
        {
            $max_percent = 100;
            foreach ($percent_arr as $k => $v)
            {
                $rand_num = mt_rand(1, $max_percent);
                if ($rand_num <= $v)
                {
                    $contrast_num = $k;
                    break;
                }
                else
                    $max_percent -= $v;
            }
            Yii::app() -> redis -> set($cache_name, $contrast_num, 60 * 60);
        }
        return Yii::app() -> redis -> get($cache_name);
    }
}

?>