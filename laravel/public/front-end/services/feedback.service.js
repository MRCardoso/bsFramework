'use strict';

angular.module('feedback')
    .factory('Feedback',['$resource', function($resource){
        return $resource('feed/:feed',{
            client: '@id'
        },{
            update: {
                method: 'PUT'
            }
        })
    }]);