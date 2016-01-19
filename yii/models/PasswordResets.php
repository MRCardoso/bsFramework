<?php
namespace app\models;

use yii\db\ActiveRecord;
/**
 * @property string $email
 * @property string $token
 * @property string $created_at
 */
class PasswordResets extends ActiveRecord
{
    public static function tableName()
    {
        return "password_resets";
    }
    public static function primaryKey()
    {
        return ["token"];
    }
    public function rules(){
        return [
            [['email','token'],'required'],
            [['email','token','created_at'],'safe'],
        ];
    }
    public function saveToken()
    {
        $this->created_at = date("Y-m-d H:i:s");

        if( $this->validate() && $this->save() )
            return true;
        return false;
    }

    public static function findToken($token)
    {
        return self::findOne(['token' => $token]);
    }

    public static function findEmail($email)
    {
        return self::findOne(['email' => $email]);
    }
}