<?php

/**
 * This is the model class for table "categorypair".
 *
 * The followings are the available columns in table 'categorypair':
 * @property integer $ID
 * @property integer $CATEGORY1ID
 * @property integer $CATEGORY2ID
 */
class CategoryPair extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'categorypair';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CATEGORY1ID, CATEGORY2ID', 'required'),
			array('CATEGORY1ID, CATEGORY2ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, CATEGORY1ID, CATEGORY2ID', 'safe', 'on'=>'search'),
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
			'CATEGORY1ID' => 'Category1',
			'CATEGORY2ID' => 'Category2',
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

		$criteria->compare('CATEGORY1ID',$this->CATEGORY1ID);

		$criteria->compare('CATEGORY2ID',$this->CATEGORY2ID);

		return new CActiveDataProvider('CategoryPair', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return CategoryPair the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}