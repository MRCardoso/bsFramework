angular
    .module('product',[])
    .controller('ProductController',[
        '$scope', '$routeParams', '$filter', 'main', 'Product',
        function ($scope, $routeParams, $filter, main, Product)
        {
            /*
             | -----------------------------------------------------------------
             | Start Factory that contains all generic methods
             | -----------------------------------------------------------------
             */
            main.init({moduleName:'product'});

            $scope.sizes = { 1: 'Pequeno', 2: 'Media',  3: 'Grande' };
            /*
             | -----------------------------------------------------------------
             | list all products
             | -----------------------------------------------------------------
             */
            $scope.find = function ()
            {
                $scope.products = Product.query();
            };
            /*
             | -----------------------------------------------------------------
             | load a specify product when the routeParams has client param
             | -----------------------------------------------------------------
             */
            $scope.findOne = function ()
            {
                $scope.product = { status: 1 };
                if( 'product' in $routeParams )
                {
                    main.findOne(Product, $routeParams, function (product)
                    {
                        $scope.product = product;
                        $scope.product.cost = $filter('currency')($scope.product.cost,'');
                        $scope.module["id"] = product.id;
                    });
                }
            };
            /*
             | -----------------------------------------------------------------
             | Create and Update a product
             | -----------------------------------------------------------------
             */
            $scope.save = function ()
            {
                var product;
                if( $scope.product.id == null )
                {
                    product = new Product({
                        name:         this.product.name,
                        description:  this.product.description,
                        cost:         this.product.cost,
                        size:         this.product.size,
                        status:       this.product.status
                    });
                }
                else
                {
                    product = $scope.product;
                }
                main.save(product);
            };
            /*
             | -----------------------------------------------------------------
             | Delete a product
             | -----------------------------------------------------------------
             */
            $scope.delete = function (id)
            {
                main.remove( id, Product.get({ product: id }) );
            };
        }
    ]
);