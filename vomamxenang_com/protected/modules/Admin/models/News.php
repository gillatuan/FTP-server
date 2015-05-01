<?php

/**
 * This is the model class for table "tbl_news".
 *
 * The followings are the available columns in table 'tbl_news':
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $info
 * @property string $content
 * @property string $image
 * @property string $status
 * @property integer $create_date
 * @property integer $update_date
 * @property string $type_news
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className='News')
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'shop_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, info', 'required'),
			array('create_date, update_date', 'numerical', 'integerOnly'=>true),
			array('title, alias, image', 'length', 'max'=>255),
			array('status, type_news', 'length', 'max'=>1),
            array('page', 'length', 'max' => 15),
            array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, alias, info, content, image, status, create_date, update_date, type_news, page', 'safe', 'on'=>'search'),
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
			'title' => Helper::t('title'),
			'alias' => 'Alias',
			'info' => Helper::t('info'),
			'content' => Helper::t('content'),
			'image' => Helper::t('image'),
			'status' => Helper::t('status'),
			'create_date' => Helper::t('create_date'),
			'update_date' => Helper::t('update_date'),
			'type_news' => Helper::t('type_news'),
            'page'        => Helper::t('page'),
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
        $criteria->compare('title',$this->title,true);
        $criteria->compare('alias',$this->alias,true);
        $criteria->compare('info',$this->info,true);
        $criteria->compare('content',$this->content,true);
        $criteria->compare('image',$this->image,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('create_date',$this->create_date);
        $criteria->compare('update_date',$this->update_date);
        $criteria->compare('type_news',$this->type_news,true);
        $criteria->compare('page', $this->page, true);

        if (Helper::get('type')) {
            $criteria->compare('type_news', Helper::get('type'));
        }
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public function sortPost()
    {
        $i = 1;
        if (Helper::post('News')) {
            foreach (Helper::post('News') as $id) {
                News::model()->updateByPk($id, array('ordering' => $i));
                $i++;
            }
        }
    }

    protected function beforeValidate() {
        if (Helper::post('News') || Helper::post('attr') == 'page') {
            $postProduct = Helper::post('News');
            $this->page = $postProduct ? implode(',', $postProduct['page']) : Helper::post('value');
        }

        return parent::beforeValidate();
    }

    protected function afterFind() {
        $this->page = explode(',', $this->page);

        return parent::afterFind();
    }

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->create_date = $this->update_date = time();
        }

        $this->alias = Helper::unicode_convert($this->title);
        $this->status = APPROVED;
        $this->update_date = time();
        $this->type_news = Helper::get('type');

        return parent::beforeSave();
    }

    protected function beforeDelete() {
        $model = 'News';
        if (is_dir(Helper::basePath().'/../uploads/Tbl_news')) {
            $params = array(
                'folder' => Helper::basePath().'/../uploads/Tbl_news',
                'id' => $this->id,
                'model' => ucfirst($model),
                'imageName' => 'image'
            );
            Helper::deleteImage($params);
        }

        return parent::beforeDelete();
    }
}
