<?php
/**
 * Created by PhpStorm.
 * User: mrcardoso
 * Date: 25/12/15
 * Time: 03:20
 */

namespace app\commands;

use app\models\CorporateRegister;
use app\models\User;
use yii\base\Exception;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property string $created_at
 * @property string $updated_at
 * @property integer $user_id
 * @property integer $corporate_register_id
 *
 */
class MyModel extends ActiveRecord
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    public $changes = NULL;
    /**
     * the current class where the method search is run
     * @var
     */
    protected $_model;
    /**
     * load the rules to the model children
     * @var
     */
    protected $_validator;
    /**
     * load the labels to the model children
     * @var
     */
    protected $_label;
    /**
     * load the relations that child model goes need
     * @var array
     */
    protected $_with = [];
    /**
     * define the limit of the pagination
     * @var int
     */
    protected $_limit = 6;
    /**
     * define the order by
     * @var string
     */
    protected $_order = "id DESC";
    /**
     * define the filter use in the search
     * @var array
     */
    protected $_filters = [ 'equal' => [], 'like' => [] ];
    /**
     * validate if the search and create|update will have filter of the corporate_register
     * @var bool
     */
    protected $_withCorporate = true;
    /**
     * validate if the search and create|update will have filter of the user_id
     * @var bool
     */
    protected $_withUser = true;
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return $this->_validator;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge($this->_label,['changes' => t('changes')]);
    }
    /**
     * run action to each record found
     */
    public function afterFind()
    {
        $this->changes = join(' ', [t('created_at'),$this->created_at,"|",t("updated_at"),$this->updated_at]);
        parent::afterFind();
    }

    public function validateNoMask($attribute, $params)
    {
        $lengthMax = ( $attribute== "cpf" ? 11 : 14 );
        $this->{$attribute} = preg_replace("/(_|\.|\)|\(|\/|-| )/", '', $this->{$attribute});

        if( strlen($this->{$attribute}) > $lengthMax )
            $this->addError($attribute, t('the {attribute} can not be greater than {length}', ['attribute' => $attribute,'length' => $lengthMax]));
        else
            return true;
    }
    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if ($this->isNewRecord)
            {
                if( $this->_withCorporate && ( $identity = self::corporateId() ) != 0 )
                    $this->corporate_register_id = $identity;

                if( $this->_withUser && ( $identity = self::corporateId('id') ) != 0 )
                    $this->user_id = $identity;

                $this->created_at = date("Y-m-d H:i:s");
            }
            $this->updated_at = date("Y-m-d H:i:s");
            return true;
        }
        return false;
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     *
     * @throws Exception
     */
    public function search($params)
    {
        if( $this->_model == NULL )
            throw new Exception("the attribute '_model' is required");

        $dataProvider = new ActiveDataProvider([
            'query' => $this->_model->orderBy($this->_order),
            'pagination' => [
                'pageSize' => $this->_limit,
            ],
        ]);

        $this->load($params);

        if (!$this->validate())
            return $dataProvider;

        if( !empty($this->_with) )
            $this->_model->joinWith($this->_with);

        $equals = [];
        // filters equal
        foreach($this->_filters["equal"] as $field => $filter)
        {
            $column = ( gettype($field) == "string" ? $field : $filter);
            if(substr_count($filter,'filter:') > 0)
            {
                $validate = explode(':', $filter)[1];
                $validField = $validate($this->{$column});
            }
            else
            {
                $validField = $this->{$filter};
            }
            $equals[$column] = $validField;
        }
        if( ($identity = self::corporateId()) != 0 )
        {
            if(className($this) != 'User' || !checkGroup("admin"))
                $this->_model->andFilterWhere(['corporate_register_id' => $identity]);
        }

        if( isset($this->_filters["other"]) )
            $equals = array_merge($equals, $this->_filters["other"]);

        $this->_model->andFilterWhere($equals);
        // filters like
        foreach($this->_filters["like"] as $field => $filter)
        {
            $column = ( gettype($field) == "string" ? $field : $filter);
            $this->_model->andFilterWhere(['like', $column, $this->{$filter}]);
        }
        return $dataProvider;
    }
    /*
     | --------------------------------------------------------------------------------------------
     | My Methods of the model
     | --------------------------------------------------------------------------------------------
     */
    /**
     * generate an arrayList of the corporates to use on dropDown in the view
     * @param bool|true $withoutAdmin
     * @return array
     */
    public function arrayCorporateRegister($withoutAdmin = true)
    {
        $corporate = CorporateRegister::find()->where(["status" => 1]);

        if( $withoutAdmin )
            $corporate->andWhere(["<>", "code", "admin_management"]);

        if( ($identity = self::corporateId()) != 0 && !checkGroup("admin") )
            $corporate->andWhere(["id" => $identity]);

        return ArrayHelper::map( $corporate->all(), 'id', 'name');
    }

    /**
     * list an array with [id => name] of the model specified, filter by corporate of the user authenticated
     * @param $model
     * @param $where
     * @return array
     */
    public function arrayListModel($model, $where = [])
    {
        $query = $model::find()
            ->where(['status'=> self::ACTIVE])
            ->andWhere($this->corporateFilter());
        if( !empty($where) )
            $query->andWhere($where);
        return ArrayHelper::map($query->all(),'id','name');
    }

    /**
     * generate an arrayList of the ids of the employees of the company authenticate
     * @return array
     */
    public static function employeeByCompany()
    {
        return ArrayHelper::map(
            User::find()
                ->where(['group'=>'employee'])
                ->andWhere(self::corporateFilter())
                ->all()
            ,"id","id");
    }

    /**
     * add corporate_id in the filter
     *
     * @param null $alias
     * @param $field
     * @return array
     */
    public function corporateFilter($alias = NULL, $field = "corporate_register_id")
    {
        $field = ($alias != NULL ? "{$alias}." : "").$field;

        if( ($identity = self::corporateId($field)) != 0 )
            return [$field => $identity];
        return [$field=> 0];
    }
    /**
     * validate authentication and return the property of the authUser
     *
     * @param string $field
     * @return int
     */
    protected static function corporateId($field = 'corporate_register_id')
    {
        if( ( $identity = \Yii::$app->user->identity) != NULL)
            return $identity->{$field};
        return 0;
    }
}