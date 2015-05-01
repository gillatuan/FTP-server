<?php

/**
 * This is the model class for table "tbl_qa".
 *
 * The followings are the available columns in table 'tbl_qa':
 * @property string $id
 * @property string $subject
 * @property string $content
 * @property string $full_name
 * @property string $parent_id
 * @property string $user_id
 * @property string $status
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Qa extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Qa the static model class
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
		return 'site_qa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('full_name', 'required'),
			array('subject, full_name', 'length', 'max'=>255),
			array('parent_id, user_id', 'length', 'max'=>11),
			array('status', 'length', 'max'=>1),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, subject, content, full_name, parent_id, user_id, status, create_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subject' => 'Tiêu đề',
			'content' => 'Nội dung',
			'full_name' => 'Họ và tên',
			'parent_id' => 'Parent',
			'user_id' => 'User',
			'status' => 'Status',
			'create_date' => 'Create Date',
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
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_date',$this->create_date,true);
        $criteria->order = 'id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function beforeValidate() {
        if (Helper::post('current')) {
            $this->parent_id = Helper::post('current') ? Helper::post('current') : 0;
        } elseif (Helper::get('parent') ) {
            $this->parent_id = Helper::get('parent') > 0 ? Helper::get('parent') : 0;
        }

        $dataQA = Helper::post('Qa');
        $this->full_name = Helper::user()->id ? Helper::user()->name : $dataQA['full_name'];

        return parent::beforeValidate();
    }

    protected function beforeSave() {
        $this->status = APPROVED;
        $this->user_id = Helper::user()->id ? Helper::user()->id : '';
        $this->create_date = time();

        return parent::beforeSave();
    }
}