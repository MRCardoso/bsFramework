/**
 * Created by mrcardoso on 17/01/16.
 */
angular.module('bs.feedback',[])
    .controller('FeedBackController', ['$scope', '$resource', function($scope,$resource)
    {
        $scope.feedback = {name:'',email:'',message:'',view_home: false};
        $scope.find = function () {
            $scope.feedbacks = $resource('/laravel/feedback/list').query();
        }
        $scope.save = function()
        {
            var Feedback = $resource('/laravel/feedback');
            Feedback.get(function (request)
            {
                $scope.errors = undefined;
                var data = new Feedback({
                    _token: request.token,
                    name: $scope.feedback.name,
                    email: $scope.feedback.email,
                    message: $scope.feedback.message,
                    view_home: $scope.feedback.view_home
                });

                data.$save(function(response){
                    $scope.success = response;
                }, function(reason)
                {
                    $scope.errors = reason.data;
                });
            });
        }
    }]);