<?php
/*
    用户中心
*/
class TtController extends Controller
{
	public function actionIndex(){
		echo time().'<br>';
		echo date('Y-m-d H:i:s',time());
	}
	public function actionTest2(){
		    $arr=array(3493,4793,2788,5343,5343,2866,2733,2667,3876,2539,1411,1396,4004,4824,5621,5343,2715,4789,939,1384);
			print_r($arr);
		$arr2=array_unique($arr);print_r($arr2);
	}
   public function actionTest(){
	   $db=Yii::app()->db->tablePrefix;
	   $sql='select * from '.$db.'_bindbuyer ';$aaa=array();$bbb=array();
	    $all=Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($all as $k=>$v){
            $aaa[$v['userid']][]=$v['id'];
        }
	   foreach ($aaa as $kk=>$vv){
            if(count($vv)>1){
				$bbb[$kk]=$vv;
                $max=max($vv);
                foreach ($vv as $v){
                    if ($max!=$v){
                       //$b=Bindbuyer::model()->findByPk($v);
                       //$b->delete();
                    }
                }

            }
        }
       
   }
}