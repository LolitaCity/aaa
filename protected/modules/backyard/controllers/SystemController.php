<?php
    class SystemController extends Aclfilter{
        
        public $layout='//layouts/backyard';//定义布局以便加载kindeditor文本编辑器的css与js
        
        
        
        /*
            新手考试管理
        */
        public function actionExam()
        {
            parent::acl();
            if(isset($_POST['Question']))
            {
                $exam=new Exam();
                //添加题目
                $exam->is_question=1;//题目
                $exam->text=$_POST['Question'];//题目标题
                $exam->time=time();//添加时间
                $exam->type=$_POST['type'];//添加时间
                if($exam->save())
                {
                    $q_id=$exam->attributes['id'];//返回插入的id
                    if(isset($_POST['answerA']) && $_POST['answerA']!=="")//存入答案A
                    {
                        $examA=new Exam();
                        $examA->is_question=0;//类型为答案
                        if($_POST['answer']==1)
                        $examA->answer=1;//如果正确答案为第一个选项，则该选项为正确答案标记为1
                        $examA->q_id=$q_id;//答案属于哪个题目
                        $examA->text=$_POST['answerA'];//答案内容
                        $examA->time=time();//添加时间
                        $examA->save();
                    }
                    
                    
                    if(isset($_POST['answerB']) && $_POST['answerB']!=="")//存入答案B
                    {
                        $examB=new Exam();
                        $examB->is_question=0;//类型为答案
                        if($_POST['answer']==2)
                        $examB->answer=1;//如果正确答案为第一个选项，则该选项为正确答案标记为1
                        $examB->q_id=$q_id;//答案属于哪个题目
                        $examB->text=$_POST['answerB'];//答案内容
                        $examB->time=time();//添加时间
                        $examB->save();
                    }
                    
                    if(isset($_POST['answerC']) && $_POST['answerC']!=="")//存入答案C
                    {
                        $examC=new Exam();
                        $examC->is_question=0;//类型为答案
                        if($_POST['answer']==3)
                        $examC->answer=1;//如果正确答案为第一个选项，则该选项为正确答案标记为1
                        $examC->q_id=$q_id;//答案属于哪个题目
                        $examC->text=$_POST['answerC'];//答案内容
                        $examC->time=time();//添加时间
                        $examC->save();
                    }
                    if(isset($_POST['answerD']) && $_POST['answerD']!=="")//存入答案D
                    {
                        $examD=new Exam();
                        $examD->is_question=0;//类型为答案
                        if($_POST['answer']==4)
                            $examD->answer=1;//如果正确答案为第一个选项，则该选项为正确答案标记为1
                        $examD->q_id=$q_id;//答案属于哪个题目
                        $examD->text=$_POST['answerD'];//答案内容
                        $examD->time=time();//添加时间
                        $examD->save();
                    }
                    
                    $this->redirect(array('system/exam'));
                    
                }
                Yii::app()->end();
            }
            $type=@$_GET['type']?$_GET['type']:1;
            $criteria = new CDbCriteria;
            $criteria->condition='is_question=1 AND type='.$type;//查询考试题目
            $criteria->order ="id desc";
        
            //分页开始
            $total = Exam::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Exam::model()->findAll($criteria);
            //分页结束
            
            $this->renderPartial('exam',array(
                'total'=>$total,
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
        
        
        /*
            考试系统-删除考题
        */
        public function actionExamDel()
        {
            if(isset($_GET['examid']) && $_GET['examid']!="")
            {
                $examinfo=Exam::model()->findByPk($_GET['examid']);
                $examinfo->delete();
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }
        /*
            ***注册黑名单管理
        */
        public function actionBlackaccount()
        {
            parent::acl();
            if(isset($_POST['blackaccountinfo']))
            {
                if($_POST['blackaccountinfo']=="")//黑名单信息不能为
                {
                    $criteria = new CDbCriteria;
                    $criteria->order ="time desc";
                
                    //分页开始
                    $total = Blackaccount::model()->count($criteria);
                    $pages = new CPagination($total);
                    $pages->pageSize=10;//分页大小
                    $pages->applyLimit($criteria);
                    
                    $proreg = Blackaccount::model()->findAll($criteria);
                    //分页结束
                    
                    $this->renderPartial('blackaccount',array(
                        'total'=>$total,
                        'proInfo' => $proreg,
                        'pages' => $pages,
                        'addWarning'=>'黑名单信息不能为空'
                    ));
                    Yii::app()->end();
                }
                else{
                    $checkBlack=Blackaccount::model()->findByAttributes(array('blackaccountinfo'=>$_POST['blackaccountinfo']));
                    if($checkBlack)
                    {
                        $criteria = new CDbCriteria;
                        $criteria->order ="time desc";
                    
                        //分页开始
                        $total = Blackaccount::model()->count($criteria);
                        $pages = new CPagination($total);
                        $pages->pageSize=10;//分页大小
                        $pages->applyLimit($criteria);
                        
                        $proreg = Blackaccount::model()->findAll($criteria);
                        //分页结束
                        
                        $this->renderPartial('blackaccount',array(
                            'total'=>$total,
                            'proInfo' => $proreg,
                            'pages' => $pages,
                            'addWarning'=>'此信息已经添加过'
                        ));
                        Yii::app()->end();
                    }
                    else
                    {
                        $blackInfo=new Blackaccount();
                        $blackInfo->blackaccountinfo=$_POST['blackaccountinfo'];
                        $blackInfo->time=time();
                        $blackInfo->adderid=Yii::app()->user->getId();
                        $blackInfo->adder=Yii::app()->user->getName();
                        $blackInfo->save();
                        
                        $criteria = new CDbCriteria;
                        $criteria->order ="time desc";
                    
                        //分页开始
                        $total = Blackaccount::model()->count($criteria);
                        $pages = new CPagination($total);
                        $pages->pageSize=10;//分页大小
                        $pages->applyLimit($criteria);
                        
                        $proreg = Blackaccount::model()->findAll($criteria);
                        //分页结束
                        
                        $this->renderPartial('blackaccount',array(
                            'total'=>$total,
                            'proInfo' => $proreg,
                            'pages' => $pages,
                            'addWarning'=>'添加成功'
                        ));
                        Yii::app()->end();
                    }
                }
            }
            
            //模糊查询黑名单信息
            if(isset($_POST['keyword']))
            {
                $criteria = new CDbCriteria;
                $criteria->condition = "blackaccountinfo like '%".$_POST['keyword']."%'";
                $criteria->order ="time desc";
            
                //分页开始
                $total = Blackaccount::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=10;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Blackaccount::model()->findAll($criteria);
                //分页结束
                
                $this->renderPartial('blackaccount',array(
                    'total'=>$total,
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
                Yii::app()->end();
            }
            
            //继续封杀
            if(@$_POST['doAction']=="start")
            {
                $blackInfo=Blackaccount::model()->findByPk($_POST['id']);
                $blackInfo->status=1;
                $blackInfo->save();
                Yii::app()->end();
            }
            
            //停止封杀
            if(@$_POST['doAction']=="stop")
            {
                $blackInfo=Blackaccount::model()->findByPk($_POST['id']);
                $blackInfo->status=0;
                $blackInfo->save();
                Yii::app()->end();
            }
            
            $criteria = new CDbCriteria;
            $criteria->order ="time desc";
        
            //分页开始
            $total = Blackaccount::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Blackaccount::model()->findAll($criteria);
            //分页结束
            
            $this->renderPartial('blackaccount',array(
                'total'=>$total,
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
        
        /*
            系统基本参数
        */
         public function actionBaseset()
        {
            //修改系统基本参数
            if(count($_POST)>0)
            {
             foreach ($_POST as $key=>$value){
                 if ($key=='buyerSet'){
                     $value=serialize($value);
                 }
                 $webtitle=System::model()->findByAttributes(array('varname'=>$key));
                 $webtitle->value=$value;
                 $webtitle->save();
            }

            }
            $this->renderPartial("baseset");
        }
    }
?>