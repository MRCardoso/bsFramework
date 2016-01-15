<?php

namespace app\models;

use Yii;
use app\commands\MyModel;
use app\validators\UserValidator;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $corporate_register_id
 * @property string $name
 * @property string $group
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CorporateRegister $corporateRegister
 */
class User extends MyModel implements IdentityInterface
{
    protected $_withCorporate = false;
    protected $_withUser = false;
    private $groupAllow = ['admin', 'user', 'company', 'employee'];
    /*
     | -------------------------------------------------------------------------------------------
     | Load data to run the parent model in the standard of the Application
     | -------------------------------------------------------------------------------------------
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->_model = User::find();
        $this->_validator = UserValidator::getRules();
        $this->_label = UserValidator::getLables();

        $this->_filters = [
            'equal' => ['corporate_register_id','status'],
            'like' => ['name', 'group', 'email', 'username'],
            'other' => ( checkGroup("employee") ? ['id' => Yii::$app->user->id]: [])
        ];
    }

    public function getAllows()
    {
        return $this->groupAllow;
    }
    /*
     | -------------------------------------------------------------------------------------------
     | Methods of the Framework
     | -------------------------------------------------------------------------------------------
     */
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
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
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
                $this->remember_token = hash('sha256', Yii::$app->params['salt']+time());
            }
            else
            {
                if( $this->password != NULL )
                    $this->password = Yii::$app->security->generatePasswordHash($this->password);
                else
                    $this->password = self::findOne($this->id)->password;
            }
            return true;
        }
        return false;
    }
    /**
     * save a user and verify your group to get corporate id appropriate
     * if is signup makes the login of the new user
     *
     * @param array $data
     * @param CorporateRegister $corporate
     * @param bool|false $isSignup
     * @return bool
     * @throws \yii\db\Exception
     */
    public function saveUser(Array $data, CorporateRegister $corporate, $isSignup = false )
    {
        if( !in_array($this->group, $this->groupAllow))
        {
            $this->addError("group", t("the group not found!"));
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        $corporateRegister = new CorporateRegister();
        if( $isSignup )
        {
            if ( !in_array($this->group, ['company', 'employee', 'user']))
                $this->group = NULL;
        }
        elseif( !checkGroup("admin") )
        {
            if( checkGroup("company") )
                if($this->id == Yii::$app->user->id )
                    $this->group = "company";
                else
                    $this->group = "employee";
            else
                $this->group = self::corporateId("group");
        }
        switch($this->group)
        {
            case "admin":
                $this->setScenario('corporateSave');
                $corporateRegister = CorporateRegister::find()->where(["code"=> "admin_management"])->one();
                break;
            case "user":
                $this->setScenario('corporateSave');
                $corporateRegister = CorporateRegister::find()->where(["code"=> "user_test"])->one();
                break;
            case "employee":
                $this->setScenario('corporateSave');
                $identity = Yii::$app->user->identity;
                if( $identity && $identity->group == "company" )
                {
                    $corporateRegister = $identity->corporateRegister;
                }
                else
                {
                    if( isset($this->corporate_register_id) && $this->corporate_register_id != NULL)
                        $corporateRegister = CorporateRegister::findOne($this->corporate_register_id);
                }
                break;
            case "company":
                $corporateRegister = $corporate;
                $corporateRegister->setScenario('save');
                $corporateRegister->attributes = $data["CorporateRegister"];

                if ( !$corporateRegister->save() )
                {
                    $transaction->rollBack();
                    return false;
                }
                break;
        }
        $this->corporate_register_id = $corporateRegister->id;

        if( $this->save() )
        {
            $transaction->commit();
            if( $isSignup )
            {
                $dataMail = [
                    "corporateRegister" => $corporateRegister->name,
                    "nome" => $this->name,
                    "usuario" => $this->username,
                    "grupo" => $this->group,
                    "email"=>$this->email
                ];
                mySendMailer("isAdmin", "criação de conta", $dataMail);
                return Yii::$app->user->login( $this::findByEmail($this->email), 0);
            }
            return true;
        }
        else
        {
            $transaction->rollBack();
        }
        return false;
    }
    /*
     | -------------------------------------------------------------------------------------------
     | Identity use in the authentication
     | -------------------------------------------------------------------------------------------
     */
    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
     * find a user by attribute
     *
     * @param $username
     * @return null|static
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * find by email
     *
     * @param $email
     * @return null|static
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['remember_token' => $token]);
    }
    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->remember_token;
    }
    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    /*
     | -------------------------------------------------------------------------------------------
     | Relations
     | -------------------------------------------------------------------------------------------
     */
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorporateRegister()
    {
        return $this->hasOne(CorporateRegister::className(), ['id' => 'corporate_register_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->find()
            ->where(['group'=>'employee'])
            ->andWhere(['status' => self::ACTIVE])
            ->andWhere(['corporate_register_id' => $this->corporate_register_id])
            ->all();
    }
}
