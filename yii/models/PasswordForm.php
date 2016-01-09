<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class PasswordForm extends Model{

    public $email;
    public $password;
    public $password_confirmation;
    private $_user;
    public function rules(){
        return [
            [['email', 'password','password_confirmation'],'required', 'on' => 'changePassword'],
            [['email'],'required', 'on' => 'checkMail'],
            ['email', 'validaTokenCreate', 'on' => 'checkMail'],
            ['email', 'validateEmail'],
            ['email', 'email'],
            ['password_confirmation', 'compare', 'compareAttribute'=>'password']
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => t('password'),
            'password_confirmation' =>  t('password_confirmation'),
        ];
    }
    public function validateEmail($attribute,$params)
    {
        $user = User::findByEmail($this->email);
        if( !$user )
            $this->addError($attribute, t('I could not find any user with the email address specified.') );
        elseif($user->status == 0 )
            $this->addError($attribute, t('this User was deactivated.'));
        else
            $this->_user = $user;
    }
    public function validaTokenCreate($attribute, $params)
    {
        if ( ( $pr = PasswordResets::findEmail($this->email)) != NULL )
            $this->addError($attribute, t('Already_exists_a_request_of_change_password_for_this_email_{email}.', ['email'=>$this->email]) );
        return true;
    }

    public function sendPassword()
    {
        if( $this->validate() && $this->_user != NULL)
        {
            $reset = new PasswordResets();
            $reset->email = $this->_user->email;
            $reset->token = hash('sha256', $this->_user->remember_token+Yii::$app->params['salt']+time());
            if( $reset->saveToken() )
            {
                mySendMailer($this->email, "Your Password Reset Link",$reset->token, [], "resetPassword");
                return true;
            }
        }
        return false;
    }
    public function resetPassword(PasswordResets $passwordResets)
    {
        if( $this->validate() && $this->_user != NULL )
        {
            $transaction = Yii::$app->db->beginTransaction();

            $this->_user->password = Yii::$app->security->generatePasswordHash($this->password);

            if( $this->_user->save() && $passwordResets->delete() )
            {
                $transaction->commit();
                return Yii::$app->user->login( $this->_user, 0);
            }
            else
            {
                $transaction->rollBack();
            }
        }
        return false;
    }
}