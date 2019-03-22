<?php

/**
 * This is the model class for table "{{_loginlog}}".
 *
 * The followings are the available columns in table '{{_loginlog}}':
 * @property integer $id
 * @property integer $userid
 * @property string $username
 * @property string $loginplace
 * @property string $loginip
 * @property integer $time
 */
class Shop extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Loginlog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_shop}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sid, userid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sid' => 'Sid',
			'userid' => 'Userid',
			'type' => 'Type',
			'manager_num' => 'Manager_num',
			'shopname' => 'Shopname',
			'nature' => 'Nature',
			'sendname' => 'Sendname',
			'sendphone' => 'Sendphone',
			'sendarea' => 'Sendarea',
			'sendprovince' => 'Sendprovince',
			'sendcity' => 'Sendcity',
			'senddistrict' => 'Senddistrict',
			'sendaddress' => 'Sendaddress',
			'images' => 'Images',
			'addtime' => 'Addtime',
			'addIP' => 'AddIP',
			'status' => 'Status',
			'auditing' => 'Auditing',
			'auditingtime' => 'Auditingtime',
			'uid' => 'Uid',
			'remark' => 'Remark',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('sid',$this->sid);
		$criteria->compare('userid',$this->userid);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}