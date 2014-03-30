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
 * @property integer $PSALT
 * @property integer $HASHPASS
 * @property string $SECURITYQ1
 * @property string $SECURITYQ2
 * @property integer $SECURITYQ1HASH
 * @property integer $SECURITYQ2HASH
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
			array('USERID, EMAIL, FIRSTNAME, LASTNAME, PSALT, HASHPASS, SECURITYQ1, SECURITYQ2, SECURITYQ1HASH, SECURITYQ2HASH', 'required'),
			array('USERID, PSALT, HASHPASS, SECURITYQ1HASH, SECURITYQ2HASH', 'numerical', 'integerOnly'=>true),
			array('EMAIL, FIRSTNAME, LASTNAME', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, USERID, EMAIL, FIRSTNAME, LASTNAME, PSALT, HASHPASS, SECURITYQ1, SECURITYQ2, SECURITYQ1HASH, SECURITYQ2HASH', 'safe', 'on'=>'search'),
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
			'USERID' => 'Userid',
			'EMAIL' => 'Email',
			'FIRSTNAME' => 'Firstname',
			'LASTNAME' => 'Lastname',
			'PSALT' => 'Psalt',
			'HASHPASS' => 'Hashpass',
			'SECURITYQ1' => 'Securityq1',
			'SECURITYQ2' => 'Securityq2',
			'SECURITYQ1HASH' => 'Securityq1 Hash',
			'SECURITYQ2HASH' => 'Securityq2 Hash',
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

		$criteria->compare('PSALT',$this->PSALT);

		$criteria->compare('HASHPASS',$this->HASHPASS);

		$criteria->compare('SECURITYQ1',$this->SECURITYQ1,true);

		$criteria->compare('SECURITYQ2',$this->SECURITYQ2,true);

		$criteria->compare('SECURITYQ1HASH',$this->SECURITYQ1HASH);

		$criteria->compare('SECURITYQ2HASH',$this->SECURITYQ2HASH);

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