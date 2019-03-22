<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {
	/**
	 *
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 *      meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/layout';
	/**
	 *
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array ();

    public $uid;
    public $db;
    public $platform;  //平台所属

    public function init()
    {
        parent::init();
        $this -> uid = Yii::app() -> user -> getId();
        $this -> db = Yii::app() -> db;
        $sql = 'SELECT value FROM zxjy_system WHERE varname = "platform"';
        $this -> platform = $this -> cacheSqlQuery('web_platform', $sql, 0, false, 'queryScalar');
//		if (!empty($this -> uid) && $this -> uid != 196)
//		{
//           exit('系统正在调试');
//        }
    }

    /**
     * 缓存某条sql语句的查询结果
     * @param $cache_name  缓存键值
     * @param $sql  SQL语句
     * @param int $expire  过期时间，默认15分钟
     * @param int $common  是否为公用缓存类，默认为私有
     * @param int $action  以何种方法返回结果集， 默认result
     * @return mixed
     */
    public function cacheSqlQuery($cache_name, $sql, $expire = 900, $common = false, $action = 'queryAll')
    {
        $cache_name = $common ? $cache_name : $cache_name . $this -> uid;
        $redis = Yii::app() -> redis;
        if (!$redis -> get($cache_name))
        {
            $result = $this -> db -> createCommand($sql) -> $action();
            $redis -> set($cache_name, $result, $expire);  //缓存15分钟
        }
        return $redis -> get($cache_name);
    }

	/**
	 *
	 * @var array the breadcrumbs of the current page. The value of this property will
	 *      be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 *      for more details on how to specify this property.
	 */
	public $breadcrumbs = array ();
	public function liuliangrukou($typeid, $stype = '') {
		$arr ['intletarr'] = array (
				'1' => '淘宝APP自然搜索',
				'2' => '淘宝PC自然搜索',
				'3' => '淘宝APP淘口令',
				'4' => '淘宝APP直通车',
				'5' => '淘宝PC直通车',
				'6' => '淘宝APP二维码' 
		);
		if (in_array ( $typeid, array ( 2, 5  ) )) {
			$arr ['terminal'] = '电脑';
		} else {
			$arr ['terminal'] = '手机';
		}
		if (in_array ( $typeid, array ( 1, 3, 4, 6  ) )) {
			$arr ['entrance'] = '淘宝App';
		} else {
			$arr ['entrance'] = '淘宝首页www.taobao.com,严禁从返利网进入';
		}
		if (in_array ( $typeid, array ( 1, 2, 4, 5  ) )) {
			$arr ['searchtype'] = '关键字搜索';
		} 
		elseif ($typeid == 3) {
			$arr ['searchtype'] = '淘口令';
		} 
		else {
			$arr ['searchtype'] = '扫二维码';
		}
		if ($stype) {
			$arr ['stype'] = array (
					"1" => '综合',
					"2" => '新品',
					"3" => '人气',
					"4" => '销量',
					"5" => '价格从低到高',
					"6" => '价格从高到低' 
			);
		}
		return $arr;
	}
	
	/* 异常任务单记录 */
	public function add_unnormaltask($usertaskid = '', $buyerid = '', $merchantid = '', $usertaskaddtime = '', $usertaskupdatetime = '', $taskid = '', $shopid = '', $taskmodelid = '', $tasktimeid = '', $usertaskstatus = '', $dofun = '') {
		$unnormaltask = new Unnormaltask ();
		$unnormaltask->usertaskid = $usertaskid;
		$unnormaltask->buyerid = $buyerid;
		$unnormaltask->merchantid = $merchantid;
		$unnormaltask->usertaskaddtime = $usertaskaddtime;
		$unnormaltask->usertaskupdatetime = $usertaskupdatetime;
		$unnormaltask->taskid = $taskid;
		$unnormaltask->shopid = $shopid;
		$unnormaltask->taskmodelid = $taskmodelid;
		$unnormaltask->tasktimeid = $tasktimeid;
		$unnormaltask->usertaskstatus = $usertaskstatus;
		$unnormaltask->dofun = $dofun;
		$unnormaltask->addtime = time ();
		$unnormaltask->save ();
		return $unnormaltask -> id;
	}
	/*
	 * 成功提示开始
	 */
	public function redirect_message($message = '成功', $status = 'success', $time = 3, $url = false) {
		$back_color = '#ff0000';
		$linkUrl = $url;
		
		if ($status == 'success') {
			$back_color = '#666';
		}
		
		if (is_array ( $url )) {
			$route = isset ( $url [0] ) ? $url [0] : '';
			$url = $this->createUrl ( $route, array_splice ( $url, 1 ) );
		}
		if ($url) {
			$url = "window.location.href='{$url}'";
		} else {
			$url = "history.back();";
		}
		echo <<<HTML
        <style>
        *{ margin:0; padding:0; font-size:12px;}
        a{ text-decoration: none;}
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <div style=" width:100%; height:100%; position:fixed; background:#fff; z-index:1000000;">
        <div style="background:#C9F1FF; margin:0 auto; height:100px; width:400px; text-align:center; line-height:28px; color:#555;">
                    <div style="margin-top:100px;">
                    <h5 style="color:{$back_color};font-size:14px; padding-top:20px;" >{$message}</h5>
                    页面正在跳转请等待<span id="sec" style="color:blue;">{$time}</span>秒，或点击<a href="{$linkUrl}" style="color:green; font-weight:bold;">链接</a>直接跳转
                    </div>
        </div>
        </div>
                    <script type="text/javascript">
                    function run(){
                        var s = document.getElementById("sec");
                        if(s.innerHTML == 0){
                        {$url}
                            return false;
                        }
                        s.innerHTML = s.innerHTML * 1 - 1;
                    }
                    window.setInterval("run();", 1000);
                    </script>
HTML;
	}
	/*
	 * 成功提示结束
	 */
	/* 计算买家级别 */
	public function taobaoLevel() {
		$arr = array (
				1 => array (
						4,
						10,
						'heart_1' 
				),
				2 => array (
						11,
						40,
						'heart_2' 
				),
				3 => array (
						41,
						90,
						'heart_3' 
				),
				4 => array (
						91,
						150,
						'heart_4' 
				),
				5 => array (
						151,
						250,
						'heart_5' 
				),
				6 => array (
						251,
						500,
						'zuan_1' 
				),
				7 => array (
						501,
						1000,
						'zuan_2' 
				),
				8 => array (
						1001,
						2000,
						'zuan_3' 
				),
				9 => array (
						2001,
						5000,
						'zuan_4' 
				),
				10 => array (
						5001,
						10000,
						'zuan_5' 
				),
				11 => array (
						10001,
						20000,
						'hguan_1' 
				),
				12 => array (
						20001,
						50000,
						'hguan_2' 
				),
				13 => array (
						50001,
						100000,
						'hguan_3' 
				),
				14 => array (
						100001,
						200000,
						'hguan_4' 
				),
				15 => array (
						200001,
						500000,
						'hguan_5' 
				),
				16 => array (
						500001,
						1000000,
						'zguan_1' 
				),
				17 => array (
						1000001,
						2000000,
						'zguan_2' 
				),
				18 => array (
						2000001,
						5000000,
						'zguan_3' 
				),
				19 => array (
						5000001,
						10000000,
						'zguan_4' 
				),
				20 => array (
						10000001,
						'zguan_5' 
				) 
		);
		return $arr;
	}
}