<?php
    class ProductController extends Aclfilter{
        
        public $layout='//layouts/backyard';//定义布局以便加载kindeditor文本编辑器的css与js
        
        
        /*
            会员充值管理-充值列表
        */
        public function actionProductlist()
        {
            parent::acl();
             /*
            ***查询出用户充值交易信息
            */
            $criteria = new CDbCriteria;
            $criteria->order ="addtime desc";
        
            //分页开始
            $total = Productlist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Productlist::model()->findAll($criteria);
            //分页结束
            $this->renderPartial('productlist',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
        
        
	
    }
?>