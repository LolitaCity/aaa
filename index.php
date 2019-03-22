<?php


//echo '<html><head> <meta http-equiv=Content-Type content="text/html;charset=utf-8"></head><body>现在正在系统维护，请稍后进行访问</body></html>' ; exit() ;



// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
error_reporting(E_ALL ^ E_NOTICE);

// remove the following lines when in production mode（在上线时删除下面这一行代码）
defined('YII_DEBUG') or define('YII_DEBUG',true);//defined('YII_DEBUG') or define('YII_DEBUG',ture);改成defined('YII_DEBUG') or define('YII_DEBUG',false);使用了weidgt的页面会加快加载速度
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
require_once(dirname(__FILE__).'/protected/config/defined.php');//加载全局变量
require_once($yii);//加载yii框架核心文件


include_once 'CacheLock.php';

if (count($_POST) > 0)
{
	foreach($_POST as &$v)
	{
		if (is_array($v))
		{
			foreach ($v as &$v2)
			{
				if (!is_array($v2))
					$v2 = htmlspecialchars(trim($v2));
			}
		}
		else
			$v = htmlspecialchars(trim($v));
	}
}
if (count($_GET) > 0)
{
	foreach($_GET as &$v)
	{
		if (is_array($v))
		{
			foreach ($v as &$v2)
			{
				if (!is_array($v2))
					$v2 = htmlspecialchars(trim($v2));
			}
		}
		else
			$v = htmlspecialchars(trim($v));
	}
}
Yii::createWebApplication($config)->run(); //运行显示最终结果

/*记录当前用户IP以及URL
$request = Yii::app() -> request;
$url = $request -> getUrl();
Yii::app() -> db -> createCommand() -> insert('zxjy_ip', [
    'ip' => 's_' . $request -> userHostAddress,
    'url' => 'aaa.18zang.com' . $request -> getUrl(),
    'addtime' => date('Y-m-d H:i:s'), 'tag'=>  Yii::app ()->user->getId ()
]);
*/

 
/*
echo '=========================================';
Yii::app()->redis->set('aaa' , 'AAAAAAAAAAAAAa') ;
echo Yii::app()->redis->get("aaa") ;
*/