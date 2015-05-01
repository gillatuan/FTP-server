<?php



/**
 * This is the model class for table "shop_products".
 *
 * The followings are the available columns in table 'shop_products':
 * @property string   $id
 * @property string   $cate_id
 * @property string   $name
 * @property string   $alias
 * @property string   $info
 * @property string   $barcode
 * @property string   $description
 * @property string   $image
 * @property double   $price_curr
 * @property double   $price
 * @property string   $is_sale_off
 * @property integer  $total_buy
 * @property string   $is_popular
 * @property string   $page
 * @property string   $status
 * @property integer  $create_date
 *
 * The followings are the available model relations:
 * @property Category $cate
 */
class Products extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Products the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'shop_products';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cate_id, name, quantity', 'required'),
            array('total_buy, create_date, quantity', 'numerical', 'integerOnly' => true),
            array('price_curr, price, discount', 'numerical'),
            array('cate_id', 'length', 'max' => 11),
            array('name, alias', 'length', 'max' => 255),
            array('image', 'length', 'max' => 500),
            array('is_sale_off, status, is_popular', 'length', 'max' => 1),
            array('barcode', 'length', 'max' => 10),
            array('page', 'length', 'max' => 15),
            array('description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, cate_id, name, alias, info, description, image, price_curr, price, barcode, quantity, discount, is_sale_off, total_buy, status, page, is_popular, create_date',
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
            'cate'        => array(self::BELONGS_TO, 'Category', 'cate_id'),
            'review'      => array(self::HAS_MANY, 'Review', 'product_id'),
            'countReview' => array(self::STAT, 'Review', 'product_id', 'condition' => 'status=' . APPROVED),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'          => 'ID',
            'cate_id'     => Helper::t('category'),
            'name'        => Helper::t('name'),
            'alias'       => 'Alias',
            'info'        => Helper::t('info'),
            'description' => Helper::t('description'),
            'image'       => Helper::t('image'),
            'price_curr'       => Helper::t('price_curr'),
            'price'       => Helper::t('price'),
            'barcode'       => Helper::t('barcode'),
            'quantity'    => Helper::t('quantity'),
            'discount'    => Helper::t('discount'),
            'is_sale_off' => Helper::t('is_sale_off'),
            'total_buy'   => Helper::t('total_buy'),
            'page'        => Helper::t('page'),
            'is_popular'  => Helper::t('is_popular'),
            'status'      => Helper::t('status'),
            'create_date' => Helper::t('create_date'),
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
        $criteria->compare('cate_id', $this->cate_id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('info', $this->info, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('price_curr', $this->price_curr);
        $criteria->compare('price', $this->price);
        $criteria->compare('barcode', $this->barcode);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('discount', $this->discount);
        $criteria->compare('is_sale_off', $this->is_sale_off, true);
        $criteria->compare('total_buy', $this->total_buy);
        $criteria->compare('page', $this->page, true);
        $criteria->compare('is_popular', $this->is_popular, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('create_date', $this->create_date);
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array('criteria' => $criteria,));
    }

    protected function beforeSave() {
        $postProduct = Helper::post('Products');
        if ($postProduct) {
            if ($this->isNewRecord) {
                $this->status      = APPROVED;
                $this->create_date = time();
                $this->alias = Helper::unicode_convert($postProduct['name']);
            }
            $this->page = is_array($postProduct['page']) ? implode(',', $postProduct['page']) : '';
        }

        return parent::beforeSave();
    }

    protected function afterSave() {
        $cate = Category::model()->find('id=:id', array(':id' => $this->cate_id));

        $this->updateByPk($this->id, array(
            'cate_name' => $cate->name
        ));
    }

    protected function beforeValidate() {
        if (Helper::post('Products')) {
            $postProduct = Helper::post('Products');
            $this->page = !empty($postProduct['page']) ? implode(',', $postProduct['page']) : Helper::post('value');
        }

        return parent::beforeValidate();
    }

    protected function afterFind() {
        $this->page = explode(',', $this->page);

        return parent::afterFind();
    }

    public function createCriteria($category = '', $alias = '', $tab = '', $limit = '', $orderBy = 'id DESC') {
        $criteria = new CDbCriteria();
        $criteria->compare('t.status', APPROVED);
        if ($category) {
            $criteriaCate = new CDbCriteria();
            $criteriaCate->compare('alias', $category);
            $cate = Cache::usingCache('Category', $criteriaCate, $category, false);
            $criteria->compare('cate_id', $cate->id);
        }
        if ($alias) {
            $criteria->compare('t.alias', $alias);
        }
        if ($tab == 'popular-items') {
            $criteria->compare('total_buy', '>= 5');
        } elseif ($tab == 'sale-off-items') {
            $criteria->compare('is_sale_off', true);
            $criteria->compare('discount', '> 0');
        }
        if (is_array($limit) && $limit) {
            $criteria->limit  = $limit['end'];
            $criteria->offset = $limit['begin'];
        } elseif (intval($limit)) {
            $criteria->limit = $limit;
        }
        $criteria->order = $orderBy;

        return $criteria;
    }

    public function updateQuantityAndTotalBuy($alias, $quantity, $category = '') {
        $criteria = $this->createCriteria($category, $alias);
        $product  = $this->find($criteria);
        $this->updateByPk($product->id, array('total_buy' => $product->total_buy + $quantity, 'quantity' => $product->quantity - $quantity));
    }

    public function averageRating() {
        $reviews       = Review::model()->findAllByAttributes(array('product_id' => $this->id));
        $averageRating = '';
        if (count($reviews)) {
            foreach ($reviews as $review) {
                $rating[] = $review->rating;
            }
            $averageRating = array_sum($rating) / count($reviews);
        }

        return round($averageRating, 0);
    }
}
