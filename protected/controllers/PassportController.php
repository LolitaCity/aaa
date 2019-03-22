<?php
class PassportController extends Controller {
	public function filters() {
		return array (
				'accessControl' 
		);
	}
	public function actions() {
		return array (
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha' => array (
						'class' => 'CCaptchaAction',
						'backColor' => 0xFFFFFF,
						'width' => 80, // 默认120
						'height' => 35, // 默认50
						'padding' => 2, // 文字周边填充大小
						
						'foreColor' => 0x2040A0, // 字体颜色
						'minLength' => 4, // 设置最短为6位
						'maxLength' => 4, // 设置最长为7位,生成的code在6-7直接rand了
						'transparent' => true, // 显示为透明,默认中可以看到为false
						'offset' => - 2  // 设置字符偏移量
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page' => array (
						'class' => 'CViewAction' 
				) 
		);
	}
	public function accessRules() {
		return array (
				array (
						'allow', // 允许所有用户访问 'login' 动作.
						'users' => array (
								'*' 
						) 
				),
				array (
						'allow', // 允许认证用户访问所有动作
						'users' => array (
								'@' 
						) 
				),
				array (
						'deny', // 拒绝所有的用户。
						'users' => array (
								'*' 
						) 
				) 
		);
	}
	
	/*
	 * 用户忘记密码-发送短信前检测号码是否存在
	 */
	public function actionCheckPhoneExist() {
		if (isset ( $_POST ['phone'] ) && $_POST ['phone'] != "") {
			$userinfo = User::model ()->findByAttributes ( array (
					'Phon' => $_POST ['phone'] 
			) );
			if ($userinfo) {
				echo "SUCCESS";
			} else // 手机号码不存在
{
				echo "FAIL";
			}
		}
	}
	
	/*
	 * 用户忘记密码-找回密码
	 */
	public function actionForgetPwd() {
		if (isset ( $_POST ['phone'] ) && $_POST ['phone'] != "" && isset ( $_POST ['newpwd'] ) && $_POST ['newpwd'] != "") {
			$userinfo = User::model ()->findByAttributes ( array (
					'Phon' => $_POST ['phone'] 
			) );
			if ($userinfo) {
				$userinfo->PassWord = md5 ( $_POST ['newpwd'] ); // 新密码
				if ($userinfo->save ())
					echo "SUCCESS";
				else
					echo "FAIL";
			} else // 手机号码不存在
{
				echo "PHONENOTEXIST";
			}
			Yii::app ()->end ();
		}
		$this->renderPartial ( 'forgetPwd' );
	}



	/*
	 * 发送验证码
	 */
	public function actionCheckCode()
    {
        $captcha_key = 'Yii.CCaptchaAction.' . Yii::app ()->getId () . '.' . Yii::app ()->controller->id . '.captcha';
        if ($_POST ['code'] == $_SESSION [$captcha_key])
        {
            if (md5 ( $_POST ['phonenum'] ) != $_POST ['ppp'])
            {
                $code = $this -> generateSMSCode();
                $post_data = json_encode([
                    'Mobile' => $_POST['phone'],
                    "Msg" => '您的验证码是' . $this -> generateSMSCode() . (PLATFORM == 'esx' ? '【二师兄威客网】' : '【信客圈】'),
                ]);
                $curl_result = Toole::consoleCurlHandle('Send_ShortMsg', $post_data);
                extract($curl_result);
                if (!$curl_error)
                {
                    if ($tmpInfo -> IsOK)
                    {
                        Yii::app() -> session['phone'] = $_POST['phone'];
                        Toole::show(1, '验证码发送成功');
                    }
                    else
                        Toole::show(0, $tmpInfo -> Description);
                }
                else
                    Toole::show(0, $curl_error);
            }
            else
                Toole::show(0, '手机号码与邀请者所填手机号无法匹配');
        }
        else
            Toole::show(0, '页面验证码输入错误');
    }

    /*
     * 生成默认6位随机数字数的验证码
     */
    public function generateSMSCode($lenght = 6)
    {
        $min = pow(10 , ($lenght - 1));
        $max = pow(10, $lenght) - 1;
        $code = rand($min, $max);
        Yii::app() -> session['phoneCode'] = $code;
        return $code;
    }
	
	/* 用户注册模块 */
	public function actionRegist() {
		if ((empty ( $_GET ['userid'] ) || empty ( $_GET ['ppp'] )) && empty ( $_POST )) {
			$this->redirect_message ( '当前链接无效！请与邀请人核实', 'failed', 3, $this->createUrl ( 'site/index' ) );
			exit ();
		}
		if (isset ( $_POST ['phonenum'] )) { // 判断用户是否有推广权限
			if (md5 ( $_POST ['phonenum'] ) != $_POST ['ppp']) {
				$result ['err_code'] = 4;
				$result ['msg'] = '手机号码与邀请者所填手机号无法匹配';
				echo json_encode ( $result );
				exit ();
			}
			if ($_POST ['userid']) {
				$sql = "SELECT ispromoter FROM " . Yii::app ()->db->tablePrefix . '_user WHERE id=' . $_POST ['userid'];
				$row = Yii::app ()->db->createCommand ( $sql )->queryRow ();
				if ($row ['ispromoter'] == 0) {
					$result ['err_code'] = 6;
					$result ['msg'] = '当前邀请者没有权限邀请！您无法注册';
					echo json_encode ( $result );
					exit ();
				}
			} else {
				$result ['err_code'] = 5;
				$result ['msg'] = '参数错误';
				echo json_encode ( $result );
				exit ();
			}
            if ($_POST ['phoneCode'] != Yii::app() -> session['phoneCode']) {
                $result ['err_code'] = 3;
                $result ['msg'] = '短信验证码输入错误';
                echo json_encode ($result);
                exit ();
            }
			
			$result = array ();
			// 注册前先经过黑名单数据库过滤
			$blackInfoCheck = Blackaccount::model ()->findAll ( array (
					'condition' => 'blackaccountinfo=' . $_POST ['qq'] . ' or blackaccountinfo=' . $_POST ['phonenum'] . ' and status=1' 
			) );
			// 用户注册的QQ或手机号在黑名单数据库中有记录
			if (count ( $blackInfoCheck ) > 0) {
				$result ['err_code'] = 1;
				$result ['msg'] = '黑名单中有您信息的记录，如有疑问请联系我们的客服人员';
				echo json_encode ( $result );
				exit ();
			}
			$checkexist = User::model ()->findByAttributes ( array (
					'Username' => $_POST ['phonenum'] 
			) );
			// 如果用户名已经存在，阻止重复注册
			if ($checkexist) {
				$result ['err_code'] = 2;
				$result ['msg'] = '该手机号已被注册，请重新输入';
				echo json_encode ( $result );
				exit ();
			}
			
			$userRegModel = new User ();
			$userRegModel->PassWord = md5 ( $_POST ['pwd'] ); // 密码md5加密
			$userRegModel->SafePwd = md5 ( $_POST ['pwd'] ); // 密码md5加密
			$userRegModel->Username = $_POST ['phonenum']; // 密码md5加密
			$userRegModel->Phon = $_POST ['phonenum']; // 密码md5加密
			$userRegModel->QQToken = $_POST ['qq']; // 密码md5加密
			$userRegModel->RegIp = XUtils::getClientIP (); // 注册IP
			$userRegModel->RegTime = time (); // 注册时间
			$userRegModel->Email = $_POST ['email']; // 注册时间
			
			$reglock = System::model ()->findByAttributes ( array (
					"varname" => "reglock" 
			) ); // 检查系统设置中的新用户注册状态
			$userRegModel->Status = $reglock->value; // 新注册用户默认状态为冻结
			/*
			 * **判断是否为推广链接
			 */
			@$userinfo = User::model ()->findByPk ( $_POST ['userid'] );
			if ($userinfo) {
				$userRegModel->IdNumber = $_POST ['userid'];
			} else {
				$result ['err_code'] = 7;
				$result ['msg'] = '没有这个推荐人存在';
				echo json_encode ( $result );
				exit ();
			}
			
			// 保存数据// 添加数据
			if ($userRegModel->save ()) {
				// 判断如果用户已经登录
				if (Yii::app ()->user->getId ()) {
					Yii::app ()->user->logout ( false ); // 当前应用用户退出
				}
				$result ['err_code'] = 0;
				$result ['msg'] = '注册成功';
				echo json_encode ( $result );
				exit ();
			}
		}
		$siteLogin = new SiteLoginForm ();
		$this->layout = false;
		$this->render ( 'regist', array (
				'sitelogin' => $siteLogin 
		) );
	}
	// 找回密码界面
	public function actionFindPwd() {
		if ($_POST ['mobile']) {
			if (empty ( $_POST ['pp'] ) || empty ( $_POST ['tt'] )) {
				// pp=phone sss //tt=time
				$res ['err_code'] = 1;
				$res ['msg'] = '该链接无效！';
				echo json_encode ( $res );
				exit ();
			} else {
				if (time () > $_POST ['tt']) {
					$res ['err_code'] = 2;
					$res ['msg'] = '有效期已过！';
					echo json_encode ( $res );
					exit ();
				}
				if (md5 ( $_POST ['mobile'] ) != $_POST ['pp']) {
					$res ['err_code'] = 3;
					$res ['msg'] = '手机号错误！';
					echo json_encode ( $res );
					exit ();
				}
				$user = User::model ()->find ( 'Username=' . $_POST ['mobile'] );
				if ($user) {
					$user->PassWord = md5 ( $_POST ['pwd'] );
					if ($user->save ()) {
						$res ['err_code'] = 0;
						$res ['msg'] = '修改成功！';
						echo json_encode ( $res );
						exit ();
					} else {
						$res ['err_code'] = 6;
						$res ['msg'] = '修改失败！';
						echo json_encode ( $res );
						exit ();
					}
				} else {
					$res ['err_code'] = 4;
					$res ['msg'] = '该手机号不存在！';
					echo json_encode ( $res );
					exit ();
				}
			}
			print_r ( $_POST );
			exit ();
		}
		$this->layout = false;
		$this->render ( 'findPwd' );
	}
	/* 检查注册的帐号是否存在 */
	public function actionCheckUser() {
		$userModel = User::model ()->findByAttributes ( array (
				'Username' => $_POST ["param"] 
		) );
		if ($_POST ["param"] == "admin") {
			echo '{
    			"info":"admin为系统保留帐号，不能注册",
    			"status":"n"
    		 }';
		} elseif ($userModel == false) {
			echo '{
    			"info":"帐号可以使用",
    			"status":"y"
    		 }';
		} else {
			echo '{
    			"info":"该帐号已被注册",
    			"status":"n"
    		 }';
		}
	}
	
	/* 检查真实姓名 */
	public function actionCheckTrueName() {
		$userModel = User::model ()->findByAttributes ( array (
				'TrueName' => $_POST ["param"] 
		) );
		if ($userModel == false) {
			echo '{
    			"info":"通过验证",
    			"status":"y"
    		 }';
		} else {
			echo '{
    			"info":"该姓名已存在",
    			"status":"n"
    		 }';
		}
	}
	
	/* 检查注册的QQ是否存在 */
	public function actionCheckQQ() {
		$userModel = User::model ()->findByAttributes ( array (
				'QQToken' => $_POST ["param"] 
		) );
		if ($userModel == false) {
			echo '{
    			"info":"该QQ号可以使用",
    			"status":"y"
    		 }';
		} else {
			echo '{
    			"info":"该QQ号已被注册",
    			"status":"n"
    		 }';
		}
	}
	
	/* 检查注册的邮箱是否存在 */
	public function actionCheckEmail() {
		$userModel = User::model ()->findByAttributes ( array (
				'Email' => $_POST ["param"] 
		) );
		if ($userModel == false) {
			echo '{
    			"info":"该邮箱可以使用",
    			"status":"y"
    		 }';
		} else {
			echo '{
    			"info":"该邮箱已被注册",
    			"status":"n"
    		 }';
		}
	}
	
	/* 检查注册的手机号是否存在 */
	public function actionCheckMobile() {
		$userModel = User::model ()->findByAttributes ( array (
				'Phon' => $_POST ["param"] 
		) );
		if ($userModel == false) {
			echo '{
    			"info":"该手机号可以使用",
    			"status":"y"
    		 }';
		} else {
			echo '{
    			"info":"该手机号已被注册",
    			"status":"n"
    		 }';
		}
	}
	
	/* 检查注册的手机验证码是否正确 */
	public function actionCheckMobileCode() {
		if ($_POST ["param"] != $_SESSION ['mobile_code'] or empty ( $_POST ['param'] )) {
			echo '{
    			"info":"验证码不正确",
    			"status":"n"
 		     }';
		} else {
			// $_SESSION['mobile'] = '';
			// $_SESSION['mobile_code'] = '';
			echo '{
    			"info":"验证码正确，请不要修改",
    			"status":"y"
 		     }';
		}
	}
	
	// 找回密码
	public function actionForgetPassword() {
		if (isset ( $_POST ['mobile'] )) {
			if ($_POST ['code']) {
				$captcha_key = 'Yii.CCaptchaAction.' . Yii::app ()->getId () . '.' . Yii::app ()->controller->id . '.captcha';
				if ($_POST ['code'] != $_SESSION [$captcha_key]) {
					$res ['err_code'] = 3;
					$res ['msg'] = '验证码输入错误';
					echo json_encode ( $res );
					exit ();
				}
			} else {
				$res = array (
						'err_code' => 2,
						'msg' => '请输入验证码' 
				);
				echo json_encode ( $res );
				exit ();
			}
			if (empty ( $_POST ['email'] )) {
				$res = array (
						'err_code' => 4,
						'msg' => '请输入邮箱' 
				);
				echo json_encode ( $res );
				exit ();
			} else {
				$user = User::model ()->find ( 'Username=' . $_POST ['mobile'] );
				if ($_POST ['email'] != $user->Email) {
					$res = array (
							'err_code' => 5,
							'msg' => '账号与邮箱不匹配！' 
					);
					echo json_encode ( $res );
					exit ();
				}
				$time = time () + 20 * 60;
				$rr = $this->sendEmail ( $_POST ['email'], $time, $_POST ['mobile'] );
				if ($rr == 'success') {
					$res ['err_code'] = 0;
					$res ['msg'] = '邮件发送成功，请注意查收！（PS:如果收件箱找不到发送邮件，则请到垃圾箱看看）';
					echo json_encode ( $res );
					exit ();
				} else {
					$res ['err_code'] = 6;
					$res ['msg'] = '发送邮件失败，请稍后再试!';
					echo json_encode ( $res );
					exit ();
				}
			}
		}
		
		$siteLogin = new SiteLoginForm ();
		$this->layout = false;
		$this->render ( 'forgetPassword', array (
				'sitelogin' => $siteLogin 
		) );
	}
	
	// 找回密码 优化
    public function  actionforemail(){
        $res = array();
        if (isset ( $_POST ['mobile'] )) {

            if ($_POST ['code']) {
                $captcha_key = 'Yii.CCaptchaAction.' . Yii::app ()->getId () . '.' . Yii::app ()->controller->id . '.captcha';
                if ($_POST ['code'] != $_SESSION [$captcha_key]) {
                    $res ['err_code'] = 3;
                    $res ['msg'] = '验证码输入错误';
                    echo json_encode ( $res );
                    exit ();
                }
            } else {
                $res = array (
                    'err_code' => 2,
                    'msg' => '请输入验证码'
                );
                echo json_encode ( $res );
                exit ();
            }

            if (empty ( $_POST ['email'] )) {
                $res = array (
                    'err_code' => 4,
                    'msg' => '请输入邮箱'
                );
                echo json_encode ( $res );
                exit ();
            }
            $user = User::model ()->find ( 'Username=' . $_POST ['mobile'] );
            $sql = "select email,Username from zxjy_user WHERE  Username =". $_POST ['mobile'];
            $user =  Yii::app ()->db->createCommand($sql)->queryAll();

            if($user[0]['email'] !=$_POST ['email']){
                $res ['err_code'] = 9;
                $res ['msg'] = "邮箱不正确！";
                echo json_encode ( $res );
                exit();
            }else{
                $prefixtime = time () + 20 * 60;
                $mailsun = $this -> sendEmail($user[0]['email'], $prefixtime, $user[0]['Username']);
                // 配置发送信息
//                $config = array (
//                    'SMTP_HOST' => 'smtp.163.com', // smtp服务器
//                    'SMTP_PORT' => '25', // 端口
//                    'SMTP_USER' => 'our_two_senior@163.com', // 邮箱帐号
//                    'SMTP_PASS' => 'senior123', // 密码
//                    'FROM_EMAIL' => 'our_two_senior@163.com',
//                    'FROM_NAME' => $this -> platform,
//
//                );
//                $mail = Yii::createComponent ( 'application.extensions.mailer.EMailer' ); // 实例化对象
//                $mail->CharSet = 'UTF-8'; // 设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
//                $mail->IsSMTP (); // 设定使用SMTP服务
//                $mail->SMTPDebug = 1; // 关闭SMTP调试功能
//                // 1 = errors and messages
//                // 2 = messages only
//                $mail->SMTPAuth = true; // 启用 SMTP 验证功能
//                // $mail->SMTPSecure = 'ssl'; // 使用安全协议
//                $mail->Host = $config ['SMTP_HOST']; // SMTP 服务器
//                $mail->Port = $config ['SMTP_PORT']; // SMTP服务器的端口号
//                $mail->Username = $config ['SMTP_USER']; // SMTP服务器用户名
//                $mail->Password = $config ['SMTP_PASS']; // SMTP服务器密码
//                $mail->SetFrom ( $config ['FROM_EMAIL'], $config ['FROM_NAME'] );
//
//                $mail->Subject = '找回密码-' . $this -> platform;
//                // $mail->MsgHTML("尊敬的366k用户请点击以下链接！<a href='http://game.366k.com/index.php/passport/forgetPwd'>http://game.366k.com/index.php/passport/forgetPwd</a>，找回您的密码，此邮件由系统发出，无须回复！");
//                $mail->MsgHTML ( '请在20分钟内找回密码，否则链接无效，<a href="' . SITE_URL . 'passport/findpwd/ptl/' . $prefixtime . '/sss/' . md5 ( $user[0]['Username'] ) . '.html">点击这里</a>' );
//                $mail->AddAddress ( $user[0]['email'] , $this -> platform);
//                $mailsun = @$mail->Send ();// 发送邮件
                if($mailsun === true){
                    $res ['err_code'] = 0;
                    $res ['msg'] = '邮件发送成功，请注意查收！（PS:如果收件箱找不到发送邮件，则请到垃圾箱看看）';
                    echo json_encode ( $res );
                    exit ();
                }else{
                    $res ['err_code'] = 6;
                    $res ['msg'] = '发送邮件失败，请稍后再试!';
                    echo json_encode ( $res );
                    exit ();
                }
            }
        }

        $siteLogin = new SiteLoginForm ();
        $this->layout = false;
        $this->render ( 'forgetPassword', array (
            'sitelogin' => $siteLogin
        ) );
    }
	
	// 找回密码下一步
	public function actionForgetpasswordnext() {
		if (isset ( $_POST ['User'] )) {
			$checkPhone = User::model ()->findByAttributes ( array (
					'Phon' => $_SESSION ['mobile'] 
			) );
			if ($checkPhone) {
				$checkPhone->PassWord = md5 ( $_POST ['User'] ['PassWord'] );
				if ($checkPhone->save ()) {
					$this->redirect_message ( '密码修改成功', 'success', 3, $this->createUrl ( 'site/index' ) );
					Yii::app ()->end ();
				} else {
					$this->redirect_message ( '密码修改失败，请联系网站管理员', 'success', 3, $this->createUrl ( 'site/index' ) );
					Yii::app ()->end ();
				}
			} else {
				$this->redirect_message ( '您填写的手机号不存在，请确认您填写的手机号为注册时填写的手机号', 'success', 3, $this->createUrl ( 'site/index' ) );
				Yii::app ()->end ();
			}
		}
		$checkPhone = User::model ()->findByAttributes ( array (
				'Phon' => $_SESSION ['mobile'] 
		) );
		
		if ($checkPhone) {
			$this->renderPartial ( 'forgetpasswordnext', array (
					'checkPhone' => $checkPhone 
			) );
		} else {
			$this->redirect_message ( '您填写的手机号不存在', 'success', 3, $this->createUrl ( 'site/index' ) );
			Yii::app ()->end ();
		}
	}
	
	/*
	 * 异地登录检测
	 */
	public function actionPlaceOtherLogin() {
		if (isset ( $_POST ['username'] ) && $_POST ['username'] != "" && isset ( $_POST ['pwd'] ) && $_POST ['pwd']) {
			$siteLogin = new SiteLoginForm ();
			$siteLogin->username = $_POST ['username'];
			$siteLogin->password = $_POST ['pwd'];
			$siteLogin->rememberMe = false;
			if ($siteLogin->validate ()) // 用户名密码正确
{
				$userinfo = User::model ()->findByAttributes ( array (
						'Username' => $_POST ['username'],
						'PassWord' => md5 ( $_POST ['pwd'] ) 
				) );
				if ($userinfo->Status == 0) // 用户帐号没有被冻结，处于正常状态
{
					if ($userinfo->PlaceOtherLogin == 0) // 用户没有开启异地登录，则允许用户直接提交登录
{
						echo "true";
					} else // 开启异地登录
{
						// 1.检查此次登录的ip与最近一次登录的ip是否相同
						$lastLoginLog = Loginlog::model ()->find ( array (
								'condition' => 'userid=' . $userinfo->id,
								'order' => 'id desc' 
						) );
						if ($lastLoginLog->loginip === XUtils::getClientIP ()) // 如果本次登录ip与最近一次登录ip相同则允许用户直接提交
{
							echo "true";
						} else // 如果不同则返回通知使用短信验证
{
							echo $userinfo->Phon; // 需要手机接手短信验证码,返回手机号码，以便发送短信进行验证
						}
					}
				} else // 帐号被冻结
{
					echo "LOCK";
				}
			} else
				echo "FAIL";
		}
	}
	
	/*
	 * 用户中心-检测手机与接收到的验证码是否正确
	 */
	public function actionUserCheckPhoneAndCode() {
		if (isset ( $_POST ['phone'] ) && isset ( $_POST ['phoneCode'] )) {
			if ($_POST ['phoneCode'] == Yii::app ()->session ['code']) {
				if ($_POST ['phone'] == Yii::app ()->session ['phone']) {
					unset ( Yii::app ()->session ['code'] ); // 清除验证码
					unset ( Yii::app ()->session ['phone'] ); // 清除手机号
					echo "SUCCESS";
				} else {
					echo "PHONEFAIL";
				}
			} else {
				echo "CODEFAIL"; // 验证码不正确
			}
		} else {
			echo "FAIL";
		}
	}
	
	/*
	 * 用户异地登录-手机验证码检测通过-提交登录
	 */
	public function actionCodePassLogin() {
		$siteLogin = new SiteLoginForm ();
		$siteLogin->username = $_POST ['username'];
		$siteLogin->password = $_POST ['pwd'];
		$siteLogin->rememberMe = false;
		if (@$siteLogin->validate () && @$siteLogin->login ()) // 数据验证与判断登录
{
			// 存储登录日志
			$loginlog = new Loginlog ();
			$loginlog->loginip = XUtils::getClientIP (); // 登录ip
			                                             // 登录地址
			$ipinfo = file_get_contents ( 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $loginlog->loginip );
			if ($ipinfo) {
				$loginlog->userid = Yii::app ()->user->getId (); // 登录id
				$loginlog->username = Yii::app ()->user->getName (); // 登录帐户
				
				$placeinfo = json_decode ( $ipinfo, true );
				$loginlog->loginplace = $placeinfo ['data'] ['region'] . $placeinfo ['data'] ['city'] != "" ? $placeinfo ['data'] ['city'] : "本地"; // 登录地址
				                                                                                                                                   // 登录地址
				$loginlog->time = time ();
				$loginlog->save (); // 保存登录日志
			}
			echo "SUCCESS"; // 登录成功
		} else
			echo "FAIL";
	}
	
	/* 用户登录验证模块 */
	public function actionLogin() {
		$siteLogin = new SiteLoginForm ();
		$cookiearr = Yii::app ()->request->getCookies ();
		// 判断如果用户已经登录
		if (Yii::app ()->user->getId ()) {
			// 用户登录情况下销毁前一个用户
			if (isset ( $_GET ['uid'] )) {
				Yii::app ()->user->logout ( false ); // 当前应用用户退出
				$signKey = "sywnew!@#$%20161612!#@$!@#$!@%!@"; // 签名key
				if ($_GET ['sign'] == md5 ( $_GET ['uid'] . $signKey )) {
					$userinfo = User::model ()->findByPk ( $_GET ['uid'] );
					
					$siteLogin->username = $userinfo->Username; // 用户名
					$siteLogin->password = $userinfo->PassWord; // 密码
					$siteLogin->rememberMe = false; // 获取用户是否点击了记住我的选择框
					                                
					// 数据验证与判断登录
					if (@$siteLogin->login ()) {
						$this->redirect ( array (
								'site/index' 
						) );
					} else
						echo "FAIL";
				}
				{
					echo "FAIL";
				}
			} else {
				$this->redirect ( $this->createUrl ( 'site/index' ) );
				Yii::app ()->end ();
			}
		}
		if (isset ( $_GET ['uid'] )) {
			$signKey = "sywnew!@#$%20161612!#@$!@#$!@%!@"; // 签名key
			if ($_GET ['sign'] == md5 ( $_GET ['uid'] . $signKey )) {
				$userinfo = User::model ()->findByPk ( $_GET ['uid'] );
				
				$siteLogin->username = $userinfo->Username; // 用户名
				$siteLogin->password = $userinfo->PassWord; // 密码
				$siteLogin->rememberMe = false; // 获取用户是否点击了记住我的选择框
				                                
				// 数据验证与判断登录
				if (@$siteLogin->login ()) {
					$this->redirect ( array (
							'site/index' 
					) );
				} else
					echo "FAIL";
			}
			{
				echo "FAIL";
			}
		}
		if (isset ( $_POST ['username'] )) {
			
			$siteLogin->username = $_POST ['username'];
			$siteLogin->password = md5 ( $_POST ['pwd'] );
			// 验证码
			
			$captcha_key = 'Yii.CCaptchaAction.' . Yii::app ()->getId () . '.' . $_POST ['cid'] . '.captcha';
			$verify = $_SESSION [$captcha_key];
			
			// 数据验证与判断登录
			if (@$siteLogin->login ()) {
				$loginlog = new Loginlog ();
				$loginlog->loginip = XUtils::getClientIP (); // 登录ip
				                                             // 登录地址
				                                             // $ipinfo=file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$loginlog->loginip);
				$ipinfo = $this->GetIp ();
				if ($ipinfo) {
					$loginlog->userid = Yii::app ()->user->getId (); // 登录id
					$loginlog->username = Yii::app ()->user->getName (); // 登录帐户
					
					$loginlog->loginplace = $ipinfo;
					// 登录地址
					$loginlog->time = time ();
					$loginlog->save (); // 保存登录日志
				}
				// $this->redirect(array('site/index'));
				// $this->redirect(array('default/index'));//成功后进行跳转\
				echo json_encode ( array (
						'err_code' => 0 
				) );
				exit ();
			} else {
				$result = array (
						'err_code' => 1,
						'msg' => '帐号或密码错误' 
				);
				// 如果用户登录错误三次以上 则显示验证码
				$error = 1;
				if (isset ( $cookiearr ['error_code'] )) {
					$error = $cookiearr ['error_code']->value; // echo $error;exit;
					if ($error > 3) {
						$result ['err_code'] = 2; // 显示验证码
						if ($verify != $_POST ['code'] && ! empty ( $_POST ['code'] )) {
							$result ['err_code'] = 3;
							$result ['msg'] = '验证码不正确';
						}
						unset ( $cookiearr ['error_code'] );
						$error = 0;
					}
					$cookie = new CHttpCookie ( 'error_code', $error + 1 );
				} else {
					$cookie = new CHttpCookie ( 'error_code', 1 );
				}
				$cookie->expire = time () + 5 * 60; // 有限期5分钟
				Yii::app ()->request->cookies ['error_code'] = $cookie;
				
				echo json_encode ( $result );
				exit ();
			}
		}
		$this->layout = false;
		$this->render ( 'login', array (
				'sitelogin' => $siteLogin,
				'err_code' => @$cookiearr ['error_code']->value,
		) );
	}
	
	/* 用户邮箱激活 */
	public function actionEmailActive() {
		// 判断传递的参数是否正确
		if (isset ( $_GET ['userid'] ) && isset ( $_GET ['email'] )) {
			$emailChangeActive = User::model ()->findByPk ( $_GET ['userid'] );
			// 判断是否已经激活过
			if ($emailChangeActive->emailActive == 0) {
				if ($emailChangeActive) {
					// 匹配与邮箱地址加密信息是否一致
					if (md5 ( $emailChangeActive->Email ) == $_GET ['email']) {
						$emailChangeActive->emailActive = 1;
						if ($emailChangeActive->save ()) {
							if (Yii::app ()->user->getId () && Yii::app ()->user->getId () == $_GET ['userid'])
								$this->redirect_message ( '您的邮箱已激活', 'success', 3, $this->createUrl ( 'user/countSafe' ) );
							else
								$this->redirect_message ( '您的邮箱已激活', 'success', 3, $this->createUrl ( 'site/index' ) );
						}
					} else {
						if (Yii::app ()->user->getId () && Yii::app ()->user->getId () == $_GET ['userid'])
							$this->redirect_message ( '您的邮箱链接已失效', 'success', 3, $this->createUrl ( 'user/countSafe' ) );
						else
							$this->redirect_message ( '您的邮箱链接已失效', 'success', 3, $this->createUrl ( 'site/index' ) );
					}
				} else {
					$this->redirect ( array (
							'site/index' 
					) );
				}
			} else {
				if (Yii::app ()->user->getId () && Yii::app ()->user->getId () == $_GET ['userid'])
					$this->redirect_message ( '您的邮箱已激活', 'success', 3, $this->createUrl ( 'user/countSafe' ) );
				else
					$this->redirect_message ( '您的邮箱已激活', 'success', 3, $this->createUrl ( 'site/index' ) );
			}
		} else {
			$this->redirect ( array (
					'site/index' 
			) );
		}
	}

	/*
	 * 发送派单消息
	 */
	public function actionSendOrdersNews()
    {
        header("content-type:text/html;charset=utf-8");  //设置编码
        if (!empty($_POST['uid']) && !empty($_POST['usertaskid']))
        {
            $sql = "SELECT Email, TrueName FROM zxjy_user WHERE id = {$_POST['uid']}";
            $user_infos = $this -> db -> createCommand($sql) -> queryRow();
            $pattern= '/([a-z0-9]*[-_.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[.][a-z]{2,3}([.][a-z]{2})?/i';
            if (isset($user_infos['Email']) && preg_match($pattern, $user_infos['Email']))
            {
                $sql = "SELECT tasksn, FROM_UNIXTIME(addtime + 60 * 45) as overdue FROM zxjy_usertask WHERE id = {$_POST['usertaskid']}";
                $task_infos = $this -> db -> createCommand($sql) -> queryRow();
                $content = "尊敬的{$user_infos['TrueName']}，您有一单任务编号为{$task_infos['tasksn']}的任务，将于{$task_infos['overdue']}过期，
                    请及时登陆平台完成。<a href='http://aaa.jensin.com'>电脑端点击</a>,<a href='http://aaa.jensin.com/mobile/user/login'>手机端点击</a>";
                $send_res = $this -> sendMail($user_infos['Email'], '新的任务信息', $content);
                exit($send_res === true ? 'OK' : $send_res);
            }
            else
                exit('邮箱为空或格式有误');
        }
        else
            exit('参数错误');
    }

	function  sendMail($email, $title, $content)
    {
        $config = [
            'SMTP_HOST' => 'ssl://smtp.163.com', // smtp服务器
            'SMTP_PORT' => '465', // 端口
            'SMTP_USER' => 'our_two_senior@163.com', // 邮箱帐号
            'SMTP_PASS' => 'senior123', // 密码
            'FROM_EMAIL' => 'our_two_senior@163.com',
            'FROM_NAME' => $this -> platform,
        ];
        $mail = Yii::createComponent ( 'application.extensions.mailer.EMailer' ); // 实例化对象
//        $message = 'Hello World!';
//        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
//        $mailer->Host = $config ['SMTP_HOST'];
//        $mailer->IsSMTP();
//        $mailer->From = $config ['FROM_EMAIL'];
//        $mailer->FromName = $config ['FROM_NAME'];
//        $mail->Username = $config ['SMTP_USER']; // SMTP服务器用户名
//        $mail->Password = $config ['SMTP_PASS']; // SMTP服务器密码
//        $mailer->AddAddress($email);
//        $mailer->CharSet = 'UTF-8';
//        $mailer->Subject = $title;
//        $mailer->Body = $content;
//        return @$mail -> Send () ? true : $mail->ErrorInfo;

        $mail->CharSet = 'UTF-8'; // 设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
        $mail->IsSMTP (); // 设定使用SMTP服务
        $mail->SMTPDebug = 1; // 关闭SMTP调试功能
        // 1 = errors and messages
        // 2 = messages only
        $mail->SMTPAuth = true; // 启用 SMTP 验证功能
        // $mail->SMTPSecure = 'ssl'; // 使用安全协议
        $mail->Host = $config ['SMTP_HOST']; // SMTP 服务器
        $mail->Port = $config ['SMTP_PORT']; // SMTP服务器的端口号
        $mail->Username = $config ['SMTP_USER']; // SMTP服务器用户名
        $mail->Password = $config ['SMTP_PASS']; // SMTP服务器密码
        $mail -> SMTPAuth = true;   // 设置为"需要验证"
        $mail->SetFrom ( $config ['FROM_EMAIL'], $config ['FROM_NAME'] );

        $mail->Subject = $title . '-' . $this -> platform;
        // $mail->MsgHTML("尊敬的366k用户请点击以下链接！<a href='http://game.366k.com/index.php/passport/forgetPwd'>http://game.366k.com/index.php/passport/forgetPwd</a>，找回您的密码，此邮件由系统发出，无须回复！");
        $mail->MsgHTML ($content);
        $mail->AddAddress ($email , $this -> platform);
        return @$mail -> Send () ? true : $mail->ErrorInfo;
    }

	function sendEmail($email, $prefixtime, $phone)
    {
        $content = '请在20分钟内找回密码，否则链接无效，<a href="' . SITE_URL . 'passport/findpwd/ptl/' . $prefixtime . '/sss/' . md5 ( $phone ) . '.html">点击这里</a>';
        return $this -> sendMail($email, '找回密码', $content);
//		// 配置发送信息
//		$config = array (
//				'SMTP_HOST' => 'smtp.163.com', // smtp服务器
//				'SMTP_PORT' => '3389', // 端口
//				'SMTP_USER' => 'our_two_senior@163.com', // 邮箱帐号
//				'SMTP_PASS' => 'senior123', // 密码
//				'FROM_EMAIL' => 'our_two_senior@163.com',
//				'FROM_NAME' => $this -> platform,
//
//		);
//		$mail = Yii::createComponent ( 'application.extensions.mailer.EMailer' ); // 实例化对象
//		$mail->CharSet = 'UTF-8'; // 设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
//		$mail->IsSMTP (); // 设定使用SMTP服务
//		$mail->SMTPDebug = 1; // 关闭SMTP调试功能
//		                      // 1 = errors and messages
//		                      // 2 = messages only
//		$mail->SMTPAuth = true; // 启用 SMTP 验证功能
//		                        // $mail->SMTPSecure = 'ssl'; // 使用安全协议
//		$mail->Host = $config ['SMTP_HOST']; // SMTP 服务器
//		$mail->Port = $config ['SMTP_PORT']; // SMTP服务器的端口号
//		$mail->Username = $config ['SMTP_USER']; // SMTP服务器用户名
//		$mail->Password = $config ['SMTP_PASS']; // SMTP服务器密码
//		$mail->SetFrom ( $config ['FROM_EMAIL'], $config ['FROM_NAME'] );
//		// $replyEmail = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
//		// $replyName = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
//		// $mail->AddReplyTo($replyEmail, $replyName);
//		$mail->Subject = '找回密码-' . $this -> platform;
//		// $mail->MsgHTML("尊敬的366k用户请点击以下链接！<a href='http://game.366k.com/index.php/passport/forgetPwd'>http://game.366k.com/index.php/passport/forgetPwd</a>，找回您的密码，此邮件由系统发出，无须回复！");
//		$mail->MsgHTML (  );
//		$mail->AddAddress ( $email, $this -> platform);
//		echo @$mail->Send () ? '发送成功' : $mail->ErrorInfo; // 发送邮件
	}
	function GetIp() {
		$realip = '';
		$unknown = 'unknown';
		if (isset ( $_SERVER )) {
			if (isset ( $_SERVER ['HTTP_X_FORWARDED_FOR'] ) && ! empty ( $_SERVER ['HTTP_X_FORWARDED_FOR'] ) && strcasecmp ( $_SERVER ['HTTP_X_FORWARDED_FOR'], $unknown )) {
				$arr = explode ( ',', $_SERVER ['HTTP_X_FORWARDED_FOR'] );
				foreach ( $arr as $ip ) {
					$ip = trim ( $ip );
					if ($ip != 'unknown') {
						$realip = $ip;
						break;
					}
				}
			} else if (isset ( $_SERVER ['HTTP_CLIENT_IP'] ) && ! empty ( $_SERVER ['HTTP_CLIENT_IP'] ) && strcasecmp ( $_SERVER ['HTTP_CLIENT_IP'], $unknown )) {
				$realip = $_SERVER ['HTTP_CLIENT_IP'];
			} else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && ! empty ( $_SERVER ['REMOTE_ADDR'] ) && strcasecmp ( $_SERVER ['REMOTE_ADDR'], $unknown )) {
				$realip = $_SERVER ['REMOTE_ADDR'];
			} else {
				$realip = $unknown;
			}
		} else {
			if (getenv ( 'HTTP_X_FORWARDED_FOR' ) && strcasecmp ( getenv ( 'HTTP_X_FORWARDED_FOR' ), $unknown )) {
				$realip = getenv ( "HTTP_X_FORWARDED_FOR" );
			} else if (getenv ( 'HTTP_CLIENT_IP' ) && strcasecmp ( getenv ( 'HTTP_CLIENT_IP' ), $unknown )) {
				$realip = getenv ( "HTTP_CLIENT_IP" );
			} else if (getenv ( 'REMOTE_ADDR' ) && strcasecmp ( getenv ( 'REMOTE_ADDR' ), $unknown )) {
				$realip = getenv ( "REMOTE_ADDR" );
			} else {
				$realip = $unknown;
			}
		}
		$realip = preg_match ( "/[\d\.]{7,15}/", $realip, $matches ) ? $matches [0] : $unknown;
		return $realip;
	}
	/*旧单接口查询 */
    public function actionOldlist(){
		$uid = Yii::app()->user->getId();
		if(!in_array( $uid, array (30804))){
        $result ['err_code'] = 1;
		$result ['msg'] = "非法";
		echo json_encode ( $result,JSON_UNESCAPED_UNICODE);
		exit ();
            exit();
        }
		header("Content-type:text/html;charset=utf-8");
		//$_POST['account_username']=trim($_POST['account_username']);
		$_GET['account_username']=trim($_GET['account_username']);
		$account_username = $_GET['account_username'];
		if(empty($account_username)){
			$result ['err_code'] = 3;
			$result ['msg'] = '不能为空';
			echo json_encode ( $result,JSON_UNESCAPED_UNICODE);
			exit ();
		}
		if( !is_numeric( $account_username ) ) 
		{ 
            $result ['err_code'] = 3;
			$result ['msg'] = '非法';
			echo json_encode ( $result,JSON_UNESCAPED_UNICODE);
			exit ();
		} 
		
		$le = strlen($account_username);
		if($le >19){
		$result ['err_code'] = 1;
		$result ['msg'] ='非法';
		echo json_encode ( $result,JSON_UNESCAPED_UNICODE);
		exit ();
		}
		
		$sql = "SELECT id from zxjy_taskevaluate WHERE usertaskid  in (SELECT id from zxjy_usertask WHERE ordersn =".$account_username.")";
;
		$taskf=  Yii::app()->db->createCommand($sql)->queryRow();
		if($taskf){
        $url ="http://127.0.0.1:9866/?ActionTag=Free_TaskEvaluateInfo&TaskEvaluateID=".$taskf['id'];
        $rr = Toole::curl_get($url);
		$jsonObject = json_decode($rr);
        if ($rr) {
			 if ($jsonObject->IsOK == true) {
				 $result ['err_code'] = 1;
				 $result ['msg'] = "评价任务被放弃";
				 echo json_encode ( $result,JSON_UNESCAPED_UNICODE);
				 exit ();
			 }else{
				 $result ['err_code'] = 1;
				 $result ['msg'] = "评价任务被放弃失败";
				 echo json_encode ( $result,JSON_UNESCAPED_UNICODE);
				 exit ();
			 }
		$result ['err_code'] = 1;
		$result ['msg'] = $rr;
		echo json_encode ( $result,JSON_UNESCAPED_UNICODE);
		exit ();
		}else{
			
		}
		}else{
		
		}
		
		$result ['err_code'] = 1;
		$result ['msg'] = "";
		echo json_encode ( $result,JSON_UNESCAPED_UNICODE);
		exit ();
		
	}
	
}