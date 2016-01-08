angular.module('request',[])
    .filter('validateNumber', function changeCharacter() {
        return function (character)
        {
            return ( character != null && character != "" && character != undefined
                ? parseFloat( character.indexOf(',') != -1 ? character.replace(',', '.') : character )
                : 0 );
        }
    })
    .controller('RequestController',[
        '$scope', '$routeParams', '$resource', '$filter', 'main', 'Request',
        function ($scope, $routeParams, $resource, $filter, main, Request)
        {
            /*
             | -----------------------------------------------------------------
             | Start Factory that contains all generic methods
             | -----------------------------------------------------------------
             */
            main.init({moduleName:'request'});

            $scope.totalValue = 0;

            /*
             | -----------------------------------------------------------------
             | list all requests
             | -----------------------------------------------------------------
             */
            $scope.find = function ()
            {
                $scope.requests = Request.query();
            };
            /*
             | -----------------------------------------------------------------
             | load a specify request when the routeParams has client param
             | -----------------------------------------------------------------
             */
            $scope.findOne = function ()
            {
                $scope.products     = $resource('api/product/active').query();
                $scope.clients      = $resource('api/client/active').query();
                $scope.deliverymen  = $resource('api/deliveryman/active').query();
                $scope.situations = {
                    1: "Pendente",
                    2: "Em trânsito",
                    3: "Cancelado",
                    4: "Entregue"
                };
                $scope.request = { status:1, price: 0, freight: 0, discount: 0};
                if( 'request' in $routeParams )
                {
                    main.findOne(Request, $routeParams, function (request)
                    {
                        $scope.module["id"] = request.id;
                        $scope.request =  request;
                        $scope.request.request_date = $filter('date')($scope.request.request_date,'dd/MM/yyyy');
                        $scope.request.price = $filter('currency')($scope.request.price,'');
                        $scope.request.change = $filter('currency')($scope.request.change,'');
                        $scope.request.freight = $filter('currency')($scope.request.freight,'');
                        $scope.request.discount = $filter('currency')($scope.request.discount,'');
                        $scope.calculateValue();
                    });
                }
            };
            /*
             | -----------------------------------------------------------------
             | Create and Update a request
             | -----------------------------------------------------------------
             */
            $scope.save = function ()
            {
                var request;
                if( $scope.request.id == null )
                {
                    request = new Request({
                        'deliveryman_id':   this.request.deliveryman_id,
                        'client_id':        this.request.client_id,
                        'product_id':       this.request.product_id,
                        'description':      this.request.description,
                        'quantity':         this.request.quantity,
                        'price':            this.request.price,
                        'request_date':     this.request.request_date,
                        'freight':          this.request.freight,
                        'observation':      this.request.observation,
                        'discount':         this.request.discount,
                        'situation':        this.request.situation
                    });
                }
                else
                {
                    request = $scope.request;
                }
                main.save(request);
            };
            /*
             | -----------------------------------------------------------------
             | Delete a request
             | -----------------------------------------------------------------
             */
            $scope.delete = function (id)
            {
                main.remove(id, Request.get({ request: id }) );
            };
            /*
             | -----------------------------------------------------------------
             | get information of the product selected
             | -----------------------------------------------------------------
             */
            $scope.productInfo = function () {
                $resource('api/request/productInfo',{id:this.request.product_id})
                    .get()
                    .$promise
                    .then(function(info){
                        $scope.request.price = $filter('currency')(info.cost,'');
                        $scope.totalValue = info.cost;
                    });
            };
            /*
             | -----------------------------------------------------------------
             | storage in totalValue value the sum of the request
             | -----------------------------------------------------------------
             */
            $scope.calculateValue = function()
            {
                $scope.totalValue = $scope.getValues($scope.request);
            };
            /*
             | -----------------------------------------------------------------
             | generate te calculate of one request
             | -----------------------------------------------------------------
             */
            $scope.getValues = function (request)
            {
                if( request.price != "" && request.quantity != undefined)
                {
                    var quantity    = parseInt(request.quantity);
                    var price       = $filter('validateNumber')(request.price);
                    var freight     = $filter('validateNumber')(request.freight);
                    var discount    = $filter('validateNumber')(request.discount);

                    return ( (quantity * price) + freight) - discount;
                }
            };
        }
    ]);