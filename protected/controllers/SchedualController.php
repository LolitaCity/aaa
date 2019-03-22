<?php
class SchedualController extends Controller
{
public  $layout='public_header';
public function init()
{
    parent::init();
    $userid=Yii::app()->user->getId();
    if (empty($userid)){
        $this->redirect($this->createUrl('passport/login'));
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

//工单列表
public function actionSchedualList(){
    $db=Yii::app()->db->tablePrefix;
    $where='';$serchword=array();
    if ($_POST){
        if ($_POST['Category1ID']){
            $where.=" AND s.typeid=$_POST[Category1ID] ";
        }
        if ($_POST['Category2ID']){
            $where.=" AND s.questionid=$_POST[Category2ID] ";
        }
        if ($_POST['tasksn']){
            $where.=" AND ut.tasksn='$_POST[tasksn]' ";
        }
        if ($_POST['ordersn']){
            $where.=" AND ut.ordersn='$_POST[ordersn]' ";
        }
        $begin=!empty($_POST['BeginDate'])?strtotime($_POST['BeginDate']):'';
        $end=!empty($_POST['EndDate'])?strtotime($_POST['EndDate']):'';
        if (!empty($begin) && !empty($end)){
            $where.=" AND s.addtime>'$begin' AND s.addtime<'$end' ";
        }
        if (!empty($begin) && empty($end)){
            $where.=" AND s.addtime>'$begin' ";
        }
        if (empty($begin) && !empty($end)){
            $where.=" AND s.addtime<'$end' ";
        }
        $serchword=$_POST;
    }
    $sql="SELECT ut.tasksn,ut.ordersn,ut.id as utaskid,s.* FROM ".$db."_schedual AS s LEFT JOIN ".$db."_usertask AS ut ON s.usertaskid=ut.id ".
        "  WHERE s.buyerid=".Yii::app()->user->getId().$where;
   // $list=Yii::app()->db->createCommand($sql)->queryAll();
    $criteria=new CDbCriteria();
    $list=Yii::app()->db->createCommand($sql)->queryAll();
    $pages=new CPagination(count($list));
    $pages->pageSize=15;
    $pages->applyLimit($criteria);
    $list=Yii::app()->db->createCommand($sql.' LIMIT :offset,:limit');
    $list->bindValue(':offset',$pages->currentPage*$pages->pageSize);
    $list->bindValue(':limit',$pages->pageSize);
    $list=$list->queryAll();

    $cate=Schedualtype::model()->findAll('pid=0');
   // print_r($serchword);exit;
    $this->render('schedualList',array('cate'=>$cate,'list'=>$list,'searchword'=>$serchword,'pages'=>$pages));
}
//积分工单列表
public function actionSchedualScoreList(){
    $db=Yii::app()->db->tablePrefix;
    $where='';$serchword=array();
    if ($_POST){
        if ($_POST['Category1ID']){
            $where.=" AND s.typeid=$_POST[Category1ID] ";
        }
        if ($_POST['Category2ID']){
            $where.=" AND s.questionid=$_POST[Category2ID] ";
        }
        if ($_POST['tasksn']){
            $where.=" AND ut.tasksn='$_POST[tasksn]' ";
        }
        if ($_POST['ordersn']){
            $where.=" AND ut.ordersn='$_POST[ordersn]' ";
        }
        $begin=!empty($_POST['BeginDate'])?strtotime($_POST['BeginDate']):'';
        $end=!empty($_POST['EndDate'])?strtotime($_POST['EndDate']):'';
        if (!empty($begin) && !empty($end)){
            $where.=" AND s.addtime>'$begin' AND s.addtime<'$end' ";
        }
        if (!empty($begin) && empty($end)){
            $where.=" AND s.addtime>'$begin' ";
        }
        if (empty($begin) && !empty($end)){
            $where.=" AND s.addtime<'$end' ";
        }
        $serchword=$_POST;
    }

    $sql="SELECT ut.ordersn,ut.id as utaskid,s.* FROM ".$db."_schedual AS s LEFT JOIN ".$db."_usertask AS ut ON s.usertaskid=ut.id ".
        "  WHERE s.buyerid=".Yii::app()->user->getId()." AND s.penaltyscore>0 ".$where;
    $criteria=new CDbCriteria();
    $list=Yii::app()->db->createCommand($sql)->queryAll();
    $pages=new CPagination(count($list));
    $pages->pageSize=15;
    $pages->applyLimit($criteria);
    $list=Yii::app()->db->createCommand($sql.' LIMIT :offset,:limit');
    $list->bindValue(':offset',$pages->currentPage*$pages->pageSize);
    $list->bindValue(':limit',$pages->pageSize);
    $list=$list->queryAll();
    //$list=Yii::app()->db->createCommand($sql)->queryAll();

    $cate=Schedualtype::model()->findAll('pid=0');
   // print_r($serchword);exit;
    $this->render('schedualScoreList',array('cate'=>$cate,'list'=>$list,'searchword'=>$serchword,'pages'=>$pages));
}

//积分处罚列表
public function actionPointsList(){

    $this->render('pointsList');
}
//查看详细页面
public function actionSchedualDetail(){
    $schedual=array();
    if ($_GET['scheduaid']){
          $schedual=Schedual::model()->findByPk($_GET['scheduaid']);
    }
    $this->render('schedualDetail',array('schedual'=>$schedual));
}
//获取工单类型
public function actionGetCategory(){
    $tbprefix=Yii::app()->db->tablePrefix;
    $list=array();
    if ($_POST['categroyID']){
        $sql="SELECT * FROM ".$tbprefix."_schedualtype WHERE pid=".$_POST['categroyID'];
        $list=Yii::app()->db->createCommand($sql)->queryAll();
    }
    array_unshift($list,array('id'=>0,'typename'=>'请选择','pid'=>0));
   echo json_encode($list);exit;
}
//查看工单任务详情
public function actionGettaskinfo(){
    $this->layout=false;
    $usertask=Usertask::model()->findByPk($_GET['usertaskid']);
    $this->render('gettaskinfo',array('usertask'=>$usertask));
}
//查看截图
public function actionGetPictureInfo(){
    $this->layout=false;
    $usertask=Usertask::model()->findByPk($_GET['usertaskid']);
    $this->render('getPictureInfo',array('usertask'=>$usertask));
}
function getChildCate($catid){
    $sechedualtype=Schedualtype::model()->findAll('pid='.$catid);
    return $sechedualtype;
}
}




















?>