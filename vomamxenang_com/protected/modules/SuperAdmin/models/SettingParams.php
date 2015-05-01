<?php

/**
 * This is the model class for table "setting_params".
 *
 * The followings are the available columns in table 'setting_params':
 * @property integer $id
 * @property string $name
 * @property string $label
 * @property string $values
 * @property string $description
 * @property string $setting_group
 * @property integer $ordering
 * @property string $visible
 * @property string $module
 */
class SettingParams extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SettingParams the static model class
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
		return 'setting_params';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, values', 'required'),
			array('ordering', 'numerical', 'integerOnly'=>true),
			array('name, label, module', 'length', 'max'=>64),
			array('setting_group', 'length', 'max'=>128),
			array('visible', 'length', 'max'=>1),
			array('values, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, label, values, description, setting_group, ordering, visible, module', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'label' => 'Label',
			'values' => 'Values',
			'description' => 'Description',
			'setting_group' => 'Setting Group',
			'ordering' => 'Ordering',
			'visible' => 'Visible',
			'module' => 'Module',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('values',$this->values,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('setting_group',$this->setting_group,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('visible',$this->visible,true);
		$criteria->compare('module',$this->module,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->visible = APPROVED;
        }

        return parent::beforeSave();
    }
}