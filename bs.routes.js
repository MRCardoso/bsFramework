/**
 * Created by mrcardoso on 09/01/16.
 */
angular.module('bs.main')
    .config(["$routeProvider", function ($routeProvider) {
        $routeProvider
        .when('/',{
            templateUrl: 'modules/views/home.html'
        })
        .when('/about',{
            templateUrl: 'modules/views/about.html'
        })
        .when('/feedback',{
            templateUrl: 'modules/views/feedback.php'
        })
        .when('/laravel',{
            templateUrl: 'laravel/index.php'
        })
        .otherwise({
        redirectTo: '/'
    });
}]);