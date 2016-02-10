<?php
    /*
     | ---------------------------------------------------------------------
     | Method helper
     | ---------------------------------------------------------------------
     | function for use in the system to help in the development
     | and reduce the writing of the action of continuous use
     |
     */
    if( !function_exists('getModules'))
    {
        /*
         | --------------------------------------------------------------------------
         | Generate the menus
         | --------------------------------------------------------------------------
         | generate the menus of the system, according the authentication
         */
        function getModules($onlyAuthData = false)
        {
            if( $onlyAuthData )
            {

                return [
                    [
                        'label' => \yii\helpers\Html::img('http://www.gravatar.com/avatar/'.md5(authData("email")).'?s=20')."\n".
                                    Yii::$app->user->identity->username,
                        'items' => [
                            [
                                'label' => '<span class="glyphicon glyphicon-education"></span> '.t('my data'),
                                'url' => ['/user/'.Yii::$app->user->id]
                            ],
                            '<li class="divider"></li>',
                            [
                                'label' => '<span class="glyphicon glyphicon-log-out"></span> '.t('get out'),
                                'url' => ['/site/logout'],
                                'linkOptions' => ['data-method' => 'post']
                            ],
                        ],
                    ]
                ];
            }
            $modules = labelText("modules");
            $menus = [];
            foreach ($modules as $url => $module)
            {
                $menus[] = [
                    'label' => "<span class=\"glyphicon glyphicon-{$module["class"]}\"></span> ".ucwords($module["name"]),
                    'url' => ['/'.$url]
                ];
            }
            return $menus;
        }
    }
    if ( ! function_exists('makeBreadcrumb') )
    {
        /*
         | --------------------------------------------------------------------------
         | generate the breadcrumb
         | --------------------------------------------------------------------------
         | generate a dynamic breadcrumb with url current
         */
        function makeBreadcrumb($route)
        {
            $path = explode('/', $route);
            $data = [];

            if( $path[0] != "" )
            {
                if( count($path) > 1 )
                {
                    $path[1] = $path[1]=="create"?"new":$path[1];
                    $data[] = ['label' => titleName($path[0]), 'url' => ["./$path[0]"]];
                    $data[] = t(preg_match("/[0-9]/", $path[1])?"view":$path[1]);
                }
                else
                {
                    $data[] = t($path[0]);
                }
            }
            return $data;
        }
    }
    if( ! function_exists('titleName'))
    {
        /*
         | --------------------------------------------------------------------------
         | Generate a  dynamic title
         | --------------------------------------------------------------------------
         | get the string of the url and generate a dynamic title with the
         | route controller/action
         */
        function titleName($key)
        {
            if( $key == NULL )
                return t("home");

            $r = [];
            foreach ( explode('/',$key) as $line)
                if(preg_match("/[0-9]/",$line))
                    $r[] = t("view");
                else
                    $r[] = t($line=="create"?"new":$line);
            return join(' - ', $r);
        }
    }
    if( !function_exists('labelText') )
    {
        /*
         | -----------------------------------------------------------------------------------
         | get the label string with text of the integer field(status|situation|size|group)
         | -----------------------------------------------------------------------------------
         */
        function labelText($type = NULL, $index = NULL)
        {
            $data = [
                "situation" => [
                    1 => [
                        "name" => "Pendente",
                        "class"=> "info"
                    ],
                    2 => [
                        "name" => "Em trânsito",
                        "class"=> "warning"
                    ],
                    3 => [
                        "name" => "Cancelado",
                        "class"=> "default"
                    ],
                    4 => [
                        "name" => "Entregue",
                        "class"=> "success"
                    ]
                ],
                "size" => [
                    1 =>  [
                        "name" => "Pequena",
                        "class" => "info"
                    ],
                    2 => [
                        "name" => "Media",
                        "class" => "warning"
                    ],
                    3 => [
                        "name" => "Grande",
                        "class" => "danger"
                    ]
                ],
                "status" => [
                    1 => [
                        "name" => "Ativo",
                        "class" => "success"
                    ],
                    0 => [
                        "name" => "Inativo",
                        "class" => "default"
                    ]
                ],
                "salaryType" => [
                    "fixed_salary" => [
                        "name" => "Salario fixo",
                        "class" => ""
                    ],
                    "by_delivery" => [
                        "name" => "Por entrega",
                        "class" => ""
                    ]
                ],
                "group" => [
                    "admin" => "Administrador",
                    "user" => "Usuário",
                    "company" =>  "Companhia",
                    "employee" => "Funcionário"
                ],
                "modules" => [
                    "user"      => [
                        "name" => "usuário",
                        "class" => "user"
                    ],
                    "client"    => [
                        "name" => "cliente",
                        "class" => "user"
                    ],
                    "company"   => [
                        "name" => "empresa",
                        "class" => "briefcase"
                    ],
                    "product"   => [
                        "name" => "produto",
                        "class" => "list-alt"
                    ],
                    "deliveryman" => [
                        "name" => "entregador",
                        "class" => "user"
                    ],
                    "request"   => [
                        "name" => "pedido",
                        "class" => "shopping-cart"
                    ],
                ]
            ];
            if( $type != NULL) $data = isset($data[$type]) ? $data[$type]: NULL;
            if( $index != NULL && $data != NULL) $data = isset($data[$index]) ? $data[$index] : NULL;
            return $data;
        }
    }
    if( ! function_exists('dropDownList') )
    {
        /*
         | -----------------------------------------------------------------------------------
         | generate the dropdown list for the array of the (status|situation|size|group)
         | -----------------------------------------------------------------------------------
         */
        function dropDownList( $type, $model = NULL )
        {
            $list = [];

            if( ($labels = labelText($type)) != NULL )
            {
                foreach( $labels as $key=> $label)
                    $list[$key] = $label["name"];
            }
            if( $model != NULL )
                return \yii\helpers\Html::activeDropDownList($model, $type, $list,['prompt' => t('Select'),'class' => 'form-control']);
            return $list;
        }
    }
