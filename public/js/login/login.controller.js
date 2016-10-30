(function(){
	'use strict';
	angular
		.module('escuela')
		.controller('loginCtrl',controller);

		function controller($location, $localStorage, AuthenticationFactory){
			var vm=this;
			vm.login={
				username:'',
				password:'',
			};
				// Funciones
			vm.loginUser=loginUser;
			vm.logoutUser=logoutUser;

			// Lanzamiento automático
			vm.logoutUser();
			
			///////////////
			function loginUser(){
				console.log('Iniciando sesión...');
				vm.loading=true;
				AuthenticationFactory.Login(vm.login, respuesta);
			}

			function respuesta(result){
				console.log(typeof($localStorage.currentUser));
                if (result === true) {
                    $location.path('/authhome');
                } else {
                    vm.error = 'Usuario o contraseña incorrectos';
                    vm.loading = false;
                }
			}

			function logoutUser(){
				console.log('Sesión cerrada.');
				AuthenticationFactory.Logout();
				console.log(typeof($localStorage.currentUser));
			}
		}
})();