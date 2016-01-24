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
            $scope.tab = {
                pass1:true,
                pass2:false,
                pass3:false
            };

            $scope.totalValue = 0;
            $scope.messageProduct='';
            $scope.productData = {};
            $scope.product_requests = [];
            $scope.productIds = [];
            $scope.request = { status:1, freight: 0, discount: 0, products: [] };

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
                $scope.productList     = $resource('api/product/active').query();
                $scope.clients      = $resource('api/client/active').query();
                $scope.deliverymen  = $resource('api/deliveryman/active').query();
                $scope.situations = {
                    1: "Pendente",
                    2: "Em trânsito",
                    3: "Cancelado",
                    4: "Entregue"
                };
                if( 'request' in $routeParams )
                {
                    main.findOne(Request, $routeParams, function (request)
                    {
                        $scope.module["id"] = request.id;
                        $scope.request =  request;
                        angular.forEach(request.products, function(product,k){
                            $scope.request.products[k]["pivot"]["price"] = $filter('currency')(product.pivot.price,'');
                        });
                        $scope.request.request_date = $filter('date')($scope.request.request_date,'dd/MM/yyyy');
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
                        'description':      this.request.description,
                        'request_date':     this.request.request_date,
                        'freight':          this.request.freight,
                        'observation':      this.request.observation,
                        'discount':         this.request.discount,
                        'situation':        this.request.situation,
                        'products':         this.request.products
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
                $resource('api/request/productInfo',{id:this.product_request.product_id})
                    .get()
                    .$promise
                    .then(function(info){
                        $scope.product_request.price = $filter('currency')(info.cost, '');
                        $scope.productData = info;
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
                if( request.products != undefined )
                {
                    var total =0;
                    angular.forEach(request.products, function(product,k)
                    {
                        var quantity = parseInt(product.pivot.quantity) || 1;
                        total += quantity * $filter('validateNumber')(product.pivot.price);
                    });

                    if( $scope.product_request != undefined)
                    {
                        var quantity = parseInt($scope.product_request.quantity) || 1;
                        total += quantity * $filter('validateNumber')($scope.product_request.price);
                    }
                    var freight     = $filter('validateNumber')(request.freight);
                    var discount    = $filter('validateNumber')(request.discount);

                    return (total + freight) - discount;
                }
            };
            /*
             | -----------------------------------------------------------------
             | add a product in the list of the request
             | -----------------------------------------------------------------
             */
            $scope.addProduct = function()
            {
                $scope.messageProduct='';
                if( this.product_request != undefined )
                {
                    if(  this.product_request.product_id == undefined )
                    {
                        $scope.messageProduct = "você preciso selecionar um produto!";
                    }
                    else if( !(/^[0-9]{1,}$/.test(this.product_request.quantity)) )
                    {
                        $scope.messageProduct = "A  quantidade de conter um número inteiro!";
                    }
                    else if( !(/^\d*(\.\d{0,3})?(\.\d{0,3})?(\,\d{2})?$/.test(this.product_request.price)) )
                    {
                        $scope.messageProduct = "O preço deve conter um valor numérico!";
                    }
                    else
                    {
                        $scope.request.products.push({
                            name: $scope.productData.name,
                            size: $scope.productData.size,
                            pivot: {
                                product_id: this.product_request.product_id,
                                quantity: this.product_request.quantity,
                                price: this.product_request.price
                            }
                        });
                        $scope.product_request = {};
                        angular.element("#addProduct").modal('hide');
                    }
                }
                else{
                    $scope.messageProduct = "você preciso informar os dados do pedido!";
                }
            };
            /*
             | -----------------------------------------------------------------
             | remove a product in the list of the request
             | -----------------------------------------------------------------
             */
            $scope.dropProduct = function($index)
            {
                this.request.products.splice($index,1);
                this.productIds.splice($index,1);
                $scope.calculateValue();
            };
            /*
             | -----------------------------------------------------------------
             | run the next and prev tab
             | -----------------------------------------------------------------
            */
            $scope.runTab = function(index)
            {
                angular.forEach($scope.tab, function(k,tab){ $scope.tab[tab] = false; });
                $scope.tab["pass"+index] = true;
            };
        }
    ]);