<?php

/**
 * This is the model class for table "subcategory".
 *
 * The followings are the available columns in table 'subcategory':
 * @property integer $ID
 * @property string $CATEGORY
 * @property integer $MAINCATEGORYID
 */
class SubCategory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'subcategory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CATEGORY, MAINCATEGORYID', 'required'),
			array('MAINCATEGORYID', 'numerical', 'integerOnly'=>true),
			array('CATEGORY', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, CATEGORY, MAINCATEGORYID', 'safe', 'on'=>'search'),
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
			'listings' => array(self::HAS_MANY, 'Listing', 'SUBCATEGORYID'),
			'mAINCATEGORY' => array(self::BELONGS_TO, 'Maincategory', 'MAINCATEGORYID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Id',
			'CATEGORY' => 'Category',
			'MAINCATEGORYID' => 'Maincategoryid',
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

		$criteria->compare('CATEGORY',$this->CATEGORY,true);

		$criteria->compare('MAINCATEGORYID',$this->MAINCATEGORYID);

		return new CActiveDataProvider('SubCategory', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return SubCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}