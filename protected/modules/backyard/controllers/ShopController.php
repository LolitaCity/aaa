<?php
    class ShopController extends Aclfilter{
        
        public $layout='//layouts/backyard';//定义布局以便加载kindeditor文本编辑器的css与js
        
        
        /*
            会员充值管理-充值列表
        */
        public function actionShoplist()
        {
            parent::acl();
             /*
            ***查询出用户充值交易信息
            */
            $criteria = new CDbCriteria;
            $criteria->order ="addtime desc";
        
            //分页开始
            $total = Shoplist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Shoplist::model()->findAll($criteria);
            //分页结束
            $this->renderPartial('shoplist',array(
                'proInfo' => $proreg,
                'pages' => $pages 
            ));
        }
        public function actionShopEdit(){
            parent::acl();
            if(isset($_GET['sid']) && $_GET['sid']<>0)
            {
                $userinfo=Shoplist::model()->findByPk($_GET['sid']);			
                $this->render('shopEdit',array(
                    'info'=>$userinfo
                ));
            }
        }
        public function actionShopDB(){
            parent::acl();
            $model=new ShopList();
            if(count($_POST)<>0)//处理提交表单
            {  
                $getmodel = Shoplist::model()->findByPk($_POST["Shop"]['sid']);
                if(count($getmodel)!=1)//如果没有内容提示错误
                {
                    $this->redirect_message("数据不存在","fail",3,''); 
                    exit;
                }                
                foreach($_POST["Shop"] as $key=>$value)
                {
                    $model->$key=$value;
                    $getmodel->$key=$value;
                }   
                $model->auditingtime=strtotime(date('Y-m-d H:i:s')); 
                $getmodel->auditingtime=strtotime(date('Y-m-d H:i:s')); 
                if($_POST["Shop"]['auditing']==1){
                    $model->status=1;
                    $getmodel->status=1;
                }else{
                    $getmodel->status=0;
                }
            }
            /*
             ***保存信息返回列表
            */
            
            //$count = $model->update(array('id','auditing','auditingtime','remark'));
            $count = $model->updateByPk($_POST["Shop"]['sid'],$getmodel);
            if($count>0) {
                $criteria = new CDbCriteria;
                $criteria->order ="addtime desc";
                
                //分页开始
                $total = Shoplist::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=10;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Shoplist::model()->findAll($criteria);
                //分页结束
                $this->renderPartial('shoplist',array(
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
            } else {
                $this->redirect_message("审核失败","fail",3,''); 
            }
            
        }
	
    }
?>