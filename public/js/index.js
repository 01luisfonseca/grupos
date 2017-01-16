(function(){
	'use strict';
	angular
		.module('app',[
			// Compartidos
			'ngAnimate',
      'app.config',
			'app.core',
			'ui.router',
      'ui.router.middleware',
      'ngStorage',

			// De aplicacion
			'app.router',
			'app.presentacion',
		])
		.config(config)
		.run(run);

    ////////////////
    function config($stateProvider, $urlRouterProvider, $middlewareProvider){

        $middlewareProvider.map({
            'nobody':[function nobodyMiddleware(){
                            // Bloqueado
                    }],
            'everyone':[function everyoneMiddleware(){
                          this.next();
                    }],
            'autorizado':[function autorizadoMiddleware(){
                          this.next();
                    }],
            'redirautenticado':[function redirautenticadoMiddleware(){
                          this.next();
                    }],
          });

          $urlRouterProvider.otherwise("/authhome");

          $stateProvider
            .state('login', {
                url: "/login",
                 middleware: 'redirautenticado',
                views:{
                    'body':{
                        templateUrl: "/js/login/login.html",
                        controller: 'loginCtrl as vm',
                    }
                }               
            })
            .state('authhome', {
                url: "/authhome",
                middleware: 'autorizado',
                views:{
                    'menu':{
                        template:'<div menu-dir></div>'
                    },
                    'body':{
                        templateUrl: "/js/authhome/authhome.html",
                        controller: 'authHomeCtrl as vm',
                    }
                }
            })
            .state('users', {
                url: "/users",
                middleware: 'autorizado',   
                views:{
                    'menu':{
                        template:'<div menu-dir></div>'
                    },
                    'body':{
                        templateUrl: "/js/users/users.html",
                        controller: 'UsersCtrl as vm',
                    }
                }
            })
            .state('profile', {
                url: "/profile",
                middleware: 'autorizado',   
                views:{
                    'menu':{
                        template:'<div menu-dir></div>'
                    },
                    'body':{
                        templateUrl: "/js/users/profile.html",
                        controller: 'profileCtrl as vm',
                    }
                }
            })
            .state('userinfo', {
                url: "/users/{id}",
                middleware: 'autorizado',   
                views:{
                    'menu':{
                        template:'<div menu-dir></div>'
                    },
                    'body':{
                        templateUrl: "/js/users/userinfo.html",
                        controller: 'UserInfoCtrl as vm',
                    }
                }
            })
            .state('options', {
                url: "/options",
                middleware: 'autorizado',   
                views:{
                    'menu':{
                        template:'<div menu-dir></div>'
                    },
                    'body':{
                        templateUrl: "/js/options/options.html",
                        controller: 'OptCtrl as vm',
                    }
                }
            });
    }

    function run($rootScope, $http, $location, $localStorage) {
        // keep user logged in after page refresh
        if ($localStorage.currentUser) {
            $http.defaults.headers.common.Authorization = 'Bearer ' + $localStorage.currentUser.access_token;
        }

        // redirect to login page if not logged in and trying to access a restricted page
        $rootScope.$on('$locationChangeStart', function (event, next, current) {
            var publicPages = ['/login'];
            var restrictedPage = publicPages.indexOf($location.path()) === -1;
            if (restrictedPage && !$localStorage.currentUser) {
                $location.path('/login');
            }
        });
    }
})();