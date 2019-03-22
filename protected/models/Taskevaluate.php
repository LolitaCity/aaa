<?php

/**
 * This is the model class for table "{{_aclgroup}}".
 *
 * The followings are the available columns in table '{{_aclgroup}}':
 * @property integer $id
 * @property string $groupname
 * @property string $acllist
 */
class Taskevaluate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Aclgroup the static model class
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
		return '{{_taskevaluate}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
        return array(
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id,usertaskid', 'safe', 'on'=>'search'),
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
			'id' => 'ID'
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


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}