<?php

/**
 * This is the model class for table "stocks".
 *
 * The followings are the available columns in table 'stocks':
 * @property integer $ID
 * @property integer $SUBCATEGORYID
 * @property string $NAME
 * @property string $SYMBOL
 * @property double $PRICE
 * @property string $LASTUPDATED
 */
class Stocks extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'stocks';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SUBCATEGORYID, NAME, SYMBOL, PRICE, LASTUPDATED', 'required'),
			array('SUBCATEGORYID', 'numerical', 'integerOnly'=>true),
			array('PRICE', 'numerical'),
			array('NAME', 'length', 'max'=>255),
			array('SYMBOL', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, SUBCATEGORYID, NAME, SYMBOL, PRICE, LASTUPDATED', 'safe', 'on'=>'search'),
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
			'SUBCATEGORYID' => 'Subcategoryid',
			'NAME' => 'Name',
			'SYMBOL' => 'Symbol',
			'PRICE' => 'Price',
			'LASTUPDATED' => 'Lastupdated',
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

		$criteria->compare('SUBCATEGORYID',$this->SUBCATEGORYID);

		$criteria->compare('NAME',$this->NAME,true);

		$criteria->compare('SYMBOL',$this->SYMBOL,true);

		$criteria->compare('PRICE',$this->PRICE);

		$criteria->compare('LASTUPDATED',$this->LASTUPDATED,true);

		return new CActiveDataProvider('Stocks', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Stocks the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}