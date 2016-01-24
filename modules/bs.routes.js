angular.module('bs.main')
    .config(["$routeProvider", function ($routeProvider) {
        $routeProvider
        .when('/',{
            templateUrl: 'modules/views/home.php'
        })
        .when('/about',{
            templateUrl: 'modules/views/about.html'
        })
        .when('/feedback',{
            templateUrl: 'modules/views/feedback.php'
        })
        .otherwise({
        redirectTo: '/'
    });
}]);