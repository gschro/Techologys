<?php

/**
 * This is the model class for table "questionvalue".
 *
 * The followings are the available columns in table 'questionvalue':
 * @property integer $ID
 * @property integer $LISTINGID
 * @property integer $VALUE
 * @property integer $QUESTIONID
 */
class QuestionValue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'questionvalue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LISTINGID, VALUE, QUESTIONID', 'required'),
			array('LISTINGID, VALUE, QUESTIONID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, LISTINGID, VALUE, QUESTIONID', 'safe', 'on'=>'search'),
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
			'qUESTION' => array(self::BELONGS_TO, 'Question', 'QUESTIONID'),
			'lISTING' => array(self::BELONGS_TO, 'Listing', 'LISTINGID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Id',
			'LISTINGID' => 'Listingid',
			'VALUE' => 'Value',
			'QUESTIONID' => 'Questionid',
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

		$criteria->compare('LISTINGID',$this->LISTINGID);

		$criteria->compare('VALUE',$this->VALUE);

		$criteria->compare('QUESTIONID',$this->QUESTIONID);

		return new CActiveDataProvider('QuestionValue', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return QuestionValue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}