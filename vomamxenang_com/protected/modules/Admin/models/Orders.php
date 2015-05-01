<?php



/**
 * This is the model class for table "shop_order".
 *
 * The followings are the available columns in table 'shop_order':
 * @property string $id
 * @property string $bill_to
 * @property string $ship_to
 * @property string $cart
 * @property string $info
 * @property string $status
 * @property string $order_status
 * @property integer $create_date
 */
class Orders extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Order the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'shop_orders';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('bill_to, ship_to, cart', 'required'),
            array('create_date', 'numerical', 'integerOnly' => true),
            array('bill_to, ship_to', 'length', 'max' => 1000),
            array('status, order_status', 'length', 'max' => 1),
            array('info, cart', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, bill_to, ship_to, cart, info, status, order_status, create_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'           => 'ID',
            'bill_to'      => Helper::t('bill_to'),
            'ship_to'      => Helper::t('ship_to'),
            'cart'         => Helper::t('cart'),
            'info'         => Helper::t('info'),
            'status'       => Helper::t('status'),
            'order_status' => Helper::t('order_status'),
            'create_date'  => Helper::t('create_date'),
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
        $criteria->compare('bill_to', $this->bill_to, true);
        $criteria->compare('ship_to', $this->ship_to, true);
        $criteria->compare('cart', $this->cart, true);
        $criteria->compare('info', $this->info, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('order_status', $this->order_status, true);
        $criteria->compare('create_date', $this->create_date);
        $criteria->order = 'id desc';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->status = PENDING;
            $this->order_status = PENDING;
            $this->create_date = time();
        }

        return parent::beforeSave();
    }

    public function insertToOrder($billTo, $shipTo, $cart, $info) {
        $modelOrder = new Orders();
        $modelOrder->bill_to = json_encode($billTo);
        $modelOrder->ship_to = json_encode($shipTo);
        $modelOrder->cart = json_encode($cart);
        $modelOrder->info = $info;
        $modelOrder->save(false);
    }
}