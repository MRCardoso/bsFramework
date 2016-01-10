angular.module('bs.main', [])
    .controller('MainController',['$scope','$resource', function($scope, $resource){
        $scope.save = function()
        {
            var Feedback = $resource('/laravel/feedback');
            var data = new Feedback({
                name: this.feedback.name,
                email: this.feedback.email,
                message: this.feedback.message
            });
            data.$save(function(response){
                console.log(response);
            });
        }
    }]);