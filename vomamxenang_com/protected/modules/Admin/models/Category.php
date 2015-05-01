<?php



/**
 * This is the model class for table "shop_category".
 *
 * The followings are the available columns in table 'shop_category':
 * @property string     $id
 * @property string     $name
 * @property string     $alias
 * @property string     $description
 * @property string     $image
 * @property integer    $parent_id
 * @property string     $status
 * @property string     $page
 * @property integer    $ordering
 *
 * The followings are the available model relations:
 * @property Products[] $products
 */
class Category extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'shop_category';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'name',
                'required'
            ),
            array(
                'parent_id',
                'numerical',
                'integerOnly' => true
            ),
            array(
                'name, alias, image',
                'length',
                'max' => 255
            ),
            array(
                'status',
                'length',
                'max' => 1
            ),
            array('page', 'length', 'max'=>15),
            array(
                'description',
                'safe'
            ), // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, name, alias, description, image, parent_id, status',
                'safe',
                'on' => 'search'
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'children'      => array(self::HAS_MANY, 'Category', 'parent_id', 'order' => 'id desc'),
            'parent'        => array(self::BELONGS_TO, 'Category', 'parent_id'),
            'products'      => array(self::HAS_MANY, 'Products', 'cate_id'),
            'countChildren' => array(self::STAT, 'Category', 'parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'          => 'ID',
            'name'        => Helper::t('name'),
            'alias'       => 'Alias',
            'description' => Helper::t('description'),
            'image'       => Helper::t('image'),
            'parent_id'   => Helper::t('parent'),
            'status'      => Helper::t('status'),
            'page'      => Helper::t('page'),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('page', $this->page, true);
        $criteria->order = 'id asc';
        $duration        = 1 * 60;
        $cache           = array(
            'name'        => 'cache.Admin.Category',
            'description' => 'Cache for Admin Category',
            'duration'    => $duration
        );
        $cacheDependency = Cache::model()->getCacheDependency($cache);

        return new CActiveDataProvider(Category::model()->cache($duration, $cacheDependency, 2), array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->status = APPROVED;
        }
        $postCate        = Helper::post('Category');
        $this->parent_id = !empty($postCate['parent_id']) ? $postCate['parent_id'] : (!empty($this->parent_id) ? $this->parent_id : 0);
        $this->alias     = Helper::unicode_convert($this->name);
        $this->page = !empty($postCate['page']) ? implode(',', $postCate['page']) : (!empty($this->page) ? $this->page : '');


        return parent::beforeSave();
    }

    protected function afterFind() {
        $this->page = explode(',', $this->page);

        return parent::afterFind();
    }

    protected function beforeValidate() {
        $postCate = Helper::post('Category');
        if (!empty($postCate['page'])) {
            $this->page = count($postCate['page']) ? implode(',', $postCate['page']) : $postCate['page'];
        }

        return parent::beforeValidate();
    }
}