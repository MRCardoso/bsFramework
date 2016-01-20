angular.module('main')
    .service('MainService', ['$rootScope', '$http', 'toastr', '$location', '$route', function ($rootScope, $http, toastr, $location, $route)
    {
        var $this = this;
        var standard_msg = {
            ERROR:  "Erro",
            SUCCESS: "Sucesso",
            WARNING: "Atenção",
            INFO: "Notificação",
            RM_TITLE: "Deletar registro",
            RM_MESSAGE: "Você tem certeza que deseja remover este registro?",
            THROW_ID: "E necessário passar o id para deletar um registro!",
            EDIT: "editar",
            REMOVE: "remover",
            CREATE: "criar",
            VIEW: "visualizar",
            TITLE_SAVE:'',
            SAVE: "salvar",
            BACK: "voltar"
        };
        this.extra = [];
        this.checkGroup = function(group)
        {
            if( $rootScope.auth.id != undefined)
                return $rootScope.auth.group == group;
            return false;
        };
        this.permission = function(resource,attribute)
        {
            var output = {newButton: true, 'interface':true};

            if ( $rootScope.auth.id != undefined && !$this.checkGroup("admin") )
            {
                var path = $location.$$path.split('/');
                path.shift();
                var owner = false, child = false;
                if( resource != undefined)
                {
                    var modelId = (path[0] == "user" ? resource.id: resource.user_id);
                    owner = modelId == $rootScope.auth.id;
                    child = $this.checkGroup("company") && ( $rootScope.idsEmploye.indexOf(modelId) != -1);
                }

                output = {
                    'newButton': path[0] != 'user' || $this.checkGroup("company"),
                    'interface': ( owner || child )
                };
            }
            if( attribute!=undefined)
                return output[attribute];
            return output;
        };
        this.ajaxRequest = function (params,callback)
        {
            if(params.url==undefined)
            {
                return;
            }
            params.method = (params.method==undefined?'post':params.method);
            var req = {
                method: params.method,
                url: params.url
            };
            if(params.data!=undefined && params.method.toLowerCase()!='get')
            {
                req.data = params.data;
            }
            $http(req)
                .success(callback)
                .error(function(err)
                {
                    console.log(err);
                    //toastr.error(err.message,$rootScope.ERROR);
                });
        };
        /**
         * get error toastr according with status http
         * @param code
         * @returns {*}
         */
        this.validCode = function (code) {
            var status;
            switch (code)
            {
                case 400:
                case 500:
                    status = "error";
                    break;
                case 203:
                case 401:
                case 403:
                case 404:
                    status = "warning";
                    break;
                default:
                    status = "error";
                    break;
            }
            return status;
        };
        /**
         * get message with status according
         * @param reason
         */
        this.getMessage = function (reason)
        {
            if( reason != null )
            {
                var output = [];

                if(typeof reason.data == "string")
                    output = [reason.data];
                else
                    angular.forEach(reason.data,function(row) { output.push(row); });

                toastr[$this.validCode(reason.status)](output.join('<br>'),reason.statusText);
            }
        };
        /**
         * method for create and update data of the a module
         * define a object with data send by form ('POST' for insert, 'PUT' for update)
         * create a record using the method $save $resource
         * update a record using the method custom $update created in the service of the module
         * success: redirect to page 'view'
         * fail: show in toastr the message with error
         */
        this.save = function( module, router )
        {
            var $element = angular.element('#btn-save');
            $element.attr('disabled', true);
            var method = (module.id == undefined ? "$save" : "$update");
            module[method](function (response) {
                if (router == 'reload')
                    window.location.href = '/laravel/public/';
                else if (router == 'pre-load')
                    $route.reload();
                else 
                {
                    var path = [$rootScope.moduleName, "/", response.module.id].join('');
                    if (router == 'no-view')
                        path = $rootScope.moduleName;
                    else if (router != undefined)
                        path = router;
                    $location.path(path);
                }
                toastr.success(response.message, standard_msg.SUCCESS);
            }, function (reason) {
                $element.attr('disabled', false);
                $this.getMessage(reason);
            });
        };
        /**
         * standard method to delete a record
         * use the method $remove $resource
         *
         * @param id
         * @param Module
         * @param callback
         */
        this.remove = function( id, Module, callback)
        {
            if(id==undefined)
            {
                throw $rootScope.THROW_ID;
            }
            else if( Module == null )
            {
                throw "falha ao carregar modulo "+$rootScope.moduleName;
            }
            else
            {
                Module.$promise.then(function (resource)
                {
                    var list = [];
                    if( $this.extra.length > 0 )
                    {
                        var array = [];
                        angular.forEach($this.extra, function (value) {
                            array.push(['<li>',value,'</li>'].join(''));
                        });
                        list.push(['<ul>',array,'</ul>'].join(''));
                    }
                    $.dialogBox({
                        type: "confirm",
                        title: standard_msg.RM_TITLE,
                        message: standard_msg.RM_MESSAGE+list.join(''),
                        callback: function (validate)
                        {
                            if (validate)
                            {
                                if( callback == undefined )
                                {
                                    callback = function (response)
                                    {
                                        if( response.message == 'logout' )
                                            window.location.href = '/laravel/';
                                        else
                                        {
                                            toastr.success(response.message, standard_msg.SUCCESS);
                                            if(/[0-9]/.test($location.$$path))
                                                $location.path($rootScope.moduleName);
                                            else
                                                $route.reload();
                                        }
                                    };
                                }
                                resource.$remove(callback, function (reason)
                                {
                                    $this.getMessage(reason);
                                });
                            }
                        }
                    });
                }, function (reason)
                {
                    $this.getMessage(reason);
                });
            }
        };
        /**
         * make a load of the a record specific and return the resource with data
         *
         * @param module
         * @param params
         * @param callback
         */
        this.findOne = function (module, params,callback)
        {
            module.get(params)
                .$promise.then(
                callback,
                function (reason)
                {
                    $rootScope.blockPage = { status: reason.status, message: reason.data, css: $this.validCode(reason.status) };
                    $rootScope.module["hasPermission"] = { newButton: false, 'interface': false };
                    $this.getMessage(reason);
                });
        };
        this.find = function(module, attribute)
        {
            module.query(function(response){
                $rootScope["attribute"] = response;
            }, function (reason) {
                $this.getMessage(reason);
            });
        }
    }]);
