<?php

/**
 * This is the model class for table "listing".
 *
 * The followings are the available columns in table 'listing':
 * @property integer $ID
 * @property integer $USERID
 * @property integer $SUBCATEGORYID
 * @property string $NAME
 * @property string $DESC
 * @property string $PATENTSTATUS
 * @property integer $LISTAGREEMENT
 * @property integer $RIGHTS
 * @property string $RIGHTSDETAILS
 * @property integer $TOTALSCORE
 * @property integer $VISIBLE
 */
class Listing extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'listing';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USERID, SUBCATEGORYID, NAME, DESC, PATENTSTATUS, LISTAGREEMENT, RIGHTS, RIGHTSDETAILS, TOTALSCORE', 'required'),
			array('USERID, SUBCATEGORYID, LISTAGREEMENT, RIGHTS, TOTALSCORE, VISIBLE', 'numerical', 'integerOnly'=>true),
			array('NAME', 'length', 'max'=>250),
			array('PATENTSTATUS', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, USERID, SUBCATEGORYID, NAME, DESC, PATENTSTATUS, LISTAGREEMENT, RIGHTS, RIGHTSDETAILS, TOTALSCORE, VISIBLE', 'safe', 'on'=>'search'),
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
			'sUBCATEGORY' => array(self::BELONGS_TO, 'Subcategory', 'SUBCATEGORYID'),
			'questionvalues' => array(self::HAS_MANY, 'Questionvalue', 'LISTINGID'),
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
			'SUBCATEGORYID' => 'Subcategoryid',
			'NAME' => 'Name',
			'DESC' => 'Desc',
			'PATENTSTATUS' => 'Patentstatus',
			'LISTAGREEMENT' => 'Listagreement',
			'RIGHTS' => 'Rights',
			'RIGHTSDETAILS' => 'Rightsdetails',
			'TOTALSCORE' => 'Totalscore',
			'VISIBLE' => 'Visible',
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

		$criteria->compare('SUBCATEGORYID',$this->SUBCATEGORYID);

		$criteria->compare('NAME',$this->NAME,true);

		$criteria->compare('DESC',$this->DESC,true);

		$criteria->compare('PATENTSTATUS',$this->PATENTSTATUS,true);

		$criteria->compare('LISTAGREEMENT',$this->LISTAGREEMENT);

		$criteria->compare('RIGHTS',$this->RIGHTS);

		$criteria->compare('RIGHTSDETAILS',$this->RIGHTSDETAILS,true);

		$criteria->compare('TOTALSCORE',$this->TOTALSCORE);

		$criteria->compare('VISIBLE',$this->VISIBLE);

		return new CActiveDataProvider('Listing', array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @return Listing the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}