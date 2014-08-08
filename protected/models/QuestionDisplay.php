<?php

/**
 * This is the model class for table "QUESTIONDISPLAY".
 *
 * The followings are the available columns in table 'QUESTIONDISPLAY':
 * @property integer $ID
 * @property integer $QUESTIONID
 * @property string $DISPLAYVALUE
 * @property string $ACTUALVALUE
 */
class QuestionDisplay extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'questiondisplay';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('QUESTIONID, DISPLAYVALUE, ACTUALVALUE', 'required'),
			array('QUESTIONID', 'numerical', 'integerOnly'=>true),
			array('DISPLAYVALUE, ACTUALVALUE', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, QUESTIONID, DISPLAYVALUE, ACTUALVALUE', 'safe', 'on'=>'search'),
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
			'ID' => 'Id',
			'QUESTIONID' => 'Questionid',
			'DISPLAYVALUE' => 'Displayvalue',
			'ACTUALVALUE' => 'Actualvalue',
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

		$criteria->compare('QUESTIONID',$this->QUESTIONID);

		$criteria->compare('DISPLAYVALUE',$this->DISPLAYVALUE,true);

		$criteria->compare('ACTUALVALUE',$this->ACTUALVALUE,true);

		return new CActiveDataProvider('QuestionDisplay', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return QuestionDisplay the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}