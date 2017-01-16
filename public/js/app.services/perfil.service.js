(function(){
	'use strict';
	angular.module('app')
		.service('perfil',service);

	function service($http,$interval,AuthenticationFactory, $localStorage){
		var vm=this;

		// Variables
		vm.info={};
		vm.url='/api/perfil';

		// Funciones
		vm.buscarInfo=buscarInfo;
		vm.getInfo=getInfo;
		vm.esAdmin=esAdmin;
		vm.esSAdmin=esSAdmin;
		vm.getId=getId;
		vm.setInfo=setInfo;

		// Automáticas
		vm.buscarInfo();
		$interval(buscarInfo,5000);

		/////////
		function buscarInfo(){
			if( typeof($localStorage.currentUser)=='object'){
			$http.get(vm.url).then(function(res){
				vm.info=res;
				if(res.data.status==0){ // Cierra la sesión automáticamente si el estado es 0
					console.log('Sesión cerrada automáticamente.');
					AuthenticationFactory.Logout();
				}
			});
			}
		}

		function getInfo(){
			if (typeof(vm.info.data)=='undefined') {
				return false;
			}
			return vm.info.data;
		}

		function esAdmin(){
			if (typeof(vm.info)!='undefined') {
			if(vm.info.data.t_users_id==2 || vm.info.data.t_users_id==3){
				return true;
			}
			}
			return false;
		}

		function esSAdmin(){
			if (typeof(vm.info)!='undefined') {
			if(vm.info.data.t_users_id==2){
				return true;
			}
			}
			return false;
		}

		function getId(){
			return vm.info.data.id | 0;
		}

		function setInfo(data){
			return $http.put(vm.url,data);
		}
	}
})();