<?php
    if ( ! function_exists('permission') )
    {
        /*
         | -----------------------------------------------------------------------------------
         | validate the permission of access to interface according the group of the auth user
         | -----------------------------------------------------------------------------------
         | are tree case
         | - newButton when the action create user is allow
         | - allowView enabled a employee see the data of the a record that he no is owner(no implemented)
         | - interface if the user has permission to access the actions[update|delete|view]
         */
        function permission($model = NULL, $attribute = NULL, $forceAllow = false)
        {
            $path = explode('/', Yii::$app->request->pathInfo);
            $controller = $path[0];
            $action = isset($path[1]) ? $path[1]: "";
            $output = ["newButton" => true, "btnAction" => true, 'interface' => true ];

            if( $forceAllow ) return $output;

            if( ($identity = Yii::$app->user->identity) != NULL )
            {
                $us = new \app\models\User();
                if( !in_array($identity->group, $us->Allows))
                {
                    return ["newButton" => false, "btnAction" => false, 'interface' => false ];
                }
                unset($us);
                if( !checkGroup("admin"))
                {
                    $childOfCorporate = \app\models\User::employeeByCompany();
                    $owner = $child = false;
                    if( $model != NULL)
                    {
                        // get the user_id
                        $modelId = ( className($model) == "User" ? $model->id : $model->user_id );
                        // check if the user authenticated is the owner
                        $owner = $modelId == $identity->id;
                        // check if the user authenticated is parent of the owner
                        //$child = in_array($modelId, $childOfCorporate); //enabled for user(employee) see the view
                        $child = checkGroup("company") && in_array($modelId, $childOfCorporate);
                    }
                    // check action[update|delete|view] is in the list of the allow
                    //$allowView = ( checkGroup("company") || preg_match('/[0-9]/', $action) ); //enabled for user(employee) see the view
                    // check permission to access interface create
                    $allowCreate = ( $action == "create" && ( checkGroup("company") || $controller != "user" ) );
                    // check permission to access interface view

                    $output = [
                        "newButton" => $controller != "user" || checkGroup("company"),
                        "interface" => ( ( $owner || $child ) || $allowCreate )
                        /*
                        enabled for user(employee) see the view
                        "btnAction" => ( ( $owner || ( $child && ( checkGroup("company") || !$allowView) ) ) || $allowCreate ),
                        "interface" => ( ( $owner || ( $child && $allowView) ) || $allowCreate )
                        */
                    ];
                    if( $attribute != NULL)
                        return $output[$attribute];
                }
            }
            return $output;
        }
    }
    if( ! function_exists('checkGroup') )
    {
        /*
         | -----------------------------------------------------------------------------------
         | Verify the group of the user auth
         | -----------------------------------------------------------------------------------
         */
        function checkGroup( $group )
        {
            if( ( $user = authData("group") ) != NULL )
                return in_array( $user, explode('|', $group) );
            return false;
        }
    }
    if( ! function_exists('className') )
    {
        /*
         | -----------------------------------------------------------------------------------
         | get short name of the class without namespace
         | -----------------------------------------------------------------------------------
         */
        function className($model)
        {
            if( $model == NULL)
                return "";
            return (new ReflectionClass($model))->getShortName();
        }
    }
    if ( ! function_exists('mySendMailer'))
    {
        /*
         | -----------------------------------------------------------------------------------
         | standard method to send mail
         | -----------------------------------------------------------------------------------
         */
        function mySendMailer($mail, $subject, $message, $dump = [], $layout = "custom")
        {
            return true;
            if( $mail == 'isAdmin' ) $mail = \Yii::$app->params['adminEmail'];
            $params = [
                'title' => $subject,
                'content' => $message,
                'dump' => $dump
            ];
            $mailer = \Yii::$app->mailer->compose("layouts/{$layout}", $params)
                ->setFrom([\Yii::$app->params['adminEmail'] => 'Admin[MRC] - system-yii2'])
                ->setTo($mail)
                ->setBcc(\Yii::$app->params['adminEmail'])
                ->setSubject($subject);

            if( $mailer->send() )
                return true;
            else
                return false;
        }
    }
    if( ! function_exists('authData') )
    {
        /*
         | -----------------------------------------------------------------------------------
         | validate authentication and return user data logged
         | -----------------------------------------------------------------------------------
         */
        function authData($field = 'corporate_register_id')
        {
            if( ( $user = Yii::$app->user->getIdentity()) != NULL)
            {
                if( $field == '') return $user;
                return $user->{$field};
            }
            return NULL;
        }
    }
