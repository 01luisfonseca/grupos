(function(){
	'use strict';
	angular.module('escuela')
		.service('perfil',service);

	function service($http){
		var vm=this;

		// Variables
		vm.info={};

		// Funciones
		vm.buscarInfo=buscarInfo;
		vm.getInfo=getInfo;

		// Automáticas
		vm.buscarInfo();

		/////////
		function buscarInfo(){
			$http.get('/api/user').then(function(res){
				vm.info=res;
			});
		}

		function getInfo(){
			if (typeof(vm.info.data)=='undefined') {
				return false;
			}
			return vm.info.data;
		}
	}
})();