<?php

/**
 * This is the model class for table "detail".
 *
 * The followings are the available columns in table 'detail':
 * @property integer $ID
 * @property string $TYPE
 * @property integer $USER
 * @property string $VALUE
 * @property integer $USERID
 */
class Detail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TYPE, USER, VALUE, USERID', 'required'),
			array('USER, USERID', 'numerical', 'integerOnly'=>true),
			array('TYPE, VALUE', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, TYPE, USER, VALUE, USERID', 'safe', 'on'=>'search'),
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
			'uSER' => array(self::BELONGS_TO, 'User', 'USERID'),
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
			'USER' => 'User',
			'VALUE' => 'Value',
			'USERID' => 'Userid',
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

		$criteria->compare('USER',$this->USER);

		$criteria->compare('VALUE',$this->VALUE,true);

		$criteria->compare('USERID',$this->USERID);

		return new CActiveDataProvider('Detail', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Detail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}