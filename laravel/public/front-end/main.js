angular
    .module('main', [])
    .factory('main',['$rootScope','toastr','Token','$http','paginationService', '$timeout', '$location','$route','MainService','$resource',
        function main($rootScope, toastr, Token, $http, paginationService, $timeout,$location, $route, MainService, $resource){
            var $ = angular.element,
                defaults = {
                    currentPage: 1,
                    moduleName: '',
                    messageDrop: [],
                    authenticate: true,
                    limit: 8
                },
                css_class = {
                    "table": "table table-striped table-bordered table-hover",
                    "save": "border-side-bottom content content-large"
                },
                text_integer = $rootScope.labels,
                main = {
                    init: init,
                    save: MainService.save,
                    remove: MainService.remove,
                    findOne: MainService.findOne,
                    ajaxRequest: MainService.ajaxRequest
                };
            return main;

            function init(params)
            {
                $rootScope.idsEmploye   = $resource('api/getPermission').query();
                $rootScope.viewCreate   = MainService.permission(null,'newButton');
                $rootScope.permission   = MainService.permission;

                var instanceId  = paginationService.getLastInstanceId(),
                    business    = businessRules("json");

                params = angular.extend({}, defaults, params);
                defaults.authenticate = params.authenticate;

                businessRules("auth");

                /*
                | ------------------------------------------------------------------------------------
                | Define the variables to access on the scope of the module current
                | ------------------------------------------------------------------------------------
                |*/
                $rootScope.blockPage    = { status: 200, message: '', css: ''};
                MainService.extra       = params.messageDrop;
                $rootScope.currentPage  = params.currentPage;
                $rootScope.totalItems   = 0;
                $rootScope.Math         = window.Math;
                $rootScope.limit        = params.limit;
                $rootScope.moduleName   = params.moduleName;
                $rootScope.moduleLabel  = $rootScope.modules[business.module];
                $rootScope.token        = Token.getToken();
                $rootScope.css_class    = css_class;
                $rootScope.statusText   = text_integer.status;
                $rootScope.sizeText     = text_integer.size;
                $rootScope.situationText= text_integer.situation;
                $rootScope.groups       = text_integer.group;
                $rootScope.salaryType   = text_integer.salaryType;
                $rootScope.save         = business.save;
                $rootScope.module       = business.actions;
                $rootScope.TITLE_SAVE   = business.title;

                $rootScope.listen = function()
                {
                    if(instanceId != undefined)
                    {
                        $timeout(function ()
                        {
                            $rootScope.totalItems = paginationService.getCollectionLength(instanceId);
                        }, 500);
                    }
                };
                $rootScope.listen();
                $rootScope.changePage = function(p) {
                    $rootScope.currentPage = p;
                };
                $rootScope.changeClass = function(id) {
                    $(".menu-action li").removeClass('active');
                    $("#"+id).addClass('active');
                };
                /*
                | ------------------------------------------------------------------------
                | Manipulation DOM with angular.element
                | ------------------------------------------------------------------------
                */
                $(business.element).addClass('active');
                $(".template-head")[($rootScope.save?'hide':'show')]();
                $timeout(function () {
                    $(".date").datepicker({
                        format: "dd/mm/yyyy",
                        todayHighlight: true,
                        autoclose: true
                    });
                },100);
            }

            /**
             * validate the access interface when user is authenticated
             * get tha parameters of the views for labels and buttons
             * @param type
             */
            function businessRules(type)
            {
                if( /public/.test($location.$$absUrl) )
                    location.href = $location.$$absUrl.replace('/public','');
                var path = $location.$$path.split('/');
                var iSignup = path[1] == "signup";
                switch (type)
                {
                    case 'auth':
                        if( defaults.authenticate )
                        {
                            var user = $rootScope.auth;

                            if (user.id == undefined && !iSignup )
                                $location.path('/');

                            if( path[1] == 'signup' || user.group != "admin" )
                                delete text_integer.group["admin"];
                        }
                        break;
                    case 'json':
                        return {
                            save: (/\/(create|info|edit)|[0-9]/.test(path.join('/')) || path.join('/')=='/'),
                            title: (path.indexOf('create')!=-1?'Novo':(path.indexOf('edit')!=-1?'Editar':'Visualizar')),
                            module: path[1],
                            element: "#"+( path[1]==''?"home":path[1]),
                            actions: {
                                id: null,
                                name: (iSignup?"": path[1]),
                                btnAction: (/(signup|create)/.test(path) || path.indexOf('edit') !=-1),
                                hasPermission: { newButton: $rootScope.viewCreate, 'interface':true }
                            }
                        };
                        break;
                }
            }
        }]);