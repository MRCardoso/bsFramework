angular
    .module('company',[])
    .controller('CompanyController',[
        '$scope', '$routeParams', '$filter','main', 'Company',
        function ($scope, $routeParams, $filter, main, Company)
    {
        /*
         | -----------------------------------------------------------------
         | Start Factory that contains all generic methods
         | -----------------------------------------------------------------
         */
        main.init({moduleName:'company', messageDrop: ["todos os entregadores vinculados a esta empresa seram removidos."]});

        /*
         | -----------------------------------------------------------------
         | list all companies
         | -----------------------------------------------------------------
         */
        $scope.find = function()
        {
            $scope.companies = Company.query();
        };
        /*
         | -----------------------------------------------------------------
         | load a specify company when the routeParams has client param
         | -----------------------------------------------------------------
         */
        $scope.findOne = function ()
        {
            $scope.company = {status:1};
            if('company' in $routeParams)
            {
                main.findOne(Company, $routeParams, function (company)
                {
                    $scope.company = company;
                    $scope.company.start_date = $filter('date')(company.start_date,'dd/MM/yyyy');
                    $scope.company.end_date = $filter('date')(company.end_date,'dd/MM/yyyy');
                    $scope.module["id"] = company.id;
                });
            }
        };
        /*
         | -----------------------------------------------------------------
         | Create and Update a company
         | -----------------------------------------------------------------
         */
        $scope.save = function ()
        {
            var company;
            if( $scope.company.id == null)
            {
                company = new Company({
                    'name':         this.company.name,
                    'cnpj':         this.company.cnpj,
                    'address':      this.company.address,
                    'start_date':   this.company.start_date,
                    'end_date':     this.company.end_date,
                    'phone':        this.company.phone,
                    'email':        this.company.email,
                    'status':       this.company.status
                });
            }
            else
            {
                company = $scope.company;
            }
            main.save(company);
        };
        /*
         | -----------------------------------------------------------------
         | Delete a client
         | -----------------------------------------------------------------
         */
        $scope.delete = function (id)
        {
            main.remove( id, Company.get({ company: id }) );
        };
    }]);