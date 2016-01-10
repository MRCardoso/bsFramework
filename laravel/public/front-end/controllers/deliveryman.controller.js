angular.module('deliveryman',[])
    .controller('DeliverymanController',[
        '$scope', '$routeParams', '$filter','main', 'Deliveryman', '$resource',
        function ($scope, $routeParams, $filter, main, Deliveryman, $resource)
        {
            /*
             | -----------------------------------------------------------------
             | Start Factory that contains all generic methods
             | -----------------------------------------------------------------
             */
            main.init({moduleName: 'deliveryman'});

            $scope.comissionTypes = [
                { key: "fixed_salary", name: 'Salário fixo'},
                { key: "by_delivery", name: 'Por entrega'}
            ];
            /*
             | -----------------------------------------------------------------
             | list all deliveryman
             | -----------------------------------------------------------------
             */
            $scope.find = function()
            {
                $scope.deliverymen = Deliveryman.query();
            };
            /*
             | -----------------------------------------------------------------
             | load a specify company when the routeParams has client param
             | -----------------------------------------------------------------
             */
            $scope.findOne = function()
            {
                $scope.deliveryman = {status:1};
                $scope.companies = $resource('api/company/active').query();
                if( 'deliveryman' in $routeParams )
                {
                    main.findOne(Deliveryman, $routeParams, function (deliveryman)
                    {
                        $scope.deliveryman = deliveryman;
                        $scope.deliveryman.cellphone = $filter('phone')($scope.deliveryman.cellphone);
                        $scope.deliveryman.salary_value = $filter('currency')($scope.deliveryman.salary_value, '');
                        $scope.module["id"] = deliveryman.id;
                    });
                }
            };
            /*
             | -----------------------------------------------------------------
             | Create and Update a company
             | -----------------------------------------------------------------
             */
            $scope.save = function()
            {
                var deliveryman;
                if( $scope.deliveryman.id == null )
                {
                    deliveryman = new Deliveryman({
                        'company_id':   this.deliveryman.company_id,
                        'name':         this.deliveryman.name,
                        'cpf':          this.deliveryman.cpf,
                        'rg':           this.deliveryman.rg,
                        'cellphone':    this.deliveryman.cellphone,
                        'status':       this.deliveryman.status,
                        'salary_type':  this.deliveryman.salary_type,
                        'salary_value': this.deliveryman.salary_value
                    });
                }
                else
                {
                    deliveryman = $scope.deliveryman;
                }
                main.save(deliveryman);
            };
            /*
             | -----------------------------------------------------------------
             | Delete a deliveryman
             | -----------------------------------------------------------------
             */
            $scope.delete = function(id)
            {
                main.remove( id, Deliveryman.get({ deliveryman: id }) );
            };
        }
    ]
);
