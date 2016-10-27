(function(){
	'use strict';
	angular
		.module('escuela',[
			// Compartidos
			'escuela.config',
			'escuela.core',
			'angular-oauth2',
			'ui.router',
            'ui.router.middleware',

			// De aplicacion
			'escuela.router',
			'escuela.presentacion',
		])

		.config([
			'OAuthProvider', // Arreglar la validacion y el acceso a las rutas despues del login
			'$stateProvider', 
			'$urlRouterProvider', 
			'$middlewareProvider', 
		function(OAuthProvider,$stateProvider, $urlRouterProvider, $middlewareProvider) {
			OAuthProvider.configure({
      			baseUrl: '/',
      			clientId: '2',
      			clientSecret: 'c5xrJb6hZv1gco95BQAoavOXqO4V9QoYbpWCIB7w',
      			grantPath: '/oauth/token',
  				revokePath: '/oauth/revoke'
    		});

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

	        $urlRouterProvider.otherwise("/login");

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
			}])

		.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth) {
    		$rootScope.$on('oauth:error', function(event, rejection) {
      		// Ignore `invalid_grant` error - should be catched on `LoginController`.
      		if ('invalid_grant' === rejection.data.error) {
        		return;
      		}

      		// Refresh token when a `invalid_token` error occurs.
      		if ('invalid_token' === rejection.data.error) {
        		return OAuth.getRefreshToken();
      		}

      		// Redirect to `/login` with the `error_reason`.
      		return $window.location.href = '/login?error_reason=' + rejection.data.error;
    	});
  	}]);
})();