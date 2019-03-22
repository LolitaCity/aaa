<?php
    class Aclfilter extends Controller
    {
        /*
            ��ʼ������
        */
        public function init()
        {
            /*
                �ж��û��Ƿ��¼
            */
            if (Yii::app()->user->getId()=="")
            {
                $this->redirect(array ('user/login' ));
                Yii::app()->end();
            }
        }
        
        //�ж��û�Ȩ��
        public function acl(){
            $aclstatue=false;//��ʼ����ֵ״̬Ϊû��Ȩ��
            
            /*
                �ж��û��Ƿ���Ȩ�޸�$aclstatue����bool���͸�ֵ�����
            */
             $admininfo=Admin::model()->findByPk(Yii::app()->user->getId());
             $groupid=$admininfo->groupid;

             if($groupid!=0)//groupid��Ϊ0ʱ��ʾ���ǳ�������Ա��Ҫ����Ȩ���ж�
             {
                 /*
                    ��֤������������ҳ��Ŀ�����ID�뷽��ID����ʽ��default/index
                 */
                 $aclsign=Yii::app()->controller->id."/".$this->getAction()->getId();
                 /*
                    ��ѯ��ǰ�û������û������Ϣ
                 */
                 $acllistArr=explode(',',@Aclgroup::model()->findByPk($groupid)->acllist);
                 array_pop($acllistArr);//�����׵�������һ����Ԫ���Ƴ�

                 /*
                    in_array($aclsign,$acllistArr,true)Ϊ1��ʾ���û����ڵ��û���ӵ��Ȩ�ޣ�null���ʾ���û���û��Ȩ��ִ�иò���
                 */
                 if(in_array(strtolower($aclsign),$acllistArr,true)==null)
                 {
                     /*
                        û��Ȩ��ִ����ʾ����
                     */
                     $this->redirect_message('无权限访问','failed',2,$this->createUrl('default/index'));exit;
                     //$this->redirect(array('acl/passfail'));
                 }
             }
        }
    }
?>