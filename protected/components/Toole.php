<?php
/**
 * Created by PhpStorm.
 * User: senming
 * Date: 2018/4/8
 * Time: 19:07
 */

class Toole
{
    private $tttti;
    /*获取今日开始时间戳*/
    public static function getbeginToday(){
        $beginToday = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) );
        return $beginToday;
    }
    /*获取今日结束时间戳*/
    public static function getendToda(){
        $endToday = mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ) + 1, date ( 'Y' ) ) - 1;
        return $endToday;
    }

    /* 获取任务总数 */
    public static function gettaskcount($start, $end)
    {
        $uid = Yii::app()->user->getId();
        $sql = "SELECT COUNT(id) AS cc FROM zxjy_usertask WHERE userid=" . $uid . " AND addtime<'$end' AND addtime>'$start'";
        $row = Yii::app()->db->createCommand($sql)->queryRow();
        return $row ['cc'];
    }

    // 获取一周的开始和结束
    public static function getWeekRange() {
        // 将日期转时间戳
        $one = time () - ((date ( 'w' ) == 0 ? 7 : date ( 'w' )) - 1) * 24 * 3600;
        $seven = time () + (7 - (date ( 'w' ) == 0 ? 7 : date ( 'w' ))) * 24 * 3600;
        $date ['start'] = mktime ( 0, 0, 0, date ( 'm', $one ), date ( 'd', $one ), date ( 'Y', $one ) );
        $date ['end'] = mktime ( 0, 0, 0, date ( 'm', $seven ), date ( 'd', $seven ), date ( 'Y', $seven ) );
        return $date;
    }
    // 获取指定上月日期
    public static function getlastMonthDays($timenow) {
        $sql = "SELECT `value`,`varname` FROM zxjy_system where varname='taskScore' OR varname='monthAccount' OR varname='buyerSet'";
        $system = Yii::app ()->db->createCommand ( $sql )->queryAll ();
        $allsystem = array ();
        foreach ( $system as $k => $v ) {
            if ($v ['varname'] == 'buyerSet') {
                $v ['value'] = unserialize ( $v ['value'] );
            }
            $allsystem [$v ['varname']] = $v ['value'];
        }
        $day = $allsystem ['monthAccount'];
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
     *图片上传
     */
    public static function updol($v,$p){
        $picname = $v['file']['name'];
        $picsize = $v['file']['size'];
        $dirname='/data';
        $ym = @date("Ym");
        if ($picname != "") {
        if ($picsize >= 4194304) { //限制上传大小 4M
            echo '{"status":0,"content":"图片大小不能超过4M"}';
            exit; 
        } 
        $type = strstr($picname, '.'); //限制上传格式
        $type_u = $v['file']['type'];
        $type_limit = ['image/gif', 'image/jpeg', 'image/png', 'image/jpg'];
        if(!in_array($type_u, $type_limit)){
            echo '{"status":2,"content":"图片格式不对！"}';
            exit;
        }
        $rand = rand(100, 999); 
        $pics = uniqid() . $type; //命名图片名称
        //文件夹
        $save_path2 = 'myUpload'.$dirname.'/'.$ym . "/";
        if (!file_exists($save_path2)) {
            mkdir($save_path2);
        }
        //上传路径
        $pic_path = "myUpload".$dirname."/".$ym."/". $pics;
        move_uploaded_file($v['file']['tmp_name'], $pic_path);
		//if (move_uploaded_file ( move_uploaded_file($v['file']['tmp_name'], $pic_path)))
		//{

		//}else{
		//	echo '{"status":2,"content":"图片保存失败，请稍后再试"}';
		//	 exit;
		//}
    } 
    $size = round($picsize/1024,2); //转换成kb

        return  '{"status":1,"name":"'.$picname.'","url":"'.$p['url_v'].$pic_path.'","size":"'.$size.'","content":"上传成功"}';

    }
     /*
      * url:访问路径
      */
    public static function curl_get($url){
        $testurl = $url;
        $ch = curl_init();
        //进行请求
        curl_setopt($ch,CURLOPT_URL,$testurl);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HEADER,0);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    //显示前后
    public static function  Substr_Cut($user_name01) {
        $user_name =trim($user_name01);
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
    /**
     * 只保留字符串尾字符，隐藏姓名的姓*代替（两个字符时只显示第一个）
     * @param string $user_name01 姓名
     * @return string 格式化后的姓名
     */
    public static function  Substr_Cut_top($user_name01) {
        $user_name =trim($user_name01);
        $strlen   = mb_strlen($user_name, 'utf-8');
        $oneStr  = mb_substr($user_name, -1,1, 'utf-8');//取名字的最后一个字
        $twoStr = mb_substr($user_name, -2, 2, 'utf-8');//取名字的最后两个字
        return $strlen == 2 ?  '*'.$oneStr :  '*'.$twoStr;
    }
    public static function set_Redid_json($redis_key,$redis_json,$time_sun){
        $uid = Yii::app()->user->getId();
        $redis_key_en =json_encode($redis_json,JSON_UNESCAPED_UNICODE);
        Yii::app()->redis->set($redis_key.'_'.$uid,$redis_key_en,$time_sun);
    }

    public static function get_Redid_json($redis_key){
        $uid = Yii::app()->user->getId();
        $redis_get = Yii::app()->redis->get($redis_key.'_'.$uid);
        return json_decode($redis_get,true);
    }

    //获取毫秒
    public static function  getMillisecond() {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }

    public static function show($status, $message = '', $data = [])
    {
        exit(json_encode([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]));
    }

    /**
     *  控制台请求操作
     * @param $action_tag  接口标志
     * @param $post_data 请求参数
     * @param $retries  curl重试次数
     * @return mixed
     */
    public static function consoleCurlHandle($action_tag, $post_data, $retries = 4)
    {
        $curl_url = BKC_URL . "?ActionTag=" . $action_tag;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $curl_url);
        curl_setopt($curl, CURLOPT_POSTFIELDS,  $post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "qianyunlai.com's CURL Example beta");
        $return_data['tmpInfo'] = json_decode(curl_exec($curl)); // 执行操作
        $return_data['curl_error'] = curl_error($curl);
        while (($return_data['curl_error'] || !$return_data['tmpInfo'] -> IsOK) && $retries--)  //请求有误，重试
        {
            $return_data['tmpInfo'] = json_decode(curl_exec($curl));
            $return_data['curl_error'] = curl_error($curl);
        }
        curl_close($curl);
        return $return_data;
    }
	
	//检查银行卡信息
    public static function checkBankInfo($number)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://ccdcapi.alipay.com/validateAndCacheCardInfo.json?_input_charset=utf-8&cardNo=' . $number . '&cardBinCheck=true');
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        $tmpInfo = curl_exec($curl); // 执行操作
        $res = json_decode($tmpInfo);
        curl_close($curl); // 关闭CURL会话
        if($res->validated){
            return $res;
        }else{
            return $res;
        }
        return false;
    }

    public static  function Removalofspace($content){
        $str =preg_replace("/(\s|\&nbsp\;| |\xc2\xa0 )/","",$content);
        return $str;
    }

    public  static function containcharacter($content,$str,$num){
        $content = self::Removalofspace($content);
       if(mb_substr($content,$num,2,"UTF-8") == $str){
              return true;
       }else{
              return false;
        }
    }
	
	//生成guid
    public static function setGuid(){
            if (function_exists('com_create_guid')){
                return com_create_guid();
            }else{
                mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
                $charid = strtoupper(md5(uniqid(rand(), true)));
                $hyphen = chr(45);// "-"
                $uuid = chr(123)// "{"
                    .substr($charid, 0, 8).$hyphen
                    .substr($charid, 8, 4).$hyphen
                    .substr($charid,12, 4).$hyphen
                    .substr($charid,16, 4).$hyphen
                    .substr($charid,20,12)
                    .chr(125);// "}"
                return $uuid;
            }
    }
}