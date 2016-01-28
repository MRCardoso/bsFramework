angular
    .module('feedback', [])
    .controller('FeedbackController',[
        '$scope', '$rootScope', '$routeParams', 'toastr', '$filter','main', 'Feedback',
        function ($scope, $rootScope, $routeParams, toastr, $filter, main, Feedback)
        {
            /*
             | -----------------------------------------------------------------
             | Start Factory that contains all generic methods
             | -----------------------------------------------------------------
             */
            main.init({moduleName:'feedback', viewCreate:false, limit:5 });

            $rootScope.moduleLabel = "Feedback";
            $scope.labelType = { "sujestion": "warning", "comment":"info", "bug": "danger" };
            $scope.labelApp = { "both": "default", "laravel":"danger", "yii": "info" };
            $scope.labelView = {
                "false": {"label": "danger", "icon": "ban", "text": "Nao"},
                "true": {"label": "success", "icon": "ok", "text": "Sim"}
            };
            /*
             | -----------------------------------------------------------------
             | list all clients
             | -----------------------------------------------------------------
             */
            $scope.find = function ()
            {
                Feedback.query(function(response){
                    $scope.feedbacks = response;
                },function(reason) {
                    $rootScope.blockPage = { status: reason.status, message: reason.data, css: "warning" };
                });
            };

        }
    ]);