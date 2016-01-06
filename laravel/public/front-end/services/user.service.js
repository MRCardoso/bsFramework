'use strict';

angular.module('user')
    .factory('User', ['$resource', function ($resource) {
        return $resource('user/:user',{
            user: '@id'
        },{
            update: {
                method: 'PUT'
            }
        });
    }]
);
