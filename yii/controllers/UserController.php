<?php

namespace app\controllers;

use app\commands\MyController;
use app\models\CorporateRegister;
use app\models\User;

class UserController extends MyController
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_model = new User();
    }

    public function actionSignup()
    {
        return $this->save($this->_model, true);
    }
    public function actionCreate()
    {
        $this->_model->status = User::ACTIVE;
        return $this->save($this->_model);
    }
    public function actionUpdate($id)
    {
        return $this->save($this->findModel($id));
    }
    private function save(User $model, $isSignup = false)
    {
        $model->setScenario($model->id?'save':'create');
        $action = t($model->isNewRecord?'create':'updated_at');
        $post = \Yii::$app->request->post();
        $groups = labelText("group");
        $corporateRegister = ( empty($model->corporateRegister) ? new CorporateRegister() : $model->corporateRegister);
        $model->password = NULL;

        if( !\Yii::$app->user->identity )
        {
            unset($groups["admin"]);
        }
        else
        {
            $identity = \Yii::$app->user->identity;
            if( $identity->group != "admin")
            {
                unset($groups["admin"]);
                if( $identity->group == "company")
                    if( $model->id != NULL && $model->id == $identity->id)
                        unset($groups["employee"]);
                    else
                        unset($groups[$identity->group]);
                else
                    unset($groups["company"]);
            }
        }

        if ($model->load($post) )
        {
            if( permission($model,"interface") )
            {
                if( $model->saveUser($post, $corporateRegister, $isSignup) )
                {
                    msf('success', $action);
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                else
                {
                    msf('error', $action);
                }
            }
            else
                msf('exception403');
        }
        return $this->render('save', compact('model', 'groups', 'corporateRegister', 'isSignup'));
    }
    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        $model->status = User::INACTIVE;
        $transaction = \Yii::$app->db->beginTransaction();

        if( $model->save() )
        {
            if ( $model->group == "company" )
            {
                $condition = ['group' => 'employee','corporate_register_id' => $model->corporate_register_id];
                if( !User::updateAll(['status' => User::INACTIVE], $condition) )
                {
                    $transaction->rollBack();
                    msf('error', t('removed'));
                    return $this->redirect(['index']);
                }
            }
            $transaction->commit();
            msf('success', t('removed'));
        }
        else
        {
            $transaction->rollBack();
            msf('error', t('removed'));
        }

        if( $model->id == \Yii::$app->user->id )
        {
            \Yii::$app->user->logout();
            return $this->goHome();
        }
        return $this->redirect(['index']);
    }
}