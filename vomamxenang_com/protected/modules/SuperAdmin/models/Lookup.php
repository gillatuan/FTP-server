<?php

class Lookup extends CActiveRecord {
    /**
     * The followings are the available columns in table 'tbl_lookup':
     * @var integer $id
     * @var string $object_type
     * @var integer $code
     * @var string $name_en
     * @var string $name_fr
     * @var integer $sequence
     * @var integer $status
     */
    private static $_items = array();

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'lookup';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'name, code, type',
                'required'
            ),
            array(
                'position',
                'numerical',
                'integerOnly' => true
            ),
            array(
                'name, type',
                'length',
                'max' => 128
            ), // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, name, code, type, position',
                'safe',
                'on' => 'search'
            ),
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
        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('code', $this->code, true);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('position', $this->position);
        $criteria->order = 'id DESC';

        return new CActiveDataProvider(get_class($this), array(
            'criteria'   => $criteria,
            'pagination' => array(
                'pageSize' => BO_PAGE_SIZE
            )
        ));
    }

    /**
     * list all types of Lookup table, used for workflow: Setting > Lookup
     *
     */
    public static function types() {
        $data = array();
        $models = self::model()->findAll(array(
            'select'   => 'type',
            'distinct' => true,
            'order'    => 'type ASC'
        ));
        foreach ($models as $model) {
            $data[$model->type] = $model->type;
        }

        return $data;
    }

    /**
     * Get the first type of types list(order by type asc)
     *
     */
    public static function firstType() {
        return self::model()->find(array(
            'select'   => 'type',
            'distinct' => true,
            'order'    => 'type ASC'
        ))->type;
    }

    /**
     * Returns the items for the specified type.
     * @param string item type (e.g. 'PostStatus').
     * @return array item names indexed by item code. The items are order by their position values.
     * An empty array is returned if the item type does not exist.
     */
    public static function items($type) {
        if (!isset(self::$_items[$type])) {
            self::loadItems($type);
        }

        return self::$_items[$type];
    }

    /**
     * Returns the item name for the specified type and code.
     * @param string  the item type (e.g. 'PostStatus').
     * @param integer the item code (corresponding to the 'code' column value)
     * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
     */
    public static function item($type, $code) {
        if (!isset(self::$_items[$type])) {
            self::loadItems($type);
        }

        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }

    /**
     * Loads the lookup items for the specified type from the database.
     * @param string the item type
     */
    private static function loadItems($type) {
        self::$_items[$type] = array();
        $models = self::model()->findAll(array(
            'condition' => 'type=:type',
            'params'    => array(':type' => $type),
            'order'     => 'position',
        ));
        foreach ($models as $model)
            self::$_items[$type][$model->code] = $model->name;
    }
}