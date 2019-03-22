<?php

/**
 * This is the model class for table "{{_blindwangwang}}".
 *
 * The followings are the available columns in table '{{_blindwangwang}}':
 * @property integer $id
 * @property integer $userid
 * @property string $wangwang
 * @property string $wangwanginfo
 * @property integer $statue
 * @property string $ip
 * @property integer $blindtime
 * @property integer $updatetime
 */
class Bindbuyer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bindbuyer the static model class
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
		return '{{_bindbuyer}}';
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
			array('id,userid,statue',  'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'userid' => 'Userid',
			'wangwangid' => 'Wangwangid',
			'account_info' => 'Account_info',
			'addtime' => 'Addtime',
			'wkqimg' => 'Wkqimg',
			'sex' => 'Sex',
			'age' => 'Age',
			'region' => 'Region',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('account_name',$this->account_name,true);
		$criteria->compare('account_info',$this->account_info,true);
		$criteria->compare('updatetime',$this->updatetime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}