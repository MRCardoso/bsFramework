angular
    .module('home', [])
    .controller('HomeController',['$scope', 'main', '$resource', function ($scope, main, $resource)
    {
        /*
         | -----------------------------------------------------------------
         | Start Factory that contains all generic methods
         | -----------------------------------------------------------------
         */
        main.init({limit: 6});

        $scope.currentDate = new Date();
        $scope.requestRecent = [];

        /*
         | -----------------------------------------------------------------
         | load the request more recents
         | -----------------------------------------------------------------
         */
        $scope.requestRecent = $resource('api/request/recent').query();
    }
]);