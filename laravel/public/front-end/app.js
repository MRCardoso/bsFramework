var modules = {};
var labels = {};
var user = {initPath:'info'};
var mainApp = 'adsWork';
var mainAppModule = angular.module(mainApp,[
        // modules of third
        "ngResource",
        "ngRoute",
        "toastr",
        "ui.bootstrap",
        "angularUtils.directives.dirPagination",
        "ngMask",
        "ui.select2",
        // modules of the application
        "main",
        "home",
        "client",
        "company",
        "deliveryman",
        "product",
        "request",
        "user"
    ]);
mainAppModule.config(["$locationProvider","toastrConfig", function($locationProvider,toastrConfig){
        angular.extend(toastrConfig, {
            allowHtml: true,
            autoDismiss: false,
            closeButton: true,
            closeHtml: '<button>&times;</button>',
            containerId: 'toast-container',
            extendedTimeOut: 1000,
            iconClasses: {
                error: 'toast-error',
                info: 'toast-info',
                success: 'toast-success',
                warning: 'toast-warning'
            },
            maxOpened: 0,
            messageClass: 'toast-message',
            newestOnTop: true,
            onHidden: null,
            onShown: null,
            positionClass: 'toast-top-right',
            preventDuplicates: false,
            preventOpenDuplicates: false,
            progressBar: true,
            tapToDismiss: true,
            target: 'body',
            templates: {
                toast: 'directives/toast/toast.html',
                progressbar: 'directives/progressbar/progressbar.html'
            },
            timeOut: 5000,
            titleClass: 'toast-title',
            toastClass: 'toast'
        });
        $locationProvider.hashPrefix('!');
    }])
    .filter('phone', function () {
        return function (phone,option) {
            if (!phone) { return ''; }

            var value = phone.toString().trim().replace(/^\+/, '');

            if (value.match(/[^0-9]/)) {
                return phone;
            }
            option = (option==undefined?"-":option);
            var city = value.slice(0, 2),
                number = value.slice(2);
            number = ["(",city,") ",number.slice(0, 4),option,number.slice(4)].join("");
            // format (99) 9999{option}9999
            return (number).trim();
        };
    })
    .filter('registry', function registry() {
        return function (registry)
        {
            if(!registry)
                return registry;

            var mask;
            if(registry.length==14)
                mask = [
                    registry.substr(0,2), ".", registry.substr(2,3), ".", registry.substr(5,3), '/', registry.substr(8,4), '-', registry.substr(12)
                ].join('');
            else
                mask = [
                    registry.substr(0,3),".",registry.substr(3,3),".",registry.substr(6,3),"-",registry.substr(9)
                ].join('');

            return mask;
        };
    })
    .filter('myUrl', function myUrl($location) {
        return function (url,path)
        {
            if( path == undefined )
                path = "views/templates/";
            url = url.replace(path, "");

            var testPath = (/public/.test($location.$$absUrl)?"./":"./public/");
            var path = [ testPath, "front-end/", path, url ].join('');

            return path;
        };
    })
    .filter('myDateFormat', function myDateFormat($filter){
        return function(text,option){
            if(text!= undefined)
            {
                option = (option==undefined?"dd/MM/yyyy":option);
                var tempdate = new Date(text.replace(/-/g,"/"));
                return $filter('date')(tempdate, option);
            }
        }
    })
    .directive('myActions',function($filter)
    {
        return {
            restrict: 'E',
            templateUrl: $filter('myUrl')('views/templates/actions.php'),
            scope: {
                module: '=module'
            }
        };
    })
    .directive('tableBtn',function($filter)
    {
        return {
            restrict: 'E',
            templateUrl: $filter('myUrl')('views/templates/tableBtn.php'),
            scope: {
                module: '=module'
            }
        };
    })
    .directive('genericField',function($filter)
    {
        return {
            restrict: 'E',
            templateUrl: $filter('myUrl')('views/templates/genericField.php'),
            scope: {
                module: '=module'
            }
        };
    })
    .run(["$http", "$rootScope", function ($http,$rootScope) {
        $rootScope.modules = modules;
        $rootScope.auth = user;
        $rootScope.labels = labels;
        user = {};
        modules = {};
        labels = {};
        console.info("Info! this application is running...");
    }]);
    angular.element(document).ready(function(){
        angular.bootstrap(document,[mainApp]);
    });