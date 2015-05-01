<?php

/**
 * This is the model class for table "shop_banner".
 *
 * The followings are the available columns in table 'shop_banner':
 * @property string $id
 * @property string $name
 * @property string $alias
 * @property string $page_link
 * @property string $image
 * @property string $position
 * @property string $page
 * @property string $status
 * @property integer $ordering
 * @property integer $create_date
 * @property integer $expired_date
 */
class Banner extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Banner the static model class
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
		return 'site_banner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, page_link, position', 'required'),
			array('ordering, create_date', 'numerical', 'integerOnly'=>true),
			array('name, alias, page_link', 'length', 'max'=>255),
			array('image', 'length', 'max'=>1000),
			array('position, status', 'length', 'max'=>1),
			array('page', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, alias, info, page_link, image, position, page, status, ordering, create_date, expired_date', 'safe', 'on'=>'search'),
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
			'name' => Helper::t('name'),
			'alias' => 'Alias',
			'info' => Helper::t('info'),
			'page_link' => Helper::t('page_link'),
			'image' => Helper::t('image'),
			'position' => Helper::t('position'),
			'page' => Helper::t('page'),
			'status' => Helper::t('status'),
			'ordering' => Helper::t('ordering'),
			'create_date' => Helper::t('create_date'),
			'expired_date' => Helper::t('expired_date'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('page_link',$this->page_link,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('page',$this->page,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('ordering',$this->ordering);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('expired_date',$this->expired_date);
        $criteria->order = 'id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function beforeSave() {
        $dataPostBanner = Helper::post('Banner');
        if ($this->isNewRecord) {
            $this->status = APPROVED;
            $this->create_date = time();
            $this->expired_date = time() + 3600 * 24 * 365;
            $this->ordering = $this->count() + 1;
        } else {
            if (isset($dataPostBanner['expired_date'])) {
                $this->expired_date = Helper::changeDateToFormat($dataPostBanner['expired_date'], 'm-d-Y');
            }
        }
        $this->page = !empty($dataPostBanner['page']) ? implode(',', $dataPostBanner['page']) : '';
        $this->alias = Helper::unicode_convert($this->name);

        return parent::beforeSave();
    }

    protected function afterFind() {
        $this->expired_date = date('m-d-Y', $this->expired_date);
        $this->page = explode(',', $this->page);

        return parent::afterFind();
    }

    protected function beforeValidate() {
        $postBanner = Helper::post('Banner');
        if (!empty($postBanner['page'])) {
            $this->page = count($postBanner['page']) ? implode(',', $postBanner['page']) : $postBanner['page'];
        }
        if (!$this->isNewRecord) {
            $this->expired_date = Helper::changeDateToFormat($this->expired_date, 'm-d-Y');
        }

        return parent::beforeValidate();
    }
}
