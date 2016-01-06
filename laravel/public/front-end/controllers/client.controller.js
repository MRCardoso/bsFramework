angular
    .module('client', [])
    .controller('ClientController',[
        '$scope', '$rootScope', '$routeParams', 'toastr', '$filter','main', 'Client',
        function ($scope, $rootScope, $routeParams, toastr, $filter, main, Client) {
        /*
         | -----------------------------------------------------------------
         | Start Factory that contains all generic methods
         | -----------------------------------------------------------------
         */
        main.init({moduleName:'client'});

        /*
         | -----------------------------------------------------------------
         | list all clients
         | -----------------------------------------------------------------
         */
        $scope.find = function ()
        {
            $scope.clients = Client.query();
        };
        /*
         | -----------------------------------------------------------------
         | load a specify client when the routeParams has client param
         | -----------------------------------------------------------------
         */
        $scope.findOne = function ()
        {
            $scope.client = {'status':1};
            if('client' in $routeParams)
            {
                main.findOne(Client, $routeParams, function (client)
                {
                    $scope.client = client;
                    $scope.client.birthday = $filter('date')(client.birthday, 'dd/MM/yyyy');
                    $scope.module["id"] = client.id;
                });
            }
        };
        /*
         | -----------------------------------------------------------------
         | Create and Update a client
         | -----------------------------------------------------------------
         */
        $scope.save = function ()
        {
            var client;
            if( $scope.client.id == null )
            {
                client = new Client({
                    'name':             this.client.name,
                    'phone':            this.client.phone,
                    'birthday':         this.client.birthday,
                    'address':          this.client.address,
                    'number':           this.client.number,
                    'neightborhood':    this.client.neightborhood,
                    'city':             this.client.city,
                    'reference':        this.client.reference,
                    'status':           this.client.status
                });
            }
            else
            {
                client = $scope.client;
            }
            main.save(client);
        };
        /*
         | -----------------------------------------------------------------
         | Delete a client
         | -----------------------------------------------------------------
         */
        $scope.delete = function (id)
        {
            main.remove( id, Client.get({ client: id }) );
        };
    }
]);