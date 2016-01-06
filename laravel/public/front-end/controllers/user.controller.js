angular.module('user',[])
    .controller('UserController', [
        '$scope', '$routeParams', '$filter', '$resource', '$location', 'main', 'User',
        function ($scope, $routeParams, $filter,$resource, $location, main, User)
        {
            /*
             | -----------------------------------------------------------------
             | Start Factory that contains all generic methods
             | -----------------------------------------------------------------
             */
            main.init({moduleName: 'user'});

            $scope.registers = [];
            $scope.registerForm = false;
            $scope.registerLink = false;

            /*
             | -----------------------------------------------------------------
             | list all users
             | -----------------------------------------------------------------
             */
            $scope.find = function ()
            {
                $scope.users = User.query();
            };
            /*
             | -----------------------------------------------------------------
             | verify the route to load the configuration of the appropriate
             | load a specify user when the routeParams has client param
             | create a new user post in the signup page
             | generate the list of the group according the authenticated user
             | -----------------------------------------------------------------
             */
            $scope.findOne = function()
            {
                var params = ( 'user' in $routeParams ) ? $routeParams : {user: 'create'};
                $scope.iSignup = $location.$$path=='/signup';
                $scope.user = { corporate_register: {name:'', code:''}};

                if( !$scope.iSignup )
                {
                    main.findOne(User, params, function (user)
                    {
                        var list = [];
                        $scope.user = user;
                        $scope.register();
                        $scope.module["id"] = user.id;

                        if( $scope.auth.group != "admin" )
                        {
                            if( $scope.auth.group == "company")
                                if( user.id == $scope.auth.id)
                                    list.push($scope.groups[$scope.auth.group]);
                                else
                                    list.push($scope.groups["employee"]);
                            else
                                list.push($scope.groups["employee"]);
                        }
                        else{
                            list = $scope.groups;
                        }
                        $scope.groupList = list;

                        if( !/(create|edit)/.test($location.$$path) )
                            $scope.employees = $resource("api/getEmployees").query();
                    });
                }
                else
                {
                    $scope.groupList = $scope.groups;
                }
            };

            /*
             | -----------------------------------------------------------------
             | Create(new|signup) and Update a user
             | -----------------------------------------------------------------
             */
            $scope.save = function()
            {
                var user, location, signup = $location.$$path=='/signup';
                if( $scope.user.id == null )
                {
                    user = new User({
                        "group": this.user.group,
                        "corporate_register_id": this.user.corporate_register_id,
                        "name": this.user.name,
                        "email": this.user.email,
                        "username": this.user.username,
                        "password": this.user.password,
                        "password_confirmation": this.user.password_confirmation,
                        "corporate_register": this.user.corporate_register,
                        "signup": signup
                    });
                    location = signup?'reload':undefined;
                }
                else
                {
                    user = $scope.user;
                }
                main.save(user,location);
            };
            /*
             | -----------------------------------------------------------------
             | Delete a user
             | -----------------------------------------------------------------
             */
            $scope.delete = function (id)
            {
                main.remove( id, User.get({ user: id }) );
            };

            /*
             | -----------------------------------------------------------------
             | verify in the change of the group to open the field appropriated
             | to create a new user linked to corporation
             | -----------------------------------------------------------------
             */
            $scope.register = function ()
            {
                switch ($scope.user.group)
                {
                    case "company":
                        $scope.registerForm = true;
                        $scope.registerLink = true;
                        break;
                    case "employee":
                        if( $scope.auth.group== undefined || $scope.auth.group=='admin' )
                        {
                            $scope.registerForm = false;
                            $scope.registerLink = true;
                            $scope.registers = $resource('api/corporateRegister/active').query();
                        }
                        break;
                    default :
                        $scope.registerLink = false;
                        break;
                }
            };
        }
    ]
);
