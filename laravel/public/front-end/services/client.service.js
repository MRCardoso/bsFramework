'use strict';

angular.module('client')
    .factory('Client',['$resource', function($resource){
    return $resource('client/:client',{
        client: '@id'
    },{
        update: {
            method: 'PUT'
        }
    })
}]);