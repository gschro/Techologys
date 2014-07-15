<?php

/**
 * This is the model class for table "questionpair".
 *
 * The followings are the available columns in table 'questionpair':
 * @property integer $ID
 * @property integer $QUESTION1ID
 * @property integer $QUESTION2ID
 */
class QuestionPair extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'questionpair';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('QUESTION1ID, QUESTION2ID', 'required'),
			array('QUESTION1ID, QUESTION2ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, QUESTION1ID, QUESTION2ID', 'safe', 'on'=>'search'),
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
			'qUESTION2' => array(self::BELONGS_TO, 'Question', 'QUESTION2ID'),
			'qUESTION1' => array(self::BELONGS_TO, 'Question', 'QUESTION1ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Id',
			'QUESTION1ID' => 'Question1',
			'QUESTION2ID' => 'Question2',
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

		$criteria->compare('QUESTION1ID',$this->QUESTION1ID);

		$criteria->compare('QUESTION2ID',$this->QUESTION2ID);

		return new CActiveDataProvider('QuestionPair', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return QuestionPair the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}