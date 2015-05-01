<?php

/**
 * This is the model class for table "posts".
 *
 * The followings are the available columns in table 'posts':
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $info
 * @property string $description
 * @property string $image
 * @property string $status
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $priority
 */
class Posts extends CActiveRecord
{
    public $_oldTags;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Posts the static model class
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
		return 'posts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, info, tags', 'required'),
			array('create_date, update_date, priority', 'numerical', 'integerOnly'=>true),
			array('title, alias, image, tags', 'length', 'max'=>255),
			array('status', 'length', 'max'=>1),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, alias, info, description, image, status, tags, create_date, update_date, priority', 'safe', 'on'=>'search'),
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
            'comments'           => array(self::HAS_MANY, 'Comments', 'post_id',
                'condition' => 'comments.status=' . APPROVED . ' and comments.is_spam=' . None_Spam
            ),
            'countComment'       => array(self::STAT, 'Comments', 'post_id',
                'condition' => 'status=' . APPROVED,
            ),
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
			'description' => Helper::t('description'),
			'image' => Helper::t('image'),
			'tags' => Helper::t('tags'),
			'status' => Helper::t('status'),
			'create_date' => Helper::t('create_date'),
			'update_date' => Helper::t('update_date'),
			'priority' => Helper::t('priority'),
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('priority',$this->priority);
        $criteria->order = 'id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->create_date = time();
            $this->status = APPROVED;
        } else {

        }

        $this->update_date = time();
        $this->alias = Helper::unicode_convert($this->title);

        return parent::beforeSave();
    }

    protected function afterSave()
    {
        Tags::model()->updateFrequency($this->_oldTags, $this->tags);

        return parent::afterSave();
    }

    protected function beforeDelete() {
        $model = $this->model()->getTableSchema()->name;
        $params = array(
            'folder' => Helper::basePath().'/../uploads/'.strtolower($model),
            'id' => $this->id,
            'model' => ucfirst($model),
            'imageName' => ''
        );
        Helper::deleteImage($params);


        return parent::beforeDelete();
    }

    protected function afterDelete()
    {
        Comment::model()->deleteAll('post_id=' . $this->id);
        Tags::model()->updateFrequency($this->tags, '');

        return parent::afterDelete();
    }

    public function getTagLinks()
    {
        $links = array();
        if (count($this->tags)):
            foreach (Tags::string2array($this->tags) as $tag)
                $links[] = CHtml::link(CHtml::encode($tag), array('/post/index', 'tag' => $tag));
        endif;

        return $links;
    }

    /**
     * Normalizes the user-entered tags.

     */
    public function normalizeTags($attribute, $params)
    {
        $this->tags = Tags::array2string(array_unique(Tags::string2array($this->tags)));
    }

    public function sortPost()
    {
        $i = 1;
        if ($_POST['post']) {
            foreach ($_POST['post'] as $id) {
                Post::model()->updateByPk($id, array('ordering' => $i));
                $i++;
            }
        }
    }
}

