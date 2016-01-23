/**
 * Created by mrcardoso on 17/01/16.
 */
angular.module('bs.feedback',[])
    .controller('FeedBackController', ['$scope', '$resource', function($scope,$resource)
    {
        angular.element('.loading').hide();
        $scope.feedback = {name:'',email:'',message:'',view_home: false};

        $scope.find = function ()
        {
            $scope.feedbacks = $resource('/laravel/feedback/list').get();
        };
        $scope.save = function()
        {
            angular.element('#btn-send').attr('disabled',true);
            var Feedback = $resource('/laravel/feedback');
            Feedback.get(function (request)
            {
                $scope.errors = undefined;
                var data = new Feedback({
                    _token: request.token,
                    type: $scope.feedback.type,
                    application: $scope.feedback.application,
                    name: $scope.feedback.name,
                    email: $scope.feedback.email,
                    message: $scope.feedback.message,
                    view_home: $scope.feedback.view_home
                });

                data.$save(function(response)
                {
                    angular.element('#btn-send').attr('disabled',false);
                    $scope.feedback = {};
                    $scope.success = response;
                }, function(reason)
                {
                    angular.element('#btn-send').attr('disabled',false);
                    $scope.errors = reason.data;
                });
            });
        }
    }]);