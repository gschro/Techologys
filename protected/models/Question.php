<?php

/**
 * This is the model class for table "question".
 *
 * The followings are the available columns in table 'question':
 * @property integer $ID
 * @property integer $QUESTIONCATEGORYID
 * @property string $QUESTION
 * @property string $NAME
 */
class Question extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'question';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('QUESTIONCATEGORYID, QUESTION, NAME', 'required'),
			array('QUESTIONCATEGORYID', 'numerical', 'integerOnly'=>true),
			array('NAME', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, QUESTIONCATEGORYID, QUESTION, NAME', 'safe', 'on'=>'search'),
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
			'qUESTIONCATEGORY' => array(self::BELONGS_TO, 'Questioncategory', 'QUESTIONCATEGORYID'),
			'questionvalues' => array(self::HAS_MANY, 'Questionvalue', 'QUESTIONID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Id',
			'QUESTIONCATEGORYID' => 'Questioncategoryid',
			'QUESTION' => 'Question',
			'NAME' => 'Name',
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

		$criteria->compare('QUESTIONCATEGORYID',$this->QUESTIONCATEGORYID);

		$criteria->compare('QUESTION',$this->QUESTION,true);

		$criteria->compare('NAME',$this->NAME,true);

		return new CActiveDataProvider('Question', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Question the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}