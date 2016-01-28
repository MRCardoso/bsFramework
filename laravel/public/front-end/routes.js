'use strict';

angular.module('main')
    .config(["$routeProvider", function ($routeProvider)
    {
        var base = (/public\//.test(location.pathname)?"./":"./public/")+"front-end/";
        $routeProvider.when('/',{
            templateUrl: base+'views/home/init.php'
        })
        .when('/info',{
            templateUrl: base+'views/home/info.php'
        })
        .when('/feedback',{
            templateUrl: base+'views/home/feedback.php'
        })
        .when('/user',{
            templateUrl: base+'views/user/index.php'
        })
        .when('/user/create',{
            templateUrl: base+'views/user/save.php'
        })
        .when('/signup',{
            templateUrl: base+'views/user/save.php'
        })
        .when('/user/:user/edit',{
            templateUrl: base+'views/user/save.php'
        })
        .when('/user/:user',{
            templateUrl: base+'views/user/view.php'
        })
        /*
        | ------------------------------------------------------------------
        | client
        | ------------------------------------------------------------------
        */
        .when('/client',{
            templateUrl: base+'views/client/index.php'
        })
        .when('/client/create',{
            templateUrl: base+'views/client/save.php'
        })
        .when('/client/:client/edit', {
            templateUrl: base+'views/client/save.php'
        })
        .when('/client/:client', {
            templateUrl: base+'views/client/view.php'
        })
        /*
         | ------------------------------------------------------------------
         | company
         | ------------------------------------------------------------------
         */
        .when('/company', {
            templateUrl: base+'views/company/index.php'
        })
        .when('/company/create',{
            templateUrl: base+'views/company/save.php'
        })
        .when('/company/:company/edit',{
            templateUrl: base+'views/company/save.php'
        })
        .when('/company/:company',{
            templateUrl: base+'views/company/view.php'
        })
        /*
         | ------------------------------------------------------------------
         | deliveryman
         | ------------------------------------------------------------------
         */
        .when('/deliveryman', {
            templateUrl: base+'views/deliveryman/index.php'
        })
        .when('/deliveryman/create',{
            templateUrl: base+'views/deliveryman/save.php'
        })
        .when('/deliveryman/:deliveryman/edit',{
            templateUrl: base+'views/deliveryman/save.php'
        })
        .when('/deliveryman/:deliveryman',{
            templateUrl: base+'views/deliveryman/view.php'
        })
        /*
         | ------------------------------------------------------------------
         | product
         | ------------------------------------------------------------------
         */
        .when('/product', {
            templateUrl: base+'views/product/index.php'
        })
        .when('/product/create',{
            templateUrl: base+'views/product/save.php'
        })
        .when('/product/:product/edit',{
            templateUrl: base+'views/product/save.php'
        })
        .when('/product/:product',{
            templateUrl: base+'views/product/view.php'
        })
        /*
         | ------------------------------------------------------------------
         | request
         | ------------------------------------------------------------------
         */
        .when('/request', {
            templateUrl: base+'views/request/index.php'
        })
        .when('/request/create',{
            templateUrl: base+'views/request/save.php'
        })
        .when('/request/:request/edit',{
            templateUrl: base+'views/request/save.php'
        })
        .when('/request/:request',{
            templateUrl: base+'views/request/view.php'
        })
        .otherwise({
            redirectTo: '/'
        });
    }
]);