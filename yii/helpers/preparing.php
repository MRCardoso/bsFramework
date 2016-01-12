<?php
    /*
     | ---------------------------------------------------------------------
     | Method helper
     | ---------------------------------------------------------------------
     | function for use in the system to help in the development
     | and reduce the writing of the action of continuous use
     |
     */
    if( !function_exists('dd') )
    {
        /*
         | --------------------------------------------------------------------------
         | Dump and die
         | --------------------------------------------------------------------------
         | Create a custom and pretty dump and kill the application(or not)
         */
        function dd( $data, $exit = true)
        {
            echo "<pre>";
                print_r($data);
            echo "<pre>";
            if( $exit ) exit;
        }
    }
    if( ! function_exists('formatDate') )
    {
        /*
         | --------------------------------------------------------------------------
         | format the date
         | --------------------------------------------------------------------------
         | Format date with method of the framework
         */
        function formatDate($date, $format = "d/m/Y H:i:s")
        {
            if( $date != NULL )
                return Yii::$app->formatter->asDatetime($date, "php:{$format}");
            return "";
        }
    }
    if( !function_exists('formatDatabase'))
    {
        function formatDatabase($date)
        {
            if( $date != "")
            {
                $datebase = explode('/',$date);
                return $datebase[2].'-'.$datebase[1].'-'.$datebase[0];
            }
            return NULL;
        }
    }
    if ( ! function_exists('t') )
    {
        /*
         | --------------------------------------------------------------------------
         | Get the translation
         | --------------------------------------------------------------------------
         | Reduce the scribe of the method of the framework
         */
        function t($index, $options = [], $category = 'app')
        {
            return Yii::t($category, strtolower(str_replace(' ', '_', $index)), $options);
        }
    }
    if ( !function_exists('viewOption') )
    {
        /*
         | --------------------------------------------------------------------------
         | Get arguments default
         | --------------------------------------------------------------------------
         | generate arrayList with options for a ActiveForm, Datepicker, GridView->layout
         */
        function viewOption( Array $params = [], $type )
        {
            $option = isset($params["options"]) ? $params["options"] : [];
            switch($type)
            {
                case 'form':
                    return array_merge([
                            'options' => [ 'class' => 'form-horizontal' ],
                            'fieldConfig' => [
                                'template' => "{label}\n<div class=\"col-lg-5\">{input}</div><span class=\"col-md-8 text-right\">{error}</span>",
                                'labelOptions' => [
                                    'class' => 'col-lg-3 control-label'
                                ],
                            ]
                        ], $option );
                    break;
                case 'datepicker':

                    $model = isset($params["model"]) ? $params["model"] : '';
                    $attribute = isset($params["attribute"]) ? $params["attribute"] : "";
                    //$className = (new ReflectionClass($model))->getShortName();
                    return array_merge([
                        'model' => $model,
                        'attribute' => $attribute,
                        'template' => '{input}{addon}',
                        'language' => 'pt',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'dd/mm/yyyy'
                        ],
                        'options' => [
                            'class' => 'range'
                        ]
                    ], $option);
                    break;
            }
        }
    }
    if( ! function_exists('isSave'))
    {
        /*
         | --------------------------------------------------------------------------
         | Check the route
         | --------------------------------------------------------------------------
         | verify if the current route is a interface of the CREATE, UPDATE OR VIEW
         */
        function isSave()
        {
            return preg_match("/(create|update)|[0-9]/", Yii::$app->request->pathInfo);
        }
    }
    if( ! function_exists('msf') )
    {
        /*
         | --------------------------------------------------------------------------
         | generate message session flash
         | --------------------------------------------------------------------------
         |
         */
        function msf($type, $action = NULL)
        {
            $alert = $message = NULL;
            switch($type)
            {
                case 'success':
                    $alert = 'alert-success';
                    $message = t("the_record_was_{action}_with_successful",['action' => $action]);
                    break;
                case 'error':
                    $alert = 'alert-danger';
                    $message = t("the record not was {action}",['action' => $action]);
                    break;
                case 'exception403':
                    $alert = 'alert-danger';
                    $message = t("the user don't has permission to access this interface");
                    break;
            }
            if( $alert != NULL && $message != NULL )
                \Yii::$app->session->setFlash($alert, $message);
        }
    }