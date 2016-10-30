(function(){
	'use strict';
	angular
		.module('escuela',[
			// Compartidos
			'escuela.config',
			'escuela.core',
			'ui.router',
      'ui.router.middleware',
      'ngStorage',

			// De aplicacion
			'escuela.router',
			'escuela.presentacion',
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
                            //if(OAuth.isAuthenticated()){
                                this.next();
                            /*}else{
                                this.redirectTo('login');
                            }*/
                    }],
            'redirautenticado':[function redirautenticadoMiddleware(){
                            /*if(OAuth.isAuthenticated()){
                                this.redirectTo('login');
                            }else{*/
                                this.next();
                            //}
                    }],
          });

          $urlRouterProvider.otherwise("/authhome");

          $stateProvider
            .state('login', {
                url: "/login",
                templateUrl: "/js/login/login.html",
                controller: 'loginCtrl as vm',
                middleware: 'redirautenticado'
            })
            .state('authhome', {
                url: "/authhome",
                templateUrl: "/js/authhome/authhome.html",
                middleware: 'autorizado'
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