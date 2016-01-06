'use strict';

angular.module('deliveryman')
    .factory('Deliveryman',['$resource', function($resource){
        return $resource('deliveryman/:deliveryman',{
            deliveryman: '@id'
        },{
            update: {
                method: 'PUT'
            }
        });
    }]);
