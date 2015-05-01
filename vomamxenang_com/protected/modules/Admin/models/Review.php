<?php

/**
 * This is the model class for table "shop_review".
 *
 * The followings are the available columns in table 'shop_review':
 * @property string $id
 * @property string $full_name
 * @property string $subject
 * @property string $description
 * @property string $status
 * @property integer $create_date
 * @property string $product_id
 * @property double $rating
 * @property string $ip_address
 * @property string   $page
 *
 * The followings are the available model relations:
 * @property Products $product
 */
class Review extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Review the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'shop_review';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('full_name, description', 'required'),
            array('create_date', 'numerical', 'integerOnly' => true),
            array('rating', 'numerical'),
            array('full_name, subject', 'length', 'max' => 255),
            array('status', 'length', 'max' => 1),
            array('page', 'length', 'max' => 15),
            array('product_id', 'length', 'max' => 11),
            array('ip_address', 'length', 'max' => 15), // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, full_name, subject, description, status, page, create_date, product_id, rating, ip_address',
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
            'product' => array(self::BELONGS_TO, 'Products', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'          => 'ID',
            'full_name'   => Helper::t('fullname'),
            'subject'     => Helper::t('subject'),
            'description' => Helper::t('description'),
            'status'      => Helper::t('status'),
            'page'            => Helper::t('page'),
            'create_date' => Helper::t('create_date'),
            'product_id'  => Helper::t('belongToProduct'),
            'rating'      => Helper::t('rating'),
            'ip_address'  => Helper::t('ip_address'),
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
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('create_date', $this->create_date);
        $criteria->compare('product_id', $this->product_id, true);
        $criteria->compare('rating', $this->rating);
        $criteria->compare('ip_address', $this->ip_address, true);
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->ip_address = Helper::getIP();
            $this->create_date = time();
            $this->status = PENDING;
        }
        $this->page = !empty($postProduct['page']) ? implode(',', $postProduct['page']) : '';

        return parent::beforeSave();
    }

    protected function beforeValidate() {
        if (Helper::post('Review')) {
            $postReview = Helper::post('Review');
            $this->page = !empty($postReview['page']) ? implode(',', $postReview['page']) : Helper::post('value');
        }

        return parent::beforeValidate();
    }

    protected function afterFind() {
        $this->page = explode(',', $this->page);

        return parent::afterFind();
    }

    public function saveParams($model, $params, $fk) {
        $model->attributes = $params;
        if ($fk) {
            $model->product_id = $fk;
        }
        if (!$model->save()) {
            throw new CHttpException(400, 'Error while submitting');
        }

        return $model;
    }
}
