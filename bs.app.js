/**
 * Created by mrcardoso on 09/01/16.
 */
var appName = 'bsFramework';
var appModule = angular.module(appName,[
    "ngResource",
    "ngRoute",
    "bs.main"
]);

appModule.config(["$locationProvider", function ($locationProvider)
{
    $locationProvider.hashPrefix('!');
}]);

angular.element(document).ready(function(){
    angular.bootstrap(document,[appName]);
});
