<?php

/**
 * This is the model class for table "categorypair".
 *
 * The followings are the available columns in table 'categorypair':
 * @property integer $ID
 * @property integer $PAIRINGID
 * @property integer $CATEGORYID
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
			array('PAIRINGID, CATEGORYID', 'required'),
			array('PAIRINGID, CATEGORYID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, PAIRINGID, CATEGORYID', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Questioncategory', 'CATEGORYID'),
			'pairing' => array(self::BELONGS_TO, 'Pairing', 'PAIRINGID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Id',
			'PAIRINGID' => 'Pairingid',
			'CATEGORYID' => 'Categoryid',
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

		$criteria->compare('PAIRINGID',$this->PAIRINGID);

		$criteria->compare('CATEGORYID',$this->CATEGORYID);

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