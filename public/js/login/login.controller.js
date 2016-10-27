(function(){
	'use strict';
	angular
		.module('escuela')
		.controller('loginCtrl',controller);

		function controller(OAuth){
			var vm=this;
			vm.login={
				username:'',
				password:'',
			};
				// Funciones
			vm.loginUser=loginUser;
			vm.logoutUser=logoutUser;
			
			///////////////
			function loginUser(){
				console.log(vm.login);
				OAuth.getAccessToken(vm.login); // Arreglar la validacion y el acceso a las rutas despues del login
				console.log(OAuth.isAuthenticated());
			}

			function logoutUser(){
				console.log('Sesión cerrada.');
				OAuth.revokeToken();
			}
		}
})();