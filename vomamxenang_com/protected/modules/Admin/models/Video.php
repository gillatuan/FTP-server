<?php

/**
 * This is the model class for table "shop_video".
 *
 * The followings are the available columns in table 'shop_video':
 * @property string $id
 * @property string $name
 * @property string $alias
 * @property string $cate_id
 * @property string $link_youtube
 * @property string $status
 * @property string $page
 * @property integer $create_date
 *
 * The followings are the available model relations:
 * @property Category $cate
 */
class Video extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Video the static model class
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
		return 'site_video';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, link_youtube', 'required'),
			array('create_date, ', 'numerical', 'integerOnly'=>true),
			array('name, alias, link_youtube', 'length', 'max'=>255),
			array('cate_id', 'length', 'max'=>11),
			array('status', 'length', 'max'=>1),
			array('page', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, alias, cate_id, link_youtube, status, page, create_date', 'safe', 'on'=>'search'),
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
			'cate' => array(self::BELONGS_TO, 'Category', 'cate_id'),
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
			'alias' => 'Alias',
			'cate_id' => Helper::t('category'),
			'link_youtube' => Helper::t('linkYoutube'),
			'status' => 'Status',
			'page' => Helper::t('page'),
			'create_date' => Helper::t('created_date'),
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
		$criteria->compare('cate_id',$this->cate_id,true);
		$criteria->compare('link_youtube',$this->link_youtube,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('page',$this->page,true);
		$criteria->compare('create_date',$this->create_date);
        $criteria->order = 'id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->status      = APPROVED;
            $this->create_date = time();
        }
        $this->alias = Helper::unicode_convert($this->name);

        return parent::beforeSave();
    }
}