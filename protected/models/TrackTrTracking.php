<?php

/**
 * This is the model class for table "track_tr_tracking".
 *
 * The followings are the available columns in table 'track_tr_tracking':
 * @property integer $id
 * @property string $lote
 * @property string $receipt
 * @property string $manifest
 * @property string $awb
 * @property string $date
 * @property string $shipper
 * @property string $account_rg
 * @property string $account_id
 * @property string $consignee
 * @property integer $pieces
 * @property string $weight_lb
 * @property string $weight_kg
 * @property string $tracking
 * @property string $value
 * @property string $comodity
 * @property string $dimm_in
 * @property string $dimm_cm
 * @property string $comment
 * @property string $timestamp
 */
class TrackTrTracking extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TrackTrTracking the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'track_tr_tracking';
	}

	/** Funcion para dar formato a la fecha antes de guardarlo en la base de datos**/
	public function beforeSave()
	{
		if(parent::beforeSave())
		{

		$this->date= Yii::app()->dateFormatter->format("yyyy-MM-dd hh:mm:ss",$this->date);
		parent::beforeSave();

		return true;
		}
		else return false;
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lote, tracking, timestamp', 'required'),
			array('pieces', 'numerical', 'integerOnly'=>true),
			array('lote', 'length', 'max'=>32),
			array('receipt, manifest, awb, comodity, dimm_in, dimm_cm', 'length', 'max'=>128),
			array('shipper, consignee, tracking, comment', 'length', 'max'=>256),
			array('account_rg, account_id', 'length', 'max'=>64),
			array('weight_lb, weight_kg, value', 'length', 'max'=>10),
			array('date', 'safe'),
			//Permite el timestamp al actualizar un registro
			array('timestamp', 'default', 'value'=>new CDbExpression('NOW()'),
					'setOnEmpty'=>false,
					'on'=>'update'
				),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, lote, receipt, manifest, awb, date, shipper, account_rg, account_id, consignee, pieces, weight_lb, weight_kg, tracking, value, comodity, dimm_in, dimm_cm, comment, timestamp', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'lote' => 'Lote',
			'receipt' => 'Receipt',
			'manifest' => 'Manifest',
			'awb' => 'Awb',
			'date' => 'Date',
			'shipper' => 'Shipper',
			'account_rg' => 'Account Rg',
			'account_id' => 'Account',
			'consignee' => 'Consignee',
			'pieces' => 'Pieces',
			'weight_lb' => 'Weight Lb',
			'weight_kg' => 'Weight Kg',
			'tracking' => 'Tracking',
			'value' => 'Value',
			'comodity' => 'Comodity',
			'dimm_in' => 'Dimm In',
			'dimm_cm' => 'Dimm Cm',
			'comment' => 'Comment',
			'timestamp' => 'Timestamp',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('lote',$this->lote,true);
		$criteria->compare('receipt',$this->receipt,true);
		$criteria->compare('manifest',$this->manifest,true);
		$criteria->compare('awb',$this->awb,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('shipper',$this->shipper,true);
		$criteria->compare('account_rg',$this->account_rg,true);
		$criteria->compare('account_id',$this->account_id,true);
		$criteria->compare('consignee',$this->consignee,true);
		$criteria->compare('pieces',$this->pieces);
		$criteria->compare('weight_lb',$this->weight_lb,true);
		$criteria->compare('weight_kg',$this->weight_kg,true);
		$criteria->compare('tracking',$this->tracking,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('comodity',$this->comodity,true);
		$criteria->compare('dimm_in',$this->dimm_in,true);
		$criteria->compare('dimm_cm',$this->dimm_cm,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('timestamp',$this->timestamp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}