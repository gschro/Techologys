<?php

/**
 * This is the model class for table "emailaccount".
 *
 * The followings are the available columns in table 'emailaccount':
 * @property integer $ID
 * @property integer $USERID
 * @property string $EMAIL
 * @property string $FIRSTNAME
 * @property string $LASTNAME
 * @property string $HASHPASS
 */
class EmailAccount extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'emailaccount';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USERID, EMAIL, FIRSTNAME, LASTNAME, HASHPASS', 'required'),
			array('USERID', 'numerical', 'integerOnly'=>true),
			array('EMAIL, FIRSTNAME, LASTNAME', 'length', 'max'=>250),
			array('HASHPASS', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, USERID, EMAIL, FIRSTNAME, LASTNAME, HASHPASS', 'safe', 'on'=>'search'),
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
			'securityitems' => array(self::HAS_MANY, 'Securityitem', 'EMAILACCOUNTID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Id',
			'USERID' => 'Userid',
			'EMAIL' => 'Email',
			'FIRSTNAME' => 'Firstname',
			'LASTNAME' => 'Lastname',
			'HASHPASS' => 'Hashpass',
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

		$criteria->compare('USERID',$this->USERID);

		$criteria->compare('EMAIL',$this->EMAIL,true);

		$criteria->compare('FIRSTNAME',$this->FIRSTNAME,true);

		$criteria->compare('LASTNAME',$this->LASTNAME,true);

		$criteria->compare('HASHPASS',$this->HASHPASS,true);

		return new CActiveDataProvider('EmailAccount', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return EmailAccount the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}