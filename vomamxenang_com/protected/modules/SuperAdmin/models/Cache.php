<?php

/**
 * This is the model class for table "cache".
 *
 * The followings are the available columns in table 'cache':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $expired
 * @property integer $duration
 */
class Cache extends CActiveRecord {
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Cache the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cache';
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
                'expired, duration',
                'numerical',
                'integerOnly' => true
            ),
            array(
                'name, description',
                'length',
                'max' => 255
            ), // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, name, description, expired, duration',
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
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id'          => 'ID',
            'name'        => 'Name',
            'description' => 'Description',
            'expired'     => 'Expired',
            'duration'    => 'Duration',
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
        $criteria->compare('description', $this->description, true);
        $criteria->compare('expired', $this->expired);
        $criteria->compare('duration', $this->duration);
        $criteria->order = 'id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function usingCache($model, $criteria, $alias = '', $pagingAjax = true, $duration = Cache_Time, $limit = '', $page = 1, $category = '') {
        $limitTrue = is_array($limit) ? 'true' : (is_int($limit) ? 'int-' . $limit : 'false-');
        if ($alias) {
            $cache = 'cache-' . $model . '_duration-' . $duration . '_alias-' . $alias . '_category-' . $category;
        } else {
            $cache = 'cached_' . $model . '_all_limit-' . $limitTrue . '_pagingAjax-' . $pagingAjax . '_duration-' . $duration . '_page-' . $page . '_category-' . $category;
        }
        $paramsForCache = array(
            'name'        => $cache,
            'duration'    => $duration,
            'description' => 'Cache for ' . $model . ' with time=' . $duration
        );
        if (!$pagingAjax) {
            $cacheFile = Yii::app()->cache->get($cache);
            if (!$cacheFile) {
                if (is_array($limit) && $limit) {
                    $criteria->limit = $limit['end'];
                    $criteria->offset = $limit['begin'];
                } elseif (intval($limit))
                    $criteria->limit = $limit;

                $cacheFile = !empty($alias) ? $model::model()->find($criteria) : $model::model()->findAll($criteria);
                Yii::app()->cache->set($cache, $cacheFile, $duration);
            }
        } else {
            $gh = $limit ? $limit : PAGE_SIZE;
            $dependence = self::getCacheDependency($paramsForCache);
            $cacheFile = new CActiveDataProvider($model::model()->cache($duration, $dependence, 2), array(
                'criteria'   => $criteria,
                'pagination' => array(
                    'pageSize' => $gh,
                )
            ));
        }

        return $cacheFile;
    }

    public static function getCacheDependency($params) {
        $name = $params['name'];
        if (empty($name)) {
            return;
        }
        self::create($params);
        $sql = "SELECT expired FROM cache WHERE name='" . $name . "'";
        $dependency = new CDbCacheDependency($sql);

        return $dependency;
    }

    public static function create($params) {
        $name = $params['name'];
        $description = $params['description'];
        $duration = isset($params['duration']) && !empty($params['duration']) ? $params['duration'] : Cache_Time;
        if (empty($name)) {
            return;
        }
        if (!Cache::model()->countByAttributes(array('name' => $name))) {
            $model = new Cache;
            $model->name = $name;
            $model->description = $description;
            $model->expired = time();
            $model->duration = $duration;
            if (!$model->save(false)) {
                return;
            }
        }

        return true;
    }

    static public function rebuildCacheByName($name) {
        if (empty($name)) {
            throw new CHttpException(400, Helper::t('ERROR_ACTION_CODE'));
        }
        Cache::model()->updateAll(array(
            'expired' => date('Y-m-d H:i:s')
        ), 'name=:name', array(
            ':name' => $name
        ));

        return true;
    }
}