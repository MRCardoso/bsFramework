<?php
    if( !function_exists('validateData') )
    {
        // return date formated if is not empty
        function validateData($date, $format = "d/m/Y")
        {
            return ($date == "" ? "" : date($format, strtotime($date)));
        }
    }
    if( !function_exists('validateField') )
    {
        /*
         | ----------------------------------------------------------------------------------
         | Validate field
         | ----------------------------------------------------------------------------------
         | prepare fields before save in database
         | clear mask from phone,cpf,cnpj
         | convert float number and date to format database
         |
         */
        function validateField($attributes, &$fields)
        {
            foreach ($attributes as $line)
            {
                if( isset($fields[$line]) )
                {
                    $fields[$line] = $fields[$line] === "" ? NULL : $fields[$line];
                    if( substr_count($fields[$line], ',') == 1)
                    {
                        $fields[$line] = str_replace('.', '', $fields[$line]);
                        $fields[$line] = str_replace(',', '.', $fields[$line]);
                    }
                    else if( preg_match("/(\(|\)| |-|\.)/", $fields[$line]) )
                    {
                        $regex = "/(\(|\)|-| |\/|\.)/";

                        if( ( (int) preg_replace($regex,"", $fields[$line]) ) != 0 )
                            $fields[$line] = preg_replace($regex,"", $fields[$line]);
                    }
                }
            }
        }
    }
    if( !function_exists('getModules'))
    {
        /*
         | --------------------------------------------------------------------------------
         | Get module of the system
         | --------------------------------------------------------------------------------
         */
        function getModules($index = NULL, $attribute = NULL)
        {
            $modules = [
                "user"        => [
                    "name" => "usuario",
                    "icon" => "user",
                ],
                "client"        => [
                    "name" => "cliente",
                    "icon" => "user",
                ],
                "company"       => [
                    "name" => "empresa",
                    "icon" => "briefcase",
                ],
                "deliveryman"   => [
                    "name" => "Entregador",
                    "icon" => "user",
                ],
                "product"       => [
                    "name" => "produto",
                    "icon" => "list-alt",
                ],
                "request"       => [
                    "name" => "pedido",
                    "icon" => "shopping-cart",
                ],
            ];
            $data = ( $index != NULL ? $modules[$index] : $modules );
            return (Object)( $attribute != NULL ? $data[$attribute] : $data );
        }
    }
    if( !function_exists('labelText'))
    {
        /*
         | --------------------------------------------------------------------------------
         | String values of the options integer of the modules
         | --------------------------------------------------------------------------------
         */
        function labelText($integer = NULL, $type = NULL)
        {
            $data = [
                "situation" => [
                    1 => [
                        "name" => "Pendente",
                        "class"=> "info"
                    ],
                    2 => [
                        "name" => "Em transito",
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
                    1 => [
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
                    ],
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
                    "admin" => [
                        "name" => "Administrador",
                        "class" => "success"
                    ],
                    "company" =>  [
                        "name" => "Empresa",
                        "class" => "warning"
                    ],
                    "employee" => [
                        "name" => "Funcionario",
                        "class" => "info"
                    ]
                ]
            ];
            if( $type != NULL && $integer != NULL )
                return $data[$type][$integer];
            return $data;
        }
    }
    function myUrl($path)
    {
        return url( ( preg_match('/public$/', url()) ? "": "public").$path);
    }