<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $ID
 * @property string $TYPE
 * @property integer $ADMIN
 * @property string $DEMOGRAPHICS
 * @property string $POSITION
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TYPE, ADMIN', 'required'),
			array('ADMIN', 'numerical', 'integerOnly'=>true),
			array('TYPE, POSITION', 'length', 'max'=>250),
			array('DEMOGRAPHICS', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, TYPE, ADMIN, DEMOGRAPHICS, POSITION', 'safe', 'on'=>'search'),
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
			'details' => array(self::HAS_MANY, 'Detail', 'USERID'),
			'emailaccounts' => array(self::HAS_MANY, 'Emailaccount', 'USERID'),
			'listings' => array(self::HAS_MANY, 'Listing', 'USERID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Id',
			'TYPE' => 'Type',
			'ADMIN' => 'Admin',
			'DEMOGRAPHICS' => 'Demographics',
			'POSITION' => 'Position',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);

		$criteria->compare('TYPE',$this->TYPE,true);

		$criteria->compare('ADMIN',$this->ADMIN);

		$criteria->compare('DEMOGRAPHICS',$this->DEMOGRAPHICS,true);

		$criteria->compare('POSITION',$this->POSITION,true);

		return new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}