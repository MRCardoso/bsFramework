'use strict';

angular.module('product')
    .factory('Product', ['$resource', function ($resource) {
        return $resource('product/:product',{
            product: '@id'
        },{
            update: {
                method: 'PUT'
            }
        })
    }]
);