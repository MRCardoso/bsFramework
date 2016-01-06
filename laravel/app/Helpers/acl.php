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
            $path = explode('/', request()->getPathInfo());
            array_shift($path);
            $controller = $path[0];
            $action = isset($path[1]) ? $path[1]: "";
            $output = ["newButton" => true, "btnAction" => true, 'interface' => true ];

            if( $forceAllow ) return $output;

            if( ($identity = auth()->user()) != NULL && !checkGroup("admin") )
            {
                $childOfCorporate = \App\Repositories\UserRepositoryEloquent::employeeByCompany(false);

                $owner = $child = false;
                if( $model != NULL)
                {
                    // get the user_id
                    $modelId = ( $model->getTable() == "user" ? $model->id : $model->user_id );
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
                    "interface" => ( ( $owner || $child ) || $allowCreate ),
                    /*
                    enabled for user(employee) see the view
                    "btnAction" => ( ( $owner || ( $child && ( checkGroup("company") || !$allowView) ) ) || $allowCreate ),
                    "interface" => ( ( $owner || ( $child && $allowView) ) || $allowCreate )
                    */
                ];
                if( $attribute != NULL)
                    return $output[$attribute];
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
            if( ($user = auth()->user()) != NULL )
                return $user->group == $group;
            return false;
        }
    }
    if ( ! function_exists('mySendMailer'))
    {
        function mySendMailer($mail, $subject, $message, $dump = [], $layout = "custom")
        {
            return "no implemented";
        }
    }
    if( ! function_exists('authData') )
    {
        function authData($field = 'corporate_register_id')
        {
            if( ( $user = auth()->user()) != NULL)
            {
                if( $field == '') return $user;
                return $user->{$field};
            }
            return NULL;
        }
    }