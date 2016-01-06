'use strict';

angular.module('company')
    .factory('Company', ['$resource', function ($resource) {
        return $resource('company/:company', {
            company: '@id'
        },{
            update:{
                method: 'PUT'
            }
        })
    }]);