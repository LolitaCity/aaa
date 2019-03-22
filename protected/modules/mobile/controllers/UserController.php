<?php
    class UserController extends Controller
    {
        public $layout = false;

        /*
              声明所有基于类的动作。
       */
        public function actions()
        {
            return array(
                'captcha' => array(
                    'class' => 'CCaptchaAction',
                    'width' => 50,    //默认120
                    'height' => 35,    //默认50
                    'padding' => 2,    //文字周边填充大小
                    'backColor' => 0xFFFFFF,      //背景颜色
                    'foreColor' => 0x2040A0,     //字体颜色
                    'minLength' => 3,      //设置最短为6位
                    'maxLength' => 4,       //设置最长为7位,生成的code在6-7直接rand了
                    'transparent' => true,      //显示为透明,默认中可以看到为false
                    'offset' => -2,        //设置字符偏移量
                ));
        }


        //用户登录
        public function actionLogin()
        {
            $res = array();
            if(Yii::app()->user->getId()){
                $this->redirect($this->createUrl('default/index'));
            }
            if (!empty($_POST['Name'])) {
                $userLogin = new LoginForm;
                $userLogin->username = $_POST['Name'];
                $userLogin->password = $_POST['Password'];
                if ($userLogin->login()) {
                    $this->redirect($this->createUrl('default/index'));
                    exit;
                } else {
                    $res['msg'] = '您的用户名或密码错误';
                    $res['err_code'] = 1;
                }
            }
            $this->render('login', array('res' => $res));
        }

        //用户退出

        public function actionLoginout()
        {
            Yii::app()->user->logout(true); //当前应用用户退出
            echo $this->redirect('index');
        }
        public function actionForgetPassword()
        {
            if (isset($_POST['mobile'])) {
                if (empty($_POST['email'])) {
                    $res = array('err_code' => 4, 'msg' => '请输入邮箱');
                    echo json_encode($res);
                    exit;
                } else {
                    $user = User::model()->find('Username=' . $_POST['mobile']);
                    if ($_POST['email'] != $user->Email) {
                        $res = array('err_code' => 5, 'msg' => '账号与邮箱不匹配！');
                        echo json_encode($res);
                        exit;
                    }
                    $time = time() + 20 * 60;
                    $rr = $this->sendEmail($_POST['email'], $time, $_POST['mobile']);
                    if ($rr == 'success') {
                        $res['err_code'] = 0;
                        $res['msg'] = '邮件发送成功，请注意查收！（PS:如果收件箱找不到发送邮件，则请到垃圾箱看看）';
                        echo json_encode($res);
                        exit;
                    } else {
                        $res['err_code'] = 6;
                        $res['msg'] = '发送邮件失败，请稍后再试!';
                        echo json_encode($res);
                        exit;
                    }
                }
            }
            $siteLogin = new LoginForm;
            $this->layout = false;
            $this->render('forgetPassword', array('sitelogin' => $siteLogin));
        }
    //找回密码界面
    public function actionFindPwd(){
	    if ($_POST['mobile']){
	        if (empty($_POST['pp'])||empty($_POST['tt'])){
                //pp=phone sss //tt=time
                $res['err_code']=1;$res['msg']='该链接无效！';
                echo json_encode($res);exit;
            }else{
	            if (time()>$_POST['tt']){
                    $res['err_code']=2;$res['msg']='修改密码有效期已过！';
                    echo json_encode($res);exit;
                }
	            if (md5($_POST['mobile'])!=$_POST['pp']){
					echo md5($_POST['mobile']);exit;
                    $res['err_code']=3;$res['msg']='手机号错误！';
                    echo json_encode($res);exit;
                }
                $user=User::model()->find('Username='.$_POST['mobile']);
	            if ($user){
                    $user->PassWord=md5($_POST['pwd']);
                    if($user->save()){
                        $res['err_code']=0;$res['msg']='修改成功！';
                        echo json_encode($res);exit;
                    }else{
                        $res['err_code']=6;$res['msg']='修改失败！';
                        echo json_encode($res);exit;
                    }
                }else{
                    $res['err_code']=4;$res['msg']='该手机号不存在或者输入错误！';
                    echo json_encode($res);exit;
                }

            }
           
        }
        $this->layout=false;
	    $this->render('findPwd');
    }      
	   function sendEmail($email,$prefixtime,$phone)
        {
            //配置发送信息
            $config=array(
                'SMTP_HOST'=>'smtp.163.com',//smtp服务器
                'SMTP_PORT'=>'25',//端口
                'SMTP_USER'=>'our_two_senior@163.com',//邮箱帐号
                'SMTP_PASS'=>'senior123',//密码
                'FROM_EMAIL'=>'our_two_senior@163.com',
                'FROM_NAME'=>'二师兄威客圈',

            );
            $mail=Yii::createComponent('application.extensions.mailer.EMailer');//实例化对象
            $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
            $mail->IsSMTP();  // 设定使用SMTP服务
            $mail->SMTPDebug  = 1;                     // 关闭SMTP调试功能
            // 1 = errors and messages
            // 2 = messages only
            $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
            //$mail->SMTPSecure = 'ssl';                 // 使用安全协议
            $mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
            $mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
            $mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
            $mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
            $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
            //$replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
            //$replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
            //$mail->AddReplyTo($replyEmail, $replyName);
            $mail->Subject    = '找回密码-二师兄威客圈';
            $mail->MsgHTML('请在20分钟内找回密码，否则链接无效，<a href="'.SITE_URL.'mobile/user/findpwd/ptl/'.$prefixtime.'/sss/'.md5($phone).'.html">点击这里</a>');
            $mail->AddAddress($email, '二师兄');
            
            return @$mail->Send() ? 'success' : $mail->ErrorInfo;//发送邮件

        }

    }
?>