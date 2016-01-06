'use strict';

angular.module('request')
    .factory('Request', ['$resource', function($resource) {
        return $resource('request/:request',{
            request: '@id'
        },{
            update: {
                method: 'PUT'
            }
        });
    }]
);